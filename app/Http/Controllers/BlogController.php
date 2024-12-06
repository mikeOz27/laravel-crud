<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Classes\FormatResponse;

class BlogController extends FormatResponse
{
    public function getBlogs()
    {
        $blogs = Blog::all();
        return response()->json($blogs);
    }

    public function createBlog()
    {
        $blog = Blog::create(request()->all());
        return response()->json($blog);
    }

    public function updateBlog($id)
    {
        $blog = Blog::find($id);
        $blog->update(request()->all());
        return response()->json($blog);
    }

    public function deleteBlog($id)
    {
        $blog = Blog::find($id);
        $blog->delete();
        return response()->json('deleted');
    }

    public function countBlogs()
    {
        $blogs = Blog::count();
        return $this->estadoExitoso($blogs);
    }
}
