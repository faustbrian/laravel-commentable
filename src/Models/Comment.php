<?php

/*
 * This file is part of Laravel :package_name.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraperStudio\Commentable\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\Node;

/**
 * Class Comment.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
class Comment extends Node
{
    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * @return bool
     */
    public function hasChildren()
    {
        return $this->children()->count() > 0;
    }

    /**
     * @return mixed
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * @return mixed
     */
    public function creator()
    {
        return $this->morphTo('creator');
    }

    /**
     * @param Model $commentable
     * @param $data
     * @param Model $creator
     *
     * @return static
     */
    public function createComment(Model $commentable, $data, Model $creator)
    {
        $comment = new static();
        $comment->fill(array_merge($data, [
            'creator_id' => $creator->id,
            'creator_type' => get_class($creator),
        ]));

        $commentable->comments()->save($comment);

        return $comment;
    }

    /**
     * @param $id
     * @param $data
     *
     * @return mixed
     */
    public function updateComment($id, $data)
    {
        $comment = static::find($id);
        $comment->update($data);

        return $comment;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function deleteComment($id)
    {
        return static::find($id)->delete();
    }
}
