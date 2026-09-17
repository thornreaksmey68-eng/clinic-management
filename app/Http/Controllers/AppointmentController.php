<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of appointments.
     */
    public function index()
    {
        $appointments = Appointment::with(['patient', 'doctor'])
            ->latest('appointment_date')
            ->latest('appointment_time')
            ->get();

        return view('appointments.index', compact('appointments'));
    }


    /**
     * Show the form for creating a new appointment.
     */
    public function create()
    {
        $patients = Patient::orderBy('name')->get();

        $doctors = Doctor::orderBy('name')->get();

        return view('appointments.create', compact(
            'patients',
            'doctors'
        ));
    }


    /**
     * Store a newly created appointment.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'patient_id' => [
                'required',
                'exists:patients,id',
            ],

            'doctor_id' => [
                'required',
                'exists:doctors,id',
            ],

            'appointment_date' => [
                'required',
                'date',
            ],

            'appointment_time' => [
                'required',
                'date_format:H:i',
            ],

            'status' => [
                'required',
                'in:Pending,Confirmed,Completed,Cancelled',
            ],

            'reason' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'notes' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);


        Appointment::create($validated);


        return redirect()
            ->route('appointments.index')
            ->with('success', 'Appointment created successfully.');
    }


    /**
     * Display the specified appointment.
     */
    public function show(Appointment $appointment)
    {
        $appointment->load(['patient', 'doctor']);

        return view('appointments.show', compact('appointment'));
    }


    /**
     * Show the form for editing the specified appointment.
     */
    public function edit(Appointment $appointment)
    {
        $patients = Patient::orderBy('name')->get();

        $doctors = Doctor::orderBy('name')->get();

        return view('appointments.edit', compact(
            'appointment',
            'patients',
            'doctors'
        ));
    }


    /**
     * Update the specified appointment.
     */
    public function update(
        Request $request,
        Appointment $appointment
    ) {
        $validated = $request->validate([

            'patient_id' => [
                'required',
                'exists:patients,id',
            ],

            'doctor_id' => [
                'required',
                'exists:doctors,id',
            ],

            'appointment_date' => [
                'required',
                'date',
            ],

            'appointment_time' => [
                'required',
                'date_format:H:i',
            ],

            'status' => [
                'required',
                'in:Pending,Confirmed,Completed,Cancelled',
            ],

            'reason' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'notes' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);


        $appointment->update($validated);


        return redirect()
            ->route('appointments.index')
            ->with('success', 'Appointment updated successfully.');
    }


    /**
     * Remove the specified appointment.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()
            ->route('appointments.index')
            ->with('success', 'Appointment deleted successfully.');
    }
}
