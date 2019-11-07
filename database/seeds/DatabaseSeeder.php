<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * Start php artisan db:seed --class="DatabaseSeeder"
     *
     * @return void
     */
    public function run()
    {
        //$this->call(CategoriesTableSeeder::class);
        $this->call(PointsTableSeeder::class);
    }
}
