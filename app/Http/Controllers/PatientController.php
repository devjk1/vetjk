<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientStoreRequest;
use App\Http\Requests\PatientUpdateRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Http\Resources\PatientResource;
use App\Http\Resources\UserResource;
use App\Models\Patient;
use App\Models\User;
use Inertia\Inertia;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::with('owner')->get();

        return Inertia::render('Patients/Index', [
            'patients' => PatientResource::collection($patients),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        return Inertia::render('Patients/Create', [
            'owner' => new UserResource($user),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePatientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientStoreRequest $request, User $user)
    {
        $validated = $request->safe()->only([
            'name',
            'species',
            'color',
            'dob',
        ]);

        $patient = $user->patients()->create($validated);

        return redirect(route('users.show', $user->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        return Inertia::render('Patients/Edit', [
            'patient' => new PatientResource($patient),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePatientRequest  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(PatientUpdateRequest $request, Patient $patient)
    {
        $validated = $request->safe()->only([
            'name',
            'species',
            'color',
            'dob',
        ]);

        $patient->name = $validated['name'];
        $patient->species = $validated['species'];
        $patient->color = $validated['color'];
        $patient->dob = $validated['dob'];
        $patient->save();

        return redirect(route('patients.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect(route('patients.index'));
    }
}
