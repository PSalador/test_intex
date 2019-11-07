<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Point extends Model
{
    use SpatialTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'latlng',
        'comment',
    ];

    protected $spatialFields = [
        'latlng',
    ];


    /**
     * Сategories with current point
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'point_categories', 'point_id', 'category_id');
    }


}
