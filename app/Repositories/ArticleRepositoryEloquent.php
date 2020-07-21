<?php

namespace App\Repositories;

use App\Entities\EntityMedia;
use App\Entities\Media;
use Illuminate\Support\Facades\Storage;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\Article;

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
     * @param $files
     * @param $medias
     * @param $articleId
     * @return mixed|void
     */
    public function createMedias($files, $medias, $articleId)
    {
        $data = [];
        if (count($files) > 0) {
            $mediasCreated = [];
            foreach ($medias as $index => $item) {
                $extension = $files[$index]->getClientOriginalExtension();
                preg_match('/.([0-9]+) /', microtime(), $m);
                $fileName = sprintf('audio%s%s.%s', date('YmdHis'), $m[1], $extension);
                $storage = Storage::disk('public');
                $checkDirectory = $storage->exists('audio');
                if (!$checkDirectory) {
                    $storage->makeDirectory('file');
                }
                $storage->put('file/' . $fileName, file_get_contents($files[$index]), 'public');
                $media['media_type'] = array_search($item->media_type, TYPES_OF_MEDIA);
                $media['name'] = $fileName;
                $media['use_type'] = array_search($item->use_type, USE_TYPE_OF_MEDIA);
                $media['sort_order'] = $item->sort_order;
                $media['created_at'] = time();
                $media = Media::create($media);
                array_push($mediasCreated, $media->id);
            }
            $entityMedias = [];
            foreach ($mediasCreated as $item) {
                $entity['entity_type'] = array_search('article', TYPES_OF_ENTITY_MEDIA);
                $entity['entity_id'] = $articleId;
                $entity['media_id'] = $item;
                array_push($entityMedias, $entity);
            }
            EntityMedia::insert($entityMedias);
        }
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
