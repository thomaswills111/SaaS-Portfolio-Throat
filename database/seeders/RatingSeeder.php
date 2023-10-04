<?php

namespace Database\Seeders;

use App\Models\Rating;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seedRatings = [
            ['id' => 01, 'name' => 'Unrated', 'stars' => 0, 'icon' => 'fa-solid fa-ghost',],
            [
                'id' => 10, 'name' => 'Terrible', 'stars' => 0, 'icon' => 'fa-solid fa-poo',],
            [
                'id' => 30, 'name' => 'Poor', 'stars' => 2, 'icon' => 'fa-solid fa-lemon',],
            [
                'id' => 40, 'name' => 'Ok', 'stars' => 4, 'icon' => 'fa-solid fa-star',],
            [
                'id' => 50, 'name' => 'Average', 'stars' => 6, 'icon' => 'fa-solid fa-star',],
            [
                'id' => 70, 'name' => 'Great', 'stars' => 8, 'icon' => 'fa-solid fa-star',],
            [
                'id' => 90, 'name' => 'Amazing', 'stars' => 10, 'icon' => 'fa-solid fa-pepper-hot',],
        ];

        foreach ($seedRatings as $seedRating) {
            Rating::updateOrCreate($seedRating);
        }
    }
}
