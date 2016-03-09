<?php

/*
 * This file is part of Laravel :package_name.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraperStudio\Commentable\Traits;

use DraperStudio\Commentable\Models\Comment;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Commentable.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
trait Commentable
{
    /**
     * @return mixed
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * @param $data
     * @param Model      $creator
     * @param Model|null $parent
     *
     * @return static
     */
    public function comment($data, Model $creator, Model $parent = null)
    {
        $comment = (new Comment())->createComment($this, $data, $creator);

        if (!empty($parent)) {
            $comment->appendTo($parent)->save();
        }

        return $comment;
    }

    /**
     * @param $id
     * @param $data
     * @param Model|null $parent
     *
     * @return mixed
     */
    public function updateComment($id, $data, Model $parent = null)
    {
        $comment = (new Comment())->updateComment($id, $data);

        if (!empty($parent)) {
            $comment->appendTo($parent)->save();
        }

        return $comment;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function deleteComment($id)
    {
        return (new Comment())->deleteComment($id);
    }

    /**
     * @return mixed
     */
    public function commentCount()
    {
        return $this->comments->count();
    }
}
