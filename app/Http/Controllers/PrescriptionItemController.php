<?php

namespace App\Http\Controllers;

use App\Models\PrescriptionItem;
use App\Models\Prescription;
use App\Models\Medicine;
use Illuminate\Http\Request;

class PrescriptionItemController extends Controller
{
    /**
     * Display all prescription items.
     */
    public function index()
    {
        $items = PrescriptionItem::with([
            'prescription.patient',
            'prescription.doctor',
            'medicine',
        ])
        ->latest()
        ->get();

        return view(
            'prescription_items.index',
            compact('items')
        );
    }


    /**
     * Show create form.
     */
    public function create()
    {
        $prescriptions = Prescription::with([
            'patient',
            'doctor'
        ])
        ->latest()
        ->get();

        $medicines = Medicine::orderBy('name')->get();

        return view(
            'prescription_items.create',
            compact(
                'prescriptions',
                'medicines'
            )
        );
    }


    /**
     * Store a new prescription item.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'prescription_id' => [
                'required',
                'exists:prescriptions,id'
            ],

            'medicine_id' => [
                'required',
                'exists:medicines,id'
            ],

            'quantity' => [
                'required',
                'integer',
                'min:1'
            ],

            'dosage' => [
                'nullable',
                'string',
                'max:255'
            ],

            'instruction' => [
                'nullable',
                'string',
                'max:255'
            ],

        ]);


        PrescriptionItem::create($validated);


        return redirect()
            ->route('prescription-items.index')
            ->with(
                'success',
                'Prescription item added successfully.'
            );
    }


    /**
     * Display one prescription item.
     */
    public function show(PrescriptionItem $prescriptionItem)
    {
        $prescriptionItem->load([
            'prescription.patient',
            'prescription.doctor',
            'medicine',
        ]);

        return view(
            'prescription_items.show',
            compact('prescriptionItem')
        );
    }


    /**
     * Show edit form.
     */
    public function edit(PrescriptionItem $prescriptionItem)
    {
        $prescriptions = Prescription::with([
            'patient',
            'doctor'
        ])
        ->latest()
        ->get();

        $medicines = Medicine::orderBy('name')->get();

        return view(
            'prescription_items.edit',
            compact(
                'prescriptionItem',
                'prescriptions',
                'medicines'
            )
        );
    }


    /**
     * Update prescription item.
     */
    public function update(
        Request $request,
        PrescriptionItem $prescriptionItem
    ) {

        $validated = $request->validate([

            'prescription_id' => [
                'required',
                'exists:prescriptions,id'
            ],

            'medicine_id' => [
                'required',
                'exists:medicines,id'
            ],

            'quantity' => [
                'required',
                'integer',
                'min:1'
            ],

            'dosage' => [
                'nullable',
                'string',
                'max:255'
            ],

            'instruction' => [
                'nullable',
                'string',
                'max:255'
            ],

        ]);


        $prescriptionItem->update($validated);


        return redirect()
            ->route(
                'prescription-items.show',
                $prescriptionItem->id
            )
            ->with(
                'success',
                'Prescription item updated successfully.'
            );
    }


    /**
     * Delete prescription item.
     */
    public function destroy(
        PrescriptionItem $prescriptionItem
    ) {

        $prescriptionItem->delete();


        return redirect()
            ->route('prescription-items.index')
            ->with(
                'success',
                'Prescription item deleted successfully.'
            );
    }
}
