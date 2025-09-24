<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\UserRoleEnum;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'      => 'Admin User',
            'email'     => 'admin@mail.com',
            'password'  => bcrypt('password'),
            'role'      => UserRoleEnum::ADMIN->value,
        ]);

        User::factory()->count(5)->create([
            'role' => UserRoleEnum::OWNER->value
        ]);
    }
}
