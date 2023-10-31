<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWordRequest;
use App\Http\Requests\UpdateWordRequest;
use App\Http\Resources\WordCollection;
use App\Http\Resources\WordResource;
use App\Models\Word;
use Illuminate\Http\Request;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $itemNum = $request->perPage;
        $search = $request->search;

        if ($search) {
            $words = Word::query()
                ->where('word', 'LIKE', "%{$search}%");
                // ->paginate($itemNum ?? 10);

            $words = $words->with('definitions');
            return new WordCollection($words->paginate($itemNum ?? 10)->appends($request->query()));
        }

        $words = Word::paginate($itemNum ?? 10);
        $words = $words->loadMissing('definitions');
        return new WordCollection($words->append($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWordRequest $request)
    {
        return new WordResource(Word::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Word $word)
    {
        return new WordResource($word->loadMissing('definitions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWordRequest $request, Word $word)
    {
        $word->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Word $word)
    {
        $word->delete();
    }
}
