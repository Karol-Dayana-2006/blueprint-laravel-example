<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Course;
use App\Models\Enrollments;
use App\Models\Lesson;
use App\Models\User;
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
        User::factory(5)->create([
            'role' => 'admin'
        ]);

        User::factory(3)->create([
            'role' => 'instructor'
        ]);

        Category::factory(5)->create();
        Course::factory(10)->create();
        Lesson::factory(10)->create();
        Enrollments::factory(5)->create();
    }
}
