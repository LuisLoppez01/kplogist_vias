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
        Schema::table('companies', function (Blueprint $table) {
            // Eliminar clave foránea actual
            $table->dropForeign(['location_id']); // Usa el nombre de la columna
            // Agregar nueva clave foránea con cascade
            $table->foreign('location_id')
                ->references('id')->on('locations')
                ->onDelete('cascade');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->foreign('company_id')
                ->references('id')->on('companies')
                ->onDelete('cascade');
        });
        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign(['location_id']);
            $table->foreign('location_id')
                ->references('id')->on('locations')
                ->onDelete('cascade');
        });
        Schema::table('yards', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->foreign('company_id')
                ->references('id')->on('companies')
                ->onDelete('cascade');
        });
        Schema::table('yards', function (Blueprint $table) {
            $table->dropForeign(['location_id']);
            $table->foreign('location_id')
                ->references('id')->on('locations')
                ->onDelete('cascade');
        });
        Schema::table('user_yard', function (Blueprint $table) {
            $table->dropForeign(['yard_id']);
            $table->foreign('yard_id')
                ->references('id')->on('yards')
                ->onDelete('cascade');
        });
        Schema::table('user_yard', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
        Schema::table('company_user', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->foreign('company_id')
                ->references('id')->on('companies')
                ->onDelete('cascade');
        });
        Schema::table('company_user', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
        Schema::table('tracks', function (Blueprint $table) {
            $table->dropForeign(['yard_id']);
            $table->foreign('yard_id')
                ->references('id')->on('yards')
                ->onDelete('cascade');
        });
        Schema::table('railroad_switches', function (Blueprint $table) {
            $table->dropForeign(['yard_id']);
            $table->foreign('yard_id')
                ->references('id')->on('yards')
                ->onDelete('cascade');
        });
        Schema::table('track_sections', function (Blueprint $table) {
            $table->dropForeign(['track_id']);
            $table->foreign('track_id')
                ->references('id')->on('tracks')
                ->onDelete('cascade');
        });
        Schema::table('inspections', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
        Schema::table('inspections', function (Blueprint $table) {
            $table->dropForeign(['yard_id']);
            $table->foreign('yard_id')
                ->references('id')->on('yards')
                ->onDelete('cascade');
        });
        Schema::table('inspections', function (Blueprint $table) {
            $table->dropForeign(['track_id']);
            $table->foreign('track_id')
                ->references('id')->on('tracks')
                ->onDelete('cascade');
        });
        Schema::table('inspections', function (Blueprint $table) {
            $table->dropForeign(['tracksection_id']);
            $table->foreign('tracksection_id')
                ->references('id')->on('track_sections')
                ->onDelete('cascade');
        });
        Schema::table('inspections', function (Blueprint $table) {
            $table->dropForeign(['railroadswitch_id']);
            $table->foreign('railroadswitch_id')
                ->references('id')->on('railroad_switches')
                ->onDelete('cascade');
        });
        Schema::table('defect_tracks', function (Blueprint $table) {
            $table->dropForeign(['inspection_id']);
            $table->foreign('inspection_id')
                ->references('id')->on('inspections')
                ->onDelete('cascade');
        });
        Schema::table('defect_tracks', function (Blueprint $table) {
            $table->dropForeign(['component_catalogs_id']);
            $table->foreign('component_catalogs_id')
                ->references('id')->on('component_catalogs')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            // Eliminar clave foránea actual
            $table->dropForeign(['location_id']); // Usa el nombre de la columna
            // Agregar nueva clave foránea con cascade
            $table->foreign('location_id')
                ->references('id')->on('locations')
                ->onDelete('set null');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->foreign('company_id')
                ->references('id')->on('companies')
                ->onDelete('set null');
        });
        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign(['location_id']);
            $table->foreign('location_id')
                ->references('id')->on('locations')
                ->onDelete('set null');
        });
        Schema::table('yards', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->foreign('company_id')
                ->references('id')->on('companies')
                ->onDelete('set null');
        });
        Schema::table('yards', function (Blueprint $table) {
            $table->dropForeign(['location_id']);
            $table->foreign('location_id')
                ->references('id')->on('locations')
                ->onDelete('set null');
        });
        Schema::table('user_yard', function (Blueprint $table) {
            $table->dropForeign(['yard_id']);
            $table->foreign('yard_id')
                ->references('id')->on('yards')
                ->onDelete('set null');
        });
        Schema::table('user_yard', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('set null');
        });
        Schema::table('company_user', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->foreign('company_id')
                ->references('id')->on('companies')
                ->onDelete('set null');
        });
        Schema::table('company_user', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('set null');
        });
        Schema::table('tracks', function (Blueprint $table) {
            $table->dropForeign(['yard_id']);
            $table->foreign('yard_id')
                ->references('id')->on('yards')
                ->onDelete('set null');
        });
        Schema::table('railroad_switches', function (Blueprint $table) {
            $table->dropForeign(['yard_id']);
            $table->foreign('yard_id')
                ->references('id')->on('yards')
                ->onDelete('set null');
        });
        Schema::table('track_sections', function (Blueprint $table) {
            $table->dropForeign(['track_id']);
            $table->foreign('track_id')
                ->references('id')->on('tracks')
                ->onDelete('set null');
        });
        Schema::table('inspections', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('set null');
        });
        Schema::table('inspections', function (Blueprint $table) {
            $table->dropForeign(['yard_id']);
            $table->foreign('yard_id')
                ->references('id')->on('yards')
                ->onDelete('set null');
        });
        Schema::table('inspections', function (Blueprint $table) {
            $table->dropForeign(['track_id']);
            $table->foreign('track_id')
                ->references('id')->on('tracks')
                ->onDelete('set null');
        });
        Schema::table('inspections', function (Blueprint $table) {
            $table->dropForeign(['tracksection_id']);
            $table->foreign('tracksection_id')
                ->references('id')->on('track_sections')
                ->onDelete('set null');
        });
        Schema::table('inspections', function (Blueprint $table) {
            $table->dropForeign(['railroadswitch_id']);
            $table->foreign('railroadswitch_id')
                ->references('id')->on('railroad_switches')
                ->onDelete('set null');
        });
        Schema::table('defect_tracks', function (Blueprint $table) {
            $table->dropForeign(['inspection_id']);
            $table->foreign('inspection_id')
                ->references('id')->on('inspections')
                ->onDelete('set null');
        });
        Schema::table('defect_tracks', function (Blueprint $table) {
            $table->dropForeign(['component_catalogs_id']);
            $table->foreign('component_catalogs_id')
                ->references('id')->on('component_catalogs')
                ->onDelete('set null');
        });
    }
};
