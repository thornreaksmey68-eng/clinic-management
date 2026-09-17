@extends('layouts.app')

@section('title', 'Payment Details')
@section('page-subtitle', 'Payment Details')

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
        font-size: 18px;
        font-weight: 700;
        color: #1f2937;
    }

    .amount-value {
        font-size: 26px;
        font-weight: 800;
        color: #2563eb;
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

    .details-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .detail-item {
        padding: 14px;
        background: #f8fafc;
        border-radius: 10px;
    }

    .detail-label {
        font-size: 12px;
        color: #64748b;
        margin-bottom: 5px;
    }

    .detail-value {
        font-size: 15px;
        font-weight: 600;
        color: #1f2937;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 11px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }

    .status-paid {
        background: #dcfce7;
        color: #166534;
    }

    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-cancelled {
        background: #fee2e2;
        color: #991b1b;
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

    @media(max-width: 850px) {
        .info-grid,
        .details-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="page-header">

```
<div class="header-info">

    <h2>
        Payment #{{ $payment->id }}
    </h2>

    <p>
        {{ $payment->payment_code }}
        ·
        {{ $payment->payment_date?->format('d M Y') }}
    </p>

</div>

<div class="header-actions">

    <a
        href="{{ route('payments.index') }}"
        class="btn btn-secondary"
    >
        ← Back
    </a>

    <a
        href="{{ route('payments.edit', $payment) }}"
        class="btn btn-primary"
    >
        Edit Payment
    </a>

</div>
```

</div>

@if(session('success'))

```
<div class="alert-success">
    {{ session('success') }}
</div>
```

@endif

<div class="info-grid">

```
<div class="info-card">

    <div class="info-label">
        Payment Code
    </div>

    <div class="info-value">
        {{ $payment->payment_code }}
    </div>

</div>

<div class="info-card">

    <div class="info-label">
        Amount
    </div>

    <div class="amount-value">
        ${{ number_format((float) $payment->amount, 2) }}
    </div>

</div>

<div class="info-card">

    <div class="info-label">
        Status
    </div>

    <div class="info-value">

        @if($payment->status === 'Paid')

            <span class="status-badge status-paid">
                Paid
            </span>

        @elseif($payment->status === 'Pending')

            <span class="status-badge status-pending">
                Pending
            </span>

        @else

            <span class="status-badge status-cancelled">
                Cancelled
            </span>

        @endif

    </div>

</div>

</div>

<div class="content-card">

```
<h3 class="card-title">
    Payment Information
</h3>

<div class="details-grid">

    <div class="detail-item">

        <div class="detail-label">
            Patient
        </div>

        <div class="detail-value">
            {{ $payment->patient->name ?? 'N/A' }}
        </div>

        @if($payment->patient)

            <div class="info-small">
                {{ $payment->patient->patient_code }}
            </div>

        @endif

    </div>

    <div class="detail-item">

        <div class="detail-label">
            Payment Method
        </div>

        <div class="detail-value">
            {{ $payment->payment_method }}
        </div>

    </div>

    <div class="detail-item">

        <div class="detail-label">
            Payment Date
        </div>

        <div class="detail-value">
            {{ $payment->payment_date?->format('d M Y') }}
        </div>

    </div>

    <div class="detail-item">

        <div class="detail-label">
            Appointment
        </div>

        @if($payment->appointment)

            <div class="detail-value">
                Appointment #{{ $payment->appointment->id }}
            </div>

            <div class="info-small">

                {{ $payment->appointment->appointment_date?->format('d M Y') }}

                @if($payment->appointment->doctor)
                    · Dr. {{ $payment->appointment->doctor->name }}
                @endif

            </div>

        @else

            <div class="detail-value">
                No Appointment
            </div>

        @endif

    </div>

</div>
```

</div>

@if($payment->notes)

```
<div class="content-card">

    <h3 class="card-title">
        Notes
    </h3>

    <div class="notes-box">
        {{ $payment->notes }}
    </div>

</div>
```

@endif

<div class="danger-zone">

```
<h3>
    Delete Payment
</h3>

<p>
    Deleting this payment cannot be undone.
</p>

<form
    action="{{ route('payments.destroy', $payment) }}"
    method="POST"
    onsubmit="return confirm('Are you sure you want to delete this payment?')"
>

    @csrf
    @method('DELETE')

    <button
        type="submit"
        class="delete-btn"
    >
        Delete Payment
    </button>

</form>

</div>

@endsection
