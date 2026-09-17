<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    /**
     * Display medicine list.
     */
    public function index()
    {
        $medicines = Medicine::latest()->get();

        return view('medicines.index', compact('medicines'));
    }


    /**
     * Show create form.
     */
    public function create()
    {
        return view('medicines.create');
    }


    /**
     * Store medicine.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'medicine_code' => 'required|string|max:50|unique:medicines,medicine_code',

            'name' => 'required|string|max:255',

            'category' => 'nullable|string|max:255',

            'unit' => 'required|string|max:255',

            'quantity' => 'required|integer|min:0',

            'price' => 'required|numeric|min:0',

            'expiry_date' => 'nullable|date',

            'description' => 'nullable|string',

        ]);

        Medicine::create($validated);

        return redirect()
            ->route('medicines.index')
            ->with('success', 'Medicine created successfully.');
    }


    /**
     * Display medicine details.
     */
    public function show(Medicine $medicine)
    {
        return view('medicines.show', compact('medicine'));
    }


    /**
     * Show edit form.
     */
    public function edit(Medicine $medicine)
    {
        return view('medicines.edit', compact('medicine'));
    }


    /**
     * Update medicine.
     */
    public function update(Request $request, Medicine $medicine)
    {
        $validated = $request->validate([

            'medicine_code' => 'required|string|max:50|unique:medicines,medicine_code,' . $medicine->id,

            'name' => 'required|string|max:255',

            'category' => 'nullable|string|max:255',

            'unit' => 'required|string|max:255',

            'quantity' => 'required|integer|min:0',

            'price' => 'required|numeric|min:0',

            'expiry_date' => 'nullable|date',

            'description' => 'nullable|string',

        ]);

        $medicine->update($validated);

        return redirect()
            ->route('medicines.index')
            ->with('success', 'Medicine updated successfully.');
    }


    /**
     * Delete medicine.
     */
    public function destroy(Medicine $medicine)
    {
        $medicine->delete();

        return redirect()
            ->route('medicines.index')
            ->with('success', 'Medicine deleted successfully.');
    }
}
