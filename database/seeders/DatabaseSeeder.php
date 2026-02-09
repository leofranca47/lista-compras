<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
        ]);


        User::get()->each(function ($user) {

            if ($user->email === 'casa@casa.com') {
                $user->assignRole('admin');
            } else {
                $user->assignRole('user');
                if($user->created_at->isToday()){
                    $user->delete();
                }
            }
        });

        // $user = User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $user->assignRole('user');

        // $admin = User::factory()->create([
        //     'name' => 'Admin User',
        //     'email' => 'admin@example.com',
        //     'password' => Hash::make('password'),
        // ]);
        // $admin->assignRole('admin');
    }
}
