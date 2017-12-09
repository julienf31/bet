<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = array(['group_name' => 'admin'],['group_name' => 'user']);

        $users = array(
            array('firstname' => 'Julien', 'lastname' => 'FOURNIER','pseudo' => 'julienf31', 'email' => 'julien.fournier@ynov.com', 'password' => bcrypt('coucou'), 'theme' => 'blue', 'description' => '', 'group_id' => 1, 'active' => 1, 'banned' => false),
        );

        DB::table('groups')->insert($groups);
        DB::table('users')->insert($users);
    }
}
