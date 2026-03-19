<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;

class DonationVerificationController extends Controller
{
    public function verify($receipt_number)
    {
        $donation = Donation::with('campaign')->where('receipt_number', $receipt_number)->first();
        
        if (!$donation) {
            return view('donation-verification.invalid', [
                'receipt_number' => $receipt_number
            ]);
        }
        
        return view('donation-verification.show', compact('donation'));
    }
}
