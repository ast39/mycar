<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cars', function(Blueprint $table) {
            $table->foreign('owner_id', 'car_owner_key')
                ->references('id')
                ->on('users');

            $table->foreign('mark_id', 'car_mark_key')
                ->references('mark_id')
                ->on('car_marks');
        });

        Schema::table('works', function(Blueprint $table) {

            $table->foreign('client_id', 'work_client_key')
                ->references('id')
                ->on('users');

            $table->foreign('car_id', 'work_car_key')
                ->references('car_id')
                ->on('cars');
        });

        Schema::table('articles', function(Blueprint $table) {

            $table->foreign('client_id', 'article_client_key')
                ->references('id')
                ->on('users');

            $table->foreign('car_id', 'article_car_key')
                ->references('car_id')
                ->on('cars');
        });

        Schema::table('notes', function(Blueprint $table) {

            $table->foreign('client_id', 'note_client_key')
                ->references('id')
                ->on('users');

            $table->foreign('car_id', 'note_car_key')
                ->references('car_id')
                ->on('cars');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function(Blueprint $table) {
            $table->dropForeign('car_owner_key');
        });

        Schema::table('works', function(Blueprint $table) {
            $table->dropForeign('work_client_key');
            $table->dropForeign('work_car_key');
        });

        Schema::table('articles', function(Blueprint $table) {
            $table->dropForeign('article_client_key');
            $table->dropForeign('article_car_key');
        });

        Schema::table('notes', function(Blueprint $table) {
            $table->dropForeign('note_client_key');
            $table->dropForeign('note_car_key');
        });
    }
};
