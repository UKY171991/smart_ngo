@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 text-center">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="mb-0 fw-bold">Website QR Code</h5>
                </div>
                <div class="card-body p-5">
                    <div class="mb-4">
                        <div class="p-4 bg-light d-inline-block rounded-4 shadow-sm">
                            {!! $qrCode !!}
                        </div>
                    </div>
                    <h4 class="fw-bold text-dark mb-2">Scan to Visit</h4>
                    <p class="text-muted mb-4">{{ $qrData }}</p>
                    
                    <div class="d-grid gap-2 col-md-8 mx-auto">
                        <button onclick="window.print()" class="btn btn-primary rounded-pill py-2">
                            <i class="fas fa-print me-2"></i> Print QR Code
                        </button>
                        <a href="{{ route('admin.settings.index') }}" class="btn btn-light rounded-pill py-2">Back to Settings</a>
                    </div>
                    
                    <div class="mt-5 text-muted small">
                        <p><i class="fas fa-info-circle me-1"></i> You can use this QR code on banners, posters, social media, or any promotional material.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        header, footer, .top-navbar, #sidebar, .btn { display: none !important; }
        #main-content { margin-left: 0 !important; }
        .card { border: none !important; shadow: none !important; }
        .card-body { padding: 0 !important; }
    }
</style>
@endsection
