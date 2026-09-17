@extends('layouts.app')

@section('title', 'Add Prescription Item')

@section('page-subtitle', 'Add Prescription Item')

@section('content')

<div class="page-header">
    <div>
        <div class="page-title">Add Prescription Item</div>
        <div class="page-description">
            Add a medicine to a patient's prescription.
        </div>
    </div>

<a href="{{ route('prescription-items.index') }}" class="btn-back">
    ← Back
</a>


</div>

<div class="form-card">

<form action="{{ route('prescription-items.store') }}" method="POST">

    @csrf

    <div class="form-grid">

        {{-- Prescription --}}
        <div class="form-group full">
            <label>Prescription</label>

            <select name="prescription_id" required>

                <option value="">Select Prescription</option>

                @foreach ($prescriptions as $prescription)

                    <option
                        value="{{ $prescription->id }}"
                        {{ old('prescription_id') == $prescription->id ? 'selected' : '' }}
                    >
                        #{{ $prescription->id }}
                        -
                        {{ $prescription->patient->name ?? 'Unknown Patient' }}
                        -
                        Dr. {{ $prescription->doctor->name ?? 'Unknown Doctor' }}
                    </option>

                @endforeach

            </select>

            @error('prescription_id')
                <small class="error">{{ $message }}</small>
            @enderror
        </div>


        {{-- Medicine --}}
        <div class="form-group full">
            <label>Medicine</label>

            <select name="medicine_id" required>

                <option value="">Select Medicine</option>

                @foreach ($medicines as $medicine)

                    <option
                        value="{{ $medicine->id }}"
                        {{ old('medicine_id') == $medicine->id ? 'selected' : '' }}
                    >
                        {{ $medicine->name }}
                        @if ($medicine->medicine_code)
                            ({{ $medicine->medicine_code }})
                        @endif
                    </option>

                @endforeach

            </select>

            @error('medicine_id')
                <small class="error">{{ $message }}</small>
            @enderror
        </div>


        {{-- Quantity --}}
        <div class="form-group">
            <label>Quantity</label>

            <input
                type="number"
                name="quantity"
                value="{{ old('quantity', 1) }}"
                min="1"
                required
            >

            @error('quantity')
                <small class="error">{{ $message }}</small>
            @enderror
        </div>


        {{-- Dosage --}}
        <div class="form-group">
            <label>Dosage</label>

            <input
                type="text"
                name="dosage"
                value="{{ old('dosage') }}"
                placeholder="e.g. 1 tablet"
            >

            @error('dosage')
                <small class="error">{{ $message }}</small>
            @enderror
        </div>


        {{-- Instruction --}}
        <div class="form-group full">
            <label>Instruction</label>

            <input
                type="text"
                name="instruction"
                value="{{ old('instruction') }}"
                placeholder="e.g. Take after meals"
            >

            @error('instruction')
                <small class="error">{{ $message }}</small>
            @enderror
        </div>

    </div>


    <div class="form-actions">

        <a
            href="{{ route('prescription-items.index') }}"
            class="btn-cancel"
        >
            Cancel
        </a>

        <button type="submit" class="btn-save">
            Save Prescription Item
        </button>

    </div>

</form>

</div>

<style>

    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
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

    .form-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        border: 1px solid #eef0f4;
        box-shadow: 0 4px 20px rgba(15, 23, 42, .05);
        max-width: 850px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 22px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    label {
        font-size: 13px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 8px;
    }

    input,
    select {
        height: 44px;
        border: 1px solid #e2e8f0;
        border-radius: 9px;
        padding: 0 13px;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        outline: none;
        background: white;
    }

    input:focus,
    select:focus {
        border-color: #93c5fd;
    }

    .error {
        color: #dc2626;
        font-size: 11px;
        margin-top: 5px;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 30px;
        padding-top: 22px;
        border-top: 1px solid #f1f5f9;
    }

    .btn-cancel,
    .btn-save {
        padding: 11px 18px;
        border-radius: 9px;
        font-size: 13px;
        font-family: 'Poppins', sans-serif;
        text-decoration: none;
        cursor: pointer;
    }

    .btn-cancel {
        color: #475569;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
    }

    .btn-save {
        border: none;
        background: #2563eb;
        color: white;
    }

    .btn-save:hover {
        background: #1d4ed8;
    }

    @media (max-width: 700px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full {
            grid-column: auto;
        }
    }

</style>

@endsection
