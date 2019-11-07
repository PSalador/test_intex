<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
    ];


    /**
     * Points with current category
     */
    public function points(): BelongsToMany
    {
        return $this->belongsToMany(Point::class, 'point_categories', 'category_id', 'point_id');
    }
}
