<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\User;
use App\Models\Course;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $users = User::all();
        $courses = Course::all();

        foreach ($courses as $course) {
            Comment::factory()->count(3)->create([
                'course_id' => $course->id,
                'user_id' => $users->random()->id,
            ]);
        }
    }
}
