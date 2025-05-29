<?php

namespace App\Http\Controllers;

use pagination;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    function index() {
        $blogs = Blog::paginate(3); // Get all blogs with pagination
        return view('theme.index', compact('blogs'));
    }
    function category($id) {
        $categoryName = Category::find($id)->name; // Get category name by ID
        $blogs = Blog::where('category_id',$id)->paginate(8); // Get blogs by category with pagination
        return view('theme.category', compact('blogs', 'categoryName'));
    }
    function contact() {
        return view('theme.contact');
    }

}
