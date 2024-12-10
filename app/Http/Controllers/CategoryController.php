<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Classes\FormatResponse;
use App\Models\Blog;

class CategoryController extends FormatResponse
{
    public function getCategories()
    {
        $categories = Category::where('used', 1)->get();

        return $this->estadoExitoso($categories);
    }

    public function getCategory($id)
    {
        $category = Category::find($id);

        return $this->estadoExitoso($category);
    }
}
