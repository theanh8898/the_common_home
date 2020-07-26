<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CityRepository;
use App\Entities\City;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class CityRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CityRepositoryEloquent extends BaseRepository implements CityRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return City::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param $params
     * @return mixed
     */
    public function createCity($params)
    {
        $data = [
            'name' => $params['name'],
            'short_name' => $params['short_name'],
        ];

        $city = $this->create($data);
        return $this->find($city->id);
    }
}
