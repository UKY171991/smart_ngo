<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;

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
            'metadata' => 'nullable|string', // JSON string from frontend or just a text field
        ]);

        $certificate = Certificate::create([
            'user_id' => $request->user_id, // nullable
            'recipient_name' => $validated['recipient_name'],
            'recipient_email' => $validated['recipient_email'],
            'type' => $validated['type'],
            'certificate_number' => 'CERT-' . strtoupper(\Illuminate\Support\Str::random(10)),
            'template_id' => $validated['template_id'],
            'metadata' => ['description' => $validated['metadata']],
        ]);

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate generated and saved successfully. Email dispatch can be triggered from the list.');
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
