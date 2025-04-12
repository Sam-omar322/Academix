<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\User;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $users = User::where('role', 'admin')->get();

        foreach ($users as $user) {
            Blog::factory()->count(2)->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
