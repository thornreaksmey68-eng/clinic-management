blade
@extends('layouts.app')

@section('title', 'Add Medicine')

@section('page-subtitle', 'Medicine Management')

@section('content')

<style>
    .form-container {
        max-width: 950px;
        margin: 0 auto;
    }

    .form-header {
        margin-bottom: 25px;
    }

    .form-header h2 {
        margin: 0;
        font-size: 26px;
        font-weight: 700;
        color: #1f2937;
    }

    .form-header p {
        margin: 6px 0 0;
        color: #6b7280;
        font-size: 14px;
    }

    .form-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 28px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .section-title {
        font-size: 17px;
        font-weight: 700;
        color: #111827;
        margin: 0 0 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid #e5e7eb;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
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
        color: #374151;
        margin-bottom: 7px;
    }

    .required {
        color: #dc2626;
    }

    input,
    select,
    textarea {
        width: 100%;
        box-sizing: border-box;
        padding: 11px 13px;
        border: 1px solid #d1d5db;
        border-radius: 9px;
        outline: none;
        font-size: 14px;
        color: #111827;
        background: #fff;
        transition: 0.2s;
        font-family: inherit;
    }

    textarea {
        min-height: 120px;
        resize: vertical;
    }

    input:focus,
    select:focus,
    textarea:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .input-error {
        border-color: #dc2626;
    }

    .error-message {
        margin-top: 6px;
        color: #dc2626;
        font-size: 12px;
    }

    .hint {
        margin-top: 5px;
        color: #9ca3af;
        font-size: 12px;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 28px;
        padding-top: 22px;
        border-top: 1px solid #e5e7eb;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 11px 18px;
        border-radius: 9px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        border: none;
        transition: 0.2s;
    }

    .btn-cancel {
        background: #f3f4f6;
        color: #374151;
    }

    .btn-cancel:hover {
        background: #e5e7eb;
    }

    .btn-save {
        background: #2563eb;
        color: #fff;
    }

    .btn-save:hover {
        background: #1d4ed8;
    }

    .alert-errors {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #991b1b;
        border-radius: 10px;
        padding: 14px 16px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .alert-errors ul {
        margin: 8px 0 0 18px;
        padding: 0;
    }

    @media (max-width: 700px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full {
            grid-column: auto;
        }

        .form-card {
            padding: 20px;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .btn {
            width: 100%;
        }
    }
</style>

<div class="form-container">

    <div class="form-header">
        <h2>Add Medicine</h2>
        <p>Add a new medicine to your clinic inventory.</p>
    </div>

    @if($errors->any())
        <div class="alert-errors">
            <strong>Please fix the following errors:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-card">

        <h3 class="section-title">Medicine Information</h3>

        <form action="{{ route('medicines.store') }}" method="POST">
            @csrf

            <div class="form-grid">

                {{-- Medicine Code --}}
                <div class="form-group">
                    <label for="medicine_code">
                        Medicine Code <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="medicine_code"
                        name="medicine_code"
                        value="{{ old('medicine_code') }}"
                        placeholder="e.g. MED-001"
                        class="{{ $errors->has('medicine_code') ? 'input-error' : '' }}"
                        required
                    >

                    @error('medicine_code')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Medicine Name --}}
                <div class="form-group">
                    <label for="name">
                        Medicine Name <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="e.g. Paracetamol"
                        class="{{ $errors->has('name') ? 'input-error' : '' }}"
                        required
                    >

                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Category --}}
                <div class="form-group">
                    <label for="category">Category</label>

                    <input
                        type="text"
                        id="category"
                        name="category"
                        value="{{ old('category') }}"
                        placeholder="e.g. Painkiller"
                    >

                    @error('category')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Unit --}}
                <div class="form-group">
                    <label for="unit">
                        Unit <span class="required">*</span>
                    </label>

                    <select
                        id="unit"
                        name="unit"
                        class="{{ $errors->has('unit') ? 'input-error' : '' }}"
                        required
                    >
                        <option value="Tablet" {{ old('unit', 'Tablet') == 'Tablet' ? 'selected' : '' }}>
                            Tablet
                        </option>
                        <option value="Capsule" {{ old('unit') == 'Capsule' ? 'selected' : '' }}>
                            Capsule
                        </option>
                        <option value="Bottle" {{ old('unit') == 'Bottle' ? 'selected' : '' }}>
                            Bottle
                        </option>
                        <option value="Box" {{ old('unit') == 'Box' ? 'selected' : '' }}>
                            Box
                        </option>
                        <option value="Tube" {{ old('unit') == 'Tube' ? 'selected' : '' }}>
                            Tube
                        </option>
                        <option value="Sachet" {{ old('unit') == 'Sachet' ? 'selected' : '' }}>
                            Sachet
                        </option>
                        <option value="Vial" {{ old('unit') == 'Vial' ? 'selected' : '' }}>
                            Vial
                        </option>
                    </select>

                    @error('unit')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Quantity --}}
                <div class="form-group">
                    <label for="quantity">
                        Quantity <span class="required">*</span>
                    </label>

                    <input
                        type="number"
                        id="quantity"
                        name="quantity"
                        value="{{ old('quantity', 0) }}"
                        min="0"
                        placeholder="0"
                        class="{{ $errors->has('quantity') ? 'input-error' : '' }}"
                        required
                    >

                    @error('quantity')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Price --}}
                <div class="form-group">
                    <label for="price">
                        Price <span class="required">*</span>
                    </label>

                    <input
                        type="number"
                        id="price"
                        name="price"
                        value="{{ old('price', '0.00') }}"
                        min="0"
                        step="0.01"
                        placeholder="0.00"
                        class="{{ $errors->has('price') ? 'input-error' : '' }}"
                        required
                    >

                    <div class="hint">Price per selected unit.</div>

                    @error('price')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Expiry Date --}}
                <div class="form-group">
                    <label for="expiry_date">Expiry Date</label>

                    <input
                        type="date"
                        id="expiry_date"
                        name="expiry_date"
                        value="{{ old('expiry_date') }}"
                        class="{{ $errors->has('expiry_date') ? 'input-error' : '' }}"
                    >

                    @error('expiry_date')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="form-group full">
                    <label for="description">Description</label>

                    <textarea
                        id="description"
                        name="description"
                        placeholder="Enter medicine description or additional information..."
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="form-actions">
                <a href="{{ route('medicines.index') }}" class="btn btn-cancel">
                    Cancel
                </a>

                <button type="submit" class="btn btn-save">
                    Save Medicine
                </button>
            </div>

        </form>

    </div>

</div>

@endsection

