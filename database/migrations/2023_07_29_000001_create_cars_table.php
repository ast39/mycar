<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {

            $table->id('car_id')
                ->comment('ID автомобиля');

            $table->unsignedBigInteger('owner_id')
                ->comment('Хозяин автомобиля');

            $table->unsignedBigInteger('mark_id')
                ->comment('ID производителя автомобиля');

            $table->string('model')
                ->comment('Модель автомобиля');

            $table->unsignedInteger('year')
                ->comment('Год автомобиля');

            $table->unsignedInteger('volume')
                ->comment('Объем двигателя');

            $table->string('vin')
                ->nullable()
                ->default(null)
                ->comment('VIN автомобиля');

            $table->string('number')
                ->nullable()
                ->default(null)
                ->comment('Гос номер автомобиля');

            $table->text('additional')
                ->nullable()
                ->default(null)
                ->comment('Описание автомобиля');

            $table->timestamps();

            $table->softDeletes();

            $table->comment('Таблица автомобилей пользователей');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
