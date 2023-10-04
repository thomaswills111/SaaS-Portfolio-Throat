<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ratings = Rating::paginate(5);
        return view('ratings.index', compact(['ratings']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ratings.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRatingRequest $request)
    {
        $details = $request->validated(); // Goes to error page if not validated
        $rating = Rating::create($details);
        return redirect(route('ratings.index'))
            ->with('created', $rating->name)
            ->with('messages', ['created', true]); // inserting the rating's name into a new variable named 'created'
    }

    /**
     * Display the specified resource.
     *
     * show(Rating $rating) is Route-Model Binding
     * retrieves the $rating from the Rating Model and returns its content or fails(404)
     */
    public function show(Rating $rating)
    {
        dd($rating);
        return view('ratings.show', compact(['rating']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rating $rating)
    {
        return view('ratings.edit', compact(['rating']));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRatingRequest $request, Rating $rating)
    {
        $id = $rating->id;
        $validated = $request->validated();
        $rating->update($validated);

        return redirect(route('ratings.index'))
            ->with('updated', $rating->name)
            ->with('messageType', ['updated', true]);

    }

    public function delete(Rating $rating) {

        return view('ratings.delete', compact(['rating']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        $oldRating = $rating;
        $rating->delete();
        return redirect(route('ratings.index'))->with('deleted', $oldRating->name);
    }
}
