<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::latest()->paginate(10);
        return view('admin.certificates.index', compact('certificates'));
    }

    public function create()
    {
        $users = \App\Models\User::where('status', 'active')->get();
        return view('admin.certificates.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'recipient_name' => 'required|string|max:255',
            'recipient_email' => 'required|email',
            'type' => 'required|in:membership,achievement,internship,visitor',
            'template_id' => 'required|string',
            'metadata' => 'nullable|string',
        ]);

        $certificate = Certificate::create([
            'user_id' => $request->user_id,
            'recipient_name' => $validated['recipient_name'],
            'recipient_email' => $validated['recipient_email'],
            'type' => $validated['type'],
            'certificate_number' => 'CERT-' . strtoupper(\Illuminate\Support\Str::random(10)),
            'template_id' => $validated['template_id'],
            'metadata' => ['description' => $validated['metadata']],
        ]);

        try {
            $this->sendEmailLogic($certificate);
            return redirect()->route('admin.certificates.index')->with('success', 'Certificate generated and emailed successfully to ' . $certificate->recipient_email);
        } catch (\Exception $e) {
            \Log::error('Mail Error: ' . $e->getMessage());
            return redirect()->route('admin.certificates.index')->with('success', 'Certificate saved! However, the email could not be sent. Please check your Mail Setup. Error: ' . $e->getMessage());
        }
    }

    private function sendEmailLogic(Certificate $certificate)
    {
        // Generate PDF
        $qrData = url('/verify/certificate/' . $certificate->certificate_number);
        $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->format('svg')->generate($qrData);
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.certificates.templates.' . $certificate->template_id, compact('certificate', 'qrCode'))
                ->setPaper('a4', 'landscape');
        
        $pdfContent = $pdf->output();
        $fileName = $certificate->certificate_number . '.pdf';
        
        // Send email
        \Illuminate\Support\Facades\Mail::to($certificate->recipient_email)->send(
            new \App\Mail\CertificateMail($certificate, $pdfContent, $fileName)
        );
    }

    public function sendEmail(Certificate $certificate)
    {
        try {
            $this->sendEmailLogic($certificate);
            return redirect()->route('admin.certificates.index')->with('success', 'Certificate emailed successfully to ' . $certificate->recipient_email);
        } catch (\Exception $e) {
            return redirect()->route('admin.certificates.index')->with('error', 'Failed to send email: ' . $e->getMessage());
        }
    }

    public function show(Certificate $certificate)
    {
        $qrData = url('/verify/certificate/' . $certificate->certificate_number);
        $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->format('svg')->generate($qrData);
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.certificates.templates.' . $certificate->template_id, compact('certificate', 'qrCode'))
                ->setPaper('a4', 'landscape');
        
        return $pdf->stream($certificate->certificate_number . '.pdf');
    }

    public function edit(Certificate $certificate)
    {
        return redirect()->route('admin.certificates.index')->with('error', 'Certificates cannot be edited once issued.');
    }

    public function update(Request $request, Certificate $certificate)
    {
        return redirect()->route('admin.certificates.index');
    }

    public function destroy(Certificate $certificate)
    {
        $certificate->delete();
        return redirect()->route('admin.certificates.index')->with('success', 'Certificate record deleted.');
    }
}
