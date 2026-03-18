<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DashboardController extends Controller
{
    public function idCard()
    {
        $user = auth()->user();
        $qrData = url('/verify/member/' . $user->id);
        $qrCode = QrCode::size(120)->format('svg')->generate($qrData);
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('member.pdfs.id-card', compact('user', 'qrCode'))
                ->setPaper('a4', 'portrait');
        
        return $pdf->stream('ID-CARD-' . $user->id . '.pdf');
    }

    public function membershipReceipt()
    {
        $user = auth()->user();
        $qrData = url('/verify/receipt/membership/' . $user->id);
        $qrCode = QrCode::size(100)->format('svg')->generate($qrData);
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('member.pdfs.receipt', compact('user', 'qrCode'));
        
        return $pdf->stream('RECEIPT-' . $user->id . '.pdf');
    }

    public function appointmentLetter()
    {
        $user = auth()->user();
        $qrData = url('/verify/appointment/' . $user->id);
        $qrCode = QrCode::size(100)->format('svg')->generate($qrData);
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('member.pdfs.appointment', compact('user', 'qrCode'));
        
        return $pdf->stream('APPOINTMENT-LETTER-' . $user->id . '.pdf');
    }

    public function index()
    {
        $user = auth()->user()->load('designation');
        
        // Donation Stats
        $donations = \App\Models\Donation::where('user_id', $user->id)
            ->where('status', 'completed')
            ->latest()
            ->get();
            
        $total_donated = $donations->sum('amount');
        
        // Referral Stats
        $referral_members = \App\Models\User::where('referred_by_id', $user->id)->get();
        $referral_donations = \App\Models\Donation::whereIn('user_id', $referral_members->pluck('id'))
            ->where('status', 'completed')
            ->sum('amount');
        
        // Birthday Wish logic
        $is_birthday = false;
        if ($user->date_of_birth) {
            $dob = \Carbon\Carbon::parse($user->date_of_birth);
            if ($dob->isBirthday()) {
                $is_birthday = true;
            }
        }
        
        return view('member.dashboard', compact(
            'user', 
            'donations', 
            'total_donated', 
            'referral_members', 
            'referral_donations',
            'is_birthday'
        ));
    }

    public function enquiries()
    {
        $enquiries = \App\Models\Enquiry::where('user_id', auth()->id())->latest()->get();
        return view('member.enquiries', compact('enquiries'));
    }

    public function postEnquiry(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        \App\Models\Enquiry::create([
            'user_id' => auth()->id(),
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Your enquiry has been submitted. We will reply soon!');
    }
}
