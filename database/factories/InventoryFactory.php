<?php

use App\Inventory;
use Faker\Generator as Faker;
function autoIncrement()
{
    $arr = array();
    $num = Inventory::max('code');
    for ($i = 1; $i <= 10; ++$i) {
        if ($i == 1){
            $num = (Inventory::count() < 1) ? "ITM-001" : ++$num;
            $arr[] = $num;
        }else{
            $arr[] = ++$num;
        }
    }
    return $arr;
}
$autoIncrement = autoIncrement();
$factory->define(App\Inventory::class, function (Faker $faker) use ($autoIncrement) {
    $faker = \Faker\Factory::create();
    $faker->addProvider(new \Bezhanov\Faker\Provider\Device($faker));
    $faker->addProvider(new Liior\Faker\Prices($faker));
    $faker->price($min = 1000, $max = 20000, $psychologicalPrice = true, $decimals = true);
    static $number = 0;
    return [
        //
        'code' => $autoIncrement[$number++],
        'name' =>$faker->unique()->deviceModelName,
        'os' =>$faker->devicePlatform,
        'manufacturer'  =>$faker->deviceManufacturer,
        'quantity' => $faker->numberBetween($min = 0, $max = 7),
        'price' => $faker->price(100, 200, true),
    ];

});