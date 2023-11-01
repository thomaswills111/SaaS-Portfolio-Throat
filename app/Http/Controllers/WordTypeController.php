<?php

namespace App\Http\Controllers;

use App\Models\WordType;
use App\Http\Requests\StoreWordTypeRequest;
use App\Http\Requests\UpdateWordTypeRequest;

class WordTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wordTypes = WordType::paginate(5);
        return view('wordTypes.index', compact(['wordTypes']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('wordTypes.add');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWordTypeRequest $request)
    {
        $details = $request->validated(); // Goes to error page if not validated
        $wordType = WordType::create($details);
        return redirect(route('wordTypes.index'))
            ->with('created', $wordType->name)
            ->with('messages', ['created', true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(WordType $wordType)
    {
        return view('wordTypes.show', compact(['wordType']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WordType $wordType)
    {
        return view('wordTypes.edit', compact(['wordType']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWordTypeRequest $request, WordType $wordType)
    {
        $id = $wordType->id;
        $validated = $request->validated();
        $wordType->update($validated);

        return redirect(route('wordTypes.index'))
            ->with('updated', $wordType->name)
            ->with('messageType', ['updated', true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(WordType $wordType) {

        return view('wordTypes.delete', compact(['wordType']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WordType $wordType)
    {
        $oldWordType = $wordType;
        $wordType->delete();

        $definitions = $wordType->definitions;
        foreach($definitions as $definition) {
            $unknownWordType = WordType::firstOrCreate(['name' => 'Unknown', 'code' => 'UK']);
            $definition->update(['word_type_id'=>$unknownWordType->id]);
        }

        return redirect(route('wordTypes.index'))->with('deleted', $oldWordType->name);
    }
}
