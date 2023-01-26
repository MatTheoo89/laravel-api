<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TecnologyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list_tecnologies = ['HTML', 'CSS', 'SASS', 'JavaScript', 'VueJS', 'React', 'PHP', 'Laravel', 'MySQL'];

        foreach ($list_tecnologies as $Tecnology) {
            $new_Tecnology = new Technology();
            $new_Tecnology->type = $Tecnology;
            $new_Tecnology->slug = Str::slug($Tecnology);
            $new_Tecnology->save();
        }
    }
}
