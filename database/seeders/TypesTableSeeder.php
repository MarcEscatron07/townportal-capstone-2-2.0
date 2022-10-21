<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
        	['name' => 'Desktop'],
        	['name' => 'Monitor'],
        	['name' => 'Keyboard'],
        	['name' => 'Mouse'],
        	['name' => 'Headset'],
        	['name' => 'Games'],
			['name' => 'Office'],
			['name' => 'AVR'],
			['name' => 'UPS'],
        	['name' => 'Computer Chair'],
        	['name' => 'Desk']
        ]);
    }
}
