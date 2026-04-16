<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Enrollment;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        // Extraordinary Reports Dashboard
        $totalRevenue = Appointment::where('is_paid', true)->sum('payment_amount') + 
                        Enrollment::where('is_paid', true)->sum('payment_amount');
        
        $totalSessions = Appointment::where('status', 'completed')->count();
        $totalEnrollments = Enrollment::count();
        $activeClients = Appointment::select('whatsapp_number')->distinct()->count();

        // Recent successful payments
        $recentPayments = Appointment::where('is_paid', true)
                            ->orderBy('updated_at', 'desc')
                            ->take(5)
                            ->get();

        return view('admin.reports', compact(
            'totalRevenue', 'totalSessions', 'totalEnrollments', 'activeClients', 'recentPayments'
        ));
    }

    public function clients()
    {
        // Group appointments by whatsapp_number to find unique clients
        // and count their completed sessions
        $clients = Appointment::select('full_name', 'email', 'whatsapp_number', 
            DB::raw('COUNT(id) as total_appointments'),
            DB::raw('SUM(CASE WHEN status = "completed" THEN 1 ELSE 0 END) as completed_sessions'),
            DB::raw('MAX(appointment_date) as last_appointment')
        )
        ->groupBy('whatsapp_number', 'email', 'full_name') // Grouping by all selected non-aggregate columns
        ->orderBy('last_appointment', 'desc')
        ->get();

        return view('admin.clients', compact('clients'));
    }
}
