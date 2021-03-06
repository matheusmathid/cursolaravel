<?php

use Illuminate\Database\Seeder;
use CodePub\Models\Book;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$categories = \CodePub\Models\Category::all();
        factory(Book::class,20)->create()->each(function($book) use($categories){
        	$categoriesHandle = $categories->random(4);
        	$book->categories()->sync($categoriesHandle->pluck('id')->all());
        }); 
    }
}
