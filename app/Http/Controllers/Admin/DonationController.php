<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Donation;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::with(['user', 'campaign'])->latest()->paginate(10);
        return view('admin.donations.index', compact('donations'));
    }

    public function create()
    {
        $users = \App\Models\User::all();
        $campaigns = \App\Models\Campaign::all();
        return view('admin.donations.create', compact('users', 'campaigns'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'required|email',
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|in:cash,bank,upi,online',
            'campaign_id' => 'nullable|exists:campaigns,id',
        ]);

        $donation = Donation::create([
            'user_id' => $request->user_id, // Member selection
            'campaign_id' => $request->campaign_id,
            'donor_name' => $request->donor_name,
            'donor_email' => $request->donor_email,
            'donor_phone' => $request->donor_phone,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'receipt_number' => 'ADM-' . strtoupper(\Illuminate\Support\Str::random(10)),
            'is_80G' => $request->has('is_80G'),
            'status' => 'completed', // Admin manually entering is usually completed
        ]);

        if ($request->campaign_id) {
            $campaign = \App\Models\Campaign::find($request->campaign_id);
            $campaign->increment('current_amount', $donation->amount);
        }

        return redirect()->route('admin.donations.index')->with('success', 'Donation record added!');
    }

    public function downloadReceipt($id)
    {
        $donation = Donation::with('campaign')->findOrFail($id);
        $qrData = url('/verify/donation/' . $donation->receipt_number);
        $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->format('svg')->generate($qrData);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdfs.donation-receipt', compact('donation', 'qrCode'));
        
        return $pdf->stream('RECEIPT-' . $donation->receipt_number . '.pdf');
    }

    public function destroy(Donation $donation)
    {
        $donation->delete();
        return redirect()->route('admin.donations.index')->with('success', 'Donation record deleted.');
    }
}
