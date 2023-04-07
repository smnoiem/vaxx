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
use Illuminate\Support\Carbon;
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

    public function getDoses(Registration $registration)
    {
        return view('operator.registrations.doses', compact('registration'));
    }

    public function doseCreate(Registration $registration)
    {
        $vaccines = Vaccine::all();

        return view('operator.registrations.doses.create', compact('registration', 'vaccines'));
    }

    public function doseStore(Request $request, Registration $registration)
    {
        $validOperator = auth()->user()->center == $registration->center;

        if (!$validOperator)
            abort(401);

        $doseType = $request->input('type');
        $doseExists = Dose::where('recipient_nid', $registration->nid)
            ->where('dose_type', $doseType)
            ->exists();

        if ($doseExists) {
            return 2;
        }

        $dose = Dose::create([
            'recipient_nid' => $registration->nid,
            'vaccine_id' => $request->input('vaccine'),
            'dose_type' => $request->input('type'),
            'scheduled_date' => $request->input('date'),
            'given_by' => null,
        ]);

        if ($dose) {

            if ($registration->center->current_available_date_count < ($registration->center->daily_limit - 1)) {
                $registration->center->current_available_date_count++;
                $registration->center->update();
            } else {
                $registration->center->current_available_date_count = 0;

                $currentDate = Carbon::create($registration->center->current_available_date);

                $nextDay = $currentDate->addDay();

                $registration->center->current_available_date = $nextDay;

                $registration->center->update();
            }
        }

        return 1;
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
            $dose->given_by = auth()->user()->id;
            $dose->update();
        }

        $vaccines = Vaccine::all();

        return redirect(route('operator.registrations.doses', $registration->nid));
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