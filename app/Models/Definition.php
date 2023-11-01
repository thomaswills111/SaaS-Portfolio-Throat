<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Definition extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'definition',
        'word_id',
        'word_type_id',
        'user_id',
        'appropriate'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];

    public function word() {
        return $this->belongsTo(Word::class);
    }

    public function wordType() {
        return $this->belongsTo(WordType::class);
    }

    public function ratings() {
        return $this->belongsToMany(Rating::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
