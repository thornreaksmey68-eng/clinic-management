@extends('layouts.app')

@section('title', 'Prescriptions')
@section('page-subtitle', 'Prescription Management')

@section('content')

<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        gap: 15px;
        flex-wrap: wrap;
    }

    .page-title h2 {
        margin: 0;
        font-size: 26px;
        font-weight: 700;
    }

    .page-title p {
        margin: 5px 0 0;
        color: #6b7280;
    }

    .btn-primary-custom {
        background: #2563eb;
        color: white;
        border: none;
        padding: 11px 18px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
    }

    .btn-primary-custom:hover {
        background: #1d4ed8;
        color: white;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-bottom: 25px;
    }

    .stat-card {
        background: white;
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 3px 15px rgba(0,0,0,.06);
    }

    .stat-card span {
        color: #6b7280;
        font-size: 14px;
    }

    .stat-card h3 {
        margin: 7px 0 0;
        font-size: 27px;
    }

    .table-card {
        background: white;
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 3px 15px rgba(0,0,0,.06);
        overflow-x: auto;
    }

    .search-box {
        width: 100%;
        max-width: 350px;
        padding: 11px 14px;
        border: 1px solid #d1d5db;
        border-radius: 9px;
        margin-bottom: 18px;
        outline: none;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        min-width: 800px;
    }

    .table th {
        background: #f8fafc;
        color: #475569;
        font-size: 13px;
        padding: 13px;
        text-align: left;
    }

    .table td {
        padding: 14px 13px;
        border-top: 1px solid #eef2f7;
        vertical-align: middle;
    }

    .patient-name {
        font-weight: 600;
    }

    .small-code {
        font-size: 12px;
        color: #64748b;
    }

    .actions {
        display: flex;
        gap: 7px;
    }

    .action-btn {
        padding: 7px 10px;
        border-radius: 7px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
    }

    .view-btn {
        background: #eff6ff;
        color: #2563eb;
    }

    .edit-btn {
        background: #fef3c7;
        color: #b45309;
    }

    .delete-btn {
        background: #fee2e2;
        color: #dc2626;
        border: none;
        cursor: pointer;
    }

    .alert-success {
        background: #dcfce7;
        color: #166534;
        padding: 13px 16px;
        border-radius: 9px;
        margin-bottom: 20px;
    }

    @media(max-width: 800px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="page-header">
    <div class="page-title">
        <h2>Prescriptions</h2>
        <p>Manage patient prescriptions and medicines</p>
    </div>

    <a href="{{ route('prescriptions.create') }}" class="btn-primary-custom">
        + New Prescription
    </a>
</div>

@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="stats-grid">
    <div class="stat-card">
        <span>Total Prescriptions</span>
        <h3>{{ $prescriptions->count() }}</h3>
    </div>

    <div class="stat-card">
        <span>Today's Prescriptions</span>
        <h3>
            {{ $prescriptions->where('prescription_date', today())->count() }}
        </h3>
    </div>

    <div class="stat-card">
        <span>This Month</span>
        <h3>
            {{ $prescriptions->filter(fn($p) => $p->prescription_date?->isCurrentMonth())->count() }}
        </h3>
    </div>
</div>

<div class="table-card">

    <input
        type="text"
        id="searchInput"
        class="search-box"
        placeholder="Search prescriptions..."
    >

    <table class="table" id="prescriptionTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Date</th>
                <th>Medicines</th>
                <th>Notes</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse($prescriptions as $prescription)
                <tr>
                    <td>#{{ $prescription->id }}</td>

                    <td>
                        <div class="patient-name">
                            {{ $prescription->patient->name ?? 'N/A' }}
                        </div>

                        <div class="small-code">
                            {{ $prescription->patient->patient_code ?? '' }}
                        </div>
                    </td>

                    <td>
                        <div class="patient-name">
                            Dr. {{ $prescription->doctor->name ?? 'N/A' }}
                        </div>

                        <div class="small-code">
                            {{ $prescription->doctor->specialization ?? '' }}
                        </div>
                    </td>

                    <td>
                        {{ $prescription->prescription_date?->format('d M Y') }}
                    </td>

                    <td>
                        {{ $prescription->prescriptionItems->count() }}
                        medicine(s)
                    </td>

                    <td>
                        {{ $prescription->notes
                            ? \Illuminate\Support\Str::limit($prescription->notes, 35)
                            : '—' }}
                    </td>

                    <td>
                        <div class="actions">

                            <a
                                href="{{ route('prescriptions.show', $prescription) }}"
                                class="action-btn view-btn"
                            >
                                View
                            </a>

                            <a
                                href="{{ route('prescriptions.edit', $prescription) }}"
                                class="action-btn edit-btn"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('prescriptions.destroy', $prescription) }}"
                                method="POST"
                                onsubmit="return confirm('Delete this prescription?')"
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
                    <td colspan="7" style="text-align:center; padding:35px;">
                        No prescriptions found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        const search = this.value.toLowerCase();

        document.querySelectorAll('#prescriptionTable tbody tr').forEach(row => {
            row.style.display =
                row.innerText.toLowerCase().includes(search)
                    ? ''
                    : 'none';
        });
    });
</script>

@endsection