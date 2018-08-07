<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner')->unsigned();
            $table->boolean('privacy')->nullable();
            $table->boolean('mail')->default(true);
            $table->boolean('mail_status')->default(false);
            $table->string('name');
            $table->string('description');
            $table->integer('tournament_id')->unsigned();
            $table->integer('winner')->nullable();
            $table->integer('daysAhead')->default(1);
            $table->integer('max_participants')->nullable();
            $table->timestamps();

            $table->foreign('owner')->references('id')->on('users');
            $table->foreign('tournament_id')->references('id')->on('tournaments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
