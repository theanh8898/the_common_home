<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\HomeRepository;
use App\Entities\Home;

/**
 * Class HomeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class HomeRepositoryEloquent extends BaseRepository implements HomeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Home::class;
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
    public function createHome($params)
    {

        $data = [
            'type_home' => $params['type_home'],
            'name' => $params['name'],
            'address' => $params['address'],
            'introduction' => $params['introduction'],
            'links' => $params['links'],
            'amenities' => $params['amenities'],
            'policies' => $params['policies'],
            'detail_description' => $params['detail_description'],
            'lat' => $params['lat'],
            'lng' => $params['lng'],
            'city_id' => $params['city_id'],
            'created_at' => time(),
            'updated_at' => time(),
        ];

        $home = $this->create($data);
        return $this->find($home->id);
    }
}
