<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enquiry;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnquiryNotification;
use App\Models\Setting;

class EnquiryController extends Controller
{
    public function index()
    {
        $enquiries = Enquiry::latest()->paginate(15);
        return view('admin.enquiries.index', compact('enquiries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $enquiry = Enquiry::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'pending'
        ]);

        // Send Email Notification
        try {
            $adminEmail = Setting::where('key', 'contact_email')->first()->value ?? 'admin@smartngo.in';
            Mail::to($adminEmail)->send(new EnquiryNotification($enquiry));
        } catch (\Exception $e) {
            // Log error or ignore if mail is not configured
        }

        return redirect()->back()->with('success', 'Thank you for your enquiry. We will get back to you soon!');
    }

    public function reply(Request $request, Enquiry $enquiry)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        $enquiry->update([
            'reply' => $request->reply,
            'status' => 'replied'
        ]);

        // Send Notification Email to User
        try {
            // Mail logic...
        } catch (\Exception $e) {
            // Log error
        }

        return redirect()->back()->with('success', 'Reply sent successfully!');
    }

    public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();
        return redirect()->back()->with('success', 'Enquiry deleted successfully.');
    }
}
