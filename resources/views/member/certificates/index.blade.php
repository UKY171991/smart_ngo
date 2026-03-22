@extends('layouts.member')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold text-primary"><i class="fas fa-certificate me-2"></i> My Rewarded Certificates</h5>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    @forelse($certificates as $cert)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm rounded-4 hover-shadow transition overflow-hidden">
                            <div class="card-body p-4 text-center">
                                <span class="badge bg-primary-soft text-primary rounded-pill mb-3 px-3">{{ ucfirst($cert->type) }}</span>
                                <div class="mb-3 text-warning">
                                    <i class="fas fa-certificate fa-3x"></i>
                                </div>
                                <h6 class="fw-bold mb-1">{{ $cert->recipient_name }}</h6>
                                <p class="small text-muted mb-3">{{ $cert->certificate_number }}</p>
                                
                                <a href="{{ route('member.certificates.download', $cert->id) }}" target="_blank" class="btn btn-outline-primary rounded-pill btn-sm px-4">
                                    <i class="fas fa-download me-2"></i> Download PDF
                                </a>
                            </div>
                            <div class="card-footer bg-light border-0 py-2 small text-center text-muted">
                                Issued: {{ $cert->created_at->format('d M, Y') }}
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <div class="text-muted mb-3">
                            <i class="fas fa-award fa-4x opacity-25"></i>
                        </div>
                        <h5>No certificates awarded yet</h5>
                        <p class="text-muted">Keep contributing to the community to earn your recognition certificates.</p>
                        <a href="{{ route('member.dashboard') }}" class="btn btn-primary rounded-pill btn-sm px-4">Go to Dashboard</a>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-primary-soft { background-color: rgba(13, 110, 253, 0.1); }
    .hover-shadow:hover { 
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.08) !important;
    }
    .transition { transition: all 0.3s ease; }
</style>
@endsection
