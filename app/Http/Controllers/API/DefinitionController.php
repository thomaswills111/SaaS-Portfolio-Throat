<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoredefinitionRequest;
use App\Http\Requests\UpdatedefinitionRequest;
use App\Http\Resources\definitionCollection;
use App\Http\Resources\definitionResource;
use App\Models\definition;
use App\Models\Rating;
use Illuminate\Http\Request;

class DefinitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $itemNum = $request->perPage;
        $search = $request->search;

        if ($search) {
            $definitions = definition::query()
                ->where('definition', 'LIKE', "%{$search}%")
                ->paginate($itemNum ?? 10);

            return new definitionCollection($definitions->appends($request->query()));
        }

        $definitions = definition::paginate($itemNum ?? 10);
        return new definitionCollection($definitions->append($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoredefinitionRequest $request)
    {
        return new definitionResource(definition::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(definition $definition)
    {
        return new definitionResource($definition);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatedefinitionRequest $request, definition $definition)
    {
        $definition->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(definition $definition)
    {
        $definition->delete();
    }

    public function addRating(Definition $definition, Request $request)
    {
        $ratings = Rating::all();
        $rating = $ratings->firstWhere('id', $request['rating_id']);

        $definition->ratings()->attach([$rating['id'] => ['value' => $rating['stars']]]);

    }

    public function updateRating(Definition $definition, Rating $rating, Request $request)
    {
        $definition->ratings()->detach([$rating['id']]);
        $ratings = Rating::all();
        $rating = $ratings->firstWhere('id', $request['rating_id']);
        $definition->ratings()->attach([$rating['id'] => ['value' => $rating['stars']]]);
    }

    public function removeRating(Definition $definition, Rating $rating)
    {
        $definition->ratings()->detach([$rating['id']]);
    }
}
