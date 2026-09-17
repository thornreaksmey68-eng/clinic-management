@extends('layouts.app')

@section('title', 'Edit Payment')
@section('page-subtitle', 'Edit Payment')

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
    }

    @media(max-width: 700px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="form-card">

<h2 class="section-title">
    Edit Payment #{{ $payment->id }}
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
    action="{{ route('payments.update', $payment) }}"
    method="POST"
>

    @csrf
    @method('PUT')

    <div class="form-grid">

        <div class="form-group">
            <label>Patient *</label>

            <select name="patient_id" required>

                <option value="">
                    Select Patient
                </option>

                @foreach($patients as $patient)

                    <option
                        value="{{ $patient->id }}"
                        {{ old(
                            'patient_id',
                            $payment->patient_id
                        ) == $patient->id ? 'selected' : '' }}
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

                <option value="">
                    No Appointment
                </option>

                @foreach($appointments as $appointment)

                    <option
                        value="{{ $appointment->id }}"
                        {{ old(
                            'appointment_id',
                            $payment->appointment_id
                        ) == $appointment->id ? 'selected' : '' }}
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
                Optional appointment.
            </div>
        </div>

        <div class="form-group">
            <label>Payment Code *</label>

            <input
                type="text"
                name="payment_code"
                value="{{ old(
                    'payment_code',
                    $payment->payment_code
                ) }}"
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
                value="{{ old(
                    'amount',
                    $payment->amount
                ) }}"
                min="0"
                step="0.01"
                required
            >
        </div>

        <div class="form-group">
            <label>Payment Method *</label>

            <select name="payment_method" required>

                @foreach([
                    'Cash',
                    'Credit Card',
                    'Debit Card',
                    'Bank Transfer',
                    'Other'
                ] as $method)

                    <option
                        value="{{ $method }}"
                        {{ old(
                            'payment_method',
                            $payment->payment_method
                        ) === $method ? 'selected' : '' }}
                    >
                        {{ $method }}
                    </option>

                @endforeach

            </select>
        </div>

        <div class="form-group">
            <label>Status *</label>

            <select name="status" required>

                @foreach([
                    'Paid',
                    'Pending',
                    'Cancelled'
                ] as $status)

                    <option
                        value="{{ $status }}"
                        {{ old(
                            'status',
                            $payment->status
                        ) === $status ? 'selected' : '' }}
                    >
                        {{ $status }}
                    </option>

                @endforeach

            </select>
        </div>

        <div class="form-group">
            <label>Payment Date *</label>

            <input
                type="date"
                name="payment_date"
                value="{{ old(
                    'payment_date',
                    $payment->payment_date?->format('Y-m-d')
                ) }}"
                required
            >
        </div>

        <div class="form-group full">
            <label>Notes</label>

            <textarea
                name="notes"
                placeholder="Additional payment notes..."
            >{{ old('notes', $payment->notes) }}</textarea>
        </div>

    </div>

    <div class="actions">

        <a
            href="{{ route('payments.show', $payment) }}"
            class="btn btn-secondary"
        >
            Cancel
        </a>

        <button
            type="submit"
            class="btn btn-primary"
        >
            Update Payment
        </button>

    </div>

</form>

</div>

@endsection
