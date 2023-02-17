<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrationRequest;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    function create() 
    {
        return view('front.registration.create');
    }

    function store(StoreRegistrationRequest $request) 
    {
        $validated = $request->validated();

        // Register user
        
        // $request->input('form-field-name');
        return view('front.registration.success');
    }
}
