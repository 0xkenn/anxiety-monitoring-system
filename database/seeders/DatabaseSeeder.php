<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use Carbon\Carbon;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
       Admin::create([
    'user_id' => '11-1-1111',
    'password' => Hash::make('12345678'), // Hash the password
    'last_name' => 'po',
    'first_name' => 'drake',
    'middle_name' => 'matugas',
    'birthdate' => Carbon::now(),
    'gender' =>  'Male',
    'mobile_number' => '09952565490',
]);
    }
}
