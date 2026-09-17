<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\Prescription;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Statistics
        $totalPatients = Patient::count();

        $totalDoctors = Doctor::count();

        $totalAppointments = Appointment::count();

        $todayAppointments = Appointment::whereDate(
            'appointment_date',
            $today
        )->count();

        $totalMedicines = Medicine::count();

        $lowStockMedicines = Medicine::where(
            'quantity',
            '<=',
            10
        )->count();

        $totalPrescriptions = Prescription::count();

        $totalPayments = Payment::count();

        $totalPaidAmount = Payment::where(
            'status',
            'Paid'
        )->sum('amount');


        // Today's appointments
        $todayAppointmentList = Appointment::with([
            'patient',
            'doctor'
        ])
        ->whereDate('appointment_date', $today)
        ->orderBy('appointment_time')
        ->take(6)
        ->get();


        // Upcoming appointments
        $upcomingAppointments = Appointment::with([
            'patient',
            'doctor'
        ])
        ->whereDate('appointment_date', '>=', $today)
        ->orderBy('appointment_date')
        ->orderBy('appointment_time')
        ->take(6)
        ->get();


        // Recent payments
        $recentPayments = Payment::with('patient')
            ->latest('payment_date')
            ->latest()
            ->take(5)
            ->get();


        // Low stock medicines
        $lowStockList = Medicine::where(
            'quantity',
            '<=',
            10
        )
        ->orderBy('quantity')
        ->take(5)
        ->get();


        return view('dashboard', compact(
            'totalPatients',
            'totalDoctors',
            'totalAppointments',
            'todayAppointments',
            'totalMedicines',
            'lowStockMedicines',
            'totalPrescriptions',
            'totalPayments',
            'totalPaidAmount',
            'todayAppointmentList',
            'upcomingAppointments',
            'recentPayments',
            'lowStockList'
        ));
    }
}