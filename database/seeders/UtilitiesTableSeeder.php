<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UtilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('utilities')->insert([
            [
                'computer_id' => 1, 
                'name' => 'Secretlab Titan 2020 Series', 
                'brand' => 'Secretlab',
                'type_id' => 9,
                'cost' => 2200,
                'purchase_date' => '2019-07-01', 
                'status_id' => 7,
                'remarks' => 'None'
            ]
        ]);
    }
}
