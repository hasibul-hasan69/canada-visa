<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Company;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name'=>$faker->company,
        'phone'=>$faker->phoneNumber,
        'email'=>$faker->email,
        'website'=>$faker->url(),
        'address'=>$faker->address,
        'header'=>'https://picsum.photos/980/100?random='.$faker->randomNumber(),
        'footer'=>'https://picsum.photos/980/100?random='.$faker->randomNumber(),
        'status'=>1,
        'created_at'=>Carbon::now(),
    ];
});
