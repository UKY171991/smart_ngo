@extends('layouts.admin')

@section('page_title', 'Certificate Customization')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <form action="{{ route('admin.settings.certificate.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0 text-primary"><i class="fas fa-certificate me-2"></i> Design & Branding</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Certificate Tagline</label>
                            <input type="text" name="certificate_tagline" class="form-control" value="{{ $settings['certificate_tagline'] ?? 'Empowering Lives, Building Futures' }}" placeholder="e.g. Empowering Lives, Building Futures">
                            <div class="form-text">This will appear below the NGO name on most templates.</div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Border Color</label>
                            <div class="d-flex gap-2">
                                <input type="color" name="certificate_border_color" class="form-control form-control-color" value="{{ $settings['certificate_border_color'] ?? '#cc0000' }}" title="Choose border color">
                                <input type="text" class="form-control" value="{{ $settings['certificate_border_color'] ?? '#cc0000' }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">NGO Logo (for Certificate)</label>
                            <input type="file" name="certificate_logo" class="form-control">
                            @if(isset($settings['certificate_logo']))
                                <img src="{{ Storage::url($settings['certificate_logo']) }}" class="mt-2 rounded border" style="max-height: 50px;">
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0 text-primary"><i class="fas fa-signature me-2"></i> Signatures & Stamp</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Authorized Signature</label>
                            <input type="file" name="certificate_signature" class="form-control">
                            <div class="form-text">Transparent PNG recommended (Max 2MB)</div>
                            @if(isset($settings['certificate_signature']))
                                <img src="{{ Storage::url($settings['certificate_signature']) }}" class="mt-2 rounded border p-2 bg-light" style="max-height: 60px;">
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Official Stamp/Seal</label>
                            <input type="file" name="certificate_stamp" class="form-control">
                            <div class="form-text">Transparent PNG recommended (Max 2MB)</div>
                            @if(isset($settings['certificate_stamp']))
                                <img src="{{ Storage::url($settings['certificate_stamp']) }}" class="mt-2 rounded border p-2 bg-light" style="max-height: 60px;">
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Signature Title 1</label>
                            <input type="text" name="cert_sign_title_1" class="form-control" value="{{ $settings['cert_sign_title_1'] ?? 'President' }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Signature Title 2</label>
                            <input type="text" name="cert_sign_title_2" class="form-control" value="{{ $settings['cert_sign_title_2'] ?? 'Secretary' }}">
                        </div>
                    </div>
                </div>
            </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary btn-fancy px-5 py-3 fw-bold rounded-pill shadow-lg border-0">
                        <i class="fas fa-save me-2"></i> SAVE CERTIFICATE SETTINGS
                    </button>
                </div>
            </form>
        </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 position-sticky" style="top: 20px;">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0"><i class="fas fa-info-circle me-2"></i> Instructions</h5>
            </div>
            <div class="card-body">
                <ul class="small text-muted mb-0">
                    <li class="mb-2"><strong>Logo:</strong> Used at the top of the certificate. High resolution recommended.</li>
                    <li class="mb-2"><strong>Signatures:</strong> Use a transparent PNG (with background removed) for a professional look on the certificate.</li>
                    <li class="mb-2"><strong>Stamp:</strong> Positioned near the signatures. Best as a transparent PNG.</li>
                    <li class="mb-2"><strong>Border:</strong> Customize the primary border color to match your NGO branding.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
