<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Article.
 *
 * @package namespace App\Entities;
 */
class Article extends Model implements Transformable
{
    use TransformableTrait;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'type',
        'name',
        'title',
        'meta_description',
        'content',
        'category_id',
        'created_at',
        'updated_at'
    ];

    public function medias()
    {
        return $this->belongsToMany('App\Entities\Media', 'entity_media', 'entity_id', 'media_id')->withPivot('entity_type');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id', 'category_id');
    }

}
