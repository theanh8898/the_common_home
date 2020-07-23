<?php

namespace App\Repositories;

use App\Entities\Article;
use App\Entities\EntityMedia;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ArticleRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ArticleRepositoryEloquent extends BaseRepository implements ArticleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Article::class;
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
     * @return mixed|void
     */
    public function getListArticles($params)
    {
        $pageSize = $params['page_size'] ?? PAGE_SIZE;
        $categories = $this->with('medias')->orderBy('created_at', 'DESC');
        $category_id = $params['category_id'];
        if ($category_id !== null) {
            $categories->scopeQuery(function ($query) use ($category_id) {
                return $query->where('category_id', $category_id);
            });
        }
        $type = $params['type'];
        if ($type !== null) {
            $categories->scopeQuery(function ($query) use ($type) {
                return $query->where('type', $type);
            });
        }
        return $categories->paginate($pageSize);
    }

    /**
     * @param $params
     * @return mixed|void
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function createArticle($params)
    {
        $data = [
            'type' => $params['type'],
            'name' => $params['name'],
            'title' => $params['title'],
            'meta_description' => $params['meta_description'],
            'content' => $params['content'],
            'category_id' => $params['category_id'],
            'created_at' => time(),
            'updated_at' => time()
        ];
        $article = $this->create($data);
        $entityMedias = array_map(function ($media) use ($article) {
            $entity['entity_type'] = array_search('article', TYPES_OF_ENTITY_MEDIA);
            $entity['entity_id'] = $article->id;
            $entity['media_id'] = $media;
            return $entity;
        }, $params['media_ids']);
        EntityMedia::insert($entityMedias);
        return $this->with('medias')->find($article->id);
    }
}
