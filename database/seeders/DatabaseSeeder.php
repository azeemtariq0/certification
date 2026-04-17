<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Permissions
        $p1 = \App\Models\Permission::create(['name' => 'Manage Certificates', 'slug' => 'manage-certificates']);
        $p2 = \App\Models\Permission::create(['name' => 'Manage Users', 'slug' => 'manage-users']);
        $p3 = \App\Models\Permission::create(['name' => 'Manage Roles', 'slug' => 'manage-roles']);

        // Roles
        $adminRole = \App\Models\Role::create(['name' => 'Administrator', 'slug' => 'admin']);
        $managerRole = \App\Models\Role::create(['name' => 'Manager', 'slug' => 'manager']);

        $adminRole->permissions()->attach([$p1->id, $p2->id, $p3->id]);
        $managerRole->permissions()->attach([$p1->id]);

        // Admin User
        \App\Models\User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'admin',
            'role_id' => $adminRole->id,
        ]);

        // Sample Certificate
        \App\Models\Certificate::create([
            'company_name' => 'ABC Industries Pvt Ltd',
            'certificate_no' => 'S2-ISO-24011',
            'standard' => 'ISO 9001:2015',
            'scope' => 'Manufacturing of Plastic Packaging Products',
            'issue_date' => '2025-01-10',
            'expiry_date' => '2028-01-09',
            'status' => 'Active',
        ]);
    }
}
