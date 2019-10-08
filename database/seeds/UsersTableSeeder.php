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
        DB::Table('users')->insert([
            'name' => 'sergio',
            'email'=> 'sergio@esergio.com',
            'password' => bcrypt('testing123')
        ]);
    }
}
