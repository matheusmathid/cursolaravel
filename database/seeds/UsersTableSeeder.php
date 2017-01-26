<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class,1)-> create([
        	'email'	=>	'matheus.mathdias@gmail.com'
        ]);
        
        factory(\App\User::class,1)-> create([
        	'email'	=>	'teste@gmail.com'
        ]);
    }
}
