<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EntityMediaRepository;
use App\Entities\EntityMedia;
use App\Validators\EntityMediaValidator;

/**
 * Class EntityMediaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EntityMediaRepositoryEloquent extends BaseRepository implements EntityMediaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EntityMedia::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
