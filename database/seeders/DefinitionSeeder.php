<?php

namespace Database\Seeders;

use App\Models\Definition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefinitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $seedDefinitions = [
           [
               'word_id' => 1,
               'definition' => 'File Transfer Protocol',
               'user_id' => 1,
               'word_type_id' => 15,
               'appropriate' => true,
           ],
           [
               'word_id' => 2,
               'definition' => 'International Business Machines',
               'user_id' => 1,
               'word_type_id' => 15,
               'appropriate' => true,
           ],
        ];

        foreach ($seedDefinitions as $seedDefinition) {
            Definition::updateOrCreate($seedDefinition);
        }
    }
}
