<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Events\LogEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
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
        $validator = Validator::make($request->all(), [
            'book_id' => 'required',
            'star_rating' => 'required',
        ]);

        if ($validator->fails()) {
            toast('Something went wrong!', 'error');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $review = Review::create([
                'book_id' => $request->book_id,
                'user_id' => auth()->user()->id,
                'comments' => $request->comments ?? null,
                'star_rating' => $request->star_rating,
            ]);

            event(new LogEvent(auth()->user()->id, 'review-download', $review->id));

            toast('Review successfully posted!', 'success');
            return redirect()->route('reads.show', $request->book_id);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
