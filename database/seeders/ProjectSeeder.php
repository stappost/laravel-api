<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use Faker\Generator as Faker;

use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i<10; $i++){
            $new_project = new Project();
            $new_project->name = $faker->words(3, true);
            $new_project->description = $faker->paragraphs(4, true);
            $new_project->start_project = $faker->date();
            $new_project->finish_project = $faker->date();
            $new_project->slug = Str::slug($new_project->name, '-');
            $new_project->in_team = '0';

            $new_project->save();
        }
    }
}
