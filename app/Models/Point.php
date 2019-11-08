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

    protected $appends = [
        'lat',
        'lng',
        'categories_in_string',
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

    /**
     * Get lat from latlng
     *
     * @return float
     */
    public function getLatAttribute()
    {
        return $this->latlng->getLat();
    }

    /**
     * Get lng from latlng
     *
     * @return float
     */
    public function getLngAttribute()
    {
        return $this->latlng->getLng();
    }

    /**
     * Get categories names
     *
     * @return float
     */
    public function getCategoriesInStringAttribute()
    {
        if (empty($this->categories())) {
            return null;
        }

        return implode(", ", $this->categories()->get()->pluck(['name'])->toArray());
    }

}
