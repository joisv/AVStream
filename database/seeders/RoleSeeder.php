<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        Role::create(['name' => 'super-admin'])->givePermissionTo(Permission::all());
        Role::create(['name' => 'admin'])->givePermissionTo(['can create', 'can update', 'can delete', 'can premium content']);
        Role::create(['name' => 'writer'])->givePermissionTo('can update', 'can premium content', 'can create');
        Role::create(['name' => 'vip'])->givePermissionTo('can premium content');
    }
}
