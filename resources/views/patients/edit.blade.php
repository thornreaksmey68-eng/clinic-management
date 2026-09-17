@extends('layouts.app')

@section('title', 'Edit Patient')
@section('page-subtitle', 'Update Patient Information')

@section('content')

<style>
    .patient-form-page {
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
        transition: .2s;
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

<div class="patient-form-page">

<div class="form-header">
    <h1>Edit Patient</h1>
    <p>Update information for {{ $patient->name }}</p>
</div>


{{-- Validation Errors --}}
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


<form action="{{ route('patients.update', $patient) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="form-card">

        {{-- Basic Information --}}
        <div class="form-section">

            <div class="section-title">
                <div class="section-icon">👤</div>

                <div>
                    <h2>Basic Information</h2>
                    <p>Patient identification and personal information</p>
                </div>
            </div>


            <div class="form-grid">

                {{-- Patient Code --}}
                <div class="form-group">

                    <label class="form-label" for="patient_code">
                        Patient Code <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="patient_code"
                        name="patient_code"
                        class="form-control @error('patient_code') is-invalid @enderror"
                        value="{{ old('patient_code', $patient->patient_code) }}"
                        maxlength="20"
                        required
                    >

                    @error('patient_code')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                </div>


                {{-- Name --}}
                <div class="form-group">

                    <label class="form-label" for="name">
                        Full Name <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $patient->name) }}"
                        maxlength="255"
                        required
                    >

                    @error('name')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                </div>


                {{-- Gender --}}
                <div class="form-group">

                    <label class="form-label" for="gender">
                        Gender <span class="required">*</span>
                    </label>

                    <select
                        id="gender"
                        name="gender"
                        class="form-control @error('gender') is-invalid @enderror"
                        required
                    >
                        <option value="">Select gender</option>

                        <option value="Male"
                            {{ old('gender', $patient->gender) === 'Male' ? 'selected' : '' }}>
                            Male
                        </option>

                        <option value="Female"
                            {{ old('gender', $patient->gender) === 'Female' ? 'selected' : '' }}>
                            Female
                        </option>

                        <option value="Other"
                            {{ old('gender', $patient->gender) === 'Other' ? 'selected' : '' }}>
                            Other
                        </option>
                    </select>

                    @error('gender')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                </div>


                {{-- Date of Birth --}}
                <div class="form-group">

                    <label class="form-label" for="date_of_birth">
                        Date of Birth
                    </label>

                    <input
                        type="date"
                        id="date_of_birth"
                        name="date_of_birth"
                        class="form-control @error('date_of_birth') is-invalid @enderror"
                        value="{{ old('date_of_birth', $patient->date_of_birth?->format('Y-m-d')) }}"
                    >

                    @error('date_of_birth')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                </div>

            </div>

        </div>


        {{-- Contact Information --}}
        <div class="form-section">

            <div class="section-title">
                <div class="section-icon">📞</div>

                <div>
                    <h2>Contact Information</h2>
                    <p>Contact and emergency details</p>
                </div>
            </div>


            <div class="form-grid">

                {{-- Phone --}}
                <div class="form-group">

                    <label class="form-label" for="phone">
                        Phone
                    </label>

                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        class="form-control @error('phone') is-invalid @enderror"
                        value="{{ old('phone', $patient->phone) }}"
                        maxlength="20"
                    >

                    @error('phone')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                </div>


                {{-- Email --}}
                <div class="form-group">

                    <label class="form-label" for="email">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $patient->email) }}"
                        maxlength="255"
                    >

                    @error('email')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                </div>


                {{-- Emergency Contact --}}
                <div class="form-group">

                    <label class="form-label" for="emergency_contact">
                        Emergency Contact
                    </label>

                    <input
                        type="text"
                        id="emergency_contact"
                        name="emergency_contact"
                        class="form-control @error('emergency_contact') is-invalid @enderror"
                        value="{{ old('emergency_contact', $patient->emergency_contact) }}"
                        maxlength="20"
                    >

                    @error('emergency_contact')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                </div>


                {{-- Blood Group --}}
                <div class="form-group">

                    <label class="form-label" for="blood_group">
                        Blood Group
                    </label>

                    <select
                        id="blood_group"
                        name="blood_group"
                        class="form-control @error('blood_group') is-invalid @enderror"
                    >
                        <option value="">Select blood group</option>

                        @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $group)

                            <option value="{{ $group }}"
                                {{ old('blood_group', $patient->blood_group) === $group ? 'selected' : '' }}>
                                {{ $group }}
                            </option>

                        @endforeach

                    </select>

                    @error('blood_group')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                </div>


                {{-- Address --}}
                <div class="form-group full">

                    <label class="form-label" for="address">
                        Address
                    </label>

                    <textarea
                        id="address"
                        name="address"
                        class="form-control @error('address') is-invalid @enderror"
                        placeholder="Enter patient's address"
                    >{{ old('address', $patient->address) }}</textarea>

                    @error('address')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                </div>

            </div>

        </div>


        {{-- Buttons --}}
        <div class="form-actions">

            <a
                href="{{ route('patients.index') }}"
                class="btn btn-cancel"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="btn btn-update"
            >
                ✓ Update Patient
            </button>

        </div>

    </div>

</form>

</div>

@endsection
