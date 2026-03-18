@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden" id="idCard">
                <div class="card-header bg-primary text-white text-center py-4 border-bottom-0">
                    <h4 class="fw-bold mb-0">IDENTITY CARD</h4>
                    <small class="opacity-75">Smart NGO - Registered Organization</small>
                </div>
                <div class="card-body p-4 text-center">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=128&background=0D6EFD&color=fff" class="rounded-circle shadow-sm mb-3 border border-4 border-white mt-n5" width="120" alt="Avatar">
                    
                    <h3 class="fw-bold mb-1">{{ strtoupper($user->name) }}</h3>
                    <p class="text-primary fw-bold mb-4">{{ strtoupper($user->role) }}</p>
                    
                    <div class="row g-2 text-start mb-4 bg-light p-3 rounded-3">
                        <div class="col-4 text-muted small">MEMBER ID</div>
                        <div class="col-8 small fw-bold">NGO-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</div>
                        
                        <div class="col-4 text-muted small">JOINED</div>
                        <div class="col-8 small fw-bold">{{ $user->created_at->format('M Y') }}</div>
                        
                        <div class="col-4 text-muted small">PHONE</div>
                        <div class="col-8 small fw-bold">{{ $user->phone ?? 'N/A' }}</div>
                    </div>

                    <div class="mb-3">
                        {!! $qrCode !!}
                    </div>
                    <p class="x-small text-muted mb-0">Scan to verify membership</p>
                </div>
                <div class="card-footer bg-dark text-white text-center py-3">
                    <small>www.smartngo.in</small>
                </div>
            </div>
            
            <div class="mt-4 text-center d-print-none">
                <button class="btn btn-primary" onclick="window.print()"><i class="fas fa-print me-2"></i> Print ID Card</button>
            </div>
        </div>
    </div>
</div>

<style>
    #idCard { max-width: 350px; margin: 0 auto; }
    .mt-n5 { margin-top: -60px !important; }
    .x-small { font-size: 0.7rem; }
</style>
@endsection
