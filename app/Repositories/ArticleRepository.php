<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ArticleRepository.
 *
 * @package namespace App\Repositories;
 */
interface ArticleRepository extends RepositoryInterface
{
    /**
     * @param $params
     * @return mixed
     */
    public function getListArticles($params);

    /**
     * @param $params
     * @return mixed
     */
    public function createArticle($params);
}
