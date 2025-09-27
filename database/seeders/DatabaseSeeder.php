<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
        ]);

        // Create test users with roles
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@efgtrack.com',
        ]);
        $admin->assignRole('admin');

        $mentor = User::factory()->create([
            'name' => 'Mentor User',
            'email' => 'mentor@efgtrack.com',
        ]);
        $mentor->assignRole('mentor');

        $manager = User::factory()->create([
            'name' => 'Manager User',
            'email' => 'manager@efgtrack.com',
        ]);
        $manager->assignRole('manager');

        $member = User::factory()->create([
            'name' => 'Member User',
            'email' => 'member@efgtrack.com',
        ]);
        $member->assignRole('member');
    }
}
