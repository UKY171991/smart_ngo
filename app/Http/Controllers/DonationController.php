<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DonationController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::where('is_active', true)->get();
        return view('donations.index', compact('campaigns'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'required|email',
            'amount' => 'required|numeric|min:1',
            'campaign_id' => 'nullable|exists:campaigns,id',
            'payment_method' => 'required|in:online,cash,custom',
        ]);

        $donation = Donation::create([
            'user_id' => auth()->id(),
            'campaign_id' => $request->campaign_id,
            'donor_name' => $request->donor_name,
            'donor_email' => $request->donor_email,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'receipt_number' => 'REC-' . strtoupper(Str::random(12)),
            'status' => $request->payment_method === 'online' ? 'pending' : 'completed',
        ]);

        if ($request->campaign_id) {
            $campaign = Campaign::find($request->campaign_id);
            if ($donation->status === 'completed') {
                $campaign->increment('current_amount', $donation->amount);
            }
        }

        if ($request->payment_method === 'online') {
            // Redirect to payment gateway selection
            return redirect()->route('donations.payment', $donation->id);
        }

        return redirect()->route('home')->with('success', 'Thank you for your donation! A receipt has been sent to your email.');
    }

    public function showPayment($id)
    {
        $donation = Donation::findOrFail($id);
        return view('donations.payment', compact('donation'));
    }

    public function downloadReceipt($id)
    {
        $donation = Donation::with('campaign')->findOrFail($id);
        $qrData = url('/verify/donation/' . $donation->receipt_number);
        $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->format('svg')->generate($qrData);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdfs.donation-receipt', compact('donation', 'qrCode'));
        
        return $pdf->stream('RECEIPT-' . $donation->receipt_number . '.pdf');
    }
}
