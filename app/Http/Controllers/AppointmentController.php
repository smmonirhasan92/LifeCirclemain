<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\App;

class AppointmentController extends Controller
{
    /**
     * Display the appointment booking form.
     */
    public function create()
    {
        return view('appointment');
    }

    /**
     * Store a new appointment and redirect to WhatsApp.
     */
    public function store(Request $request)
    {
        App::setLocale('bn');

        $validated_data = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'whatsapp' => 'required|string|max:20',
            'service_type' => 'required|string',
            'transaction_id' => 'required|string|max:100',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'nullable|string',
            'message' => 'nullable|string',
        ]);

        $appointmentData = $validated_data;
        $appointmentData['whatsapp_number'] = $validated_data['whatsapp'];
        unset($appointmentData['whatsapp']);

        // Standardize WhatsApp Number
        $wa_number = preg_replace('/[^0-9]/', '', $appointmentData['whatsapp_number']);
        if (strlen($wa_number) === 11 && str_starts_with($wa_number, '01')) {
            $wa_number = '88' . $wa_number;
        }
        $appointmentData['whatsapp_number'] = $wa_number;

        try {
            $appointment = Appointment::create($appointmentData);

            // WhatsApp Redirection Logic for Appointment
            $mam_number = '8801716437859';
            $message_body = "আসসালামু আলাইকুম শারমিন মুজাহিদ ম্যাম,\n\n" .
                            "আমি একটি নতুন সেশনের অ্যাপয়েন্টমেন্ট বুক করেছি।\n\n" .
                            "• নাম: {$appointment->full_name}\n" .
                            "• তারিখ: {$appointment->appointment_date}\n" .
                            "• সময়: " . ($appointment->appointment_time ?? 'আলোচনা সাপেক্ষে') . "\n" .
                            "• সার্ভিস: {$appointment->service_type}\n" .
                            "• ট্রানজেকশন আইডি: {$appointment->transaction_id}\n" .
                            "• ফোন: {$appointment->whatsapp_number}\n";

            if ($appointment->message) {
                $message_body .= "• বার্তা: {$appointment->message}\n";
            }

            $message_body .= "\nদয়া করে আমার অ্যাপয়েন্টমেন্টটি নিশ্চিত করুন। ধন্যবাদ।";

            $whatsapp_url = "https://wa.me/{$mam_number}?text=" . urlencode($message_body);

            return redirect()->away($whatsapp_url);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'দুঃখিত, কোনো একটি সমস্যা হয়েছে। দয়া করে আবার চেষ্টা করুন।']);
        }
    }

    /**
     * Admin view for all appointments.
     */
    public function index()
    {
        $appointments = Appointment::latest()->paginate(15);
        $total_count = Appointment::count();
        $pending_count = Appointment::where('status', 'pending')->count();
        $confirmed_count = Appointment::where('status', 'confirmed')->count();

        return view('admin.appointments', compact('appointments', 'total_count', 'pending_count', 'confirmed_count'));
    }

    /**
     * Update appointment status.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'payment_amount' => 'nullable|numeric',
        ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->status = $request->status;
        
        if ($request->has('payment_amount')) {
            $appointment->payment_amount = $request->payment_amount;
        }
        
        // Handle checkbox: if present, it's true, else false.
        $appointment->is_paid = $request->has('is_paid') ? true : false;
        
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment details updated successfully.');
    }
}
