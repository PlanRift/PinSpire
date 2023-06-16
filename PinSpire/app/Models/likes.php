<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class likes extends Model
{
    use HasFactory;
    protected $fillable = [
        'author',
        'post_id'
    ];

    public function posts(): BelongsTo
    {
        return $this->belongsTo(posts::class, 'author', 'id');
    }

    public function LikedPost(): BelongsTo
    {
        return $this->belongsTo(posts::class, 'post_id', 'id');
    }
}
