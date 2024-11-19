<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'Admin',
            'description' => 'Administrator'
        ]);

        Role::create([
            'name' => 'User',
            'description' => 'User'
        ]);

        Role::create([
            'name' => 'Tester',
            'description' => 'Tester',
        ]);
    }
}
