<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DesktopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('desktops')->insert([
            [
                'computer_id' => 1, 
                'name' => 'ROG Strix GL12', 
                'brand' => 'ASUS',                        
                'serial_number' => '9XYT89UJG',
                'cost' => 18500,
                'purchase_date' => '2019-07-01',               
                'status_id' => 1
            ],
            [
                'computer_id' => 2, 
                'name' => 'Acer Predator Orion 9000', 
                'brand' => 'Acer',                        
                'serial_number' => '3XYHD3UJG',
                'cost' => 15100,
                'purchase_date' => '2019-07-01',               
                'status_id' => 1
            ]
        ]);
    }
}
