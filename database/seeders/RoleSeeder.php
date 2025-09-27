<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $managerRole = Role::create(['name' => 'manager']);
        $mentorRole = Role::create(['name' => 'mentor']);
        $memberRole = Role::create(['name' => 'member']);
        
        // Create permissions
        $permissions = [
            'view_dashboard',
            'manage_users',
            'manage_content',
            'view_analytics',
            'manage_commissions',
            'view_commissions',
            'manage_leads',
            'view_leads',
            'access_ai_modules',
        ];
        
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        
        // Assign permissions to roles
        $adminRole->givePermissionTo($permissions);
        $managerRole->givePermissionTo([
            'view_dashboard',
            'manage_users',
            'manage_content',
            'view_analytics',
            'manage_commissions',
            'view_commissions',
            'manage_leads',
            'view_leads',
            'access_ai_modules',
        ]);
        $mentorRole->givePermissionTo([
            'view_dashboard',
            'manage_content',
            'view_analytics',
            'manage_leads',
            'view_leads',
            'access_ai_modules',
        ]);
        $memberRole->givePermissionTo([
            'view_dashboard',
            'view_commissions',
            'view_leads',
            'access_ai_modules',
        ]);
    }
}
