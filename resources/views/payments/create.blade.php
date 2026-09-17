@extends('layouts.app')

@section('title', 'New Payment')
@section('page-subtitle', 'Create Payment')

@section('content')

<style>
    .form-card {
        background: white;
        border-radius: 14px;
        padding: 25px;
        box-shadow: 0 3px 15px rgba(0,0,0,.06);
        max-width: 1000px;
        margin: auto;
    }

    .section-title {
        font-size: 18px;
        font-weight: 700;
        margin: 5px 0 20px;
        color: #1f2937;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    label {
        font-size: 14px;
        font-weight: 600;
        color: #374151;
    }

    input,
    select,
    textarea {
        width: 100%;
        padding: 11px 13px;
        border: 1px solid #d1d5db;
        border-radius: 9px;
        outline: none;
        box-sizing: border-box;
        font-size: 14px;
    }

    input:focus,
    select:focus,
    textarea:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 2px rgba(37, 99, 235, .08);
    }

    textarea {
        min-height: 110px;
        resize: vertical;
    }

    .payment-section {
        margin-top: 30px;
        border-top: 1px solid #e5e7eb;
        padding-top: 25px;
    }

    .actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 25px;
    }

    .btn {
        padding: 11px 18px;
        border-radius: 9px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-weight: 600;
        font-size: 14px;
    }

    .btn-primary {
        background: #2563eb;
        color: white;
    }

    .btn-primary:hover {
        background: #1d4ed8;
    }

    .btn-secondary {
        background: #e5e7eb;
        color: #374151;
    }

    .btn-secondary:hover {
        background: #d1d5db;
    }

    .error-box {
        background: #fee2e2;
        color: #991b1b;
        padding: 14px;
        border-radius: 9px;
        margin-bottom: 20px;
    }

    .hint {
        color: #64748b;
        font-size: 12px;
        margin-top: 2px;
    }

    @media(max-width: 700px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="form-card">

<h2 class="section-title">
    Payment Information
</h2>

@if($errors->any())
    <div class="error-box">
        <strong>Please fix the following:</strong>

        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form
    action="{{ route('payments.store') }}"
    method="POST"
>

    @csrf

    <div class="form-grid">

        <div class="form-group">
            <label>Patient *</label>

            <select name="patient_id" required>
                <option value="">Select Patient</option>

                @foreach($patients as $patient)
                    <option
                        value="{{ $patient->id }}"
                        {{ old('patient_id') == $patient->id ? 'selected' : '' }}
                    >
                        {{ $patient->name }}
                        — {{ $patient->patient_code }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Appointment</label>

            <select name="appointment_id">
                <option value="">No Appointment</option>

                @foreach($appointments as $appointment)
                    <option
                        value="{{ $appointment->id }}"
                        {{ old('appointment_id') == $appointment->id ? 'selected' : '' }}
                    >
                        #{{ $appointment->id }}
                        —
                        {{ $appointment->patient->name ?? 'N/A' }}
                        —
                        {{ $appointment->appointment_date?->format('d M Y') }}
                    </option>
                @endforeach
            </select>

            <div class="hint">
                Optional. Select an appointment if this payment is related to one.
            </div>
        </div>

        <div class="form-group">
            <label>Payment Code *</label>

            <input
                type="text"
                name="payment_code"
                value="{{ old('payment_code') }}"
                placeholder="e.g. PAY-0001"
                required
            >

            <div class="hint">
                Payment code must be unique.
            </div>
        </div>

        <div class="form-group">
            <label>Amount *</label>

            <input
                type="number"
                name="amount"
                value="{{ old('amount') }}"
                min="0"
                step="0.01"
                placeholder="0.00"
                required
            >
        </div>

        <div class="form-group">
            <label>Payment Method *</label>

            <select name="payment_method" required>

                <option value="Cash"
                    {{ old('payment_method', 'Cash') === 'Cash' ? 'selected' : '' }}>
                    Cash
                </option>

                <option value="Credit Card"
                    {{ old('payment_method') === 'Credit Card' ? 'selected' : '' }}>
                    Credit Card
                </option>

                <option value="Debit Card"
                    {{ old('payment_method') === 'Debit Card' ? 'selected' : '' }}>
                    Debit Card
                </option>

                <option value="Bank Transfer"
                    {{ old('payment_method') === 'Bank Transfer' ? 'selected' : '' }}>
                    Bank Transfer
                </option>

                <option value="Other"
                    {{ old('payment_method') === 'Other' ? 'selected' : '' }}>
                    Other
                </option>

            </select>
        </div>

        <div class="form-group">
            <label>Status *</label>

            <select name="status" required>

                <option value="Paid"
                    {{ old('status', 'Paid') === 'Paid' ? 'selected' : '' }}>
                    Paid
                </option>

                <option value="Pending"
                    {{ old('status') === 'Pending' ? 'selected' : '' }}>
                    Pending
                </option>

                <option value="Cancelled"
                    {{ old('status') === 'Cancelled' ? 'selected' : '' }}>
                    Cancelled
                </option>

            </select>
        </div>

        <div class="form-group">
            <label>Payment Date *</label>

            <input
                type="date"
                name="payment_date"
                value="{{ old('payment_date', now()->format('Y-m-d')) }}"
                required
            >
        </div>

        <div class="form-group full">
            <label>Notes</label>

            <textarea
                name="notes"
                placeholder="Additional payment notes..."
            >{{ old('notes') }}</textarea>
        </div>

    </div>

    <div class="actions">

        <a
            href="{{ route('payments.index') }}"
            class="btn btn-secondary"
        >
            Cancel
        </a>

        <button
            type="submit"
            class="btn btn-primary"
        >
            Save Payment
        </button>

    </div>

</form>

</div>

@endsection
