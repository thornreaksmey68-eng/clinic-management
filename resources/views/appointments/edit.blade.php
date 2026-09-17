@extends('layouts.app')

@section('title', 'Edit Appointment')
@section('page-subtitle', 'Update Appointment')

@section('content')

<style>
    .appointment-form-page {
        max-width: 1100px;
        margin: 0 auto;
    }

    .form-header {
        margin-bottom: 25px;
    }

    .form-header h1 {
        margin: 0 0 6px;
        font-size: 28px;
        font-weight: 700;
        color: #111827;
    }

    .form-header p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    .form-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        overflow: hidden;
    }

    .form-section {
        padding: 24px;
        border-bottom: 1px solid #e5e7eb;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .section-icon {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eff6ff;
        border-radius: 9px;
        font-size: 18px;
    }

    .section-title h2 {
        margin: 0;
        font-size: 17px;
        color: #111827;
    }

    .section-title p {
        margin: 3px 0 0;
        color: #6b7280;
        font-size: 12px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    .form-label {
        margin-bottom: 7px;
        color: #374151;
        font-size: 13px;
        font-weight: 600;
    }

    .required {
        color: #dc2626;
    }

    .form-control {
        width: 100%;
        box-sizing: border-box;
        padding: 11px 13px;
        border: 1px solid #d1d5db;
        border-radius: 9px;
        background: white;
        color: #111827;
        font-size: 14px;
        outline: none;
        font-family: inherit;
    }

    .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .1);
    }

    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    .field-error {
        margin-top: 5px;
        color: #dc2626;
        font-size: 12px;
    }

    .form-control.is-invalid {
        border-color: #dc2626;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding: 20px 24px;
        background: #f9fafb;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 11px 18px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }

    .btn-cancel {
        background: white;
        color: #374151;
        border: 1px solid #d1d5db;
    }

    .btn-update {
        background: #2563eb;
        color: white;
    }

    .btn-update:hover {
        background: #1d4ed8;
    }

    .alert-danger {
        margin-bottom: 20px;
        padding: 14px 18px;
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
        border-radius: 10px;
        font-size: 13px;
    }

    .alert-danger ul {
        margin: 6px 0 0;
        padding-left: 20px;
    }

    @media (max-width: 700px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full {
            grid-column: auto;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .form-actions .btn {
            width: 100%;
        }
    }
</style>

<div class="appointment-form-page">

<div class="form-header">
    <h1>Edit Appointment</h1>
    <p>Update appointment information</p>
</div>

@if($errors->any())
    <div class="alert-danger">
        <strong>Please fix the following errors:</strong>

        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('appointments.update', $appointment) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-card">

        <div class="form-section">

            <div class="section-title">
                <div class="section-icon">👥</div>

                <div>
                    <h2>Patient & Doctor</h2>
                    <p>Select the patient and doctor</p>
                </div>
            </div>

            <div class="form-grid">

                <div class="form-group">

                    <label class="form-label">
                        Patient <span class="required">*</span>
                    </label>

                    <select
                        name="patient_id"
                        class="form-control @error('patient_id') is-invalid @enderror"
                        required
                    >
                        <option value="">Select patient</option>

                        @foreach($patients as $patient)

                            <option
                                value="{{ $patient->id }}"
                                {{ old('patient_id', $appointment->patient_id) == $patient->id ? 'selected' : '' }}
                            >
                                {{ $patient->name }} — {{ $patient->patient_code }}
                            </option>

                        @endforeach

                    </select>

                    @error('patient_id')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group">

                    <label class="form-label">
                        Doctor <span class="required">*</span>
                    </label>

                    <select
                        name="doctor_id"
                        class="form-control @error('doctor_id') is-invalid @enderror"
                        required
                    >
                        <option value="">Select doctor</option>

                        @foreach($doctors as $doctor)

                            <option
                                value="{{ $doctor->id }}"
                                {{ old('doctor_id', $appointment->doctor_id) == $doctor->id ? 'selected' : '' }}
                            >
                                Dr. {{ $doctor->name }} — {{ $doctor->specialization }}
                            </option>

                        @endforeach

                    </select>

                    @error('doctor_id')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                </div>

            </div>

        </div>

        <div class="form-section">

            <div class="section-title">
                <div class="section-icon">📅</div>

                <div>
                    <h2>Appointment Schedule</h2>
                    <p>Update date, time and status</p>
                </div>
            </div>

            <div class="form-grid">

                <div class="form-group">

                    <label class="form-label">
                        Date <span class="required">*</span>
                    </label>

                    <input
                        type="date"
                        name="appointment_date"
                        class="form-control @error('appointment_date') is-invalid @enderror"
                        value="{{ old('appointment_date', $appointment->appointment_date?->format('Y-m-d')) }}"
                        required
                    >

                    @error('appointment_date')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group">

                    <label class="form-label">
                        Time <span class="required">*</span>
                    </label>

                    <input
                        type="time"
                        name="appointment_time"
                        class="form-control @error('appointment_time') is-invalid @enderror"
                        value="{{ old('appointment_time', \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i')) }}"
                        required
                    >

                    @error('appointment_time')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group">

                    <label class="form-label">
                        Status <span class="required">*</span>
                    </label>

                    <select
                        name="status"
                        class="form-control @error('status') is-invalid @enderror"
                        required
                    >
                        @foreach(['Pending', 'Confirmed', 'Completed', 'Cancelled'] as $status)

                            <option
                                value="{{ $status }}"
                                {{ old('status', $appointment->status) === $status ? 'selected' : '' }}
                            >
                                {{ $status }}
                            </option>

                        @endforeach
                    </select>

                    @error('status')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                </div>

            </div>

        </div>

        <div class="form-section">

            <div class="section-title">
                <div class="section-icon">📝</div>

                <div>
                    <h2>Appointment Details</h2>
                    <p>Reason and additional notes</p>
                </div>
            </div>

            <div class="form-grid">

                <div class="form-group full">

                    <label class="form-label">
                        Reason
                    </label>

                    <textarea
                        name="reason"
                        class="form-control @error('reason') is-invalid @enderror"
                    >{{ old('reason', $appointment->reason) }}</textarea>

                    @error('reason')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group full">

                    <label class="form-label">
                        Notes
                    </label>

                    <textarea
                        name="notes"
                        class="form-control @error('notes') is-invalid @enderror"
                    >{{ old('notes', $appointment->notes) }}</textarea>

                    @error('notes')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                </div>

            </div>

        </div>

        <div class="form-actions">

            <a
                href="{{ route('appointments.index') }}"
                class="btn btn-cancel"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="btn btn-update"
            >
                ✓ Update Appointment
            </button>

        </div>

    </div>

</form>

</div>

@endsection
