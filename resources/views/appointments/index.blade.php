@extends('layouts.app')

@section('title', 'Appointments')
@section('page-subtitle', 'Appointment Management')

@section('content')

<style>
    .appointments-page {
        width: 100%;
    }

    .appointments-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        gap: 20px;
    }

    .appointments-title h1 {
        margin: 0 0 6px;
        font-size: 28px;
        font-weight: 700;
        color: #111827;
    }

    .appointments-title p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    .add-appointment-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 18px;
        border-radius: 10px;
        background: #2563eb;
        color: white;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: .2s;
    }

    .add-appointment-btn:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 20px;
    }

    .stat-card span {
        display: block;
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 8px;
    }

    .stat-card strong {
        font-size: 25px;
        color: #111827;
    }

    .stat-icon {
        font-size: 22px;
        margin-bottom: 10px;
    }

    .alert {
        padding: 14px 18px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .alert-success {
        background: #ecfdf5;
        color: #047857;
        border: 1px solid #a7f3d0;
    }

    .appointments-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        overflow: hidden;
    }

    .appointments-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 22px;
        border-bottom: 1px solid #e5e7eb;
        gap: 20px;
    }

    .appointments-card-header h2 {
        margin: 0;
        font-size: 18px;
        color: #111827;
    }

    .appointments-card-header span {
        color: #6b7280;
        font-size: 13px;
    }

    .search-box {
        position: relative;
    }

    .search-box input {
        width: 240px;
        padding: 10px 14px 10px 38px;
        border: 1px solid #d1d5db;
        border-radius: 9px;
        outline: none;
        font-size: 13px;
    }

    .search-box input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .1);
    }

    .search-icon {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
    }

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .appointments-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1000px;
    }

    .appointments-table th {
        background: #f9fafb;
        padding: 14px 18px;
        text-align: left;
        color: #6b7280;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .4px;
        border-bottom: 1px solid #e5e7eb;
    }

    .appointments-table td {
        padding: 16px 18px;
        border-bottom: 1px solid #f1f5f9;
        color: #374151;
        font-size: 14px;
        vertical-align: middle;
    }

    .appointments-table tbody tr:hover {
        background: #f8fafc;
    }

    .person-name strong {
        display: block;
        color: #111827;
        font-weight: 600;
    }

    .person-code {
        color: #9ca3af;
        font-size: 11px;
        margin-top: 3px;
    }

    .date-time strong {
        display: block;
        color: #111827;
    }

    .date-time span {
        color: #6b7280;
        font-size: 12px;
    }

    .status-badge {
        display: inline-flex;
        padding: 6px 10px;
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

    .reason-text {
        max-width: 180px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .action-buttons {
        display: flex;
        gap: 6px;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 7px 10px;
        border-radius: 7px;
        border: none;
        text-decoration: none;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
    }

    .view-btn {
        background: #eff6ff;
        color: #2563eb;
    }

    .edit-btn {
        background: #fefce8;
        color: #a16207;
    }

    .delete-btn {
        background: #fef2f2;
        color: #dc2626;
    }

    .empty-state {
        text-align: center;
        padding: 55px 20px !important;
        color: #9ca3af !important;
    }

    .empty-icon {
        font-size: 38px;
        margin-bottom: 10px;
    }

    @media (max-width: 1000px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 700px) {
        .appointments-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .appointments-card-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .search-box,
        .search-box input {
            width: 100%;
        }
    }
</style>

<div class="appointments-page">


<div class="appointments-header">
    <div class="appointments-title">
        <h1>Appointments</h1>
        <p>Schedule and manage patient appointments</p>
    </div>

    <a href="{{ route('appointments.create') }}" class="add-appointment-btn">
        ＋ Add Appointment
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        ✓ {{ session('success') }}
    </div>
@endif

<div class="stats-grid">

    <div class="stat-card">
        <div class="stat-icon">📅</div>
        <span>Total Appointments</span>
        <strong>{{ $appointments->count() }}</strong>
    </div>

    <div class="stat-card">
        <div class="stat-icon">⏳</div>
        <span>Pending</span>
        <strong>{{ $appointments->where('status', 'Pending')->count() }}</strong>
    </div>

    <div class="stat-card">
        <div class="stat-icon">✓</div>
        <span>Confirmed</span>
        <strong>{{ $appointments->where('status', 'Confirmed')->count() }}</strong>
    </div>

    <div class="stat-card">
        <div class="stat-icon">✔</div>
        <span>Completed</span>
        <strong>{{ $appointments->where('status', 'Completed')->count() }}</strong>
    </div>

</div>

<div class="appointments-card">

    <div class="appointments-card-header">

        <div>
            <h2>Appointment List</h2>
            <span>All scheduled appointments</span>
        </div>

        <div class="search-box">
            <span class="search-icon">⌕</span>
            <input
                type="text"
                id="appointmentSearch"
                placeholder="Search appointments..."
            >
        </div>

    </div>

    <div class="table-wrapper">

        <table class="appointments-table" id="appointmentsTable">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Date & Time</th>
                    <th>Status</th>
                    <th>Reason</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($appointments as $appointment)

                    <tr>

                        <td>
                            #{{ $appointment->id }}
                        </td>

                        <td>
                            <div class="person-name">
                                <strong>
                                    {{ $appointment->patient->name ?? 'Unknown Patient' }}
                                </strong>

                                <div class="person-code">
                                    {{ $appointment->patient->patient_code ?? '-' }}
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="person-name">
                                <strong>
                                    Dr. {{ $appointment->doctor->name ?? 'Unknown Doctor' }}
                                </strong>

                                <div class="person-code">
                                    {{ $appointment->doctor->specialization ?? '-' }}
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="date-time">
                                <strong>
                                    {{ $appointment->appointment_date?->format('d M Y') }}
                                </strong>

                                <span>
                                    {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                </span>
                            </div>
                        </td>

                        <td>

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

                        </td>

                        <td>
                            <div class="reason-text">
                                {{ $appointment->reason ?? '-' }}
                            </div>
                        </td>

                        <td>

                            <div class="action-buttons">

                                <a
                                    href="{{ route('appointments.show', $appointment) }}"
                                    class="action-btn view-btn"
                                >
                                    View
                                </a>

                                <a
                                    href="{{ route('appointments.edit', $appointment) }}"
                                    class="action-btn edit-btn"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('appointments.destroy', $appointment) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this appointment?');"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="action-btn delete-btn"
                                    >
                                        Delete
                                    </button>
                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="empty-state">
                            <div class="empty-icon">📅</div>

                            <strong>No appointments found</strong>

                            <div>
                                Start by scheduling your first appointment.
                            </div>
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


</div>

<script>
    document.getElementById('appointmentSearch').addEventListener('keyup', function () {

        const search = this.value.toLowerCase();

        document
            .querySelectorAll('#appointmentsTable tbody tr')
            .forEach(function (row) {

                const text = row.textContent.toLowerCase();

                row.style.display =
                    text.includes(search) ? '' : 'none';

            });

    });
</script>

@endsection
