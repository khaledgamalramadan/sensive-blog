<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    function store(StoreContactRequest $request)
    {
        $data = $request->validated();

        Contact::create($data);

        return back()->with('status-message', 'Your message has been sent successfully');
    }
}
