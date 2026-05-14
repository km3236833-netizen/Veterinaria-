<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = 'admin';
        $user->email = 'admin@gmail.com';
        $user->password = Hash::make('admin');
        $user->rol = 'administrador';
        $user->save();

        $user = new User();
        $user->name = 'veterinario';
        $user->email = 'veterinario@gmail.com';
        $user->password = Hash::make('veterinario');
        $user->rol = 'veterinario';
        $user->save();
    }
}
