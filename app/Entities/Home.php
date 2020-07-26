<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Home.
 *
 * @package namespace App\Entities;
 */
class Home extends Model implements Transformable
{
    use TransformableTrait;

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type_home', 'name', 'address', 'introduction', 'links', 'amenities', 'policies', 'detail_description', 'lat', 'lng', 'city_id', 'created_at', 'updated_at'];

    public function medias()
    {
        return $this->belongsToMany('App\Entities\Media', 'entity_media', 'entity_id', 'media_id')->withPivot('entity_type');
    }
}
