<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface MediaRepository.
 *
 * @package namespace App\Repositories;
 */
interface MediaRepository extends RepositoryInterface
{
    /**
     * @param $params
     * @return mixed
     */
    public function createMedia($params);

    /**
     * @param $params
     * @return mixed
     */
    public function getListMedia($params);

    /**
     * @param $params
     * @param $id
     * @return mixed
     */
    public function updateMedia($params, $id);
}
