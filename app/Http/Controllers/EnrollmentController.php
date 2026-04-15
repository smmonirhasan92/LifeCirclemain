<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Enrollment;
use Illuminate\Support\Facades\App;

class EnrollmentController extends Controller
{
    /**
     * Display the enrollment form.
     */
    public function create()
    {
        return view('enroll');
    }

    /**
     * Store a new enrollment and redirect to WhatsApp.
     */
    public function store(Request $request)
    {
        // Set locale to Bengali for humanized validation messages
        App::setLocale('bn');

        $validated_data = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'whatsapp' => 'required|string|max:20',
            'service_type' => 'required|string',
            'transaction_id' => 'required|string|max:100',
            'message' => 'nullable|string',
        ]);

        // Humanized Logic: Save lead to database before redirection
        $enrollment = Enrollment::create($validated_data);

        // Professional WhatsApp Redirection Logic
        $mam_number = '8801716437859';
        $message_body = "আসসালামু আলাইকুম শারমিন মুজাহিদ ম্যাম,\n\n" .
                        "আমি নতুন রিলেশনাল ওয়েলনেস সেশনের জন্য আবেদন করেছি। আমার তথ্যাবলি নিচে দেয়া হলো:\n\n" .
                        "• নাম: {$enrollment->full_name}\n" .
                        "• সার্ভিস: {$enrollment->service_type}\n" .
                        "• ট্রানজেকশন আইডি: {$enrollment->transaction_id}\n" .
                        "• ফোন: {$enrollment->whatsapp}\n";
        
        if ($enrollment->message) {
            $message_body .= "• বার্তা: {$enrollment->message}\n";
        }

        $message_body .= "\nদয়া করে আমার সেশনটি নিশ্চিত করুন। ধন্যবাদ।";

        $whatsapp_url = "https://wa.me/{$mam_number}?text=" . urlencode($message_body);

        return redirect()->away($whatsapp_url);
    }

    /**
     * Display all enrollments for Admin.
     */
    public function index()
    {
        $enrollments = Enrollment::latest()->get();
        return view('admin.list', compact('enrollments'));
    }
}
