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
        User::create([
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

        User::create([
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

        User::create([
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

        User::create([
            'name' => 'Liah',
            'nickname' => 'Liah123452',
            'email' => 'liah2@gmail.com',
            'image' => 'https://ui-avatars.com/api/?name='.urlencode('Liah Doe'),
            'password' => bcrypt('123456')
        ]);

        UserRol::create([
            'user_id' => 4,
            'role_id' => 2
        ]);

        User::create([
            'name' => 'Miah',
            'nickname' => 'Miah123452',
            'email' => 'Miah@gmail.com',
            'image' => 'https://ui-avatars.com/api/?name='.urlencode('Miah Martinez'),
            'password' => bcrypt('123456')
        ]);

        UserRol::create([
            'user_id' => 5,
            'role_id' => 3
        ]);
        User::create([
            'name' => 'Kanneeth',
            'nickname' => 'Kanneeth123453',
            'email' => 'Kanneeth@gmail.com',
            'image' => 'https://ui-avatars.com/api/?name='.urlencode('Kanneeth Florez'),
            'password' => bcrypt('123456')
        ]);

        UserRol::create([
            'user_id' => 6,
            'role_id' => 2
        ]);

        User::create([
            'name' => 'Kevin',
            'nickname' => 'Kevin123453',
            'email' => 'Kevin@gmail.com',
            'image' => 'https://ui-avatars.com/api/?name='.urlencode('Kevin Martinez'),
            'password' => bcrypt('123456')
        ]);

        UserRol::create([
            'user_id' => 7,
            'role_id' => 3
        ]);
    }
}
