@extends('layouts.admin')

@section('page_title', 'Receipt Customization')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <form action="{{ route('admin.settings.receipt.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0 text-primary"><i class="fas fa-file-invoice me-2"></i> Receipt Branding</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label class="form-label fw-bold">NGO Name (on Receipt)</label>
                            <input type="text" name="receipt_ngo_name" class="form-control" value="{{ $settings['receipt_ngo_name'] ?? $settings['ngo_name'] ?? 'SMART NGO' }}">
                            <div class="form-text">This will appear as the main heading on all donation receipts.</div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Receipt Primary Color</label>
                            <div class="d-flex gap-2">
                                <input type="color" name="receipt_primary_color" class="form-control form-control-color" value="{{ $settings['receipt_primary_color'] ?? '#28a745' }}" title="Choose primary color">
                                <input type="text" class="form-control" value="{{ $settings['receipt_primary_color'] ?? '#28a745' }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">NGO Logo (for Receipt)</label>
                            <input type="file" name="receipt_logo" class="form-control">
                            @if(isset($settings['receipt_logo']))
                                <img src="{{ Storage::url($settings['receipt_logo']) }}" class="mt-2 rounded border" style="max-height: 50px;">
                            @endif
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-bold">Registration Number</label>
                            <input type="text" name="receipt_reg_no" class="form-control" value="{{ $settings['receipt_reg_no'] ?? 'NGO/DEL/2026/01' }}">
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
                            <label class="form-label fw-bold">Authorized Digital Signature</label>
                            <input type="file" name="receipt_signature" class="form-control">
                            <div class="form-text">Transparent PNG recommended (Max 2MB)</div>
                            @if(isset($settings['receipt_signature']))
                                <div class="mt-2 p-3 bg-light rounded border text-center">
                                    <img src="{{ Storage::url($settings['receipt_signature']) }}" class="img-fluid" style="max-height: 80px;">
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Official Receipt Stamp/Seal</label>
                            <input type="file" name="receipt_stamp" class="form-control">
                            <div class="form-text">Transparent PNG recommended (Max 2MB)</div>
                            @if(isset($settings['receipt_stamp']))
                                <div class="mt-2 p-3 bg-light rounded border text-center">
                                    <img src="{{ Storage::url($settings['receipt_stamp']) }}" class="img-fluid" style="max-height: 80px;">
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Signatory Designation</label>
                            <input type="text" name="receipt_sign_title" class="form-control" value="{{ $settings['receipt_sign_title'] ?? 'Authorized Signatory' }}">
                            <div class="form-text">Text below the signature line.</div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Signatory Department</label>
                            <input type="text" name="receipt_sign_dept" class="form-control" value="{{ $settings['receipt_sign_dept'] ?? 'Smart NGO Official' }}">
                            <div class="form-text">Sub-text (e.g., Smart NGO Official).</div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-bold">Receipt Footer Note</label>
                            <textarea name="receipt_footer_note" class="form-control" rows="2">{{ $settings['receipt_footer_note'] ?? 'Making a Positive Impact in Communities' }}</textarea>
                            <div class="form-text">Short tagline shown at the very bottom.</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-primary btn-fancy px-5 py-3 fw-bold rounded-pill shadow-lg border-0">
                    <i class="fas fa-save me-2"></i> SAVE RECEIPT SETTINGS
                </button>
            </div>
        </form>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 position-sticky" style="top: 20px;">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0 text-success"><i class="fas fa-info-circle me-2"></i> Instructions</h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h6 class="fw-bold small text-uppercase text-muted">Digital Signature</h6>
                    <p class="small text-muted">Upload a clear image of the signatory's signature. For best results, use a <strong>transparent PNG</strong> file so it blends perfectly with the receipt background.</p>
                </div>
                
                <div class="mb-4">
                    <h6 class="fw-bold small text-uppercase text-muted">Official Stamp</h6>
                    <p class="small text-muted">The stamp will be placed next to or behind the signature. Again, a transparent PNG is highly recommended.</p>
                </div>

                <div class="mb-0">
                    <h6 class="fw-bold small text-uppercase text-muted">80G Info</h6>
                    <p class="small text-muted">The 80G tax benefit information is automatically included if the donation is marked as 80G eligible.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
