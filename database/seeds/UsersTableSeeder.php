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
            'name' => 'tester',
            'email'=> 'testy.testerson@fakemail.com',
            'password' => bcrypt('testing123')
        ]);

        DB::Table('users')->insert([
            'name' => 'tester',
            'email'=> 'tester@esergio.com',
            'password' => bcrypt('123test')
        ]);
    }
}
