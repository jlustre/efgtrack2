<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds for users/roles.
     */
    public function run(): void
    {
        // Create or update admin (idempotent)
        $admin = User::firstOrNew(['email' => 'superadmin@efgtrack.com']);
        $admin->name = 'Super Admin';
        $admin->first_name = 'Super';
        $admin->last_name = 'Admin';
        $admin->username = 'superadmin';
        // Only set the password if the user is newly created or password is empty
        if (! $admin->exists || ! $admin->password) {
            $admin->password = bcrypt('password');
        }
        $admin->rank_id = 5;
        // set a temporary sponsor_id for new admin to satisfy non-null DB constraint
        if (! $admin->exists) {
            $admin->sponsor_id = 1; // temporary placeholder, will be updated to self after save
        }
        $admin->member_status = 'active';
        $admin->last_active_at = now();
        $admin->save();
        // ensure sponsor_id points to self
        if ($admin->sponsor_id !== $admin->id) {
            $admin->sponsor_id = $admin->id;
            $admin->save();
        }
        // assign roles without detaching existing roles
        $admin->assignRole('admin');
        $admin->assignRole('manager');
        $admin->assignRole('mentor');
        $admin->assignRole('member');

        

        // Create or update manager
        $manager = User::firstOrNew(['email' => 'manager@efgtrack.com']);
        $manager->name = 'Manager User';
        $manager->first_name = 'Manager';
        $manager->last_name = 'User';
        $manager->username = 'manager';
        if (! $manager->exists || ! $manager->password) {
            $manager->password = bcrypt('password');
        }
        $manager->rank_id = 4;
        $manager->sponsor_id = $admin->id;
        $manager->member_status = 'active';
        $manager->last_active_at = now();
        $manager->save();
        $manager->assignRole('manager');

        // Create or update mentor
        $mentor = User::firstOrNew(['email' => 'mentor@efgtrack.com']);
        $mentor->name = 'Mentor User';
        $mentor->first_name = 'Mentor';
        $mentor->last_name = 'User';
        $mentor->username = 'mentor';
        if (! $mentor->exists || ! $mentor->password) {
            $mentor->password = bcrypt('password');
        }
        $mentor->rank_id = 3;
        $mentor->sponsor_id = $manager->id;
        $mentor->member_status = 'active';
        $mentor->last_active_at = now();
        $mentor->save();
        $mentor->assignRole('mentor');

        // Create or update member
        $member = User::firstOrNew(['email' => 'jlustre@efgtrack.com']);
        $member->name = 'Joey Lustre';
        $member->first_name = 'Joey';
        $member->last_name = 'Lustre';
        $member->username = 'jlustre';
        if (! $member->exists || ! $member->password) {
            $member->password = bcrypt('password');
        }
        $member->rank_id = 1;
        $member->member_status = 'active';
        $member->sponsor_id = $mentor->id;
        $member->assigned_manager_id = $manager->id;
        $member->last_active_at = now();
        $member->save();
        $member->assignRole('member');
    }
}
