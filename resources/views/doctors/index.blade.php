@extends('layouts.app')

@section('title', 'Doctors')
@section('page-subtitle', 'Doctor Management')

@section('content')

<style>
    .doctors-page {
        width: 100%;
    }

    .doctors-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        gap: 20px;
    }

    .doctors-title h1 {
        margin: 0 0 6px;
        font-size: 28px;
        font-weight: 700;
        color: #111827;
    }

    .doctors-title p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    .add-doctor-btn {
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

    .add-doctor-btn:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
    }

    .doctor-stat {
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

    .doctors-card {
        background: white;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        overflow: hidden;
    }

    .doctors-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 22px;
        border-bottom: 1px solid #e5e7eb;
        gap: 20px;
    }

    .doctors-card-header h2 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: #111827;
    }

    .doctors-card-header span {
        color: #6b7280;
        font-size: 13px;
    }

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
        transition: .2s;
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

    .doctors-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1000px;
    }

    .doctors-table th {
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

    .doctors-table td {
        padding: 16px 18px;
        border-bottom: 1px solid #f1f5f9;
        color: #374151;
        font-size: 14px;
        vertical-align: middle;
    }

    .doctors-table tbody tr {
        transition: .15s;
    }

    .doctors-table tbody tr:hover {
        background: #f8fafc;
    }

    .doctors-table tbody tr:last-child td {
        border-bottom: none;
    }

    .doctor-name {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .doctor-avatar {
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

    .doctor-name strong {
        display: block;
        color: #111827;
        font-weight: 600;
    }

    .doctor-code {
        color: #6b7280;
        font-size: 12px;
        margin-top: 2px;
    }

    .specialization-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 10px;
        border-radius: 8px;
        background: #f0fdf4;
        color: #15803d;
        font-size: 12px;
        font-weight: 600;
    }

    .gender-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
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

    .qualification {
        color: #6b7280;
        font-size: 13px;
    }

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
        transition: .2s;
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

    @media (max-width: 800px) {
        .doctors-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .doctors-card-header {
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

<div class="doctors-page">

<div class="doctors-header">
    <div class="doctors-title">
        <h1>Doctors</h1>
        <p>Manage doctors and their professional information</p>
    </div>

    <a href="{{ route('doctors.create') }}" class="add-doctor-btn">
        <span>＋</span>
        Add Doctor
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        ✓ {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="doctor-stat">
    <div class="stat-icon">👨‍⚕️</div>

    <div class="stat-info">
        <span>Total Doctors</span>
        <strong>{{ $doctors->count() }}</strong>
    </div>
</div>

<div class="doctors-card">

    <div class="doctors-card-header">
        <div>
            <h2>Doctor List</h2>
            <span>All registered doctors</span>
        </div>

        <div class="search-box">
            <span class="search-icon">⌕</span>
            <input
                type="text"
                id="doctorSearch"
                placeholder="Search doctors..."
            >
        </div>
    </div>

    <div class="table-wrapper">

        <table class="doctors-table" id="doctorsTable">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Doctor</th>
                    <th>Specialization</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Qualification</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($doctors as $doctor)

                    <tr>

                        <td>
                            #{{ $doctor->id }}
                        </td>

                        <td>

                            <div class="doctor-name">

                                <div class="doctor-avatar">
                                    {{ strtoupper(substr($doctor->name, 0, 1)) }}
                                </div>

                                <div>
                                    <strong>
                                        {{ $doctor->name }}
                                    </strong>

                                    <div class="doctor-code">
                                        {{ $doctor->doctor_code }}
                                    </div>
                                </div>

                            </div>

                        </td>

                        <td>
                            <span class="specialization-badge">
                                {{ $doctor->specialization }}
                            </span>
                        </td>

                        <td>

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

                                <span style="color:#9ca3af;">
                                    -
                                </span>

                            @endif

                        </td>

                        <td>
                            {{ $doctor->phone ?? '-' }}
                        </td>

                        <td>
                            {{ $doctor->email ?? '-' }}
                        </td>

                        <td>

                            @if($doctor->qualification)

                                <span class="qualification">
                                    {{ $doctor->qualification }}
                                </span>

                            @else

                                <span style="color:#9ca3af;">
                                    -
                                </span>

                            @endif

                        </td>

                        <td>

                            <div class="action-buttons">

                                <a
                                    href="{{ route('doctors.show', $doctor) }}"
                                    class="action-btn view-btn"
                                >
                                    View
                                </a>

                                <a
                                    href="{{ route('doctors.edit', $doctor) }}"
                                    class="action-btn edit-btn"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('doctors.destroy', $doctor) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this doctor?');"
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
                                👨‍⚕️
                            </div>

                            <strong>
                                No doctors found
                            </strong>

                            <span>
                                Start by adding your first doctor.
                            </span>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>
```

</div>

<script>
    document.getElementById('doctorSearch').addEventListener('keyup', function () {

        const search = this.value.toLowerCase();

        const rows = document.querySelectorAll(
            '#doctorsTable tbody tr'
        );

        rows.forEach(function (row) {

            const text = row.textContent.toLowerCase();

            row.style.display =
                text.includes(search) ? '' : 'none';

        });

    });
</script>

@endsection
