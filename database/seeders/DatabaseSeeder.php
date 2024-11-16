<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Mike',
            'nickname' => 'Mike12345',
            'email' => 'mike.barsa@hotmail.com',
            'image' => 'https://ui-avatars.com/api/?name='.urlencode('Mike Oz'),
            'password' => bcrypt('123456')
        ]);

        User::factory()->create([
            'name' => 'John',
            'nickname' => 'John12345',
            'email' => 'john@gmail.com',
            'image' => 'https://ui-avatars.com/api/?name='.urlencode('John Doe'),
            'password' => bcrypt('123456')
        ]);
        User::factory()->create([
            'name' => 'Michael',
            'nickname' => 'Michael12345',
            'email' => 'michael.martinez.2227@gmail.com',
            'image' => 'https://ui-avatars.com/api/?name='.urlencode('Michael Martinez'),
            'password' => bcrypt('123456')
        ]);
    }
}
