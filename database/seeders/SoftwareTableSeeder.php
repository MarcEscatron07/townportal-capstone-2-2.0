<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SoftwareTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('software')->insert([
            [
                'computer_id' => 1,
                'name' => 'League of Legends',
                'company' => 'Riot Games',
                'type_id' => 7,
                'cost' => 0,
                'subscription_date' => '2019-07-01',
                'subscription_end' => '2022-07-01',     
                'status_id' => 3,
                'remarks' => 'None'
            ]
        ]);
    }
}
