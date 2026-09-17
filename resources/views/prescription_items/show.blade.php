@extends('layouts.app')

@section('title', 'Prescription Item')

@section('page-subtitle', 'Prescription Item Details')

@section('content')

<div class="page-header">

<div>
    <div class="page-title">
        Prescription Item
    </div>

    <div class="page-description">
        View prescription medicine details.
    </div>
</div>

<a
    href="{{ route('prescription-items.index') }}"
    class="btn-back"
>
    ← Back
</a>

</div>

@if (session('success'))

<div class="success-alert">
    ✓ {{ session('success') }}
</div>

@endif

<div class="detail-card">

<div class="detail-header">

    <div class="medicine-icon">
        💊
    </div>

    <div>

        <div class="medicine-name">
            {{ $prescriptionItem->medicine->name ?? 'Unknown Medicine' }}
        </div>

        <div class="item-number">
            Prescription Item #{{ $prescriptionItem->id }}
        </div>

    </div>

</div>


<div class="detail-grid">

    <div class="detail-box">

        <span class="label">
            Patient
        </span>

        <strong>
            {{ $prescriptionItem->prescription->patient->name ?? 'Unknown' }}
        </strong>

    </div>


    <div class="detail-box">

        <span class="label">
            Doctor
        </span>

        <strong>
            Dr. {{ $prescriptionItem->prescription->doctor->name ?? 'Unknown' }}
        </strong>

    </div>


    <div class="detail-box">

        <span class="label">
            Medicine
        </span>

        <strong>
            {{ $prescriptionItem->medicine->name ?? 'Unknown' }}
        </strong>

    </div>


    <div class="detail-box">

        <span class="label">
            Quantity
        </span>

        <strong>
            {{ $prescriptionItem->quantity }}
        </strong>

    </div>


    <div class="detail-box">

        <span class="label">
            Dosage
        </span>

        <strong>
            {{ $prescriptionItem->dosage ?? '-' }}
        </strong>

    </div>


    <div class="detail-box">

        <span class="label">
            Instruction
        </span>

        <strong>
            {{ $prescriptionItem->instruction ?? '-' }}
        </strong>

    </div>

</div>


<div class="actions">

    <a
        href="{{ route('prescription-items.edit', $prescriptionItem->id) }}"
        class="btn-edit"
    >
        Edit
    </a>

    <form
        action="{{ route('prescription-items.destroy', $prescriptionItem->id) }}"
        method="POST"
        onsubmit="return confirm('Are you sure you want to delete this item?');"
    >

        @csrf
        @method('DELETE')

        <button type="submit" class="btn-delete">
            Delete
        </button>

    </form>

</div>

</div>

<style>

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
    }

    .page-title {
        font-size: 28px;
        font-weight: 600;
        color: #1e293b;
    }

    .page-description {
        color: #94a3b8;
        font-size: 14px;
        margin-top: 5px;
    }

    .btn-back {
        text-decoration: none;
        color: #475569;
        background: white;
        border: 1px solid #e2e8f0;
        padding: 10px 17px;
        border-radius: 9px;
        font-size: 13px;
    }

    .success-alert {
        background: #ecfdf5;
        color: #047857;
        border: 1px solid #a7f3d0;
        border-radius: 10px;
        padding: 13px 16px;
        margin-bottom: 20px;
        font-size: 13px;
    }

    .detail-card {
        background: white;
        border-radius: 16px;
        border: 1px solid #eef0f4;
        box-shadow: 0 4px 20px rgba(15, 23, 42, .05);
        padding: 30px;
        max-width: 900px;
    }

    .detail-header {
        display: flex;
        align-items: center;
        gap: 15px;
        padding-bottom: 25px;
        border-bottom: 1px solid #f1f5f9;
        margin-bottom: 25px;
    }

    .medicine-icon {
        width: 55px;
        height: 55px;
        border-radius: 13px;
        background: #eff6ff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
    }

    .medicine-name {
        font-size: 19px;
        font-weight: 600;
        color: #1e293b;
    }

    .item-number {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 3px;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .detail-box {
        background: #f8fafc;
        border-radius: 10px;
        padding: 16px;
    }

    .label {
        display: block;
        color: #94a3b8;
        font-size: 11px;
        margin-bottom: 5px;
    }

    .detail-box strong {
        color: #334155;
        font-size: 13px;
    }

    .actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 28px;
        padding-top: 20px;
        border-top: 1px solid #f1f5f9;
    }

    .btn-edit,
    .btn-delete {
        padding: 10px 17px;
        border-radius: 9px;
        font-size: 13px;
        text-decoration: none;
        cursor: pointer;
    }

    .btn-edit {
        background: #eff6ff;
        color: #2563eb;
        border: none;
    }

    .btn-delete {
        background: #fef2f2;
        color: #dc2626;
        border: none;
    }

    @media (max-width: 700px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }
    }

</style>

@endsection
