<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property $id
 * @property $user_id
 * @property $post_id
 * @property $title
 * @property $body
 * @property $approved
 * @property $approved_at
 * @property $create_at
 * @property $update_at
 *
 * @property $user
 * @property $post
 * @property $category
 * @property $replies
 * @property $likes
 */

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'title',
        'body',
        'approved',
        'approved_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function category(): HasOneThrough
    {
        // accomplish a belongsToThrough with hasOneThrough
        return $this->hasOneThrough(
            Category::class,
            Post::class,
            'id',
            'id',
            'post_id',
            'category_id'
        );
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likable');
    }
}
