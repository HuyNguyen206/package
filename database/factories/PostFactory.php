<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use huynl\Press\Post;

$factory->define(Post::class, function (\Faker\Generator $faker){
    $title = $faker->sentence;
   return [
       'identifier' => Str::random(),
       'slug' => Str::slug($title),
       'title' => $title,
       'body' => $faker->paragraph,
       'extra' => json_encode(['test' => 'value'])
   ];
});