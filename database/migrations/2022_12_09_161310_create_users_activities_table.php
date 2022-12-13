<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usersActivities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user')->unsigned()->index();
            $table->bigInteger('id_activity')->unsigned()->index();
            $table->timestamps();
        });
        Schema::table('usersActivities', function(Blueprint $table)
        {
            $table->foreign('id_user')->references('id')->on('users')->cascadeOnDelete();;
            $table->foreign('id_activity')->references('id')->on('activities')->cascadeOnDelete();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usersActivities');
    }
};
