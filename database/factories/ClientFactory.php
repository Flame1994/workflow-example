<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use App\Company;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'company_id' => factory(Company::class)->create()->id,
        'name' => $faker->name,
        'email' => $faker->email,
        'phone_number' => $faker->phoneNumber,
        'joined' => $faker->dateTime,
    ];
});
