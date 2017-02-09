<?php

use Illuminate\Database\Seeder;
use CodeEduBook\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CodeEduBook\Models\Category::class,50)->create();
    }
}
