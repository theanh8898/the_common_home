<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Media.
 *
 * @package namespace App\Entities;
 */
class Media extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'media_type',
        'name',
        'use_type',
        'sort_order',
        'created_at'
    ];

    public $timestamps = false;

    public function articles()
    {
        return $this->belongsToMany('App\Entities\Article', 'entity_media', 'media_id', 'entity_id')->withPivot('entity_type');
    }

    public function getNameAttribute($value)
    {
        if ($value !== null) {
            return asset(Storage::url('file/' . $value));
        }
        return $value;
    }

}
