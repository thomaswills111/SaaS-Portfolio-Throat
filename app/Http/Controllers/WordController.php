<?php

namespace App\Http\Controllers;

use App\Models\Word;
use App\Http\Requests\StoreWordRequest;
use App\Http\Requests\UpdateWordRequest;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $words = Word::paginate(5);
        return view('words.index', compact(['words']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('words.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWordRequest $request)
    {
        $details = $request->validated(); // Goes to error page if not validated
        $word = Word::create($details);
        return redirect(route('words.index'))
            ->with('created', $word->word)
            ->with('messages', ['created', true]); // inserting the rating's name into a new variable named 'created'
    }

    /**
     * Display the specified resource.
     *
     * show(Rating $rating) is Route-Model Binding
     * retrieves the $rating from the Rating Model and returns its content or fails(404)
     */
    public function show(Word $word)
    {
        return view('words.show', compact(['word']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Word $word)
    {
        return view('words.edit', compact(['word']));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWordRequest $request, Word $word)
    {
        $validated = $request->validated();
        $word->update($validated);

        return redirect(route('words.index'))
            ->with('updated', $word->word)
            ->with('messageType', ['updated', true]);

    }

    public function delete(Word $word) {

        return view('words.delete', compact(['word']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Word $word)
    {
        $oldWord = $word;
        $word->delete();
        return redirect(route('words.index'))->with('deleted', $oldWord->word);
    }
}
