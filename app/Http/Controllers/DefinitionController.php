<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRatingRequest;
use App\Models\Definition;
use App\Http\Requests\StoreDefinitionRequest;
use App\Http\Requests\UpdateDefinitionRequest;
use App\Models\DefinitionRating;
use App\Models\Rating;
use App\Models\User;
use App\Models\Word;
use App\Models\WordType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Null_;
use function Laravel\Prompts\error;

class DefinitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $definitions = Definition::paginate(5);
        return view('definitions.index', compact(['definitions']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Word $word = Null)
    {
        return view('definitions.add', compact(['word']));

    }

    public function rate(Definition $definition)
    {

        $ratings = Rating::all();
        return view('definitions.rate', (['definition' => $definition, 'ratings' => $ratings]));
    }

    public function storeDefinitionRating(Definition $definition, Rating $rating)
    {
        $id = Auth::id();

        $definitionRatings = DefinitionRating::all();


        $userDefinitionRating = $definitionRatings
            ->where('definition_id', $definition['id'])
            ->where('user_id', $id)
            ->first();

        if ($userDefinitionRating) {
            $definition->ratings()->detach($userDefinitionRating['rating_id']);
        }

        $definition->ratings()->attach([$rating['id'] => ['value' => $rating['stars'], 'user_id' => $id]]);

        return redirect(route('definitions.index'))
            ->with('rated', $definition->word->word)
            ->with('messages', ['created', true]);
    }

    public function removeDefinitionRating(Definition $definition)
    {
        $id = Auth::id();

        $definitionRatings = DefinitionRating::all();

        $userDefinitionRating = $definitionRatings
            ->where('definition_id', $definition['id'])
            ->where('user_id', $id)
            ->first();

        if ($userDefinitionRating) {
            $definition->ratings()->detach($userDefinitionRating['rating_id']);
        }
        else {
            return redirect(route('definitions.index'))
                ->with('noRating', $definition)
                ->with('messages', ['noRating', true]);
        }

        return redirect(route('definitions.index'))
            ->with('unrated', $definition)
            ->with('messages', ['unrated', true]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDefinitionRequest $request)
    {
        $id = Auth::id();

        $data = $request->validated();

        $wordTypes = WordType::all();
        $wordType = $wordTypes->firstWhere('name', $data['word_type']);


        // create the word_type if it doesn't exist
        if (is_null($wordType)) {
            $detailsWordType = $data['word_type'];
            $swLength = Str::length($detailsWordType);
            $codeExists = true;
            $codeLetters = Str::substr($detailsWordType, 0, 2);
            $firstLetter = 0;
            $secondLetter = 0;
            while ($codeExists && $firstLetter < ($swLength - 1)) {
                $secondLetter = 1;
                while ($codeExists && $secondLetter < $swLength) {
                    $codeLetters = Str::substr($detailsWordType, $firstLetter, 1) . Str::substr($detailsWordType, $secondLetter, 1);
                    $codeExists = WordType::where('code', '=', $codeLetters)->get()->count() ?? false;
                    $secondLetter++;
                }
                $firstLetter++;
            }

            $wordType = WordType::create([
                'code' => Str::upper($codeLetters),
                'name' => $data['word_type'],
            ]);

            $data['word_type_id'] = $wordType['id'];
        }

        // Create the word if it does not exist
        $newWord = [
            'word' => $data['word'],
        ];

        $word = Word::firstWhere('word', $data['word']);
        if (is_null($word)) {
            $word = Word::create($newWord);
            //$this->command->line("  - Created new word: {$wordType->word}", 'comment');
        }

        $words = Word::all();
        $word = $words->firstWhere('word', $data['word']);
        $details['word_id'] = $word['id'];

        $details['definition'] = $data['definition'];


        $wordTypes = WordType::all();
        $wordType = $wordTypes->firstWhere('name', $data['word_type']);
        $details['word_type_id'] = $wordType['id'];

        $details['appropriate'] = true;
        $details['user_id'] = $id;

        $definition = Definition::create($details);
        return redirect(route('definitions.index'))
            ->with('created', $definition->word->word)
            ->with('messages', ['created', true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Definition $definition)
    {
        return view('definitions.show', compact(['definition']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Definition $definition)
    {
        $user = Auth::user();
        if ($definition->user_id == $user->id || $user->hasAnyRole('staff', 'admin')) {
            if ($definition->user->hasRole('admin') && $user->hasRole('staff')) {
                abort(403, 'This belongs to an admin');
            }
            return view('definitions.edit', compact(['definition']));
        }
        abort(403, 'This is not your definition');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDefinitionRequest $request, Definition $definition)
    {
        $user = Auth::user();

        $data = $request->validated();

        $wordTypes = WordType::all();
        $wordType = $wordTypes->firstWhere('name', $data['word_type']);


        // create the word_type if it doesn't exist
        if (is_null($wordType)) {
            $detailsWordType = $data['word_type'];
            $swLength = Str::length($detailsWordType);
            $codeExists = true;
            $codeLetters = Str::substr($detailsWordType, 0, 2);
            $firstLetter = 0;
            $secondLetter = 0;
            while ($codeExists && $firstLetter < ($swLength - 1)) {
                $secondLetter = 1;
                while ($codeExists && $secondLetter < $swLength) {
                    $codeLetters = Str::substr($detailsWordType, $firstLetter, 1) . Str::substr($detailsWordType, $secondLetter, 1);
                    $codeExists = WordType::where('code', '=', $codeLetters)->get()->count() ?? false;
                    $secondLetter++;
                }
                $firstLetter++;
            }

            $wordType = WordType::create([
                'code' => Str::upper($codeLetters),
                'name' => $data['word_type'],
            ]);

            $data['word_type_id'] = $wordType['id'];
        }

        $words = Word::all();
        $word = $words->firstWhere('word', $data['word']);
        $details['word_id'] = $word['id'];

        $details['definition'] = $data['definition'];


        $wordTypes = WordType::all();
        $wordType = $wordTypes->firstWhere('name', $data['word_type']);
        $details['word_type_id'] = $wordType['id'];

        $details['appropriate'] = true;
        $details['user_id'] = $user->id;

        $definition->update($details);

        return redirect(route('definitions.index'))
            ->with('updated', $definition->word->word)
            ->with('messageType', ['updated', true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Definition $definition)
    {

        $user = Auth::user();
        if ($definition->user_id == $user->id || $user->hasAnyRole('admin', 'staff')) {
            if($user->hasRole('admin')) {
                return view('definitions.delete', compact(['definition']));
            }

            if ($definition->user->hasRole('admin')) {
                abort(403, 'This belongs to an admin');
            }
            return view('definitions.delete', compact(['definition']));
        }
        abort(403, 'This is not your definition');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Definition $definition)
    {
        $oldDefinition = $definition;
        $definition->delete();
        return redirect(route('definitions.index'))->with('deleted', $oldDefinition->word->word);
    }
}
