<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRatingRequest;
use App\Models\Definition;
use App\Http\Requests\StoreDefinitionRequest;
use App\Http\Requests\UpdateDefinitionRequest;
use App\Models\Rating;
use App\Models\Word;
use App\Models\WordType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Null_;

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
        return view('definitions.rate', (['definition'=>$definition, 'ratings'=>$ratings]));
    }

    public function storeDefinitionRating(Definition $definition, Rating $rating)
    {
//        dd($rating);
//        $ratings = Rating::all();

//        $rating = $ratings->firstWhere('name', $request['name']);

        $definition->ratings()->attach([$rating['id'] => ['value' => $rating['stars']]]);

        return redirect(route('definitions.index'))
            ->with('rated', $definition->word->word)
            ->with('messages', ['created', true]);
    }

    public function storeNewDefinitionRating(StoreRatingRequest $request, Definition $definition)
    {
        $details = $request->validated(); // Goes to error page if not validated
        $rating = Rating::create($details);

        $definition->ratings()->attach([$rating['id'] => ['value' => $rating['stars']]]);

        return redirect(route('definitions.index'))
            ->with('rated', $definition->word->word)
            ->with('ratingCreated', $rating->name)
            ->with('messages', ['created', true]); // inserting the rating's name into a new variable named 'created'
    }

    public function rateStoreNewRating()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDefinitionRequest $request)
    {
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
                    $codeLetters = Str::substr($detailsWordType, $firstLetter, 1).Str::substr($detailsWordType, $secondLetter, 1);
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
        $word =$words->firstWhere('word', $data['word']);
        $details['word_id'] = $word['id'];

        $details['definition'] = $data['definition'];


        $wordTypes = WordType::all();
        $wordType = $wordTypes->firstWhere('name', $data['word_type']);
        $details['word_type_id'] = $wordType['id'];

        $details['appropriate'] = true;

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
        return view('definitions.edit', compact(['definition']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDefinitionRequest $request, Definition $definition)
    {
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
                    $codeLetters = Str::substr($detailsWordType, $firstLetter, 1).Str::substr($detailsWordType, $secondLetter, 1);
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
        $word =$words->firstWhere('word', $data['word']);
        $details['word_id'] = $word['id'];

        $details['definition'] = $data['definition'];


        $wordTypes = WordType::all();
        $wordType = $wordTypes->firstWhere('name', $data['word_type']);
        $details['word_type_id'] = $wordType['id'];

        $details['appropriate'] = true;

        $definition->update($details);

        return redirect(route('definitions.index'))
            ->with('updated', $definition->word->word)
            ->with('messageType', ['updated', true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Definition $definition) {

        return view('definitions.delete', compact(['definition']));
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
