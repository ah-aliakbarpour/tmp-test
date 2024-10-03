<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

/**
 * @property $id
 * @property $user_id
 * @property $comment_id
 * @property $body
 * @property $create_at
 * @property $update_at
 *
 * @property $user
 * @property $comment
 * @property $post
 */

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'comment_id',
        'body',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }

    public function post(): HasOneThrough
    {
        // accomplish a belongsToThrough with hasOneThrough
        return $this->hasOneThrough(
            Post::class,
            Comment::class,
            'id',
            'id',
            'comment_id',
            'post_id'
        );
    }
}
