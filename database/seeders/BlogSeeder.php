<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\Category;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //crear blog con categorias
        Blog::create([
            'user_id' => 1,
            'category_id' => 1,
            'title' => 'My First Blog',
            'image' => 'https://via.placeholder.com/150',
            'content' => 'This is the content of my first blog.',
        ]);

        Blog::create([
            'user_id' => 1,
            'category_id' => 2,
            'title' => 'My Second Blog',
            'image' => 'https://via.placeholder.com/150',
            'content' => 'This is the content of my second blog.',
        ]);

        Blog::create([
            'user_id' => 1,
            'category_id' => 3,
            'title' => 'My Third Blog',
            'image' => 'https://via.placeholder.com/150',
            'content' => 'This is the content of my third blog.',
        ]);

        Blog::create([
            'user_id' => 1,
            'category_id' => 4,
            'title' => 'My Fourth Blog',
            'image' => 'https://via.placeholder.com/150',
            'content' => 'This is the content of my fourth blog.',
        ]);

        Blog::create([
            'user_id' => 1,
            'category_id' => 5,
            'title' => 'My Fifth Blog',
            'image' => 'https://via.placeholder.com/150',
            'content' => 'This is the content of my fifth blog.',
        ]);

    }
}
