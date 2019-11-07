<?php

use Illuminate\Database\Seeder;
use App\Models\Point;
use App\Models\Category;

class PointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Point::class, 20)->create()->each(function ($p) {
            $p->categories()->save(Category::inRandomOrder()->first());
        });
    }
}
