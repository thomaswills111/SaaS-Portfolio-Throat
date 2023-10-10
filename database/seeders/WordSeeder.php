<?php

namespace Database\Seeders;

use App\Models\Definition;
use App\Models\User;
use App\Models\Word;
use App\Models\WordType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::findOrFail(1);

        $seedWords = [

            [
                'word' => 'FTP',
                'definition' => 'File Transfer Protocol',
                'word_type' => 'Initialism',
            ],

            [
                'word' => 'FTP',
                'definition' => 'Fast Track Program',
                'word_type' => 'Initialism',
            ],

            [
                'word' => 'IBM',
                'definition' => 'International Business Machines',
                'word_type' => 'Initialism',
            ],

            [
                'word' => 'laser',
                'definition' => 'Light Amplification by Stimulated Emission of Radiation',
                'word_type' => 'Acronym',
            ],

            [
                'word' => 'MoSCoW',
                'definition' => "Must Have, Should Have, Could Have, Won't Have",
                'word_type' => 'Acronym',
            ],

            [
                'word' => 'THROAT',
                'definition' => 'The Huge Resource Of Acronyms and Terms',
                'word_type' => 'Backronym',
            ],

            [
                'word' => 'CRUD',
                'definition' => 'Create, Retrieve, Update, Delete',
                'word_type' => 'Acronym',
            ],

            [
                'word' => 'KISS',
                'definition' => 'Keep It Simple, Stupid',
                'word_type' => 'Acronym',
            ],

            [
                'word' => 'PHP',
                'definition' => 'PHP Hypertext Preprocessor',
                'word_type' => 'Name',
            ],

            [
                'word' => 'imho',
                'definition' => 'In My Honest Opinion',
                'word_type' => 'Textese',
            ],

            [
                'word' => 'DRY',
                'definition' => "Don't Repeat Yourself",
                'word_type' => 'Acronym',
            ],

            [
                'word' => 'inc.',
                'definition' => 'Incorporated',
                'word_type' => 'Abbreviation',
            ],

            [
                'word' => 'imo',
                'definition' => 'In My Opinion',
                'word_type' => 'Textese',
            ],

            [
                'word' => 'Silly Old Henry Carried a Horse To Our Abattoir',
                'definition' => 'Sin = Opposite/Hypotenuse, Cosine = Adjacent/Hypotenuse, Tan = Opposite/Adjacent',
                'word_type' => 'Mnemonic',
            ],

            [
                'word' => 'SQL',
                'definition' => 'Structured Query Language',
                'word_type' => 'Initialism',
            ],

            [
                'word' => 'btw',
                'definition' => 'By The Way',
                'word_type' => 'Textese',
            ],

            [
                'word' => "can't",
                'definition' => 'cannot',
                'word_type' => 'Contraction',
            ],

            [
                'word' => 'Dr.',
                'definition' => 'Doctor',
                'word_type' => 'Contraction',
            ],

        ];

        /*
         * Grab the word types table as a collection.
         * This reduces the number of database calls made.
         */
        $wordTypes = WordType::all();

        /*
         * Loop through each word in the seed list:
         */
        foreach ($seedWords as $seedWord) {
            $wordType = $wordTypes->firstWhere('name', $seedWord['word_type']);

            /*
             * If the word type is not in the collection then we create the new word type
             * with a random code made from the word type's name (currently not checking
             * for duplicate codes/names), and retrieving the new collection of word types.
             *
             * This is still much faster than if we had individual SQL executions for each
             * word type check.
             */
            if (is_null($wordType)) {
                $seedWordType = $seedWord['word_type'];
                $swLength = Str::length($seedWordType);
                $codeExists = true;
                $codeLetters = Str::substr($seedWordType, 0, 2);
                $firstLetter = 0;
                $secondLetter = 0;
                while ($codeExists && $firstLetter < ($swLength - 1)) {
                    $secondLetter = 1;
                    while ($codeExists && $secondLetter < $swLength) {
                        $codeLetters = Str::substr($seedWordType, $firstLetter, 1).Str::substr($seedWordType, $secondLetter, 1);
                        $codeExists = WordType::where('code', '=', $codeLetters)->get()->count() ?? false;
                        $secondLetter++;
                    }
                    $firstLetter++;
                }

                $wordType = WordType::create([
                    'code' => Str::upper($codeLetters),
                    'name' => $seedWord['word_type'],
                ]);

                $this->command->line("  - Created new word type: {$wordType->code} {$wordType->name}", 'comment');
                $wordTypes = WordType::all();
            }

            // Create the word if it does not exist
            $newWord = [
                'word' => $seedWord['word'],
                //                'word_type_id' => $wordType->id,
                // 'user_id' => $user->id,
            ];

            $word = Word::firstWhere('word', $seedWord['word']);
            if (is_null($word)) {
                $word = Word::create($newWord);
            }

//            $seedDefinition = [
//                'definition' => $seedWord['definition'],
//                'word_type_id' => $wordType->id,
//                // 'user_id' => $user->id,
//            ];

//            $definition = Definition::create($seedDefinition);
//            $word->definitions()->save($definition);

        }
    }
}
