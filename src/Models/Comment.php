<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Commentable.
 *
 * (c) Brian Faust <hello@basecode.sh>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Artisanry\Commentable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Kalnoy\Nestedset\NodeTrait;

class Comment extends Model
{
    use NodeTrait;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Determine if a comment has child comments.
     *
     * @return bool
     */
    public function hasChildren(): bool
    {
        return $this->children()->count() > 0;
    }

    /**
     * Get the commentable entity that the comment belongs to.
     *
     * @return mixed
     */
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return mixed
     */
    public function creator(): MorphTo
    {
        return $this->morphTo('creator');
    }

    /**
     * Create a comment and persists it.
     *
     * @param Model $commentable
     * @param array $data
     * @param Model $creator
     *
     * @return static
     */
    public function createComment(Model $commentable, array $data, Model $creator): self
    {
        return $commentable->comments()->create(array_merge($data, [
            'creator_id'   => $creator->getAuthIdentifier(),
            'creator_type' => $creator->getMorphClass(),
        ]));
    }

    /**
     * Update a comment by an ID.
     *
     * @param int $id
     * @param array $data
     *
     * @return bool
     */
    public function updateComment(int $id, array $data): bool
    {
        return (bool) static::find($id)->update($data);
    }

    /**
     * Delete a comment by an ID.
     *
     * @param int $id
     *
     * @return bool
     */
    public function deleteComment(int $id): bool
    {
        return (bool) static::find($id)->delete();
    }
}
