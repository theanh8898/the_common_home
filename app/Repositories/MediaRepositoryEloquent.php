<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MediaRepository;
use App\Entities\Media;
use App\Validators\MediaValidator;

/**
 * Class MediaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MediaRepositoryEloquent extends BaseRepository implements MediaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Media::class;
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
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function createMedia($params)
    {
        $file = $params['file'];
        $mediaType = TYPES_OF_MEDIA[$params['media_type']];
        $extension = $file->getClientOriginalExtension();
        preg_match('/.([0-9]+) /', microtime(), $m);
        $fileName = sprintf($mediaType . '%s%s.%s', date('YmdHis'), $m[1], $extension);
        $storage = Storage::disk('public');
        $checkDirectory = $storage->exists('file');
        if (!$checkDirectory) {
            $storage->makeDirectory('file');
        }
        $storage->put('file/' . $fileName, file_get_contents($file), 'public');
        $params['name'] = $fileName;
        $params['created_at'] = time();
        return $this->create($params);
    }

    /**
     * @param $params
     * @return mixed|void
     */
    public function getListMedia($params)
    {
        $pageSize = $params['page_size'] ?? PAGE_SIZE;
        $medias = $this->orderBy('id', 'DESC');
        $type = $params['media_type'];
        $useType = $params['use_type'];
        if ($type !== null) {
            $medias->scopeQuery(function ($query) use ($type) {
                return $query->where('media_type', $type);
            });
        }
        if ($useType !== null) {
            $medias->scopeQuery(function ($query) use ($useType) {
                return $query->where('use_type', $useType);
            });
        }
        return $medias->paginate($pageSize);
    }

    /**
     * @param $params
     * @param $id
     * @return mixed|void
     */
    public function updateMedia($params, $id)
    {

    }
}
