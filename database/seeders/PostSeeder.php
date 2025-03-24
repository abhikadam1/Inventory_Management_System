<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $faker = Faker::create();

        // for ($i = 0; $i < 50; $i++) {
        //     Post::create([
        //         'title' => $faker->sentence(6), // Generates a random title
        //         'content' => $faker->paragraph(4) // Generates random content
        //     ]);
        // }

        Post::factory(10)->create();
    }
}
