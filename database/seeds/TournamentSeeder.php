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
            array('name' => 'Ligue 1', 'year' => '2017', 'type' => 'league', 'country_id' => 74, 'description' => 'Premiére ligue de france', 'participants' => 20, 'status' => 2, 'currentDay' => 1),
            array('name' => 'Ligue 2', 'year' => '2017', 'type' => 'league', 'country_id' => 74, 'description' => 'Seconde ligue de france', 'participants' => 20, 'status' => 2, 'currentDat' => 1),
        );

        $teams = array(
            array('type' => 'local', 'country_id' => 74, 'name' => 'Olympique Lyonnais', 'city' => 'Lyon', 'logo' => 'png'),
            array('type' => 'local', 'country_id' => 74, 'name' => 'Olympique de Marseille', 'city' => 'Marseille', 'logo' => 'png'),
            array('type' => 'local', 'country_id' => 74, 'name' => 'Montpellier Hérault Sporting Club', 'city' => 'Montpellier', 'logo' => 'png'),
            array('type' => 'local', 'country_id' => 74, 'name' => 'FC Nantes', 'city' => 'Nantes', 'logo' => 'png'),
            array('type' => 'local', 'country_id' => 74, 'name' => 'OGC Nice', 'city' => 'Nice', 'logo' => 'png'),
            array('type' => 'local', 'country_id' => 74, 'name' => 'Dijon FCO', 'city' => 'Dijon', 'logo' => 'png'),
            array('type' => 'local', 'country_id' => 74, 'name' => 'En Avant de Guingamp', 'city' => 'Guingamp', 'logo' => 'png'),
            array('type' => 'local', 'country_id' => 74, 'name' => 'ESTAC Troyes', 'city' => 'Troyes', 'logo' => 'png'),
            array('type' => 'local', 'country_id' => 74, 'name' => 'LOSC', 'city' => 'Lille', 'logo' => 'png'),
            array('type' => 'local', 'country_id' => 74, 'name' => 'FC Metz', 'city' => 'Metz', 'logo' => 'png'),
            array('type' => 'local', 'country_id' => 74, 'name' => 'Amiens', 'city' => 'Amiens', 'logo' => 'png'),
            array('type' => 'local', 'country_id' => 74, 'name' => 'AS Monaco', 'city' => 'Monaco', 'logo' => 'png'),
            array('type' => 'local', 'country_id' => 74, 'name' => 'ASSE', 'city' => 'Saint Etienne', 'logo' => 'png'),
            array('type' => 'local', 'country_id' => 74, 'name' => 'Girondins de Bordeaux', 'city' => 'Bordeaux', 'logo' => 'png'),
            array('type' => 'local', 'country_id' => 74, 'name' => 'Caen', 'city' => 'Caen', 'logo' => 'png'),
            array('type' => 'local', 'country_id' => 74, 'name' => 'Rennes', 'city' => 'Rennes', 'logo' => 'png'),
            array('type' => 'local', 'country_id' => 74, 'name' => 'Strasbourg', 'city' => 'Strasbourg', 'logo' => 'png'),
            array('type' => 'local', 'country_id' => 74, 'name' => 'Angers SCO', 'city' => 'Angers', 'logo' => 'png'),
            array('type' => 'local', 'country_id' => 74, 'name' => 'TFC', 'city' => 'Toulouse', 'logo' => 'png'),
            array('type' => 'local', 'country_id' => 74, 'name' => 'PSG', 'city' => 'Paris', 'logo' => 'png'),
        );

        $link = [];

        for($i = 1; $i <= 20; $i++){
            $link[] = array('team_id' => $i ,'tournament_id' => '1');
        }

        $days = array(
            array('tournament_id' => 2, 'date' => date('Y-m-d H:i:s', time()), 'type' => 'championship', 'home_team_id' => 12, 'visitor_team_id' => 19, 'days' => 1, 'home_score' => 3, 'visitor_score' => 2),
            array('tournament_id' => 1, 'date' => date('Y-m-d H:i:s', time()), 'type' => 'championship', 'home_team_id' => 11, 'visitor_team_id' => 20, 'days' => 1, 'home_score' => 0, 'visitor_score' => 2),
            array('tournament_id' => 1, 'date' => date('Y-m-d H:i:s', time()), 'type' => 'championship', 'home_team_id' => 1, 'visitor_team_id' => 17, 'days' => 1, 'home_score' => 4, 'visitor_score' => 0),
        );

        DB::table('teams')->insert($teams);
        DB::table('tournaments')->insert($tournaments);
        DB::table('tournaments_teams')->insert($link);
        DB::table('matches')->insert($days);
    }
}
