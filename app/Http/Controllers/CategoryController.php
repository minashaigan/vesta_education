<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories=Category::all();
        return $categories;
    }

    public function show($category)
    {
        $courses=$category->courses;
        return $courses;
    }
}
