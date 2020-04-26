<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use App\User;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'user_id' => User::all()->random()->id,
        'content' => $faker->text($maxNbChars = 1200),
        'thumbnail' => 'https://picsum.photos/250/250',
    ];
});
