<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class comments extends Model
{
    use HasFactory;
    protected $fillable = [
        'author',
        'post_id',
        'comments_content'
    ];

    public function posts(): BelongsTo
    {
        return $this->belongsTo(posts::class, 'author', 'id');
    }

    public function commentator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }
}
