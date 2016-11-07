<?php

namespace BrianFaust\Commentable\Traits;

use Illuminate\Database\Eloquent\Model;

trait HasCommentsTrait
{
    /**
     * @return string
     */
    public function commentable_model()
    {
        return config('commentable.model');
    }

    /**
     * @return mixed
     */
    public function comments()
    {
        return $this->morphMany($this->commentable_model(), 'commentable');
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
        $commentableModel = $this->commentable_model();

        $comment = (new $commentableModel())->createComment($this, $data, $creator);

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
        $commentableModel = $this->commentable_model();

        $comment = (new $commentableModel())->updateComment($id, $data);

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
        $commentableModel = $this->commentable_model();

        return (new $commentableModel())->deleteComment($id);
    }

    /**
     * @return mixed
     */
    public function commentCount()
    {
        return $this->comments->count();
    }
}
