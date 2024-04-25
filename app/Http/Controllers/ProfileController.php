<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Events\LogEvent;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('scaffolds.profiles.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function changePassword()
    {
        return view('scaffolds.profiles.password');
    }

    /**
     * Display a listing of the resource.
     */
    public function changeProfile()
    {
        return view('scaffolds.profiles.profile');
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            toast('Something went wrong!', 'error');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            User::where('id', auth()->user()->id)
                ->update(['password' => Hash::make($request->password)]);

            event(new LogEvent(auth()->user()->id, 'password-update', auth()->user()->id));

            toast('Password successfully updated!', 'success');
            return redirect()->route('profiles.change.password');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            toast('Something went wrong!', 'error');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            User::where('id', auth()->user()->id)
                ->update([
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'address' => $request->address,
                ]);

            event(new LogEvent(auth()->user()->id, 'profile-update', auth()->user()->id));

            toast('Address successfully updated!', 'success');
            return redirect()->route('profiles.change.profile');
        }
    }
}
