<?php
/**
 * Created by PhpStorm
 * User: khanh
 * Date: 10/7/19
 * Time: 2:28 PM
 */

namespace Iamnvk\Repository\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface RepositoryInterface
{
    /**
     * @return mixed
     */
    public function all();

    /**
     * @return mixed
     */
    public function allWithBuilder(): Builder;

    /**
     * @param array $relations
     * @return mixed
     */
    public function with(array $relations);

    /**
     * @param  string $value
     * @param  string $key
     * @return array
     */
    public function lists($value, $key = null);

    /**
     * @param int $perPage
     * @return mixed
     */
    public function paginate($perPage = 15);
    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param $model
     * @param array $data
     * @return mixed
     */
    public function update($model, array $data);

    /**
     * @param $model
     * @return mixed
     */
    public function destroy($model);

    /**
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Return a collection of elements who's ids match
     * @param  array $ids
     * @return mixed
     */
    public function findByMany(array $ids);

    /**
     * Find data by id
     * @param $id
     * @return mixed
     */
    public function findOrFail($id);

    /**
     * @param array $attributes
     * @return mixed
     */
    public function findByAttributes(array $attributes);

    /**
     * @param array $attributes
     * @return mixed
     */
    public function getByAttributes(array $attributes);
}
