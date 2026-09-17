blade
@extends('layouts.app')

@section('title', 'Medicine Details')

@section('page-subtitle', 'Medicine Management')

@section('content')

<style>
    .details-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .details-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .medicine-icon {
        width: 58px;
        height: 58px;
        border-radius: 14px;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
    }

    .details-header h2 {
        margin: 0;
        font-size: 25px;
        color: #111827;
        font-weight: 700;
    }

    .details-header p {
        margin: 5px 0 0;
        color: #6b7280;
        font-size: 13px;
    }

    .header-actions {
        display: flex;
        gap: 9px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 16px;
        border-radius: 9px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-back {
        background: #f3f4f6;
        color: #374151;
    }

    .btn-back:hover {
        background: #e5e7eb;
    }

    .btn-edit {
        background: #2563eb;
        color: #fff;
    }

    .btn-edit:hover {
        background: #1d4ed8;
    }

    .main-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        margin-bottom: 20px;
    }

    .card-header {
        padding: 18px 22px;
        border-bottom: 1px solid #e5e7eb;
        font-size: 16px;
        font-weight: 700;
        color: #111827;
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
        color: #9ca3af;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .info-value {
        color: #111827;
        font-size: 15px;
        font-weight: 600;
    }

    .code {
        font-family: monospace;
        color: #6b7280;
        font-weight: 500;
    }

    .category {
        display: inline-block;
        background: #eff6ff;
        color: #2563eb;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .stock-normal {
        color: #16a34a;
    }

    .stock-low {
        color: #d97706;
    }

    .stock-empty {
        color: #dc2626;
    }

    .expiry-normal {
        color: #374151;
    }

    .expiry-warning {
        color: #d97706;
    }

    .expiry-expired {
        color: #dc2626;
    }

    .description {
        padding: 22px;
        color: #4b5563;
        font-size: 14px;
        line-height: 1.7;
        white-space: pre-line;
    }

    .empty-text {
        color: #9ca3af;
        font-weight: 400;
    }

    .danger-zone {
        background: #fff;
        border: 1px solid #fecaca;
        border-radius: 14px;
        padding: 20px 22px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .danger-zone h3 {
        margin: 0 0 5px;
        color: #991b1b;
        font-size: 15px;
    }

    .danger-zone p {
        margin: 0;
        color: #7f1d1d;
        font-size: 13px;
    }

    .btn-delete {
        background: #dc2626;
        color: #fff;
        white-space: nowrap;
    }

    .btn-delete:hover {
        background: #b91c1c;
    }

    @media (max-width: 700px) {
        .info-grid {
            grid-template-columns: 1fr;
        }

        .info-item:nth-child(odd) {
            border-right: none;
        }

        .details-header {
            align-items: flex-start;
        }

        .header-actions {
            width: 100%;
        }

        .header-actions .btn {
            flex: 1;
        }

        .danger-zone {
            flex-direction: column;
            align-items: flex-start;
        }

        .danger-zone .btn {
            width: 100%;
        }
    }
</style>

@php
    if ($medicine->quantity == 0) {
        $stockClass = 'stock-empty';
        $stockText = 'Out of Stock';
    } elseif ($medicine->quantity <= 10) {
        $stockClass = 'stock-low';
        $stockText = 'Low Stock';
    } else {
        $stockClass = 'stock-normal';
        $stockText = 'In Stock';
    }

    $expiryClass = 'expiry-normal';
    $expiryText = 'No expiry date';

    if ($medicine->expiry_date) {
        if ($medicine->expiry_date->isPast()) {
            $expiryClass = 'expiry-expired';
            $expiryText = 'Expired';
        } elseif ($medicine->expiry_date->diffInDays(now()) <= 30) {
            $expiryClass = 'expiry-warning';
            $expiryText = 'Expires soon';
        } else {
            $expiryText = 'Valid';
        }
    }
@endphp

<div class="details-container">

    {{-- Header --}}
    <div class="details-header">

        <div class="header-left">

            <div class="medicine-icon">
                💊
            </div>

            <div>
                <h2>{{ $medicine->name }}</h2>

                <p>
                    {{ $medicine->medicine_code }}
                </p>
            </div>

        </div>

        <div class="header-actions">

            <a
                href="{{ route('medicines.index') }}"
                class="btn btn-back"
            >
                ← Back
            </a>

            <a
                href="{{ route('medicines.edit', $medicine) }}"
                class="btn btn-edit"
            >
                Edit Medicine
            </a>

        </div>

    </div>

    {{-- Medicine Information --}}
    <div class="main-card">

        <div class="card-header">
            Medicine Information
        </div>

        <div class="info-grid">

            {{-- Code --}}
            <div class="info-item">
                <div class="info-label">Medicine Code</div>
                <div class="info-value code">
                    {{ $medicine->medicine_code }}
                </div>
            </div>

            {{-- Name --}}
            <div class="info-item">
                <div class="info-label">Medicine Name</div>
                <div class="info-value">
                    {{ $medicine->name }}
                </div>
            </div>

            {{-- Category --}}
            <div class="info-item">
                <div class="info-label">Category</div>
                <div class="info-value">
                    @if($medicine->category)
                        <span class="category">
                            {{ $medicine->category }}
                        </span>
                    @else
                        <span class="empty-text">Not specified</span>
                    @endif
                </div>
            </div>

            {{-- Unit --}}
            <div class="info-item">
                <div class="info-label">Unit</div>
                <div class="info-value">
                    {{ $medicine->unit }}
                </div>
            </div>

            {{-- Quantity --}}
            <div class="info-item">
                <div class="info-label">Current Stock</div>
                <div class="info-value {{ $stockClass }}">
                    {{ number_format($medicine->quantity) }}
                    {{ $medicine->unit }}

                    <span style="font-size:12px; font-weight:500;">
                        — {{ $stockText }}
                    </span>
                </div>
            </div>

            {{-- Price --}}
            <div class="info-item">
                <div class="info-label">Price</div>
                <div class="info-value">
                    ${{ number_format((float) $medicine->price, 2) }}
                </div>
            </div>

            {{-- Expiry --}}
            <div class="info-item">
                <div class="info-label">Expiry Date</div>

                <div class="info-value {{ $expiryClass }}">

                    @if($medicine->expiry_date)
                        {{ $medicine->expiry_date->format('d M Y') }}

                        <span style="font-size:12px; font-weight:500;">
                            — {{ $expiryText }}
                        </span>
                    @else
                        <span class="empty-text">
                            No expiry date
                        </span>
                    @endif

                </div>
            </div>

            {{-- Created --}}
            <div class="info-item">
                <div class="info-label">Created</div>
                <div class="info-value">
                    {{ $medicine->created_at?->format('d M Y, h:i A') ?? '—' }}
                </div>
            </div>

        </div>

    </div>

    {{-- Description --}}
    <div class="main-card">

        <div class="card-header">
            Description
        </div>

        <div class="description">

            @if($medicine->description)
                {{ $medicine->description }}
            @else
                <span class="empty-text">
                    No description provided.
                </span>
            @endif

        </div>

    </div>

    {{-- Delete --}}
    <div class="danger-zone">

        <div>
            <h3>Delete Medicine</h3>
            <p>
                Deleting this medicine will permanently remove it from the system.
            </p>
        </div>

        <form
            action="{{ route('medicines.destroy', $medicine) }}"
            method="POST"
            onsubmit="return confirm('Are you sure you want to delete this medicine?');"
        >
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-delete">
                Delete Medicine
            </button>
        </form>

    </div>

</div>

@endsection

