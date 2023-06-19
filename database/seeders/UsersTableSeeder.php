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
        $user = User::where('email', 'adam@simtail.com')->first();

        if (!$user) {
            User::create([
                'name' => 'Adam Trickett',
                'email' => 'adam@simtail.com',
                'businessName' => 'Simtail',
                'role' => 'admin',
                'password' => Hash::make('Twowords.39'),
            ]);
        }
    }
}