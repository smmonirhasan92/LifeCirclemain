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

        $enrollmentData = $validated_data;
        $enrollmentData['whatsapp_number'] = $validated_data['whatsapp'];
        unset($enrollmentData['whatsapp']);

        // Standardize WhatsApp Number (Add 88 prefix if needed)
        $wa_number = preg_replace('/[^0-9]/', '', $enrollmentData['whatsapp_number']);
        if (strlen($wa_number) === 11 && str_starts_with($wa_number, '01')) {
            $wa_number = '88' . $wa_number;
        }
        $enrollmentData['whatsapp_number'] = $wa_number;

        try {
            // Humanized Logic: Save lead to database before redirection
            $enrollment = Enrollment::create($enrollmentData);

            // Professional WhatsApp Redirection Logic
            $mam_number = '8801716437859';
            $message_body = "আসসালামু আলাইকুম শারমিন মুজাহিদ ম্যাম,\n\n" .
                            "আমি নতুন রিলেশনাল ওয়েলনেস সেশনের জন্য আবেদন করেছি। আমার তথ্যাবলি নিচে দেয়া হলো:\n\n" .
                            "• নাম: {$enrollment->full_name}\n" .
                            "• সার্ভিস: {$enrollment->service_type}\n" .
                            "• ট্রানজেকশন আইডি: {$enrollment->transaction_id}\n" .
                            "• ফোন: {$enrollment->whatsapp_number}\n";
            
            if ($enrollment->message) {
                $message_body .= "• বার্তা: {$enrollment->message}\n";
            }

            $message_body .= "\nদয়া করে আমার সেশনটি নিশ্চিত করুন। ধন্যবাদ।";

            $whatsapp_url = "https://wa.me/{$mam_number}?text=" . urlencode($message_body);

            return redirect()->away($whatsapp_url);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'দুঃখিত, কোনো একটি সমস্যা হয়েছে। দয়া করে আবার চেষ্টা করুন।']);
        }
    }

    /**
     * Display all enrollments for Admin.
     */
    public function index()
    {
        $enrollments = Enrollment::latest()->paginate(15);
        
        $stats = (object)[
            'total' => Enrollment::count(),
            'pending' => Enrollment::where('status', 'pending')->count(),
            'contacted' => Enrollment::where('status', 'contacted')->count(),
            'enrolled' => Enrollment::where('status', 'enrolled')->count(),
            'completed' => Enrollment::where('status', 'completed')->count(),
        ];

        return view('admin.list', compact('enrollments', 'stats'));
    }

    /**
     * Update the status of an enrollment via Admin Panel.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,contacted,enrolled,completed',
            'payment_amount' => 'nullable|numeric',
        ]);

        $enrollment = Enrollment::findOrFail($id);
        $enrollment->status = $request->status;
        
        if ($request->has('payment_amount')) {
            $enrollment->payment_amount = $request->payment_amount;
        }
        
        // Handle checkbox: if present, it's true, else false.
        $enrollment->is_paid = $request->has('is_paid') ? true : false;
        
        $enrollment->save();

        return redirect()->back()->with('success', 'Enrollment details updated successfully.');
    }
}
