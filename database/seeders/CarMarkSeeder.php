<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Article;
use App\Models\CarMark;
use App\Models\Note;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CarMarkSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CarMark::create(['title' => 'Acura']);
        CarMark::create(['title' => 'Alfa Romeo']);
        CarMark::create(['title' => 'Aston Martin']);
        CarMark::create(['title' => 'Audi']);
        CarMark::create(['title' => 'Bentley']);
        CarMark::create(['title' => 'BMW']);
        CarMark::create(['title' => 'Bugatti']);
        CarMark::create(['title' => 'Buick']);
        CarMark::create(['title' => 'Cadillac']);
        CarMark::create(['title' => 'Changan']);
        CarMark::create(['title' => 'Chery']);
        CarMark::create(['title' => 'CheryExeed']);
        CarMark::create(['title' => 'Chevrolet']);
        CarMark::create(['title' => 'Chrysler']);
        CarMark::create(['title' => 'Citroen']);
        CarMark::create(['title' => 'Dacia']);
        CarMark::create(['title' => 'Daewoo']);
        CarMark::create(['title' => 'Daihatsu']);
        CarMark::create(['title' => 'Dodge']);
        CarMark::create(['title' => 'EXEED']);
        CarMark::create(['title' => 'Faw']);
        CarMark::create(['title' => 'Ferrari']);
        CarMark::create(['title' => 'Fiat']);
        CarMark::create(['title' => 'Ford']);
        CarMark::create(['title' => 'Geely']);
        CarMark::create(['title' => 'Genesis']);
        CarMark::create(['title' => 'Haval']);
        CarMark::create(['title' => 'Honda']);
        CarMark::create(['title' => 'Hummer']);
        CarMark::create(['title' => 'Hyundai']);
        CarMark::create(['title' => 'Infiniti']);
        CarMark::create(['title' => 'Isuzu']);
        CarMark::create(['title' => 'Iveco']);
        CarMark::create(['title' => 'JAC']);
        CarMark::create(['title' => 'Jaguar']);
        CarMark::create(['title' => 'Jeep']);
        CarMark::create(['title' => 'JMC']);
        CarMark::create(['title' => 'Kia']);
        CarMark::create(['title' => 'Koenigsegg']);
        CarMark::create(['title' => 'Lamborghini']);
        CarMark::create(['title' => 'Lancia']);
        CarMark::create(['title' => 'Land Rover']);
        CarMark::create(['title' => 'Lexus']);
        CarMark::create(['title' => 'LIFAN']);
        CarMark::create(['title' => 'Lincoln']);
        CarMark::create(['title' => 'Lotus']);
        CarMark::create(['title' => 'Marussia']);
        CarMark::create(['title' => 'Maserati']);
        CarMark::create(['title' => 'Maybach']);
        CarMark::create(['title' => 'Mazda']);
        CarMark::create(['title' => 'McLaren']);
        CarMark::create(['title' => 'Mercedes-Benz']);
        CarMark::create(['title' => 'MG']);
        CarMark::create(['title' => 'MINI']);
        CarMark::create(['title' => 'Mitsubishi']);
        CarMark::create(['title' => 'Nissan']);
        CarMark::create(['title' => 'OMODA']);
        CarMark::create(['title' => 'Opel']);
        CarMark::create(['title' => 'Pagani']);
        CarMark::create(['title' => 'Peugeot']);
        CarMark::create(['title' => 'Plymouth']);
        CarMark::create(['title' => 'Pontiac']);
        CarMark::create(['title' => 'Porsche']);
        CarMark::create(['title' => 'Renault']);
        CarMark::create(['title' => 'Rover']);
        CarMark::create(['title' => 'Saab']);
        CarMark::create(['title' => 'Scoda']);
        CarMark::create(['title' => 'SsangYong']);
        CarMark::create(['title' => 'Subaru']);
        CarMark::create(['title' => 'Suzuki']);
        CarMark::create(['title' => 'Tesla']);
        CarMark::create(['title' => 'Toyota']);
        CarMark::create(['title' => 'Ultima']);
        CarMark::create(['title' => 'Volkswagen']);
        CarMark::create(['title' => 'Volvo']);
        CarMark::create(['title' => 'ВАЗ']);
        CarMark::create(['title' => 'ГАЗ']);
        CarMark::create(['title' => 'ЗАЗ']);
        CarMark::create(['title' => 'Москвич']);
        CarMark::create(['title' => 'ТагАЗ']);
        CarMark::create(['title' => 'УАЗ']);
    }
}
