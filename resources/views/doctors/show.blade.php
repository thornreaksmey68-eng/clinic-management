@extends('layouts.app')

@section('title', 'Doctor Details')
@section('page-subtitle', 'Doctor Information')

@section('content')

<style>
    .doctor-show {
        max-width: 1100px;
        margin: 0 auto;
    }

    .doctor-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        gap: 20px;
    }

    .doctor-profile {
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

    .doctor-profile h1 {
        margin: 0 0 5px;
        font-size: 27px;
        color: #111827;
    }

    .doctor-code {
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

    .specialization-badge {
        display: inline-flex;
        padding: 6px 10px;
        border-radius: 8px;
        background: #f0fdf4;
        color: #15803d;
        font-size: 12px;
        font-weight: 700;
    }

    .gender-badge {
        display: inline-flex;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }

    .gender-male {
        background: #eff6ff;
        color: #2563eb;
    }

    .gender-female {
        background: #fdf2f8;
        color: #be185d;
    }

    .gender-other {
        background: #f3f4f6;
        color: #4b5563;
    }

    .address-box {
        padding: 22px;
        color: #374151;
        font-size: 14px;
        line-height: 1.7;
        min-height: 45px;
    }

    .empty-value {
        color: #9ca3af;
    }

    .danger-zone {
        border: 1px solid #fecaca;
        background: #fffafa;
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 20px;
    }

    .danger-header {
        padding: 18px 22px;
        border-bottom: 1px solid #fecaca;
    }

    .danger-header h2 {
        margin: 0;
        color: #991b1b;
        font-size: 16px;
    }

    .danger-header p {
        margin: 4px 0 0;
        color: #b91c1c;
        font-size: 12px;
    }

    .danger-content {
        padding: 18px 22px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .danger-content span {
        color: #6b7280;
        font-size: 13px;
    }

    .delete-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 9px 14px;
        border-radius: 8px;
        border: none;
        background: #dc2626;
        color: white;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
    }

    .delete-btn:hover {
        background: #b91c1c;
    }

    @media (max-width: 700px) {
        .doctor-top {
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

        .danger-content {
            flex-direction: column;
            align-items: stretch;
        }
    }
</style>

<div class="doctor-show">

{{-- Doctor Header --}}
<div class="doctor-top">

    <div class="doctor-profile">

        <div class="profile-avatar">
            {{ strtoupper(substr($doctor->name, 0, 1)) }}
        </div>

        <div>

            <h1>
                {{ $doctor->name }}
            </h1>

            <div class="doctor-code">
                Doctor Code:
                <strong>{{ $doctor->doctor_code }}</strong>
            </div>

        </div>

    </div>

    <div class="top-actions">

        <a
            href="{{ route('doctors.index') }}"
            class="btn btn-back"
        >
            ← Back
        </a>

        <a
            href="{{ route('doctors.edit', $doctor) }}"
            class="btn btn-edit"
        >
            ✎ Edit Doctor
        </a>

    </div>

</div>

{{-- Professional Information --}}
<div class="info-card">

    <div class="card-header">

        <h2>Professional Information</h2>

        <p>
            Doctor professional details
        </p>

    </div>

    <div class="info-grid">

        <div class="info-item">

            <span class="info-label">
                Full Name
            </span>

            <span class="info-value">
                {{ $doctor->name }}
            </span>

        </div>

        <div class="info-item">

            <span class="info-label">
                Doctor Code
            </span>

            <span class="info-value">
                {{ $doctor->doctor_code }}
            </span>

        </div>

        <div class="info-item">

            <span class="info-label">
                Specialization
            </span>

            <span class="specialization-badge">
                {{ $doctor->specialization }}
            </span>

        </div>

        <div class="info-item">

            <span class="info-label">
                Qualification
            </span>

            @if($doctor->qualification)

                <span class="info-value">
                    {{ $doctor->qualification }}
                </span>

            @else

                <span class="empty-value">
                    Not provided
                </span>

            @endif

        </div>

        <div class="info-item">

            <span class="info-label">
                Gender
            </span>

            @if($doctor->gender === 'Male')

                <span class="gender-badge gender-male">
                    Male
                </span>

            @elseif($doctor->gender === 'Female')

                <span class="gender-badge gender-female">
                    Female
                </span>

            @elseif($doctor->gender)

                <span class="gender-badge gender-other">
                    {{ $doctor->gender }}
                </span>

            @else

                <span class="empty-value">
                    Not provided
                </span>

            @endif

        </div>

        <div class="info-item">

            <span class="info-label">
                Doctor ID
            </span>

            <span class="info-value">
                #{{ $doctor->id }}
            </span>

        </div>

    </div>

</div>

{{-- Contact Information --}}
<div class="info-card">

    <div class="card-header">

        <h2>Contact Information</h2>

        <p>
            Doctor contact details
        </p>

    </div>

    <div class="info-grid">

        <div class="info-item">

            <span class="info-label">
                Phone
            </span>

            @if($doctor->phone)

                <span class="info-value">
                    {{ $doctor->phone }}
                </span>

            @else

                <span class="empty-value">
                    Not provided
                </span>

            @endif

        </div>

        <div class="info-item">

            <span class="info-label">
                Email
            </span>

            @if($doctor->email)

                <span class="info-value">
                    {{ $doctor->email }}
                </span>

            @else

                <span class="empty-value">
                    Not provided
                </span>

            @endif

        </div>

    </div>

</div>

{{-- Address --}}
<div class="info-card">

    <div class="card-header">

        <h2>Address</h2>

        <p>
            Doctor residential information
        </p>

    </div>

    <div class="address-box">

        @if($doctor->address)

            {{ $doctor->address }}

        @else

            <span class="empty-value">
                No address provided.
            </span>

        @endif

    </div>

</div>

{{-- Delete Doctor --}}
<div class="danger-zone">

    <div class="danger-header">

        <h2>Delete Doctor</h2>

        <p>
            This action cannot be undone.
        </p>

    </div>

    <div class="danger-content">

        <span>
            Permanently remove this doctor from the system.
        </span>

        <form
            action="{{ route('doctors.destroy', $doctor) }}"
            method="POST"
            onsubmit="return confirm('Are you sure you want to delete this doctor?');"
        >

            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="delete-btn"
            >
                Delete Doctor
            </button>

        </form>

    </div>

</div>

</div>

@endsection
