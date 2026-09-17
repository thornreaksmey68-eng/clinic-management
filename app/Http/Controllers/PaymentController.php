<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PaymentController extends Controller
{
    /**
     * Display all payments.
     */
    public function index()
    {
        $payments = Payment::with([
            'patient',
            'appointment.doctor'
        ])
        ->latest('payment_date')
        ->latest()
        ->get();

        return view(
            'payments.index',
            compact('payments')
        );
    }

    /**
     * Show create payment form.
     */
    public function create()
    {
        $patients = Patient::orderBy('name')->get();

        $appointments = Appointment::with([
            'patient',
            'doctor'
        ])
        ->latest('appointment_date')
        ->get();

        return view(
            'payments.create',
            compact(
                'patients',
                'appointments'
            )
        );
    }

    /**
     * Store new payment.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => [
                'required',
                'exists:patients,id'
            ],

            'appointment_id' => [
                'nullable',
                'exists:appointments,id'
            ],

            'payment_code' => [
                'required',
                'string',
                'max:255',
                'unique:payments,payment_code'
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0'
            ],

            'payment_method' => [
                'required',
                'string',
                'max:255'
            ],

            'status' => [
                'required',
                'in:Paid,Pending,Cancelled'
            ],

            'payment_date' => [
                'required',
                'date'
            ],

            'notes' => [
                'nullable',
                'string'
            ],
        ]);

        Payment::create($validated);

        return redirect()
            ->route('payments.index')
            ->with(
                'success',
                'Payment created successfully!'
            );
    }

    /**
     * Display one payment.
     */
    public function show(Payment $payment)
    {
        $payment->load([
            'patient',
            'appointment.doctor'
        ]);

        return view(
            'payments.show',
            compact('payment')
        );
    }

    /**
     * Show edit payment form.
     */
    public function edit(Payment $payment)
    {
        $patients = Patient::orderBy('name')->get();

        $appointments = Appointment::with([
            'patient',
            'doctor'
        ])
        ->latest('appointment_date')
        ->get();

        return view(
            'payments.edit',
            compact(
                'payment',
                'patients',
                'appointments'
            )
        );
    }

    /**
     * Update payment.
     */
    public function update(
        Request $request,
        Payment $payment
    ) {
        $validated = $request->validate([
            'patient_id' => [
                'required',
                'exists:patients,id'
            ],

            'appointment_id' => [
                'nullable',
                'exists:appointments,id'
            ],

            'payment_code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('payments', 'payment_code')
                    ->ignore($payment->id)
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0'
            ],

            'payment_method' => [
                'required',
                'string',
                'max:255'
            ],

            'status' => [
                'required',
                'in:Paid,Pending,Cancelled'
            ],

            'payment_date' => [
                'required',
                'date'
            ],

            'notes' => [
                'nullable',
                'string'
            ],
        ]);

        $payment->update($validated);

        return redirect()
            ->route(
                'payments.show',
                $payment
            )
            ->with(
                'success',
                'Payment updated successfully!'
            );
    }

    /**
     * Delete payment.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()
            ->route('payments.index')
            ->with(
                'success',
                'Payment deleted successfully!'
            );
    }
}