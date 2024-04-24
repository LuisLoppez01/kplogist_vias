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
        Schema::create('railroad_switches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type_switch');
            $table->unsignedBigInteger('yard_id')->nullable();
            $table->foreign('yard_id')->references('id')->on('yards')->onDelete('SET NULL');            
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
        Schema::dropIfExists('railroad_switches');
    }
};
