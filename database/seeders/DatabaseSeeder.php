<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(UserRolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(LocationsTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(TypesTableSeeder::class);
        $this->call(ComputersTableSeeder::class);
        $this->call(DesktopsTableSeeder::class);
        $this->call(PeripheralsTableSeeder::class);
        $this->call(SoftwareTableSeeder::class);
        $this->call(UtilitiesTableSeeder::class);
        $this->call(NetworksTableSeeder::class);
    }
}
