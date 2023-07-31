<?php

namespace Database\Seeders;

use App\Enums\WorkStatusEnum;
use App\Models\Car;
use App\Models\Article;
use App\Models\CarMark;
use App\Models\Note;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'     => 'Водитель',
            'email'    => 'demo@mail.ru',
            'password' => Hash::make('demo'),
            'email_verified_at' => Carbon::now(),
        ])->id;

        $audi = Car::create([
            'owner_id'   => $user,
            'mark_id'    => 4,
            'model'      => 'A6',
            'year'       => 2012,
            'volume'     => 3000,
            'vin'        => 'VAGETR534DE35490',
            'number'     => 'с505ос 39',
            'additional' => 'Автомобиль жены',
        ])->car_id;

        Note::create([
            'client_id'  => $user,
            'car_id'     => $audi,
            'title'      => 'Покупка',
            'additional' => 'Сегодня приобрел автомобиль и переоформил',
            'mileage'    => 92082,
        ]);

        $bmw = Car::create([
            'owner_id'   => $user,
            'mark_id'    => 6,
            'model'      => '320',
            'year'       => 2009,
            'volume'     => 2000,
            'vin'        => 'BAVTFD5438DF6379',
            'number'     => 'р333ву 39',
            'additional' => 'Мой конь',
        ])->car_id;

        Note::create([
            'client_id'  => $user,
            'car_id'     => $bmw,
            'title'      => 'Покупка',
            'additional' => 'Сегодня приобрел автомобиль и переоформил',
            'mileage'    => 124580,
        ]);

        Note::create([
            'client_id'  => $user,
            'car_id'     => $bmw,
            'title'      => 'Первая поломка',
            'additional' => 'Сегодня загорелся check, записался на диагностику',
            'mileage'    => 124754,
        ]);

        Service::create([
            'client_id'     => $user,
            'car_id'        => $bmw,
            'service_title' => 'Ашот Сервис',
            'title'         => 'Диагностика',
            'work_list'     => 'Выполнена диагностика на ошибки, текущих ошибок нет, только в истории по ABS, ошибки сбросили.',
            'mileage'       => 124782,
            'price'         => 1500,
            'status'        => WorkStatusEnum::Completed,
            'additional'    => 'Рад, что ничего серьезного',
        ]);

        Note::create([
            'client_id'  => $user,
            'car_id'     => $bmw,
            'title'      => 'Скрип при торможении',
            'additional' => 'Сегодня начался скрип при торможении и загорелся датчик износа колодок',
            'mileage'    => 125102,
        ]);

        Service::create([
            'client_id'     => $user,
            'car_id'        => $bmw,
            'service_title' => 'Васген Сервис',
            'title'         => 'Замена колодок',
            'work_list'     => 'Выполнена замена передних тормозных колодок',
            'mileage'       => 125186,
            'price'         => 2000,
            'status'        => WorkStatusEnum::Completed,
            'additional'    => '',
        ]);

        Article::create([
            'client_id'  => $user,
            'car_id'     => $bmw,
            'article'    => '34116780711',
            'title'      => 'Тормозные колодки - фронт',
            'price'      => 5985,
            'additional' => 'Колодки TRW',
        ]);

        Note::create([
            'client_id'  => $user,
            'car_id'     => $bmw,
            'title'      => 'Наблюдения',
            'additional' => 'Накатал почти первую свою тысячу, пока доволен',
            'mileage'    => 125473,
        ]);
    }
}
