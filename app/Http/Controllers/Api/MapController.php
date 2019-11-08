<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Point;
use Illuminate\Http\Request;
use Grimzy\LaravelMysqlSpatial\Types\Point as TypePoint;
use Illuminate\Support\Str;

class MapController extends Controller
{
    /**
     * Get all points
     *
     * @return collection
     */
    public function getPoints()
    {
        return Point::with('categories')->get();
    }

    /**
     * Get all categories
     *
     * @return collection
     */
    public function getCategory()
    {
        return Category::all();
    }

    /**
     * Add new point
     *
     * @return collection
     */
    public function addPoint(Request $request)
    {
        $point = new Point();
        $point->comment = $request->get('comment');
        $point->latlng = new TypePoint($request->get('lat'), $request->get('lng'));
        $point->save();
        foreach ($request->get('category') as $category) {
            $point->categories()->save(Category::find($category['id']));
        }

        return ['result' => 'success'];
    }


    /**
     * Add new category
     *
     * @return collection
     */
    public function addCategory(Request $request)
    {
        $category = new Category();
        $category->name = $request->get('name');
        $category->slug = Str::slug($request->get('name'));
        $category->save();

        return $category;
    }
}
