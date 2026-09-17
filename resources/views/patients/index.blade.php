@extends('layouts.app')

@section('title', 'Patients')
@section('page-subtitle', 'Patient Management')

@section('content')

<style>
    .patients-page {
        width: 100%;
    }

    /* Header */
    .patients-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        gap: 20px;
    }

    .patients-title h1 {
        margin: 0 0 6px;
        font-size: 28px;
        font-weight: 700;
    }

    .patients-title p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    .add-patient-btn {
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
        transition: 0.2s;
    }

    .add-patient-btn:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
    }

    /* Statistics */
    .patient-stat {
        background: white;
        border-radius: 14px;
        padding: 20px;
        margin-bottom: 24px;
        border: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eff6ff;
        font-size: 23px;
    }

    .stat-info span {
        display: block;
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 4px;
    }

    .stat-info strong {
        font-size: 24px;
        color: #111827;
    }

    /* Alert */
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

    .alert-danger {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }

    .alert-danger ul {
        margin: 0;
        padding-left: 20px;
    }

    /* Main Card */
    .patients-card {
        background: white;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        overflow: hidden;
    }

    .patients-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 22px;
        border-bottom: 1px solid #e5e7eb;
        gap: 20px;
    }

    .patients-card-header h2 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: #111827;
    }

    .patients-card-header span {
        color: #6b7280;
        font-size: 13px;
    }

    /* Search */
    .search-box {
        position: relative;
    }

    .search-box input {
        width: 230px;
        padding: 10px 14px 10px 38px;
        border: 1px solid #d1d5db;
        border-radius: 9px;
        outline: none;
        font-size: 13px;
        transition: 0.2s;
    }

    .search-box input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
    }

    /* Table */
    .table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .patients-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 950px;
    }

    .patients-table th {
        background: #f9fafb;
        padding: 14px 18px;
        text-align: left;
        color: #6b7280;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        border-bottom: 1px solid #e5e7eb;
    }

    .patients-table td {
        padding: 16px 18px;
        border-bottom: 1px solid #f1f5f9;
        color: #374151;
        font-size: 14px;
        vertical-align: middle;
    }

    .patients-table tbody tr {
        transition: 0.15s;
    }

    .patients-table tbody tr:hover {
        background: #f8fafc;
    }

    .patients-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Patient */
    .patient-name {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .patient-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eff6ff;
        color: #2563eb;
        font-weight: 700;
        font-size: 14px;
        flex-shrink: 0;
    }

    .patient-name strong {
        display: block;
        color: #111827;
        font-weight: 600;
    }

    .patient-code {
        color: #6b7280;
        font-size: 12px;
        margin-top: 2px;
    }

    /* Badges */
    .badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-male {
        background: #eff6ff;
        color: #2563eb;
    }

    .badge-female {
        background: #fdf2f8;
        color: #be185d;
    }

    .badge-other {
        background: #f3f4f6;
        color: #4b5563;
    }

    .blood-badge {
        background: #fef2f2;
        color: #dc2626;
        padding: 5px 9px;
        border-radius: 7px;
        font-weight: 700;
        font-size: 12px;
    }

    /* Actions */
    .action-buttons {
        display: flex;
        align-items: center;
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
        transition: 0.2s;
    }

    .view-btn {
        background: #eff6ff;
        color: #2563eb;
    }

    .view-btn:hover {
        background: #dbeafe;
    }

    .edit-btn {
        background: #fefce8;
        color: #a16207;
    }

    .edit-btn:hover {
        background: #fef9c3;
    }

    .delete-btn {
        background: #fef2f2;
        color: #dc2626;
    }

    .delete-btn:hover {
        background: #fee2e2;
    }

    /* Empty */
    .empty-state {
        text-align: center;
        padding: 55px 20px !important;
        color: #9ca3af !important;
    }

    .empty-icon {
        font-size: 38px;
        margin-bottom: 10px;
    }

    .empty-state strong {
        display: block;
        color: #374151;
        margin-bottom: 5px;
    }

    /* Responsive */
    @media (max-width: 800px) {
        .patients-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .patients-card-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .search-box,
        .search-box input {
            width: 100%;
        }

        .search-box {
            width: 100%;
        }
    }
