@extends('layouts.app')

@section('title', 'Payments')
@section('page-subtitle', 'Payment Management')

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
        color: #1f2937;
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
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 25px;
    }

    .stat-card {
        background: white;
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, .06);
    }

    .stat-card span {
        color: #6b7280;
        font-size: 14px;
    }

    .stat-card h3 {
        margin: 7px 0 0;
        font-size: 25px;
        color: #1f2937;
    }

    .table-card {
        background: white;
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, .06);
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
        box-sizing: border-box;
    }

    .search-box:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 2px rgba(37, 99, 235, .08);
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1050px;
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
        color: #1f2937;
    }

    .small-text {
        font-size: 12px;
        color: #64748b;
        margin-top: 3px;
    }

    .payment-code {
        font-weight: 600;
        color: #2563eb;
    }

    .amount {
        font-weight: 700;
        color: #1f2937;
    }

    .status-badge {
        display: inline-block;
        padding: 5px 10px;
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

    .method-badge {
        display: inline-block;
        background: #f1f5f9;
        color: #475569;
        padding: 5px 9px;
        border-radius: 7px;
        font-size: 12px;
        font-weight: 600;
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

    .view-btn:hover {
        background: #dbeafe;
    }

    .edit-btn {
        background: #fef3c7;
        color: #b45309;
    }

    .edit-btn:hover {
        background: #fde68a;
    }

    .delete-btn {
        background: #fee2e2;
        color: #dc2626;
        border: none;
        cursor: pointer;
    }

    .delete-btn:hover {
        background: #fecaca;
    }

    .alert-success {
        background: #dcfce7;
        color: #166534;
        padding: 13px 16px;
        border-radius: 9px;
        margin-bottom: 20px;
    }

    .empty-row {
        text-align: center;
        padding: 35px !important;
        color: #64748b;
    }

    @media(max-width: 1000px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media(max-width: 600px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="page-header">

    <div class="page-title">
        <h2>Payments</h2>
        <p>Manage patient payments and transactions</p>
    </div>

    <a
        href="{{ route('payments.create') }}"
        class="btn-primary-custom"
    >
        + New Payment
    </a>

</div>

@if(session('success'))

    <div class="alert-success">
        {{ session('success') }}
    </div>

@endif

@php
    $totalAmount = $payments->sum(fn($payment) => (float) $payment->amount);

    $paidPayments = $payments->where('status', 'Paid');

    $pendingPayments = $payments->where('status', 'Pending');

    $cancelledPayments = $payments->where('status', 'Cancelled');
@endphp

<div class="stats-grid">

    <div class="stat-card">
        <span>Total Payments</span>

        <h3>
            {{ $payments->count() }}
        </h3>
    </div>

    <div class="stat-card">
        <span>Total Amount</span>

        <h3>
            ${{ number_format($totalAmount, 2) }}
        </h3>
    </div>

    <div class="stat-card">
        <span>Paid</span>

        <h3>
            {{ $paidPayments->count() }}
        </h3>
    </div>

    <div class="stat-card">
        <span>Pending</span>

        <h3>
            {{ $pendingPayments->count() }}
        </h3>
    </div>

</div>

<div class="table-card">

    <input
        type="text"
        id="searchInput"
        class="search-box"
        placeholder="Search payments..."
    >

    <table
        class="table"
        id="paymentTable"
    >

        <thead>

            <tr>
                <th>ID</th>
                <th>Payment Code</th>
                <th>Patient</th>
                <th>Appointment</th>
                <th>Amount</th>
                <th>Method</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>

        </thead>

        <tbody>

            @forelse($payments as $payment)

                <tr>

                    <td>
                        #{{ $payment->id }}
                    </td>

                    <td>
                        <div class="payment-code">
                            {{ $payment->payment_code }}
                        </div>
                    </td>

                    <td>

                        <div class="patient-name">
                            {{ $payment->patient->name ?? 'N/A' }}
                        </div>

                        @if($payment->patient)

                            <div class="small-text">
                                {{ $payment->patient->patient_code }}
                            </div>

                        @endif

                    </td>

                    <td>

                        @if($payment->appointment)

                            <div class="patient-name">
                                Appointment #{{ $payment->appointment->id }}
                            </div>

                            <div class="small-text">

                                {{ $payment->appointment->appointment_date?->format('d M Y') }}

                                @if($payment->appointment->doctor)
                                    · Dr. {{ $payment->appointment->doctor->name }}
                                @endif

                            </div>

                        @else

                            <span class="small-text">
                                No appointment
                            </span>

                        @endif

                    </td>

                    <td>

                        <span class="amount">
                            ${{ number_format((float) $payment->amount, 2) }}
                        </span>

                    </td>

                    <td>

                        <span class="method-badge">
                            {{ $payment->payment_method }}
                        </span>

                    </td>

                    <td>
                        {{ $payment->payment_date?->format('d M Y') }}
                    </td>

                    <td>

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

                    </td>

                    <td>

                        <div class="actions">

                            <a
                                href="{{ route('payments.show', $payment) }}"
                                class="action-btn view-btn"
                            >
                                View
                            </a>

                            <a
                                href="{{ route('payments.edit', $payment) }}"
                                class="action-btn edit-btn"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('payments.destroy', $payment) }}"
                                method="POST"
                                onsubmit="return confirm('Delete this payment?')"
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
                    <td
                        colspan="9"
                        class="empty-row"
                    >
                        No payments found.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>

<script>
    document
        .getElementById('searchInput')
        .addEventListener('keyup', function () {

            const search = this.value.toLowerCase();

            document
                .querySelectorAll('#paymentTable tbody tr')
                .forEach(row => {

                    row.style.display =
                        row.innerText
                            .toLowerCase()
                            .includes(search)
                            ? ''
                            : 'none';

                });

        });
</script>

@endsection