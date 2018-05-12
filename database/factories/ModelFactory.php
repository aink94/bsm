<?php

use bsm\Model\Koperasi;
use bsm\Model\Nasabah;
use bsm\Model\Pegawai;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/* @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Pegawai::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'nama'      => $faker->name,
        'username'  => $faker->unique()->userName,
        'password'  => 'password', //$password ?: $password = bcrypt('secret'),
        'status_id' => rand(1, 3),
        //'remember_token' => str_random(10),
    ];
});

$factory->define(Nasabah::class, function (Faker\Generator $faker) {
    return [
        'nis'          => $faker->unique()->isbn10,
        'uid'          => $faker->unique()->ean8,
        'nama'         => $faker->name, //$password ?: $password = bcrypt('secret'),
        'date_opened'  => $faker->dateTimeThisYear(),
        'date_closed'  => $faker->dateTimeThisYear(),
        'status_kartu' => ['GOLD', 'SILVER'][rand(0, 1)],
    ];
});

$factory->define(Koperasi::class, function (Faker\Generator $faker) {
    //static $password;

    return [
        'nama'       => $faker->company,
        'date_open'  => $faker->date($format = 'Y-m-d', $max = 'now'),
        'date_close' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'key'        => bcrypt($faker->company),
        'token'      => bcrypt($faker->company),
    ];
});
