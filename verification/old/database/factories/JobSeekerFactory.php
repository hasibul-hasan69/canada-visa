<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\JobSeeker;
use Faker\Generator as Faker;
use Carbon\Carbon;


$factory->define(JobSeeker::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
        'phone'=>$faker->phoneNumber,
        'email'=>$faker->email,
        'passportNo'=>strtoupper(uniqid()),
        'country'=>$faker->country,
        'appointDate'=>$faker->date(),
        'reportTime'=>$faker->time(),
        'designation'=>$faker->title,
        'jobLocation'=>$faker->address,
        'salary'=>$faker->numberBetween(10,10),
        'currency'=>$faker->randomElement(['cad','usd']),
        'barCode'=>substr(str_shuffle("abcjhalkdfjkdsgf"), 0,5).uniqid(),
        'status'=>$faker->randomElement([1,2,3]),
        'isPrinted'=>0,
        'created_at'=>Carbon::now(),
    ];
});
