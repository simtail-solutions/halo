<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'leanne@simtail.com')->first();

        if (!$user) {
            User::create([
                'name' => 'Leanne Bishop',
                'email' => 'leanne@simtail.com',
                'role' => 'admin',
                'password' => Hash::make('password')
            ]);
        }
    }
}