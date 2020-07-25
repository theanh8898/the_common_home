<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CategoryRepository;
use App\Entities\Category;
use App\Validators\CategoryValidator;

/**
 * Class CategoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getListCategories($params)
    {
        $pageSize = $params['page_size'] ?? PAGE_SIZE;
        $keyword = $params['keyword'];
        $categories = $this->orderBy('name', 'ASC');
        if ($keyword !== null) {
            $categories->scopeQuery(function ($query) use ($keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            });
        }
        return $categories->paginate($pageSize);
    }
}
