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
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->unsignedBigInteger('yard_id')->nullable();
            $table->foreign('yard_id')->references('id')->on('yards')->onDelete('SET NULL');
            $table->unsignedBigInteger('track_id')->nullable();
            $table->foreign('track_id')->references('id')->on('tracks')->onDelete('SET NULL');
            $table->unsignedBigInteger('tracksection_id')->nullable();
            $table->foreign('tracksection_id')->references('id')->on('track_sections')->onDelete('SET NULL');
            $table->unsignedBigInteger('railroadswitch_id')->nullable();
            $table->foreign('railroadswitch_id')->references('id')->on('railroad_switches')->onDelete('SET NULL');
            $table->dateTime('date');
            $table->integer('type_inspection');
            $table->integer('condition');
/*            $table->text('comments')->nullable();
            $table->integer('priority');*/
            //$table->integer('status');
            $table->integer('active')->default(1);
            $table->integer('sent')->default(0);

            $table->timestamps();
        });
        Schema::create('defect_tracks', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('component_catalogs_id')->nullable();
            $table->foreign('component_catalogs_id')->references('id')->on('component_catalogs')->onDelete('SET NULL');
            $table->string('priority');
            $table->string('comment')->nullable();
            $table->unsignedBigInteger('inspection_id')->nullable();
            $table->foreign('inspection_id')->references('id')->on('inspections')->onDelete('SET NULL');
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
        Schema::dropIfExists('inspection');
        Schema::dropIfExists('defect_tracks');
    }
};
