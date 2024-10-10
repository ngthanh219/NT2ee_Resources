<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role_id' => config('base.role_id.admin'),
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456')
        ]);
    }
}
