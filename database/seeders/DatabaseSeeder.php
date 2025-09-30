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
        ]);

        // Create test users with roles
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@efgtrack.com',
            'rank_id' => 5, // Admin rank
            'sponsor_id' => null, // Admin exempt from sponsor
        ]);
        $admin->assignRole('admin');

        $mentor = User::factory()->create([
            'name' => 'Mentor User',
            'email' => 'mentor@efgtrack.com',
            'rank_id' => 3, // Mentor rank
            'sponsor_id' => $admin->id,
        ]);
        $mentor->assignRole('mentor');

        $manager = User::factory()->create([
            'name' => 'Manager User',
            'email' => 'manager@efgtrack.com',
            'rank_id' => 4, // Manager rank
            'sponsor_id' => $admin->id,
        ]);
        $manager->assignRole('manager');

        $member = User::factory()->create([
            'name' => 'Member User',
            'email' => 'member@efgtrack.com',
            'rank_id' => 2, // Member rank
            'sponsor_id' => $mentor->id,
        ]);
        $member->assignRole('member');
    }
}
