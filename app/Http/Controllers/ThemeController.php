<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThemeController extends Controller
{
    function index() {
        return view('theme.index');
    }
    function contact() {
        return view('theme.contact');
    }
    function singleBlog() {
        return view('theme.single-blog');
    }
    function category() {
        return view('theme.category');
    }
}
