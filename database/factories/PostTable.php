<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
        'title' => $faker->title,
        'content' => $faker->text,
        'thumbnail' => $faker->imageUrl,
        'image' => $faker->imageUrl,
        'visit' => 0,
        'visited' => 0,
        'activated' => 0,
    ];
});
