<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;

class SubscriberController extends Controller
{
    function store(Request $request){
        $data = $request->validate([
            'email' => 'required|email|unique:subscribers,email'
        ]);
        Subscriber::create($data);

        return back()->with('status', 'You have been subscribed successfully');
    }
}
