@extends('layouts.app')

@section('title', 'Patient Details')
@section('page-subtitle', 'Patient Information')

@section('content')

<style>
    .patient-show {
        max-width: 1100px;
        margin: 0 auto;
    }

    .patient-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        gap: 20px;
    }

    .patient-profile {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .profile-avatar {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
        font-weight: 700;
    }

    .patient-profile h1 {
        margin: 0 0 5px;
        font-size: 27px;
        color: #111827;
    }

    .patient-code {
        color: #6b7280;
        font-size: 13px;
    }

    .top-actions {
        display: flex;
        gap: 9px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 10px 16px;
        border-radius: 9px;
        text-decoration: none;
        border: none;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: .2s;
    }

    .btn-back {
        background: white;
        color: #374151;
        border: 1px solid #d1d5db;
    }

    .btn-back:hover {
        background: #f3f4f6;
    }

    .btn-edit {
        background: #2563eb;
        color: white;
    }

    .btn-edit:hover {
        background: #1d4ed8;
    }

    .info-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        margin-bottom: 20px;
        overflow: hidden;
    }

    .card-header {
        padding: 19px 22px;
        border-bottom: 1px solid #e5e7eb;
    }

    .card-header h2 {
        margin: 0;
        font-size: 17px;
        color: #111827;
    }

    .card-header p {
        margin: 4px 0 0;
        color: #6b7280;
        font-size: 12px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0;
    }

    .info-item {
        padding: 18px 22px;
        border-bottom: 1px solid #f1f5f9;
    }

    .info-item:nth-child(odd) {
        border-right: 1px solid #f1f5f9;
    }

    .info-label {
        display: block;
        color: #9ca3af;
        font-size: 11px;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: .4px;
        margin-bottom: 6px;
    }

    .info-value {
        color: #374151;
        font-size: 14px;
        font-weight: 500;
    }

    .gender-badge,
    .blood-badge {
        display: inline-flex;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }

    .gender-badge {
        background: #eff6ff;
        color: #2563eb;
    }

    .blood-badge {
        background: #fef2f2;
        color: #dc2626;
    }

    .address-box {
        padding: 22px;
        color: #374151;
        font-size: 14px;
        line-height: 1.7;
        min-height: 45px;
    }

    .emergency-box {
        padding: 20px 22px;
        background: #fff7ed;
        color: #9a3412;
        font-size: 14px;
    }

    .empty-value {
        color: #9ca3af;
    }

    @media (max-width: 700px) {
        .patient-top {
            flex-direction: column;
            align-items: flex-start;
        }

        .top-actions {
            width: 100%;
        }

        .top-actions .btn {
            flex: 1;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .info-item:nth-child(odd) {
            border-right: none;
        }
    }
</style>

<div class="patient-show">

{{-- Patient Header --}}
<div class="patient-top">

    <div class="patient-profile">

        <div class="profile-avatar">
            {{ strtoupper(substr($patient->name, 0, 1)) }}
        </div>

        <div>
            <h1>{{ $patient->name }}</h1>

            <div class="patient-code">
                Patient Code: <strong>{{ $patient->patient_code }}</strong>
            </div>
        </div>

    </div>


    <div class="top-actions">

        <a href="{{ route('patients.index') }}" class="btn btn-back">
            ← Back
        </a>

        <a href="{{ route('patients.edit', $patient) }}" class="btn btn-edit">
            ✎ Edit Patient
        </a>

    </div>

</div>


{{-- Personal Information --}}
<div class="info-card">

    <div class="card-header">
        <h2>Personal Information</h2>
        <p>Basic patient information</p>
    </div>

    <div class="info-grid">

        <div class="info-item">
            <span class="info-label">Full Name</span>
            <span class="info-value">{{ $patient->name }}</span>
        </div>

        <div class="info-item">
            <span class="info-label">Patient Code</span>
            <span class="info-value">{{ $patient->patient_code }}</span>
        </div>

        <div class="info-item">
            <span class="info-label">Gender</span>

            <span class="gender-badge">
                {{ $patient->gender }}
            </span>
        </div>

        <div class="info-item">
            <span class="info-label">Date of Birth</span>

            <span class="info-value">
                {{ $patient->date_of_birth?->format('d M Y') ?? 'Not provided' }}
            </span>
        </div>

        <div class="info-item">
            <span class="info-label">Blood Group</span>

            @if($patient->blood_group)
                <span class="blood-badge">
                    {{ $patient->blood_group }}
                </span>
            @else
                <span class="empty-value">Not provided</span>
            @endif
        </div>

        <div class="info-item">
            <span class="info-label">Patient ID</span>
            <span class="info-value">#{{ $patient->id }}</span>
        </div>

    </div>

</div>


{{-- Contact Information --}}
<div class="info-card">

    <div class="card-header">
        <h2>Contact Information</h2>
        <p>Patient contact details</p>
    </div>

    <div class="info-grid">

        <div class="info-item">
            <span class="info-label">Phone</span>
            <span class="info-value">
                {{ $patient->phone ?? 'Not provided' }}
            </span>
        </div>

        <div class="info-item">
            <span class="info-label">Email</span>
            <span class="info-value">
                {{ $patient->email ?? 'Not provided' }}
            </span>
        </div>

    </div>

</div>


{{-- Address --}}
<div class="info-card">

    <div class="card-header">
        <h2>Address</h2>
        <p>Patient residential information</p>
    </div>

    <div class="address-box">
        {{ $patient->address ?? 'No address provided.' }}
    </div>

</div>


{{-- Emergency Contact --}}
<div class="info-card">

    <div class="card-header">
        <h2>Emergency Contact</h2>
        <p>Contact information for emergencies</p>
    </div>

    <div class="emergency-box">
        {{ $patient->emergency_contact ?? 'No emergency contact provided.' }}
    </div>

</div>

</div>

@endsection
