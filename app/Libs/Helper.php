<?php

namespace App\Libs;

use App\Enums\WorkStatusEnum;
use Illuminate\Database\Eloquent\Collection;

class Helper {

    /**
     * Полное наименование автомобиля
     *
     * @param object|array $car_data
     * @param bool $year
     * @return string
     */
    public static function carName(object|array $car_data, bool $year = false): string
    {
        if (is_array($car_data)) {
            return $car_data['mark']['title'] . ' ' . $car_data['model'] . ($year ? ' (' . $car_data['year'] . ')' : '');
        }

        return $car_data->mark->title . ' ' . $car_data->model . ($year ? ' (' . $car_data->year . ')' : '');
    }

    /**
     * Статус текстом
     *
     * @param int $status
     * @return string
     */
    public static function statusText(int $status): string
    {
        return match ($status) {

            WorkStatusEnum::Planned->value   => 'Запланировано',
            WorkStatusEnum::InWork->value    => 'В работе',
            WorkStatusEnum::Completed->value => 'Выполнено',

            default => 'В архиве',
        };
    }

    /**
     * Вывод пробега
     *
     * @param int|null $mileage
     * @return string
     */
    public static function mileage(?int $mileage): string
    {
        if (is_null($mileage)) {
            return ' - ';
        }

        return number_format($mileage, 0, '.', ' ') . ' км.';
    }

    /**
     * Объем двигателя
     *
     * @param int|null $volume
     * @return string
     */
    public static function volume(?int $volume): string
    {
        if (is_null($volume)) {
            return ' - ';
        }

        return $volume . ' cm3';
    }

    /**
     * Год автомобиля
     *
     * @param int|null $year
     * @return string
     */
    public static function year(?int $year): string
    {
        if (is_null($year)) {
            return ' - ';
        }

        return $year . ' г/в';
    }

    /**
     * Объем заправки в литрах
     *
     * @param float|null $gas
     * @return string
     */
    public static function liters(?float $gas): string
    {
        if (is_null($gas)) {
            return ' - ';
        }

        return number_format($gas, 2, '.', ' ') . ' л.';
    }

    /**
     * Стоимость
     *
     * @param float|null $price
     * @param bool $float
     * @return string
     */
    public static function price(?float $price, bool $float = false): string
    {
        if (is_null($price)) {
            return ' - ';
        }

        return number_format($price, $float ? 2 : 0, '.', ' ') . ' р.';
    }

}
