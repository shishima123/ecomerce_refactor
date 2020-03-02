<?php
namespace App\Repositories;

use App\Repositories\RepositoryAbstract;
use App\Models\City;

/**
 * Class AddressRepository
 *
 * @package App\Repositories\Backend
 */
class CityRepository extends RepositoryAbstract
{
    /**
     * Function getModel
     *
     * @return string
     */
    public function getModel()
    {
        return City::class;
    }

//    /**
//     * Function search get all data with search and pagination
//     *
//     * @param string $search
//     * @param string $field
//     * @return
//     */
//    public function getData($search)
//    {
//        // get data from config file
//        $limit = config('constants.page.per_page');
//        if ($search != self::EMPTY_STRING) {
//            return $this->model->orderBy('id','desc')
//                ->whereLike(['name'], $search)
//                ->paginate($limit);
//        }
//        return $this->model->orderBy('id','desc')->paginate($limit);
//    }

    /**
     * Function search get all data with search and pagination
     *
     * @param int $limit
     * @return int
     */
    public function getLastedPage($limit = 20)
    {
        $countRows = $this->model->all()->count();
        if($countRows <1) {
            return 1;
        }

        $totalPage = ceil($countRows/$limit);
        return (int)$totalPage;
    }
}
