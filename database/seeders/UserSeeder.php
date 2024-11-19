<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRol;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Mike',
            'nickname' => 'Mike12345',
            'email' => 'mike.barsa@hotmail.com',
            'image' => 'https://ui-avatars.com/api/?name='.urlencode('Mike Oz'),
            'password' => bcrypt('123456')
        ]);

        UserRol::create([
            'user_id' => 1,
            'role_id' => 1
        ]);

        User::factory()->create([
            'name' => 'John',
            'nickname' => 'John12345',
            'email' => 'john@gmail.com',
            'image' => 'https://ui-avatars.com/api/?name='.urlencode('John Doe'),
            'password' => bcrypt('123456')
        ]);

        UserRol::create([
            'user_id' => 2,
            'role_id' => 2
        ]);

        User::factory()->create([
            'name' => 'Michael',
            'nickname' => 'Michael12345',
            'email' => 'michael.martinez.2227@gmail.com',
            'image' => 'https://ui-avatars.com/api/?name='.urlencode('Michael Martinez'),
            'password' => bcrypt('123456')
        ]);

        UserRol::create([
            'user_id' => 3,
            'role_id' => 3
        ]);
    }
}
