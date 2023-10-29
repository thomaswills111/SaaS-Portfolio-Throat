<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWordTypeRequest;
use App\Http\Requests\UpdateWordTypeRequest;
use App\Http\Resources\WordTypeCollection;
use App\Http\Resources\WordTypeResource;
use App\Models\WordType;
use Illuminate\Http\Request;

class WordTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $itemNum = $request->perPage;
        $search = $request->search;

        if ($search) {
            $wordTypes = WordType::query()
                ->where('name', 'LIKE', "%{$search}%")
                ->paginate($itemNum ?? 10);

            return new WordTypeCollection($wordTypes->appends($request->query()));
        }

        $wordTypes = WordType::paginate($itemNum ?? 10);
        return new WordTypeCollection($wordTypes->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWordTypeRequest $request)
    {
        return new WordTypeResource(WordType::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(WordType $wordType)
    {
        return new WordTypeResource($wordType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWordTypeRequest $request, WordType $wordType)
    {
        $wordType->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WordType $wordType)
    {
        $wordType->delete();
    }
}
