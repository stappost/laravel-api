<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items=[
            'HTML',
            'CSS',
            'Javascript',
            'vueJs',
            'PHP',
            'Laravel',
        ];
        foreach($items as $item){
            $technology = new Technology;
            
            $technology->name = $item;
            $technology->slug = Str::slug($item, '-');

            $technology->save();
        }
    }
}
