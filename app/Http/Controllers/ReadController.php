<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Role;
use App\Models\Review;
use App\Events\LogEvent;
use App\Models\Bookshelf;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $read)
    {
        $data = $read;
        $reviews = Review::where('book_id', $read->id)->get();
        if (auth()->check()) {
            $brw_books = Borrowing::where([
                ['book_id', '=', $read->id],
                ['status', '=', 'B'],
            ])->count();
            $borrowed = Borrowing::where([
                ['user_id', '=', auth()->user()->id],
                ['book_id', '=', $read->id],
                ['status', '=', 'B'],
            ])->first();
            $is_reading = Bookshelf::where([
                ['user_id', '=', auth()->user()->id],
                ['book_id', '=', $read->id],
                ['status', '=', 'R'],
            ])->first();
            $is_shelved = Bookshelf::where([
                ['user_id', '=', auth()->user()->id],
                ['book_id', '=', $read->id],
            ])->first();
            return view('scaffolds.reads.view', compact('data', 'reviews', 'brw_books', 'borrowed', 'is_shelved', 'is_reading'));
        }
        return view('scaffolds.reads.view', compact('data', 'reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $read)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $read)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $read)
    {
        //
    }

    /**
     * Read the specified resources from storage.
     */
    public function borrow($read)
    {
        if (auth()->user()->address == null || auth()->user()->phone == null) {

            toast('Please complete your data first!', 'error');
            return redirect()->route('profiles.change.profile');
        }

        Borrowing::create([
            'user_id' => auth()->user()->id,
            'book_id' => $read,
            'borrow_date' => Carbon::today(),
            'return_date' => Carbon::today()->addDays(7),
            'status' => 'B',
        ]);

        event(new LogEvent(auth()->user()->id, 'read-borrow', $read));

        toast('Book Successfully Borrowed!', 'success');
        return redirect()->route('reads.show', $read);
    }

    /**
     * Read the specified resources from storage.
     */
    public function read(Book $read)
    {
        $type = pathinfo($read->file_name);

        $book = Bookshelf::where([
            ['book_id', '=', $read->id],
            ['user_id', '=', auth()->user()->id],
        ]);

        $book_status = $book->where('status', 'L');

        if ($book_status->first()) {
            $book->update(['status' => 'R']);
        } else if (!$book->first()) {
            $book->create([
                'book_id' => $read->id,
                'user_id' => auth()->user()->id,
                'status' => 'R',
            ]);
        }

        event(new LogEvent(auth()->user()->id, 'read-open', $read->id));

        if ($type['extension'] == 'pdf') {
            return view('scaffolds.reads.pdf', compact('read'));
        } else {
            return view('scaffolds.reads.epub', compact('read'));
        }
    }

    /**
     * Read the specified resources from storage.
     */
    public function later($read)
    {
        Bookshelf::create([
            'book_id' => $read,
            'user_id' => auth()->user()->id,
            'status' => 'L',
        ]);

        event(new LogEvent(auth()->user()->id, 'read-later', $read));

        return redirect()->route('reads.show', $read);
    }

    /**
     * Read the specified resources from storage.
     */
    public function finish(Book $read)
    {
        $read->update(['status' => 'F']);

        event(new LogEvent(auth()->user()->id, 'read-finish', $read->id));

        return response()->json(['message' => 'success!']);
    }

    /**
     * Read the specified resources from storage.
     */
    public function download($read)
    {
        $file = public_path('storage/storage/files/' . $read);
        event(new LogEvent(auth()->user()->id, 'read-download', 0));
        return response()->download($file);
    }
}
