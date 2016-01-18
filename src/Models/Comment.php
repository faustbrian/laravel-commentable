<?php

namespace DraperStudio\Commentable\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\Node;

class Comment extends Node
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function hasChildren()
    {
        return $this->children()->count() > 0;
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function creator()
    {
        return $this->morphTo('creator');
    }

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

    public function updateComment($id, $data)
    {
        $comment = static::find($id);
        $comment->update($data);

        return $comment;
    }

    public function deleteComment($id)
    {
        return static::find($id)->delete();
    }
}
