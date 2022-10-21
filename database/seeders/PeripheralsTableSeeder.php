<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PeripheralsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('peripherals')->insert([
            [
                'computer_id' => 1, 
                'name' => 'ASUS ROG Swift PG279Q', 
                'brand' => 'ASUS',
                'type_id' => 2,
                'serial_number' => '7UYM460LPK',
                'cost' => 8000,
                'purchase_date' => '2019-07-01', 
                'status_id' => 1
            ],
            [
                'computer_id' => 1, 
                'name' => 'Razer Cynosa Chroma', 
                'brand' => 'Razer',
                'type_id' => 3,
                'serial_number' => '8X3F60GJG',
                'cost' => 4200,
                'purchase_date' => '2019-07-01', 
                'status_id' => 1
            ],
            [
                'computer_id' => 1, 
                'name' => 'Steelseries Sensei 310', 
                'brand' => 'Steelseries',
                'type_id' => 4,
                'serial_number' => '4CYT460GJG',
                'cost' => 3500,
                'purchase_date' => '2019-07-01', 
                'status_id' => 1
            ],
            [
                'computer_id' => 1, 
                'name' => 'HyperX Cloud Revolver S', 
                'brand' => 'HyperX',
                'type_id' => 5,
                'serial_number' => 'NKRC460UHE',
                'cost' => 1000,
                'purchase_date' => '2019-07-01', 
                'status_id' => 1
            ],[
                'computer_id' => 2, 
                'name' => 'TEST MONITOR', 
                'brand' => 'TEST BRAND',
                'type_id' => 2,
                'serial_number' => 'TEST SERIAL1',
                'cost' => 8000,
                'purchase_date' => '2019-07-01', 
                'status_id' => 1
            ],
            [
                'computer_id' => 2, 
                'name' => 'TEST KEYBOARD', 
                'brand' => 'TEST BRAND',
                'type_id' => 3,
                'serial_number' => 'TEST SERIAL2',
                'cost' => 4200,
                'purchase_date' => '2019-07-01', 
                'status_id' => 1
            ],
            [
                'computer_id' => 2, 
                'name' => 'TEST MOUSE', 
                'brand' => 'TEST BRAND',
                'type_id' => 4,
                'serial_number' => 'TEST SERIAL3',
                'cost' => 3500,
                'purchase_date' => '2019-07-01', 
                'status_id' => 1
            ],
            [
                'computer_id' => 2, 
                'name' => 'TEST HEADSET', 
                'brand' => 'TEST BRAND',
                'type_id' => 5,
                'serial_number' => 'TEST SERIAL4',
                'cost' => 1000,
                'purchase_date' => '2019-07-01', 
                'status_id' => 1
            ]
        ]);
    }
}
