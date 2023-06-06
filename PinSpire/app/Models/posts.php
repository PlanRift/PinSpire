<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class posts extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'title',
        'description',
        'author',
    ];

    public function writer(): BelongsTo
    {
        return $this->belongsTo(user::class, 'author', 'id');
    }

    public function likes(): HasMany
    {
        return $this->HasMany(likes::class, 'post_id', 'id');
    }

    public function comments(): HasMany
    {
        return $this->HasMany(comments::class, 'comments_id', 'id');
    }
}

