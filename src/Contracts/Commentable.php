<?php

namespace DraperStudio\Commentable\Contracts;

use Illuminate\Database\Eloquent\Model;

interface Commentable
{
    public function comments();

    public function comment($data, Model $creator, Model $parent = null);

    public function updateComment($id, $data, Model $parent = null);

    public function deleteComment($id);

    public function commentCount();
}
