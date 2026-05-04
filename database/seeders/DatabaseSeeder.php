<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Default Admin User
        |--------------------------------------------------------------------------
        | Ini supaya kalau database di-refresh, akun admin tetap ada.
        */

        User::updateOrCreate(
            ['email' => 'dickyendra07@gmail.com'],
            [
                'name' => 'Dicky Admin',
                'password' => Hash::make('password'),
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Program Awal
        |--------------------------------------------------------------------------
        */

        $this->call([
            ProgramSeeder::class,
        ]);
    }
}