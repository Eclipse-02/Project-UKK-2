<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $notifications = Borrowing::where([
            ['user_id', '=', auth()->user()->id],
            ['status', '=', 'B'],
        ])->get();

        $admin_notifications = Borrowing::where('status', 'B')->get();

        $histories = Borrowing::where([
            ['user_id', '=', auth()->user()->id],
        ])->get();

        $borrowed = Borrowing::where('status', 'B')->count();

        $phy_book = Book::select('book_count')->sum('book_count');

        $upl_book = Book::count();


        return view('home', compact('notifications', 'admin_notifications', 'histories', 'borrowed', 'phy_book', 'upl_book'));
    }
}
