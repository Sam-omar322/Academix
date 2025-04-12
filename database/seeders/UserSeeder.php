<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    
    public function run(): void {
        $faker = Faker::create();

        // إنشاء أدمن
        User::create([
            'name' => $faker->name,
            'email' => 'admin@example.com',
            'password' => Hash::make('abc32132'),
            'role' => 'admin',
            'lang' => 'ar'
        ]);
        
        // إنشاء 10 طلاب
        User::factory()->count(10)->create([
            'name' => $faker->name,
            'email' => function () {
                return Str::random(10) . '@example.com';
            },
            'password' => Hash::make('abc32132'),
            'role' => 'student',
            'lang' => 'ar',
        ]);
    }
}

