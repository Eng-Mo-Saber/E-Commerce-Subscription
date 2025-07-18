<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'name' => 'reading',
        ]);
        Service::create([
            'name' => 'audio ',
        ]);
        Service::create([
            'name' => 'download',
        ]);
    }
}
