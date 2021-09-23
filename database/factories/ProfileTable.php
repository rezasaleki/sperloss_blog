<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
        'title' => $faker->title,
        'bio' => $faker->paragraph,
        'website' => $faker->url,
        'image' => $faker->imageUrl
    ];
});
