<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    function store(StoreCommentRequest $request)
    {

        $data = $request->validated();
        Comment::create($data);
        return back()->with('CommentCreatestatus', 'Your Comment created successfully');
    }
}
