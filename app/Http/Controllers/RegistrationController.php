<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrationRequest;
use App\Models\Registration;
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
        Registration::create($validated);
        
        return view('front.registration.success');
    }
}
