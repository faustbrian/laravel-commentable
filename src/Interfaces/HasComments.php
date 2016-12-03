<?php

/*
 * This file is part of Laravel Commentable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

/*
 * This file is part of Laravel Commentable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Commentable\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface HasComments
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
