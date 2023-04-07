<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAssignCenterRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\Center;
use App\Models\Dose;
use App\Models\Registration;
use App\Models\User;
use App\Models\Vaccine;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registrations = Registration::all();

        return view('operator.registrations.index', compact('registrations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('operator.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $user = new User($validated);

        $user->forceFill([
            'password' => Hash::make($validated['password']),
            'remember_token' => Str::random(60),
        ]);

        $saved = $user->save();

        if ($saved)
            return 1;

        return response('User Registration Failed!', 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nid)
    {
        $registration = Registration::findOrFail($nid);
        return view('operator.registrations.edit', compact('registration'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registration $registration)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nid)
    {
        //
    }

    public function getVaccines(Registration $registration)
    {
        $vaccines = Vaccine::all();
        return view('operator.registrations.vaccines', compact('registration', 'vaccines'));
    }

    public function markDoseAsTaken(Registration $registration, Dose $dose)
    {
        $validOperator = auth()->user()->center == $registration->center;
        $validDose = $dose->registration->nid == $registration->nid;
        $validRequest = $validOperator && $validDose;

        if (!$validRequest)
            abort(401);

        if (!$dose->taken_date) {
            $dose->taken_date = now();
            $dose->update();
        }

        $vaccines = Vaccine::all();

        return redirect(route('operator.registrations.vaccines', $registration->nid));
    }

    public function assignCenterStore(StoreAssignCenterRequest $request, User $user)
    {
        $validated = $request->validated();

        if ($validated['user_id'] != $user->id)
            abort(401);

        $isAssigned = $user->update(['center_id' => $validated['user_id']]);

        if ($isAssigned)
            return 1;

        return response('Center Assigning Failed!', 500);
    }
}