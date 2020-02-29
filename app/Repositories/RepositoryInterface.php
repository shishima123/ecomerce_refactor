<?php
namespace App\Repositories;

/**
 * Interface RepositoryInterface
 *
 * @package App\Repositories
 */
interface RepositoryInterface
{
    /**
     * Retrieve all data of repository
     *
     * @param array $columns
     * @return mixed
     */
    public function all($columns = ['*']);

    /**
     * Retrieve all data of repository, paginated
     *
     * @param int $limit
     * @param array $columns
     * @return mixed
     */
    public function paginate($limit = 20, $columns = ['*']);

    /**
     * Find data by id
     *
     * @param  number  $id
     * @param array $columns
     * @return mixed
     */
    public function findById($id, $columns = ['*']);

    /**
     * Find data by field and value
     *
     * @param $field
     * @param $value
     * @return mixed
     */
    public function findByField($field, $value);

    /**
     * Save a new entity in repository
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Update a entity in repository by id
     *
     * @param array $attributes
     * @param       $id
     * @return mixed
     */
    public function update(array $attributes, $id);

    /**
     * Delete a entity in repository by id
     *
     * @param $id
     * @return int
     */
    public function delete($id);

    /**
     * Order collection by a given column
     *
     * @param string $field
     * @param string $direction
     * @return $this
     */
    public function orderBy($field, $direction = 'asc');

    /**
     * Load relations
     *
     * @param $tableName
     * @return $this
     */
    public function with($tableName);

}
