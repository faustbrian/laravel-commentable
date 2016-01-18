<?php

namespace DraperStudio\Commentable\Traits;

use DraperStudio\Commentable\Models\Comment;
use Illuminate\Database\Eloquent\Model;

trait Commentable
{
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function comment($data, Model $creator, Model $parent = null)
    {
        $comment = (new Comment())->createComment($this, $data, $creator);

        if (!empty($parent)) {
            $comment->appendTo($parent)->save();
        }

        return $comment;
    }

    public function updateComment($id, $data, Model $parent = null)
    {
        $comment = (new Comment())->updateComment($id, $data);

        if (!empty($parent)) {
            $comment->appendTo($parent)->save();
        }

        return $comment;
    }

    public function deleteComment($id)
    {
        return (new Comment())->deleteComment($id);
    }

    public function commentCount()
    {
        return $this->comments->count();
    }
}
