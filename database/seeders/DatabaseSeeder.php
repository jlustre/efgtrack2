<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\StatesProvincesSeeder;
use Database\Seeders\TimezoneSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            CountrySeeder::class,
            StatesProvincesSeeder::class,
            TimezoneSeeder::class,
            RankSeeder::class,
            UsersSeeder::class,
        ]);

        // Create test users with roles using a separate seeder
        $this->call([
            UsersSeeder::class,
        ]);
    }
}
