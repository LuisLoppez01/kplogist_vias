<?php

use App\Models\CarInspection;
use App\Models\CarType;
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
        Schema::create('car_inspections', function (Blueprint $table) {
            $table->id();
            $table->string('serie');
            $table->string('shiftwork');
            $table->enum('le',[CarInspection::EMPTY,CarInspection::LOADED]);
            $table->enum('status',[CarInspection::BO,CarInspection::OK]);
            $table->text('comment');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('initial_id')->nullable();
            $table->unsignedBigInteger('car_type_id')->nullable();
            $table->unsignedBigInteger('track_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('initial_id')->references('id')->on('initials')->onDelete('SET NULL');
            $table->foreign('car_type_id')->references('id')->on('car_types')->onDelete('SET NULL');
            $table->foreign('track_id')->references('id')->on('tracks')->onDelete('SET NULL');

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
        Schema::dropIfExists('car_inspections');
    }
};
