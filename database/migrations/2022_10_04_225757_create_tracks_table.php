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
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('yard_id')->nullable();
            $table->foreign('yard_id')->references('id')->on('yards')->onDelete('SET NULL');
            $table->timestamps();
        });
        Schema::create('component_tracks', function (Blueprint $table){
            $table->id();
            $table->string('type_track');
            $table->string('type_tracksleeper_one');
            $table->string('lenght_tracksleeper_one');
            $table->string('type_tracksleeper_two')->nullable();
            $table->string('lenght_tracksleeper_two')->nullable();
            $table->string('weight_rails_one');
            $table->string('lenght_rails_one');
            $table->string('weight_rails_two')->nullable();
            $table->string('lenght_rails_two')->nullable();
            $table->string('railroadswitch_interior')->nullable();
            $table->string('railroadswitch_exterior')->nullable();
            $table->unsignedBigInteger('track_id')->nullable()->unique();
            $table->foreign('track_id')->references('id')->on('tracks')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tracks');
        Schema::dropIfExists('component_tracks');
    }
};
