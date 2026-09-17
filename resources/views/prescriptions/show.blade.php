@extends('layouts.app')

@section('title', 'Prescription Details')
@section('page-subtitle', 'Prescription Details')

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

    .header-info h2 {
        margin: 0;
        font-size: 26px;
        font-weight: 700;
        color: #1f2937;
    }

    .header-info p {
        margin: 6px 0 0;
        color: #6b7280;
    }

    .header-actions {
        display: flex;
        gap: 9px;
        flex-wrap: wrap;
    }

    .btn {
        padding: 10px 16px;
        border-radius: 9px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-weight: 600;
        font-size: 14px;
    }

    .btn-primary {
        background: #2563eb;
        color: white;
    }

    .btn-primary:hover {
        background: #1d4ed8;
        color: white;
    }

    .btn-secondary {
        background: #e5e7eb;
        color: #374151;
    }

    .btn-secondary:hover {
        background: #d1d5db;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-bottom: 22px;
    }

    .info-card {
        background: white;
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 3px 15px rgba(0,0,0,.06);
    }

    .info-label {
        color: #64748b;
        font-size: 13px;
        margin-bottom: 7px;
    }

    .info-value {
        font-size: 17px;
        font-weight: 700;
        color: #1f2937;
    }

    .info-small {
        color: #64748b;
        font-size: 13px;
        margin-top: 4px;
    }

    .content-card {
        background: white;
        border-radius: 14px;
        padding: 22px;
        box-shadow: 0 3px 15px rgba(0,0,0,.06);
        margin-bottom: 22px;
    }

    .card-title {
        font-size: 18px;
        font-weight: 700;
        color: #1f2937;
        margin: 0 0 18px;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .medicine-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 700px;
    }

    .medicine-table th {
        background: #f8fafc;
        color: #475569;
        font-size: 13px;
        padding: 13px;
        text-align: left;
    }

    .medicine-table td {
        padding: 14px 13px;
        border-top: 1px solid #eef2f7;
    }

    .medicine-name {
        font-weight: 700;
        color: #1f2937;
    }

    .medicine-code {
        font-size: 12px;
        color: #64748b;
        margin-top: 3px;
    }

    .quantity-badge {
        display: inline-block;
        background: #eff6ff;
        color: #2563eb;
        padding: 5px 10px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 13px;
    }

    .notes-box {
        background: #f8fafc;
        border-radius: 10px;
        padding: 16px;
        color: #475569;
        line-height: 1.6;
        white-space: pre-line;
    }

    .danger-zone {
        background: white;
        border: 1px solid #fecaca;
        border-radius: 14px;
        padding: 20px;
        margin-top: 22px;
    }

    .danger-zone h3 {
        color: #dc2626;
        margin: 0 0 6px;
        font-size: 17px;
    }

    .danger-zone p {
        color: #64748b;
        margin: 0 0 15px;
        font-size: 14px;
    }

    .delete-btn {
        background: #dc2626;
        color: white;
        border: none;
        padding: 10px 16px;
        border-radius: 9px;
        cursor: pointer;
        font-weight: 600;
    }

    .delete-btn:hover {
        background: #b91c1c;
    }

    .alert-success {
        background: #dcfce7;
        color: #166534;
        padding: 13px 16px;
        border-radius: 9px;
        margin-bottom: 20px;
    }

    .empty-medicines {
        text-align: center;
        padding: 30px;
        color: #64748b;
    }

    @media(max-width: 850px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="page-header">

    <div class="header-info">
        <h2>Prescription #{{ $prescription->id }}</h2>

        <p>
            Prescription issued on
            {{ $prescription->prescription_date?->format('d M Y') }}
        </p>
    </div>

    <div class="header-actions">

        <a
            href="{{ route('prescriptions.index') }}"
            class="btn btn-secondary"
        >
            ← Back
        </a>

        <a
            href="{{ route('prescriptions.edit', $prescription) }}"
            class="btn btn-primary"
        >
            Edit Prescription
        </a>

    </div>

</div>

@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Prescription Information -->

<div class="info-grid">

    <div class="info-card">
        <div class="info-label">
            Patient
        </div>

        <div class="info-value">
            {{ $prescription->patient->name ?? 'N/A' }}
        </div>

        @if($prescription->patient)
            <div class="info-small">
                {{ $prescription->patient->patient_code }}
            </div>
        @endif
    </div>

    <div class="info-card">
        <div class="info-label">
            Doctor
        </div>

        <div class="info-value">
            Dr. {{ $prescription->doctor->name ?? 'N/A' }}
        </div>

        @if($prescription->doctor)
            <div class="info-small">
                {{ $prescription->doctor->specialization }}
            </div>
        @endif
    </div>

    <div class="info-card">
        <div class="info-label">
            Prescription Date
        </div>

        <div class="info-value">
            {{ $prescription->prescription_date?->format('d M Y') }}
        </div>

        <div class="info-small">
            {{ $prescription->prescriptionItems->count() }}
            medicine(s)
        </div>
    </div>

</div>

<!-- Medicine List -->

<div class="content-card">

    <h3 class="card-title">
        Prescribed Medicines
    </h3>

    @if($prescription->prescriptionItems->count())

        <div class="table-wrapper">

            <table class="medicine-table">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Medicine</th>
                        <th>Quantity</th>
                        <th>Dosage</th>
                        <th>Instruction</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($prescription->prescriptionItems as $item)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <div class="medicine-name">
                                    {{ $item->medicine->name ?? 'N/A' }}
                                </div>

                                @if($item->medicine)
                                    <div class="medicine-code">
                                        {{ $item->medicine->medicine_code }}
                                    </div>
                                @endif
                            </td>

                            <td>
                                <span class="quantity-badge">
                                    {{ $item->quantity }}
                                </span>
                            </td>

                            <td>
                                {{ $item->dosage ?: '—' }}
                            </td>

                            <td>
                                {{ $item->instruction ?: '—' }}
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @else

        <div class="empty-medicines">
            No medicines have been added to this prescription.
        </div>

    @endif

</div>

<!-- Notes -->

@if($prescription->notes)

    <div class="content-card">

        <h3 class="card-title">
            Notes
        </h3>

        <div class="notes-box">
            {{ $prescription->notes }}
        </div>

    </div>

@endif

<!-- Danger Zone -->

<div class="danger-zone">

    <h3>Delete Prescription</h3>

    <p>
        Deleting this prescription will also remove all of its medicine items.
        This action cannot be undone.
    </p>

    <form
        action="{{ route('prescriptions.destroy', $prescription) }}"
        method="POST"
        onsubmit="return confirm('Are you sure you want to delete this prescription?')"
    >
        @csrf
        @method('DELETE')

        <button
            type="submit"
            class="delete-btn"
        >
            Delete Prescription
        </button>
    </form>

</div>

@endsection