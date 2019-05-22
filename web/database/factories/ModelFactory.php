<?php
use Faker\Generator;
use App\Post;
use App\Comment;
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

/*$factory->define(Post::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
        'title'   => $faker->randomElement(['Apa yaa judulnya', 'aku gatau judulnya apaan', 'ehh apa yaaa ', 'djudul 1', 'jdul 22 aja kali ya']),
        'body'    => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum",
        'image_url' => $faker->randomElement(['https://dummyimage.com/600x400/008033/ffffff&text=1', 'https://dummyimage.com/600x400/008033/ffffff&text=2','https://dummyimage.com/600x400/008033/ffffff&text=3','https://dummyimage.com/600x400/008033/ffffff&text=4']),
    ];
});*/

$factory->define(Comment::class, function(Faker\Generator $faker){
	return [
        'name'    		=> $faker->randomElement(['Nanda', 'Tami', 'Dini']),
        'email'   		=> "emai@email.com",
        'message'    	=> "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum",
        'mobile' 		=> "08962722929",
    ];
});
