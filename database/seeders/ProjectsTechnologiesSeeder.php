<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectsTechnologiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = Project::all();
        foreach ($projects as $project) {
            $rand = rand(0,4);
            for ($i=0; $i < $rand; $i++) { 
                $tecnology_id = Technology::all()->unique()->random()->id;
                // dd($tecnology_id);
                $project->technologies()->attach($tecnology_id);
            }
        }
    }
}
