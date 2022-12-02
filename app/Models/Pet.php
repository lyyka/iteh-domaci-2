<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pet extends Model
{
    protected $casts = [
        'date_of_birth' => 'date'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images() : HasMany
    {
        return $this->hasMany(PetImage::class);
    }
}
