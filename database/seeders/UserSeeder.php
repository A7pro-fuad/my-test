<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->create(
            [
                'email' => 'admin@admin.com',
                'name' => 'Admin',
            ]
        );
        $admin->roles()->attach(Role::where('name', 'Administrator')->value('id'));

        $editor = User::factory()->create(
            ['email' => 'user@user.com']
        );
        $editor->roles()->attach(Role::where('name', 'User')->value('id'));
    }
}
