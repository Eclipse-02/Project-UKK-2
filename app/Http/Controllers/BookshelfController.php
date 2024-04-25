<?php

namespace App\Http\Controllers;

use App\Events\LogEvent;
use App\Models\Bookshelf;
use Illuminate\Http\Request;
use App\DataTables\BookshelvesDataTable;

class BookshelfController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BookshelvesDataTable $dataTable)
    {
        return $dataTable->render('scaffolds.bookshelves.index');
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
        $bookshelf = Bookshelf::create([
            'book_id' => $request->book_id,
            'user_id' => auth()->user()->id,
            'status' => 'L'
        ]);

        event(new LogEvent(auth()->user()->id, 'bookshelf-create', $bookshelf->id));

        toast('Book stored successfully!', 'success');
        return response()->json(['message' => 'Success!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Bookshelf $bookshelf)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bookshelf $bookshelf)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bookshelf $bookshelf)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bookshelf $bookshelf)
    {
        //
    }
}
