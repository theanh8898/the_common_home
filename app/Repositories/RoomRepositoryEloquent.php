<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RoomRepository;
use App\Entities\Room;
use App\Validators\RoomValidator;

/**
 * Class RoomRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RoomRepositoryEloquent extends BaseRepository implements RoomRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Room::class;
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
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function createRoom($params)
    {
        $data = [
            'name' => $params['name'],
            'num_bed' => $params['num_bed'],
            'price' => $params['price'],
            'home_id' => $params['home_id'],
        ];

        $room = $this->create($data);
        return $this->find($room->id);
    }
}
