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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->dateTime('date');
            $table->unsignedBigInteger('type');
            $table->unsignedBigInteger('place');
            $table->unsignedBigInteger('teaching');
            $table->timestamps();
        });
        Schema::table('activities', function(Blueprint $table)
        {
            $table->foreign('type')->references('ID')->on('type_activities');
            $table->foreign('place')->references('ID')->on('places');
            $table->foreign('teaching')->references('ID')->on('teachings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
};
