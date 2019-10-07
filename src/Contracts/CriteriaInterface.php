<?php
/**
 * Created by PhpStorm
 * User: khanh
 * Date: 10/7/19
 * Time: 2:35 PM
 */

namespace Iamnvk\Repository\Contracts;

use Iamnvk\Repository\Criteria\Criteria;

interface CriteriaInterface
{
    /**
     * @param bool $status
     * @return $this
     */
    public function skipCriteria($status = true);
    /**
     * @return mixed
     */
    public function getCriteria();
    /**
     * @param Criteria $criteria
     * @return $this
     */
    public function getByCriteria(Criteria $criteria);
    /**
     * @param Criteria $criteria
     * @return $this
     */
    public function pushCriteria(Criteria $criteria);
    /**
     * @return $this
     */
    public function  applyCriteria();
}
