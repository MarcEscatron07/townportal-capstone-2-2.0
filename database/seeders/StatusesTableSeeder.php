<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
        	['name' => 'Working'],
            ['name' => 'For Maintenance'],
            ['name' => 'Active'],
            ['name' => 'Expired'],
            ['name' => 'Connected'],
            ['name' => 'Disconnected'],
            ['name' => 'Good'],
            ['name' => 'Damaged']            
        ]);
    }
}
