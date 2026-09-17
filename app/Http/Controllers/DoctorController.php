<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of doctors.
     */
    public function index()
    {
        $doctors = Doctor::latest()->get();

        return view('doctors.index', compact('doctors'));
    }


    /**
     * Show the form for creating a new doctor.
     */
    public function create()
    {
        return view('doctors.create');
    }


    /**
     * Store a newly created doctor.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_code'   => 'required|string|max:50|unique:doctors,doctor_code',
            'name'          => 'required|string|max:255',
            'specialization'=> 'required|string|max:255',
            'gender'        => 'nullable|string|max:20',
            'phone'         => 'nullable|string|max:30',
            'email'         => 'nullable|email|max:255',
            'qualification' => 'nullable|string|max:255',
            'address'       => 'nullable|string',
        ]);

        Doctor::create($validated);

        return redirect()
            ->route('doctors.index')
            ->with('success', 'Doctor added successfully!');
    }


    /**
     * Display the specified doctor.
     */
    public function show(Doctor $doctor)
    {
        return view('doctors.show', compact('doctor'));
    }


    /**
     * Show the form for editing the specified doctor.
     */
    public function edit(Doctor $doctor)
    {
        return view('doctors.edit', compact('doctor'));
    }


    /**
     * Update the specified doctor.
     */
    public function update(Request $request, Doctor $doctor)
    {
        $validated = $request->validate([
            'doctor_code'   => 'required|string|max:50|unique:doctors,doctor_code,' . $doctor->id,
            'name'          => 'required|string|max:255',
            'specialization'=> 'required|string|max:255',
            'gender'        => 'nullable|string|max:20',
            'phone'         => 'nullable|string|max:30',
            'email'         => 'nullable|email|max:255',
            'qualification' => 'nullable|string|max:255',
            'address'       => 'nullable|string',
        ]);

        $doctor->update($validated);

        return redirect()
            ->route('doctors.index')
            ->with('success', 'Doctor updated successfully!');
    }


    /**
     * Remove the specified doctor.
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();

        return redirect()
            ->route('doctors.index')
            ->with('success', 'Doctor deleted successfully!');
    }
}
