@extends('layouts.app')

@section('title', 'Edit Doctor')
@section('page-subtitle', 'Update Doctor Information')

@section('content')

<style>
    .doctor-form-page {
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
        font-weight: 700;
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
        align-items: center;
        gap: 10px;
        padding: 20px 24px;
        background: #f9fafb;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 11px 18px;
        border-radius: 9px;
        border: none;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: .2s;
    }

    .btn-cancel {
        background: white;
        color: #374151;
        border: 1px solid #d1d5db;
    }

    .btn-cancel:hover {
        background: #f3f4f6;
    }

    .btn-update {
        background: #2563eb;
        color: white;
    }

    .btn-update:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
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

    .alert-danger strong {
        display: block;
        margin-bottom: 6px;
    }

    .alert-danger ul {
        margin: 0;
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
            align-items: stretch;
        }

        .form-actions .btn {
            width: 100%;
        }
    }
</style>

<div class="doctor-form-page">

<div class="form-header">
    <h1>Edit Doctor</h1>
    <p>Update information for {{ $doctor->name }}</p>
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

<form action="{{ route('doctors.update', $doctor) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-card">

        {{-- Professional Information --}}
        <div class="form-section">

            <div class="section-title">
                <div class="section-icon">👨‍⚕️</div>

                <div>
                    <h2>Professional Information</h2>
                    <p>Doctor identification and professional details</p>
                </div>
            </div>

            <div class="form-grid">

                <div class="form-group">

                    <label class="form-label" for="doctor_code">
                        Doctor Code <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="doctor_code"
                        name="doctor_code"
                        class="form-control @error('doctor_code') is-invalid @enderror"
                        value="{{ old('doctor_code', $doctor->doctor_code) }}"
                        maxlength="50"
                        required
                    >

                    @error('doctor_code')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group">

                    <label class="form-label" for="name">
                        Full Name <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $doctor->name) }}"
                        maxlength="255"
                        required
                    >

                    @error('name')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group">

                    <label class="form-label" for="specialization">
                        Specialization <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="specialization"
                        name="specialization"
                        class="form-control @error('specialization') is-invalid @enderror"
                        value="{{ old('specialization', $doctor->specialization) }}"
                        maxlength="255"
                        required
                    >

                    @error('specialization')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group">

                    <label class="form-label" for="qualification">
                        Qualification
                    </label>

                    <input
                        type="text"
                        id="qualification"
                        name="qualification"
                        class="form-control @error('qualification') is-invalid @enderror"
                        value="{{ old('qualification', $doctor->qualification) }}"
                        maxlength="255"
                    >

                    @error('qualification')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group">

                    <label class="form-label" for="gender">
                        Gender
                    </label>

                    <select
                        id="gender"
                        name="gender"
                        class="form-control @error('gender') is-invalid @enderror"
                    >
                        <option value="">Select gender</option>

                        <option
                            value="Male"
                            {{ old('gender', $doctor->gender) === 'Male' ? 'selected' : '' }}
                        >
                            Male
                        </option>

                        <option
                            value="Female"
                            {{ old('gender', $doctor->gender) === 'Female' ? 'selected' : '' }}
                        >
                            Female
                        </option>

                        <option
                            value="Other"
                            {{ old('gender', $doctor->gender) === 'Other' ? 'selected' : '' }}
                        >
                            Other
                        </option>

                    </select>

                    @error('gender')
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
                    <p>Doctor contact details</p>
                </div>
            </div>

            <div class="form-grid">

                <div class="form-group">

                    <label class="form-label" for="phone">
                        Phone
                    </label>

                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        class="form-control @error('phone') is-invalid @enderror"
                        value="{{ old('phone', $doctor->phone) }}"
                        maxlength="30"
                    >

                    @error('phone')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group">

                    <label class="form-label" for="email">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $doctor->email) }}"
                        maxlength="255"
                    >

                    @error('email')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group full">

                    <label class="form-label" for="address">
                        Address
                    </label>

                    <textarea
                        id="address"
                        name="address"
                        class="form-control @error('address') is-invalid @enderror"
                        placeholder="Enter doctor's address"
                    >{{ old('address', $doctor->address) }}</textarea>

                    @error('address')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                </div>

            </div>

        </div>

        <div class="form-actions">

            <a
                href="{{ route('doctors.index') }}"
                class="btn btn-cancel"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="btn btn-update"
            >
                ✓ Update Doctor
            </button>

        </div>

    </div>

</form>

</div>

@endsection
