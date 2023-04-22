<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $faker = \Faker\Factory::create();

      for ($i = 0; $i < 10; $i++) {

          $user = User::create([
              'name'        => $faker->name,
              'email'             => $faker->email,
              'password'          => Hash::make('password'),
              'phone'      => $faker->phoneNumber,
              'type'      => 'user'
          ]);


      }
  }
}

