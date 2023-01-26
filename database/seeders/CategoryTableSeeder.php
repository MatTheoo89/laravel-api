<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list_type = ['FrontEnd', 'BackEnd', 'FullStack'];

        foreach ($list_type as $type) {
            $new_type = new Type();
            $new_type->type = $type;
            $new_type->slug = Str::slug($type);
            $new_type->save();
        }
    }
}
