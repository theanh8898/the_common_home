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
     * @param $files
     * @param $medias
     * @param $articleId
     * @return mixed
     */
    public function createMedias($files, $medias, $articleId);
}
