<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matchs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tournament_id')->unsigned();
            $table->date('date');
            $table->enum('type', array('poule','championship','finalphase'));
            $table->integer('home_team_id')->unsigned();
            $table->integer('visitor_team_id')->unsigned();
            $table->integer('winner');
            $table->integer('home_score');
            $table->integer('visitor_score');
            $table->timestamps();

            $table->foreign('tournament_id')->references('id')->on('tournaments');
            $table->foreign('home_team_id')->references('id')->on('teams');
            $table->foreign('visitor_team_id')->references('id')->on('teams');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matchs');
    }
}
