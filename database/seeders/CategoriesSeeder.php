<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'id'=>1,
            'name'=>'اللغة العربية',
        ]);
        Category::create([
            'id'=>2,
            'name'=>'اللغة الانجليزيه',
        ]);
    }
}
