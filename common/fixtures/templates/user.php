<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'email' => $faker->email,
    'name' => $faker->firstName,
    'password' => $faker->numberBetween(1, 5)   
];