<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display all patients.
     */
    public function index()
    {
        $patients = Patient::latest()->get();

        return view('patients.index', compact('patients'));
    }


    /**
     * Show the form for creating a new patient.
     */
    public function create()
    {
        return view('patients.create');
    }


    /**
     * Store a newly created patient.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_code' => 'required|string|max:20|unique:patients,patient_code',
            'name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female,Other',
            'date_of_birth' => 'nullable|date',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'blood_group' => 'nullable|string|max:10',
            'emergency_contact' => 'nullable|string|max:20',
        ]);

        Patient::create($validated);

        return redirect()
            ->route('patients.index')
            ->with('success', 'Patient created successfully!');
    }


    /**
     * Display a specific patient.
     */
    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }


    /**
     * Show the form for editing a patient.
     */
    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }


    /**
     * Update a patient.
     */
    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'patient_code' => 'required|string|max:20|unique:patients,patient_code,' . $patient->id,
            'name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female,Other',
            'date_of_birth' => 'nullable|date',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'blood_group' => 'nullable|string|max:10',
            'emergency_contact' => 'nullable|string|max:20',
        ]);

        $patient->update($validated);

        return redirect()
            ->route('patients.index')
            ->with('success', 'Patient updated successfully!');
    }


    /**
     * Delete a patient.
     */
    public function destroy(Patient $patient)
{
    $patient->delete();

    return redirect()
        ->route('patients.index')
        ->with('success', 'Patient deleted successfully!');
}
}