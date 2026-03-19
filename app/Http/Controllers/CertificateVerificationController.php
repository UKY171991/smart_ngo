<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateVerificationController extends Controller
{
    public function verify($certificate_number)
    {
        $certificate = Certificate::where('certificate_number', $certificate_number)->first();
        
        if (!$certificate) {
            return view('certificate-verification.invalid', [
                'certificate_number' => $certificate_number
            ]);
        }
        
        return view('certificate-verification.show', compact('certificate'));
    }
}
