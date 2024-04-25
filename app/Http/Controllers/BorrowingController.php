<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Events\LogEvent;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use App\DataTables\BorrowingsDataTable;
use Illuminate\Support\Facades\Validator;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BorrowingsDataTable $dataTable)
    {
        return $dataTable->render('scaffolds.borrowings.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book' => 'required',
            'date' => 'required',
        ]);

        $dates = explode(' - ', $request->date);

        if ($validator->fails()) {
            toast('Something went wrong!', 'error');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $book = Book::where('id', $request->book);
            $book_count = $book->select('book_count')->first();
            $book->update(['book_count' => --$book_count->book_count]);

            $borrowing = Borrowing::create([
                'user_id' => auth()->user()->id,
                'book_id' => $request->book,
                'borrow_date' => Carbon::parse($dates[0])->format('Y-m-d H:i:s'),
                'return_date' => Carbon::parse($dates[1])->format('Y-m-d H:i:s'),
                'status' => 'B',
            ]);

            event(new LogEvent(auth()->user()->id, 'borrowing-create', $borrowing->id));

            toast('Data successfully created!', 'success');
            return redirect()->route('borrowings.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Borrowing $borrowing)
    {
        $data = $borrowing;

        return view('scaffolds.borrowings.view', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Borrowing $borrowing)
    {
        return view('scaffolds.borrowings.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Borrowing $borrowing)
    {
        $validator = Validator::make($request->all(), [
            'book' => 'required',
            'date' => 'required',
            'status' => 'required',
        ]);

        $dates = explode(' - ', $request->date);

        if ($validator->fails()) {
            toast('Something went wrong!', 'error');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $borrowing->update([
                'book_id' => $request->book,
                'borrow_date' => Carbon::parse($dates[0])->format('Y-m-d H:i:s'),
                'return_date' => Carbon::parse($dates[1])->format('Y-m-d H:i:s'),
                'status' => $request->status,
            ]);

            event(new LogEvent(auth()->user()->id, 'borrowing-update', $borrowing->id));

            toast('Data successfully created!', 'success');
            return redirect()->route('borrowings.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrowing $borrowing)
    {
        $borrowing->update(['status' => 'R']);

        event(new LogEvent(auth()->user()->id, 'borrowing-update', $borrowing->id));

        toast('Status updated successfully', 'success');
        return redirect()->route('borrowings.index');
    }
}
