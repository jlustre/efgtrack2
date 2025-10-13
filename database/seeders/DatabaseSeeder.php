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

        // Create admin with sponsor_id=1 (will be self after creation)
            $admin = User::factory()->create([
                'name' => 'Super Admin',
                'password' => bcrypt('password'),
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'username' => 'superadmin',
                'email' => 'superadmin@efgtrack.com',
                'rank_id' => 5, // Admin rank
                'sponsor_id' => 1, // Temporary, will update to self
                'member_status' => 'active',
                'last_active_at' => now(),
            ]);
        // Now set admin's sponsor_id to their own id (self-sponsor)
        $admin->sponsor_id = $admin->id;
        $admin->save();
        $admin->assignRole('admin');
        $admin->assignRole('manager');
        $admin->assignRole('mentor');
        $admin->assignRole('member');

        $manager = User::factory()->create([
            'name' => 'Manager User',
            'password' => bcrypt('password'),
            'first_name' => 'Manager',
            'last_name' => 'User',
            'username' => 'manager',
            'email' => 'manager@efgtrack.com',
            'rank_id' => 4, // Manager rank
            'sponsor_id' => $admin->id,
            'member_status' => 'active',
            'last_active_at' => now(),
        ]);
        $manager->assignRole('manager');
        $admin->assignRole('member');

        $mentor = User::factory()->create([
            'name' => 'Mentor User',
            'password' => bcrypt('password'),
            'first_name' => 'Mentor',
            'last_name' => 'User',
            'username' => 'mentor',
            'email' => 'mentor@efgtrack.com',
            'rank_id' => 3, // Mentor rank
            'sponsor_id' => $manager->id,
            'member_status' => 'active',
            'last_active_at' => now(),
        ]);
        $mentor->assignRole('mentor');
        $admin->assignRole('member');


        $member = User::factory()->create([
            'name' => 'Joey Lustre',
            'password' => bcrypt('password'),
            'first_name' => 'Joey',
            'last_name' => 'Lustre',
            'username' => 'jlustre',
            'email' => 'jlustre@efgtrack.com',
            'rank_id' => 1, // Member rank
            'member_status' => 'active',
            'sponsor_id' => $mentor->id,
            'assigned_manager_id' => $manager->id,
            'last_active_at' => now(),
        ]);
        $member->assignRole('member');
    }
}
