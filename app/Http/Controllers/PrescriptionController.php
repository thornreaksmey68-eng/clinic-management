<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrescriptionController extends Controller
{
    /**
     * Display all prescriptions.
     */
    public function index()
    {
        $prescriptions = Prescription::with([
            'patient',
            'doctor',
            'prescriptionItems.medicine'
        ])
        ->latest('prescription_date')
        ->latest()
        ->get();

        return view('prescriptions.index', compact('prescriptions'));
    }

    /**
     * Show create prescription form.
     */
    public function create()
    {
        $patients = Patient::orderBy('name')->get();
        $doctors = Doctor::orderBy('name')->get();
        $medicines = Medicine::orderBy('name')->get();

        return view('prescriptions.create', compact(
            'patients',
            'doctors',
            'medicines'
        ));
    }

    /**
     * Store new prescription.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'prescription_date' => 'required|date',
            'notes' => 'nullable|string',

            'medicine_id' => 'required|array|min:1',
            'medicine_id.*' => 'required|exists:medicines,id',

            'quantity' => 'required|array|min:1',
            'quantity.*' => 'required|integer|min:1',

            'dosage' => 'nullable|array',
            'dosage.*' => 'nullable|string|max:255',

            'instruction' => 'nullable|array',
            'instruction.*' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($validated) {

            $prescription = Prescription::create([
                'patient_id' => $validated['patient_id'],
                'doctor_id' => $validated['doctor_id'],
                'prescription_date' => $validated['prescription_date'],
                'notes' => $validated['notes'] ?? null,
            ]);

            foreach ($validated['medicine_id'] as $index => $medicineId) {
                $prescription->prescriptionItems()->create([
                    'medicine_id' => $medicineId,
                    'quantity' => $validated['quantity'][$index],
                    'dosage' => $validated['dosage'][$index] ?? null,
                    'instruction' => $validated['instruction'][$index] ?? null,
                ]);
            }
        });

        return redirect()
            ->route('prescriptions.index')
            ->with('success', 'Prescription created successfully!');
    }

    /**
     * Display one prescription.
     */
    public function show(Prescription $prescription)
    {
        $prescription->load([
            'patient',
            'doctor',
            'prescriptionItems.medicine'
        ]);

        return view(
            'prescriptions.show',
            compact('prescription')
        );
    }

    /**
     * Show edit form.
     */
    public function edit(Prescription $prescription)
    {
        $prescription->load('prescriptionItems');

        $patients = Patient::orderBy('name')->get();
        $doctors = Doctor::orderBy('name')->get();
        $medicines = Medicine::orderBy('name')->get();

        return view(
            'prescriptions.edit',
            compact(
                'prescription',
                'patients',
                'doctors',
                'medicines'
            )
        );
    }

    /**
     * Update prescription.
     */
    public function update(
        Request $request,
        Prescription $prescription
    ) {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'prescription_date' => 'required|date',
            'notes' => 'nullable|string',

            'medicine_id' => 'required|array|min:1',
            'medicine_id.*' => 'required|exists:medicines,id',

            'quantity' => 'required|array|min:1',
            'quantity.*' => 'required|integer|min:1',

            'dosage' => 'nullable|array',
            'dosage.*' => 'nullable|string|max:255',

            'instruction' => 'nullable|array',
            'instruction.*' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($validated, $prescription) {

            $prescription->update([
                'patient_id' => $validated['patient_id'],
                'doctor_id' => $validated['doctor_id'],
                'prescription_date' => $validated['prescription_date'],
                'notes' => $validated['notes'] ?? null,
            ]);

            // Remove old medicine items
            $prescription->prescriptionItems()->delete();

            // Create updated medicine items
            foreach ($validated['medicine_id'] as $index => $medicineId) {
                $prescription->prescriptionItems()->create([
                    'medicine_id' => $medicineId,
                    'quantity' => $validated['quantity'][$index],
                    'dosage' => $validated['dosage'][$index] ?? null,
                    'instruction' => $validated['instruction'][$index] ?? null,
                ]);
            }
        });

        return redirect()
            ->route('prescriptions.show', $prescription)
            ->with('success', 'Prescription updated successfully!');
    }

    /**
     * Delete prescription.
     */
    public function destroy(Prescription $prescription)
    {
        $prescription->prescriptionItems()->delete();

        $prescription->delete();

        return redirect()
            ->route('prescriptions.index')
            ->with('success', 'Prescription deleted successfully!');
    }
}