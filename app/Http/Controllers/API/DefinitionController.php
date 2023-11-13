<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoredefinitionRequest;
use App\Http\Requests\UpdatedefinitionRequest;
use App\Http\Resources\definitionCollection;
use App\Http\Resources\definitionResource;
use App\Models\definition;
use App\Models\DefinitionRating;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DefinitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $itemNum = $request->perPage;
        $search = $request->search;
        $userId = $request->userId;
        $myDefinitions = $request->myDefinitions;

        if ($search) {
            $definitions = definition::query()
                ->where('definition', 'LIKE', "%{$search}%")
                ->paginate($itemNum ?? 10);

            return new definitionCollection($definitions->appends($request->query()));
        }

        if ($userId) {
            $definitions = definition::query()
                ->where('user_id', 'LIKE', $userId)
                ->paginate($itemNum ?? 10);

            return new definitionCollection($definitions->appends($request->query()));
        }

        if ($myDefinitions) {
            $user = auth('sanctum')->user();
            $definitions = definition::query()
                ->where('user_id', 'LIKE', $user->id)
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
        $user = auth('sanctum')->user();

        if ($user->hasRole('admin|staff')) {
            $definition->update($request->all());

            return response()->json([
                'message' => 'Updated definition successfully'
            ], 200);
        }
        if ($definition->user_id != $user->id) {
            return response()->json([
                'message' => 'Unauthorised'
            ], 403);
        }

        $definition->update($request->all());

        return response()->json([
            'message' => 'Updated definition successfully'
        ], 200);
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

        return response()->json([
            'message' => 'Updated rating'
        ], 200);

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
        $user = auth('sanctum')->user();

        $definitionRatings = DefinitionRating::all();
        $userDefinitionRating = $definitionRatings
            ->where('definition_id', $definition['id'])
            ->where('user_id', $user->id)
            ->first();

        if ($user->hasRole('admin') || $user->id == $userDefinitionRating->id) {
            $definition->ratings()->detach([$rating['id']]);

            return response()->json([
                'message' => 'Deleted the rating of the definition successfully'
            ], 200);
        }

        return response()->json([
            'message' => 'Unauthorised'
        ], 403);
    }
}