</style>

<div class="patients-page">

{{-- Page Header --}}
<div class="patients-header">

    <div class="patients-title">
        <h1>Patients</h1>
        <p>Manage patient information and medical records</p>
    </div>

    <a href="{{ route('patients.create') }}" class="add-patient-btn">
        <span>＋</span>
        Add Patient
    </a>

</div>


{{-- Success Message --}}
@if(session('success'))
    <div class="alert alert-success">
        ✓ {{ session('success') }}
    </div>
@endif


{{-- Error Messages --}}
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


{{-- Patient Statistics --}}
<div class="patient-stat">

    <div class="stat-icon">
        👥
    </div>

    <div class="stat-info">
        <span>Total Patients</span>
        <strong>{{ $patients->count() }}</strong>
    </div>

</div>


{{-- Patient Card --}}
<div class="patients-card">

    <div class="patients-card-header">

        <div>
            <h2>Patient List</h2>
            <span>All registered patients</span>
        </div>

        <div class="search-box">
            <span class="search-icon">⌕</span>
            <input
                type="text"
                id="patientSearch"
                placeholder="Search patients..."
            >
        </div>

    </div>


    {{-- Table --}}
    <div class="table-wrapper">

        <table class="patients-table" id="patientsTable">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Patient</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Blood Group</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($patients as $patient)

                    <tr>

                        <td>
                            #{{ $patient->id }}
                        </td>


                        {{-- Patient --}}
                        <td>
                            <div class="patient-name">

                                <div class="patient-avatar">
                                    {{ strtoupper(substr($patient->name, 0, 1)) }}
                                </div>

                                <div>
                                    <strong>
                                        {{ $patient->name }}
                                    </strong>

                                    <div class="patient-code">
                                        {{ $patient->patient_code }}
                                    </div>
                                </div>

                            </div>
                        </td>


                        {{-- Gender --}}
                        <td>

                            @if($patient->gender === 'Male')

                                <span class="badge badge-male">
                                    Male
                                </span>

                            @elseif($patient->gender === 'Female')

                                <span class="badge badge-female">
                                    Female
                                </span>

                            @else

                                <span class="badge badge-other">
                                    Other
                                </span>

                            @endif

                        </td>


                        {{-- Date of Birth --}}
                        <td>

                            @if($patient->date_of_birth)

                                {{ \Carbon\Carbon::parse($patient->date_of_birth)->format('d M Y') }}

                            @else

                                -

                            @endif

                        </td>


                        {{-- Phone --}}
                        <td>
                            {{ $patient->phone ?? '-' }}
                        </td>


                        {{-- Email --}}
                        <td>
                            {{ $patient->email ?? '-' }}
                        </td>


                        {{-- Blood Group --}}
                        <td>

                            @if($patient->blood_group)

                                <span class="blood-badge">
                                    {{ $patient->blood_group }}
                                </span>

                            @else

                                -

                            @endif

                        </td>


                        {{-- Actions --}}
                        <td>

                            <div class="action-buttons">

                                <a
                                    href="{{ route('patients.show', $patient) }}"
                                    class="action-btn view-btn"
                                >
                                    View
                                </a>

                                <a
                                    href="{{ route('patients.edit', $patient) }}"
                                    class="action-btn edit-btn"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('patients.destroy', $patient) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this patient?');"
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
                        <td colspan="8" class="empty-state">

                            <div class="empty-icon">
                                👥
                            </div>

                            <strong>No patients found</strong>

                            <span>
                                Start by adding your first patient.
                            </span>

                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</div>

{{-- Search --}}

<script>
    document.getElementById('patientSearch').addEventListener('keyup', function () {

        const search = this.value.toLowerCase();
        const rows = document.querySelectorAll('#patientsTable tbody tr');

        rows.forEach(function (row) {

            const text = row.textContent.toLowerCase();

            row.style.display = text.includes(search) ? '' : 'none';

        });

    });
</script>

@endsection
