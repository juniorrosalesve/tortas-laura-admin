<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Júnior Rosales',
            'email' => 'junior@admin.com',
            'password' => bcrypt('12')
        ]);
        User::create([
            'name' => 'Gleidy Diana',
            'email' => 'gleidydianapulido@gmail.com',
            'password' => bcrypt('12')
        ]);
    }
}
