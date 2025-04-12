<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;

class CourseUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $users = User::where('role', 'student')->get();
        $courses = Course::all();

        foreach ($users as $user) {
            $randomCourses = $courses->random(rand(1, 3));
            foreach ($randomCourses as $course) {
                $user->courses()->attach($course->id, [
                    'bought' => true,
                    'price_at_purchase' => $course->price,
                ]);
            }
        }
    }
}
