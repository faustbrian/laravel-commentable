<?php

/*
 * This file is part of Laravel :package_name.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraperStudio\Commentable\Contracts;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface Commentable.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
interface Commentable
{
    /**
     * @return mixed
     */
    public function comments();

    /**
     * @param $data
     * @param Model      $creator
     * @param Model|null $parent
     *
     * @return mixed
     */
    public function comment($data, Model $creator, Model $parent = null);

    /**
     * @param $id
     * @param $data
     * @param Model|null $parent
     *
     * @return mixed
     */
    public function updateComment($id, $data, Model $parent = null);

    /**
     * @param $id
     *
     * @return mixed
     */
    public function deleteComment($id);

    /**
     * @return mixed
     */
    public function commentCount();
}
