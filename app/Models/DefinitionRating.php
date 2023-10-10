<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DefinitionRating extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'rating_id',
        'definition_id',
        'value',
        'user_id',
    ];
}
