<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Events\LogEvent;
use App\Models\Category;
use App\Models\Borrowing;
use App\Models\Publisher;
use Illuminate\Http\Request;
use App\DataTables\BooksDataTable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BooksDataTable $dataTable)
    {
        return $dataTable->render('scaffolds.books.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $publishers = Publisher::all();
        $categories = Category::all();

        return view('scaffolds.books.create', compact('publishers', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:pdf,epub',
            'cover' => 'required|file|mimes:png,jpg',
            'title' => 'required',
            'writer' => 'required',
            'publisher' => 'required',
            'category' => 'required',
            'desc' => 'required',
            'year' => 'required|numeric',
            'isbn' => 'nullable|min:13|max:13',
            'book_count' => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            toast('Something went wrong!', 'error');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $new_data = Book::create([
                'title' => $request->title,
                'writer' => $request->writer,
                'publisher_id' => $request->publisher,
                'category_id' => $request->category,
                'desc' => $request->desc,
                'year' => $request->year,
                'book_count' => $request->book_count
            ]);

            if ($request->file('file')) {
                $request->file('file')->move(storage_path('app/public/storage/files'), 'book-' . Carbon::now()->format('Y-m-d-His') . '.' . $request->file('file')->getClientOriginalExtension());
                Book::where('id', $new_data->id)->update(['file_name' => 'book-' . Carbon::now()->format('Y-m-d-His') . '.' . $request->file('file')->getClientOriginalExtension()]);
            }

            if ($request->file('cover')) {
                $request->file('cover')->move(storage_path('app/public/storage/covers'), 'cover-' . Carbon::now()->format('Y-m-d-His') . '.png');
                Book::where('id', $new_data->id)->update(['cover' => 'cover-' . Carbon::now()->format('Y-m-d-His') . '.png']);
            }

            event(new LogEvent(auth()->user()->id, 'book-create', $new_data->id));

            toast('Data successfully created!', 'success');
            return redirect()->route('books.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $data = $book;

        return view('scaffolds.books.view', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $data = $book;
        $publishers = Publisher::all();
        $categories = Category::all(); 

        return view('scaffolds.books.edit', compact('data', 'publishers', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'nullable|file|mimes:pdf,epub',
            'cover' => 'nullable|file|mimes:png,jpg',
            'title' => 'required',
            'writer' => 'required',
            'publisher' => 'required',
            'category' => 'required',
            'desc' => 'required',
            'year' => 'required|numeric',
            'isbn' => 'nullable|min:13|max:13',
            'book_count' => 'required|numeric'
        ]);

        $borrowed = Borrowing::where([
            ['book_id', '=', $book->id],
            ['status', '=', 'B'],
        ])->count();

        if (($request->book_count - $borrowed) < 0) {
            toast('Something went wrong!', 'error');
            return redirect()->back()->with('cnt_sml', 'The total books are less than zero!');
        }

        if ($validator->fails()) {
            toast('Something went wrong!', 'error');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $book->update([
                'title' => $request->title,
                'writer' => $request->writer,
                'publisher_id' => $request->publisher,
                'category_id' => $request->category,
                'desc' => $request->desc,
                'year' => $request->year,
                'book_count' => $request->book_count
            ]);

            if ($request->file('file')) {
                if ($request->old_file) {
                    Storage::delete('public/storage/files/' . $request->old_file);
                }
                $request->file('file')->move(storage_path('app/public/storage/files'), 'file-' . Carbon::now()->format('Y-m-d-His') . '.png');
                $book->update(['file_name' => 'file-' . Carbon::now()->format('Y-m-d-His') . $request->file('file')->getClientOriginalExtension()]);
            }

            if ($request->file('cover')) {
                if ($request->old_cover) {
                    Storage::delete('public/storage/covers/' . $request->old_cover);
                }
                $request->file('cover')->move(storage_path('app/public/storage/covers'), 'cover-' . Carbon::now()->format('Y-m-d-His') . '.png');
                $book->update(['cover' => 'cover-' . Carbon::now()->format('Y-m-d-His') . '.png']);
            }

            event(new LogEvent(auth()->user()->id, 'book-update', $book->id));

            toast('Data successfully updated!', 'success');
            return redirect()->route('books.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        
        $change = $book->is_active == 0 ? true : false;

        $book->update([
            'is_active' => $change
        ]);

        event(new LogEvent(auth()->user()->id, 'book-delete', $book->id));

        toast('Data deleted successfully!', 'success');
        return redirect()->route('books.index');
    }
}
