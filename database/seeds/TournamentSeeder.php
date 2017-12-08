<?php

use Illuminate\Database\Seeder;

class TournamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tournaments = array(
            array('name' => 'Ligue 1', 'years' => '2017', 'type' => 'league'),
        );

        DB::table('tournaments')->insert($tournaments);
    }
}
