<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NetworksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('networks')->insert([
            [
                'location_id' => 1, 
                'name' => 'LAN 1',
                'service_provider' => 'PLDT',
                'status_id' => 5,
                'remarks' => 'None'
            ]
        ]);
    }
}
