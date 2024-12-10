<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = [
            [
                'name' => 'Laravel',
                'slug' => 'laravel',
                'description' => 'Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in most web projects.',
                'status' => 1,
                'used' => 1,
            ],
            [
                'name' => 'Vue',
                'slug' => 'vue',
                'description' => 'Vue.js is a progressive JavaScript framework for building user interfaces on the web. Vue.js is designed from the ground up to be incrementally adoptable. The core library is focused on the view layer only, and is easy to pick up and integrate with other libraries or existing projects.',
                'status' => 1,
                'used' => 1,
            ],
            [
                'name' => 'React',
                'slug' => 'react',
                'description' => 'React is a JavaScript library for building user interfaces. Learn what React is all about on our homepage or in the tutorial.',
                'status' => 1,
                'used' => 1,
            ],
            [
                'name' => 'Angular',
                'slug' => 'angular',
                'description' => 'Angular is a platform and framework for building single-page client applications using HTML and TypeScript. Angular is written in TypeScript. It implements core and optional functionality as a set of TypeScript libraries that you import into your apps.',
                'status' => 1,
                'used' => 1,
            ],
            [
                'name' => 'Node',
                'slug' => 'node',
                'description' => 'Node.js is an open-source, cross-platform, back-end JavaScript runtime environment that runs on the V8 engine and executes JavaScript code outside a web browser.',
                'status' => 1,
                'used' => 1,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
