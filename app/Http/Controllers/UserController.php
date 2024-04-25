<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Events\LogEvent;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\DataTables\UsersDataTable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('scaffolds.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('scaffolds.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users,name',
            'role' => 'required',
            'email' => 'required|unique:users,email',
            'password' => ['required', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            toast('Something went wrong!', 'error');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'address' => $request->address ?? null,
                'phone' => $request->phone ?? null
            ])->addRole($request->role);

            // event(new LogEvent(auth()->user()->id, 'user-create', $user->id));

            toast('Data created successfully!', 'success');
            return redirect()->route('users.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $data = $user;

        return view('scaffolds.users.view', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $data = $user;

        if ($user->hasRole('admin')) {
            $role = 'admin';
        } else if ($user->hasRole('employee')) {
            $role = 'employee';
        } else {
            $role = 'user';
        }

        return view('scaffolds.users.edit', compact('data', 'role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            toast('Something went wrong!', 'error');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $user->update([
                'name' => $request->name,
                'address' => $request->address ?? null,
                'phone' => $request->phone ?? null
            ]);

            if ($request->password) {
                $user->update(['password' => $request->password]);
            }

            if ($request->role) {
                if ($user->hasRole('admin')) {
                    $role = 'admin';
                } else if ($user->hasRole('employee')) {
                    $role = 'employee';
                } else {
                    $role = 'user';
                }

                $user->removeRole($role);
                $user->addRole($request->role);
            }

            // event(new LogEvent(auth()->user()->id, 'user-update', $user->id));

            toast('Data updated successfully!', 'success');
            return redirect()->route('users.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        event(new LogEvent(auth()->user()->id, 'user-delete', $user->id));

        toast('Data deleted successfully!', 'success');
        return redirect()->route('users.index');
    }
}
