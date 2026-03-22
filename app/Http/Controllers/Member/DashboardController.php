<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function idCard()
    {
        $user = auth()->user()->load('designation');
        $qrData = url('/verify/member/' . $user->id);
        $qrCode = QrCode::size(120)->format('svg')->generate($qrData);
        $siteSettings = \App\Models\Setting::pluck('value', 'setting_key')->toArray();
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('member.pdfs.id-card', compact('user', 'qrCode', 'siteSettings'))
                ->setPaper('a4', 'portrait');
        
        return $pdf->stream('ID-CARD-' . $user->id . '.pdf');
    }

    public function membershipReceipt()
    {
        $user = auth()->user()->load('designation');
        $qrData = url('/verify/receipt/membership/' . $user->id);
        $qrCode = QrCode::size(100)->format('svg')->generate($qrData);
        $siteSettings = \App\Models\Setting::pluck('value', 'setting_key')->toArray();
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('member.pdfs.receipt', compact('user', 'qrCode', 'siteSettings'));
        
        return $pdf->stream('RECEIPT-' . $user->id . '.pdf');
    }

    public function appointmentLetter()
    {
        $user = auth()->user()->load('designation');
        $qrData = url('/verify/appointment/' . $user->id);
        $qrCode = QrCode::size(100)->format('svg')->generate($qrData);
        $siteSettings = \App\Models\Setting::pluck('value', 'setting_key')->toArray();
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('member.pdfs.appointment', compact('user', 'qrCode', 'siteSettings'));
        
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

    public function referrals()
    {
        $referrals = \App\Models\User::where('referred_by_id', auth()->id())->latest()->get();
        return view('member.referrals', compact('referrals'));
    }

    public function certificates()
    {
        $certificates = \App\Models\Certificate::where('user_id', auth()->id())
            ->orWhere('recipient_email', auth()->user()->email)
            ->latest()->get();
        return view('member.certificates.index', compact('certificates'));
    }

    public function downloadCertificate(\App\Models\Certificate $certificate)
    {
        // Security Check: Only the owner (by ID or Email) can view their certificate
        if ($certificate->user_id !== auth()->id() && $certificate->recipient_email !== auth()->user()->email) {
            abort(403);
        }

        $qrData = url('/verify/certificate/' . $certificate->certificate_number);
        $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->format('svg')->generate($qrData);
        $siteSettings = \App\Models\Setting::pluck('value', 'setting_key')->toArray();
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.certificates.templates.' . $certificate->template_id, compact('certificate', 'qrCode', 'siteSettings'))
                ->setPaper('a4', 'landscape');
        
        return $pdf->stream($certificate->certificate_number . '.pdf');
    }

    public function profile()
    {
        $user = auth()->user();
        return view('member.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'date_of_birth' => 'nullable|date|before:today',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();
        
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];

        // Handle date of birth
        if ($request->filled('date_of_birth')) {
            $updateData['date_of_birth'] = $request->date_of_birth;
        }

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar) {
                // Same logic as Admin Profile
                if (Storage::disk('public')->exists($user->getAttributes()['avatar'] ?? '')) {
                    Storage::disk('public')->delete($user->getAttributes()['avatar']);
                }
            }
            
            // Upload new avatar
            $path = $request->file('avatar')->store('avatars', 'public');
            $updateData['avatar'] = $path;
        }

        $user->update($updateData);

        return back()->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match our records.']);
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Password updated successfully!');
    }
}
