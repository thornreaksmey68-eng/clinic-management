@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-subtitle', 'Clinic Overview')

@section('content')

<style>
    .dashboard {
        width: 100%;
    }

    /* =========================
       HEADER
    ========================= */

    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
    }

    .dashboard-title {
        font-size: 28px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 6px;
    }

    .dashboard-description {
        font-size: 14px;
        color: #64748b;
    }

    .dashboard-date {
        display: flex;
        align-items: center;
        gap: 8px;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 11px 16px;
        font-size: 13px;
        font-weight: 500;
        color: #475569;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.04);
    }

    /* =========================
       STATISTICS
    ========================= */

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 24px;
    }

    .stat-card {
        position: relative;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 20px;
        overflow: hidden;
        transition: all 0.2s ease;
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.08);
    }

    .stat-card::after {
        content: "";
        position: absolute;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        right: -35px;
        top: -35px;
        opacity: 0.5;
    }

    .stat-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .stat-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
    }

    .stat-label {
        font-size: 12px;
        color: #64748b;
        margin-bottom: 7px;
    }

    .stat-number {
        font-size: 27px;
        font-weight: 700;
        color: #0f172a;
    }

    .stat-footer {
        margin-top: 15px;
        font-size: 11px;
        color: #94a3b8;
    }

    .blue {
        background: #eff6ff;
    }

    .green {
        background: #ecfdf5;
    }

    .purple {
        background: #f5f3ff;
    }

    .orange {
        background: #fff7ed;
    }

    .pink {
        background: #fdf2f8;
    }

    .cyan {
        background: #ecfeff;
    }

    .yellow {
        background: #fefce8;
    }

    .red {
        background: #fef2f2;
    }

    /* =========================
       MAIN GRID
    ========================= */

    .dashboard-grid {
        display: grid;
        grid-template-columns: 1.65fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    .dashboard-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
    }

    .card-header {
        padding: 19px 21px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-title-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-title-icon {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        background: #eff6ff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    .card-title {
        font-size: 14px;
        font-weight: 700;
        color: #1e293b;
    }

    .card-subtitle {
        font-size: 11px;
        color: #94a3b8;
        margin-top: 2px;
    }

    .card-link {
        color: #2563eb;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
    }

    .card-link:hover {
        text-decoration: underline;
    }

    .card-body {
        padding: 6px 21px 15px;
    }

    /* =========================
       APPOINTMENTS
    ========================= */

    .appointment-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .appointment-item:last-child {
        border-bottom: none;
    }

    .appointment-info {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .patient-avatar {
        width: 42px;
        height: 42px;
        min-width: 42px;
        border-radius: 11px;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 700;
    }

    .patient-name {
        font-size: 13px;
        font-weight: 600;
        color: #334155;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 180px;
    }

    .doctor-name {
        font-size: 11px;
        color: #94a3b8;
        margin-top: 3px;
    }

    .appointment-right {
        text-align: right;
        flex-shrink: 0;
    }

    .appointment-date {
        font-size: 11px;
        color: #64748b;
    }

    .appointment-time {
        font-size: 12px;
        font-weight: 600;
        color: #334155;
        margin-top: 2px;
    }

    .status {
        display: inline-block;
        margin-top: 5px;
        padding: 4px 9px;
        border-radius: 20px;
        font-size: 9px;
        font-weight: 700;
    }

    .status-pending {
        background: #fff7ed;
        color: #ea580c;
    }

    .status-confirmed {
        background: #ecfdf5;
        color: #059669;
    }

    .status-completed {
        background: #eff6ff;
        color: #2563eb;
    }

    .status-cancelled {
        background: #fef2f2;
        color: #dc2626;
    }

    /* =========================
       QUICK ACTIONS
    ========================= */

    .quick-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .quick-action {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 13px;
        border: 1px solid #e2e8f0;
        border-radius: 11px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .quick-action:hover {
        background: #f8fafc;
        border-color: #bfdbfe;
        transform: translateY(-1px);
    }

    .quick-icon {
        width: 36px;
        height: 36px;
        min-width: 36px;
        border-radius: 9px;
        background: #eff6ff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    .quick-title {
        font-size: 11px;
        font-weight: 700;
        color: #334155;
    }

    .quick-description {
        font-size: 9px;
        color: #94a3b8;
        margin-top: 2px;
    }

    /* =========================
       PAYMENT
    ========================= */

    .payment-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 13px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .payment-item:last-child {
        border-bottom: none;
    }

    .payment-left {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .payment-icon {
        width: 36px;
        height: 36px;
        border-radius: 9px;
        background: #ecfdf5;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
    }

    .payment-code {
        font-size: 11px;
        font-weight: 700;
        color: #334155;
    }

    .payment-patient {
        font-size: 10px;
        color: #94a3b8;
        margin-top: 2px;
    }

    .payment-amount {
        font-size: 12px;
        font-weight: 700;
        color: #0f172a;
        text-align: right;
    }

    .payment-status {
        font-size: 9px;
        color: #059669;
        margin-top: 2px;
        text-align: right;
    }

    /* =========================
       LOW STOCK
    ========================= */

    .medicine-item {
        padding: 13px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .medicine-item:last-child {
        border-bottom: none;
    }

    .medicine-top {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 7px;
    }

    .medicine-name {
        font-size: 11px;
        font-weight: 700;
        color: #334155;
    }

    .medicine-quantity {
        font-size: 10px;
        font-weight: 700;
        color: #dc2626;
    }

    .stock-bar {
        height: 5px;
        background: #f1f5f9;
        border-radius: 20px;
        overflow: hidden;
    }

    .stock-progress {
        height: 100%;
        border-radius: 20px;
        background: #ef4444;
    }

    .stock-warning {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-top: 9px;
        font-size: 10px;
        color: #ea580c;
    }

    /* =========================
       EMPTY
    ========================= */

    .empty-dashboard {
        text-align: center;
        padding: 35px 10px;
        color: #94a3b8;
        font-size: 12px;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 1200px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 900px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }

        .dashboard-header {
            align-items: flex-start;
            gap: 15px;
            flex-direction: column;
        }

        .quick-actions {
            grid-template-columns: 1fr;
        }

        .appointment-item {
            align-items: flex-start;
        }

        .patient-name {
            max-width: 130px;
        }
    }
</style>


<div class="dashboard">

    {{-- =========================
         HEADER
    ========================= --}}

    <div class="dashboard-header">

        <div>
            <div class="dashboard-title">
                Dashboard
            </div>

            <div class="dashboard-description">
                Good afternoon! Here's what's happening in your clinic today.
            </div>
        </div>

        <div class="dashboard-date">
            📅 {{ now()->format('d M Y') }}
        </div>

    </div>


    {{-- =========================
         STATISTICS
    ========================= --}}

    <div class="stats-grid">

        {{-- Patients --}}
        <div class="stat-card">

            <div class="stat-top">

                <div>
                    <div class="stat-label">
                        Total Patients
                    </div>

                    <div class="stat-number">
                        {{ $totalPatients }}
                    </div>
                </div>

                <div class="stat-icon blue">
                    👥
                </div>

            </div>

            <div class="stat-footer">
                Registered patients
            </div>

        </div>


        {{-- Doctors --}}
        <div class="stat-card">

            <div class="stat-top">

                <div>
                    <div class="stat-label">
                        Total Doctors
                    </div>

                    <div class="stat-number">
                        {{ $totalDoctors }}
                    </div>
                </div>

                <div class="stat-icon green">
                    👨‍⚕️
                </div>

            </div>

            <div class="stat-footer">
                Medical professionals
            </div>

        </div>


        {{-- Appointments --}}
        <div class="stat-card">

            <div class="stat-top">

                <div>
                    <div class="stat-label">
                        Today's Appointments
                    </div>

                    <div class="stat-number">
                        {{ $todayAppointments }}
                    </div>
                </div>

                <div class="stat-icon purple">
                    📅
                </div>

            </div>

            <div class="stat-footer">
                {{ $totalAppointments }} total appointments
            </div>

        </div>


        {{-- Medicines --}}
        <div class="stat-card">

            <div class="stat-top">

                <div>
                    <div class="stat-label">
                        Total Medicines
                    </div>

                    <div class="stat-number">
                        {{ $totalMedicines }}
                    </div>
                </div>

                <div class="stat-icon orange">
                    💊
                </div>

            </div>

            <div class="stat-footer">
                {{ $lowStockMedicines }} low-stock items
            </div>

        </div>


        {{-- Prescriptions --}}
        <div class="stat-card">

            <div class="stat-top">

                <div>
                    <div class="stat-label">
                        Prescriptions
                    </div>

                    <div class="stat-number">
                        {{ $totalPrescriptions }}
                    </div>
                </div>

                <div class="stat-icon pink">
                    📋
                </div>

            </div>

            <div class="stat-footer">
                Medical prescriptions
            </div>

        </div>


        {{-- Payments --}}
        <div class="stat-card">

            <div class="stat-top">

                <div>
                    <div class="stat-label">
                        Total Payments
                    </div>

                    <div class="stat-number">
                        {{ $totalPayments }}
                    </div>
                </div>

                <div class="stat-icon cyan">
                    💳
                </div>

            </div>

            <div class="stat-footer">
                Recorded transactions
            </div>

        </div>


        {{-- Paid Amount --}}
        <div class="stat-card">

            <div class="stat-top">

                <div>
                    <div class="stat-label">
                        Paid Revenue
                    </div>

                    <div class="stat-number">
                        ${{ number_format((float) $totalPaidAmount, 2) }}
                    </div>
                </div>

                <div class="stat-icon green">
                    💰
                </div>

            </div>

            <div class="stat-footer">
                Successfully paid
            </div>

        </div>


        {{-- Low Stock --}}
        <div class="stat-card">

            <div class="stat-top">

                <div>
                    <div class="stat-label">
                        Low Stock
                    </div>

                    <div class="stat-number">
                        {{ $lowStockMedicines }}
                    </div>
                </div>

                <div class="stat-icon red">
                    ⚠️
                </div>

            </div>

            <div class="stat-footer">
                Medicines below 10 units
            </div>

        </div>

    </div>


    {{-- =========================
         APPOINTMENTS + QUICK ACTIONS
    ========================= --}}

    <div class="dashboard-grid">

        {{-- TODAY / UPCOMING --}}
        <div class="dashboard-card">

            <div class="card-header">

                <div class="card-title-wrapper">

                    <div class="card-title-icon">
                        📅
                    </div>

                    <div>

                        <div class="card-title">
                            Today's Appointments
                        </div>

                        <div class="card-subtitle">
                            Scheduled appointments for today
                        </div>

                    </div>

                </div>

                <a
                    href="{{ route('appointments.index') }}"
                    class="card-link"
                >
                    View All →
                </a>

            </div>


            <div class="card-body">

                @forelse ($todayAppointmentList as $appointment)

                    @php
                        $status = strtolower(
                            $appointment->status ?? 'pending'
                        );

                        $statusClass = match ($status) {
                            'confirmed' => 'status-confirmed',
                            'completed' => 'status-completed',
                            'cancelled' => 'status-cancelled',
                            default => 'status-pending',
                        };
                    @endphp

                    <div class="appointment-item">

                        <div class="appointment-info">

                            <div class="patient-avatar">

                                {{ strtoupper(
                                    substr(
                                        $appointment->patient->name ?? 'P',
                                        0,
                                        1
                                    )
                                ) }}

                            </div>

                            <div>

                                <div class="patient-name">
                                    {{ $appointment->patient->name ?? 'Unknown Patient' }}
                                </div>

                                <div class="doctor-name">
                                    Dr. {{ $appointment->doctor->name ?? 'Unknown Doctor' }}
                                </div>

                            </div>

                        </div>


                        <div class="appointment-right">

                            <div class="appointment-time">
                                {{ \Carbon\Carbon::parse(
                                    $appointment->appointment_time
                                )->format('h:i A') }}
                            </div>

                            <span class="status {{ $statusClass }}">
                                {{ ucfirst($appointment->status ?? 'Pending') }}
                            </span>

                        </div>

                    </div>

                @empty

                    <div class="empty-dashboard">
                        📅 No appointments scheduled for today.
                    </div>

                @endforelse

            </div>

        </div>


        {{-- QUICK ACTIONS --}}
        <div class="dashboard-card">

            <div class="card-header">

                <div class="card-title-wrapper">

                    <div class="card-title-icon">
                        ⚡
                    </div>

                    <div>

                        <div class="card-title">
                            Quick Actions
                        </div>

                        <div class="card-subtitle">
                            Frequently used actions
                        </div>

                    </div>

                </div>

            </div>


            <div class="card-body">

                <div class="quick-actions">

                    <a
                        href="{{ route('patients.create') }}"
                        class="quick-action"
                    >

                        <div class="quick-icon">
                            👤
                        </div>

                        <div>

                            <div class="quick-title">
                                Add Patient
                            </div>

                            <div class="quick-description">
                                Register patient
                            </div>

                        </div>

                    </a>


                    <a
                        href="{{ route('doctors.create') }}"
                        class="quick-action"
                    >

                        <div class="quick-icon">
                            👨‍⚕️
                        </div>

                        <div>

                            <div class="quick-title">
                                Add Doctor
                            </div>

                            <div class="quick-description">
                                Register doctor
                            </div>

                        </div>

                    </a>


                    <a
                        href="{{ route('appointments.create') }}"
                        class="quick-action"
                    >

                        <div class="quick-icon">
                            📅
                        </div>

                        <div>

                            <div class="quick-title">
                                Appointment
                            </div>

                            <div class="quick-description">
                                Schedule visit
                            </div>

                        </div>

                    </a>


                    <a
                        href="{{ route('prescriptions.create') }}"
                        class="quick-action"
                    >

                        <div class="quick-icon">
                            📋
                        </div>

                        <div>

                            <div class="quick-title">
                                Prescription
                            </div>

                            <div class="quick-description">
                                Create prescription
                            </div>

                        </div>

                    </a>


                    <a
                        href="{{ route('medicines.create') }}"
                        class="quick-action"
                    >

                        <div class="quick-icon">
                            💊
                        </div>

                        <div>

                            <div class="quick-title">
                                Medicine
                            </div>

                            <div class="quick-description">
                                Add medicine
                            </div>

                        </div>

                    </a>


                    <a
                        href="{{ route('payments.create') }}"
                        class="quick-action"
                    >

                        <div class="quick-icon">
                            💰
                        </div>

                        <div>

                            <div class="quick-title">
                                Payment
                            </div>

                            <div class="quick-description">
                                Record payment
                            </div>

                        </div>

                    </a>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================
         UPCOMING + PAYMENTS
    ========================= --}}

    <div class="dashboard-grid">

        {{-- UPCOMING APPOINTMENTS --}}
        <div class="dashboard-card">

            <div class="card-header">

                <div class="card-title-wrapper">

                    <div class="card-title-icon">
                        🗓️
                    </div>

                    <div>

                        <div class="card-title">
                            Upcoming Appointments
                        </div>

                        <div class="card-subtitle">
                            Next scheduled patient visits
                        </div>

                    </div>

                </div>

                <a
                    href="{{ route('appointments.index') }}"
                    class="card-link"
                >
                    View All →
                </a>

            </div>


            <div class="card-body">

                @forelse ($upcomingAppointments as $appointment)

                    @php
                        $status = strtolower(
                            $appointment->status ?? 'pending'
                        );

                        $statusClass = match ($status) {
                            'confirmed' => 'status-confirmed',
                            'completed' => 'status-completed',
                            'cancelled' => 'status-cancelled',
                            default => 'status-pending',
                        };
                    @endphp

                    <div class="appointment-item">

                        <div class="appointment-info">

                            <div class="patient-avatar">
                                {{ strtoupper(
                                    substr(
                                        $appointment->patient->name ?? 'P',
                                        0,
                                        1
                                    )
                                ) }}
                            </div>

                            <div>

                                <div class="patient-name">
                                    {{ $appointment->patient->name ?? 'Unknown Patient' }}
                                </div>

                                <div class="doctor-name">
                                    Dr. {{ $appointment->doctor->name ?? 'Unknown Doctor' }}
                                </div>

                            </div>

                        </div>


                        <div class="appointment-right">

                            <div class="appointment-date">

                                {{ $appointment->appointment_date
                                    ? $appointment->appointment_date->format('d M Y')
                                    : 'No date'
                                }}

                            </div>

                            <div class="appointment-time">

                                {{ \Carbon\Carbon::parse(
                                    $appointment->appointment_time
                                )->format('h:i A') }}

                            </div>

                            <span class="status {{ $statusClass }}">
                                {{ ucfirst($appointment->status ?? 'Pending') }}
                            </span>

                        </div>

                    </div>

                @empty

                    <div class="empty-dashboard">
                        🗓️ No upcoming appointments.
                    </div>

                @endforelse

            </div>

        </div>


        {{-- RECENT PAYMENTS --}}
        <div class="dashboard-card">

            <div class="card-header">

                <div class="card-title-wrapper">

                    <div class="card-title-icon">
                        💳
                    </div>

                    <div>

                        <div class="card-title">
                            Recent Payments
                        </div>

                        <div class="card-subtitle">
                            Latest payment transactions
                        </div>

                    </div>

                </div>

                <a
                    href="{{ route('payments.index') }}"
                    class="card-link"
                >
                    View All →
                </a>

            </div>


            <div class="card-body">

                @forelse ($recentPayments as $payment)

                    <div class="payment-item">

                        <div class="payment-left">

                            <div class="payment-icon">
                                💰
                            </div>

                            <div>

                                <div class="payment-code">
                                    {{ $payment->payment_code }}
                                </div>

                                <div class="payment-patient">
                                    {{ $payment->patient->name ?? 'Unknown Patient' }}
                                </div>

                            </div>

                        </div>


                        <div>

                            <div class="payment-amount">
                                ${{ number_format((float) $payment->amount, 2) }}
                            </div>

                            <div class="payment-status">
                                {{ $payment->status }}
                            </div>

                        </div>

                    </div>

                @empty

                    <div class="empty-dashboard">
                        💳 No payments recorded yet.
                    </div>

                @endforelse

            </div>

        </div>

    </div>


    {{-- =========================
         LOW STOCK
    ========================= --}}

    <div class="dashboard-card">

        <div class="card-header">

            <div class="card-title-wrapper">

                <div class="card-title-icon">
                    ⚠️
                </div>

                <div>

                    <div class="card-title">
                        Low Stock Medicines
                    </div>

                    <div class="card-subtitle">
                        Medicines that may need restocking
                    </div>

                </div>

            </div>

            <a
                href="{{ route('medicines.index') }}"
                class="card-link"
            >
                Manage Medicines →
            </a>

        </div>


        <div class="card-body">

            @forelse ($lowStockList as $medicine)

                @php
                    $stockPercent = min(
                        100,
                        max(
                            5,
                            ($medicine->quantity / 10) * 100
                        )
                    );
                @endphp

                <div class="medicine-item">

                    <div class="medicine-top">

                        <div class="medicine-name">
                            💊 {{ $medicine->name }}
                        </div>

                        <div class="medicine-quantity">
                            {{ $medicine->quantity }}
                            {{ $medicine->unit }}
                        </div>

                    </div>

                    <div class="stock-bar">

                        <div
                            class="stock-progress"
                            style="width: {{ $stockPercent }}%;"
                        ></div>

                    </div>

                    <div class="stock-warning">
                        ⚠️ Low stock — consider restocking
                    </div>

                </div>

            @empty

                <div class="empty-dashboard">
                    ✅ All medicines have sufficient stock.
                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection