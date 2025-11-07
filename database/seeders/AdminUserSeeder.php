<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@salon.test'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password123'),
                'is_admin' => true,
            ]
        );

        if (!$user->is_admin) {
            $user->is_admin = true;
            $user->save();
        }
    }
}
