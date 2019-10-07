<?php
/**
 * Created by PhpStorm
 * User: khanh
 * Date: 10/7/19
 * Time: 2:41 PM
 */

namespace Iamnvk\Repository\Criteria;

use Iamnvk\Repository\Contracts\RepositoryInterface as Repository;

abstract class Criteria
{
    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public abstract function apply($model, Repository $repository);
}
