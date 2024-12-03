<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'Administrator']);
        $admin->permissions()->attach(Permission::pluck('id'));

        $user = Role::create(['name' => 'User']);
        $user->permissions()->attach(
            Permission::where('name', '=', 'posts.user')
                ->pluck('id')
        );
    }
}
