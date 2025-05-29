<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBlogRequest;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{

    function __construct()   // only authenticated user can create blog post
    {
        $this->middleware('auth')->only(['create']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('theme.blogs.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $data = $request->validated();

        //uoload image
        //1- get image
        $image = $request->image;
        //2- change it's name
        $imageName = time(). '_' .$image->getClientOriginalName();
        //3- move it to my project
        $image->storeAs('blogs',$imageName,'public');
        //4- save the image name in the database
        $data['image'] = $imageName;
        $data['user_id'] = Auth::user()->id;
        // create new blog record in the database
        Blog::create($data);
        return back()->with('BlogCreatestatus','Blog created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        // Increment the view count
        return view('theme.single-blog',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        if($blog->user_id == Auth::user()->id){
            $categories = Category::get();
            return view('theme.blogs.edit', compact('blog', 'categories'));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        if($blog->user_id == Auth::user()->id){

        $data = $request->validated();
        if($request->hasFile('image')){
            //uoload image
            // 0 delete old image
            Storage::delete('public/blogs/'.$blog->image);
            //1- get image
            $image = $request->image;
            //2- change it's name
            $imageName = time(). '_' .$image->getClientOriginalName();
            //3- move it to my project
            $image->storeAs('blogs',$imageName,'public');
            //4- save the image name in the database
            $data['image'] = $imageName;
        }
        // create new blog record in the database
        $blog->update($data);
        return back()->with('BlogUpdatestatus','Blog updated successfully');
    }
    abort(403);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if($blog->user_id == Auth::user()->id){
            //delete image
            Storage::delete('public/blogs/'.$blog->image);
            //delete blog
            $blog->delete();
            return back()->with('BlogDeletestatus','Blog deleted successfully');
        }


    }

    /**
     * Display the user's blogs.
     */
    public function myBlogs()
    {
        if(Auth::check())
        {
            $blogs = Blog::where('user_id',Auth::user()->id)->paginate(10);
            return view('theme.blogs.my-blogs', compact('blogs'));
        }
        abort(403);
    }

}