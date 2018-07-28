<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('pseudo')->unique();
            $table->string('password');
            $table->string('theme');
            $table->string('description');
            $table->integer('group_id')->unsigned();
            $table->boolean('active');
            $table->boolean('banned');
            $table->string('country')->default('fr');
            $table->integer('favorite_team')->nullable()->unsigned();
            $table->string('role')->default('user');
            $table->boolean('send_mail')->default(true);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('favorite_team')->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
