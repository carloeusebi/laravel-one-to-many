<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $DIR = 'project_images';

        Storage::makeDirectory($DIR);
        // creates 10 records
        for ($i = 0; $i < 10; $i++) {
            Project::create([
                'name' => $faker->words(3, true),
                'thumbnail' => "$DIR/" . $faker->image(storage_path("app/public/$DIR"), 250, 250, fullPath: false),
                'description' => $faker->paragraph(10),
                'url' => $faker->url(),
                'github_url' => $faker->url(),

            ]);
        }
    }
}
