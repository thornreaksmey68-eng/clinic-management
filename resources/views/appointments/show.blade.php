@extends('layouts.app')

@section('title', 'Appointment Details')
@section('page-subtitle', 'Appointment Information')

@section('content')

<style>
    .appointment-show {
        max-width: 1100px;
        margin: 0 auto;
    }

    .appointment-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        gap: 20px;
    }

    .appointment-title h1 {
        margin: 0 0 6px;
        font-size: 28px;
        color: #111827;
    }

    .appointment-title p {
        margin: 0;
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
        padding: 10px 16px;
        border-radius: 9px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-back {
        background: white;
        color: #374151;
        border: 1px solid #d1d5db;
    }

    .btn-edit {
        background: #2563eb;
        color: white;
    }

    .info-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 20px;
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
        padding: 20px 22px;
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
        margin-bottom: 7px;
    }

    .info-value {
        color: #374151;
        font-size: 14px;
        font-weight: 500;
    }

    .person-name {
        color: #111827;
        font-weight: 700;
        font-size: 15px;
    }

    .person-code {
        color: #9ca3af;
        font-size: 12px;
        margin-top: 3px;
    }

    .status-badge {
        display: inline-flex;
        padding: 7px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }

    .status-pending {
        background: #fefce8;
        color: #a16207;
    }

    .status-confirmed {
        background: #eff6ff;
        color: #2563eb;
    }

    .status-completed {
        background: #ecfdf5;
        color: #047857;
    }

    .status-cancelled {
        background: #fef2f2;
        color: #dc2626;
    }

    .text-box {
        padding: 22px;
        color: #374151;
        font-size: 14px;
        line-height: 1.7;
        min-height: 45px;
    }

    .empty {
        color: #9ca3af;
    }

    .danger-zone {
        border: 1px solid #fecaca;
        background: #fffafa;
        border-radius: 16px;
        overflow: hidden;
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
        padding: 9px 14px;
        border: none;
        border-radius: 8px;
        background: #dc2626;
        color: white;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
    }

    @media (max-width: 700px) {
        .appointment-top {
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

<div class="appointment-show">

<div class="appointment-top">

    <div class="appointment-title">

        <h1>
            Appointment #{{ $appointment->id }}
        </h1>

        <p>
            {{ $appointment->appointment_date?->format('d M Y') }}
            at
            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
        </p>

    </div>

    <div class="top-actions">

        <a
            href="{{ route('appointments.index') }}"
            class="btn btn-back"
        >
            ← Back
        </a>

        <a
            href="{{ route('appointments.edit', $appointment) }}"
            class="btn btn-edit"
        >
            ✎ Edit
        </a>

    </div>

</div>

<div class="info-card">

    <div class="card-header">
        <h2>Appointment Information</h2>
        <p>Patient and doctor appointment details</p>
    </div>

    <div class="info-grid">

        <div class="info-item">

            <span class="info-label">
                Patient
            </span>

            <div class="person-name">
                {{ $appointment->patient->name ?? 'Unknown Patient' }}
            </div>

            <div class="person-code">
                {{ $appointment->patient->patient_code ?? '-' }}
            </div>

        </div>

        <div class="info-item">

            <span class="info-label">
                Doctor
            </span>

            <div class="person-name">
                Dr. {{ $appointment->doctor->name ?? 'Unknown Doctor' }}
            </div>

            <div class="person-code">
                {{ $appointment->doctor->specialization ?? '-' }}
            </div>

        </div>

        <div class="info-item">

            <span class="info-label">
                Date
            </span>

            <span class="info-value">
                {{ $appointment->appointment_date?->format('d M Y') }}
            </span>

        </div>

        <div class="info-item">

            <span class="info-label">
                Time
            </span>

            <span class="info-value">
                {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
            </span>

        </div>

        <div class="info-item">

            <span class="info-label">
                Status
            </span>

            @php
                $statusClass = match($appointment->status) {
                    'Pending' => 'status-pending',
                    'Confirmed' => 'status-confirmed',
                    'Completed' => 'status-completed',
                    'Cancelled' => 'status-cancelled',
                    default => 'status-pending',
                };
            @endphp

            <span class="status-badge {{ $statusClass }}">
                {{ $appointment->status }}
            </span>

        </div>

        <div class="info-item">

            <span class="info-label">
                Appointment ID
            </span>

            <span class="info-value">
                #{{ $appointment->id }}
            </span>

        </div>

    </div>

</div>

<div class="info-card">

    <div class="card-header">
        <h2>Reason</h2>
        <p>Reason for the appointment</p>
    </div>

    <div class="text-box">

        @if($appointment->reason)
            {{ $appointment->reason }}
        @else
            <span class="empty">
                No reason provided.
            </span>
        @endif

    </div>

</div>

<div class="info-card">

    <div class="card-header">
        <h2>Notes</h2>
        <p>Additional appointment notes</p>
    </div>

    <div class="text-box">

        @if($appointment->notes)
            {{ $appointment->notes }}
        @else
            <span class="empty">
                No additional notes.
            </span>
        @endif

    </div>

</div>

<div class="danger-zone">

    <div class="danger-header">

        <h2>Delete Appointment</h2>

        <p>
            This action cannot be undone.
        </p>

    </div>

    <div class="danger-content">

        <span>
            Permanently remove this appointment from the system.
        </span>

        <form
            action="{{ route('appointments.destroy', $appointment) }}"
            method="POST"
            onsubmit="return confirm('Are you sure you want to delete this appointment?');"
        >

            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="delete-btn"
            >
                Delete Appointment
            </button>

        </form>

    </div>

</div>

</div>

@endsection
