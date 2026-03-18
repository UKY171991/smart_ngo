@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row pt-2 pb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h4 class="mb-0 fw-bold">Beneficiary Details</h4>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.beneficiaries.index') }}" class="btn btn-outline-secondary rounded-pill btn-sm shadow-sm px-3">
                    <i class="fas fa-arrow-left me-1"></i> Back to List
                </a>
                <a href="{{ route('admin.beneficiaries.edit', $beneficiary) }}" class="btn btn-info rounded-pill btn-sm shadow-sm px-3 text-white">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-5 col-xl-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4 text-center">
                    <div class="mb-4">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($beneficiary->name) }}&size=150&background=F3F4F6&color=111827&bold=true" class="rounded-circle shadow-sm" alt="{{ $beneficiary->name }}">
                    </div>
                    <h3 class="fw-bold mb-1">{{ $beneficiary->name }}</h3>
                    <p class="text-muted mb-4 pb-3 border-bottom"><i class="fas fa-user-tag me-2"></i>Beneficiary ID: {{ str_pad($beneficiary->id, 5, '0', STR_PAD_LEFT) }}</p>
                    
                    <div class="text-start">
                        <div class="mb-3 d-flex align-items-start gap-3">
                            <div class="bg-light p-2 rounded-3 text-secondary">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 text-muted small text-uppercase fw-bold">Phone Number</h6>
                                <p class="mb-0 fw-bold">{{ $beneficiary->phone ?? 'Not provided' }}</p>
                            </div>
                        </div>
                        
                        <div class="mb-3 d-flex align-items-start gap-3">
                            <div class="bg-light p-2 rounded-3 text-secondary">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 text-muted small text-uppercase fw-bold">Address</h6>
                                <p class="mb-0 fw-bold">{{ $beneficiary->address ?? 'Not provided' }}</p>
                            </div>
                        </div>
                        
                        <div class="mb-0 d-flex align-items-start gap-3">
                            <div class="bg-light p-2 rounded-3 text-secondary">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 text-muted small text-uppercase fw-bold">Registered On</h6>
                                <p class="mb-0 fw-bold">{{ $beneficiary->created_at->format('F d, Y h:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-7 col-xl-8">
            <div class="row g-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white py-3 border-0">
                            <h5 class="mb-0 fw-bold"><i class="fas fa-info-circle text-primary me-2"></i> Additional Details</h5>
                        </div>
                        <div class="card-body pt-0">
                            @if($beneficiary->details)
                                <div class="bg-light p-4 rounded-3 text-dark">
                                    {!! nl2br(e($beneficiary->details)) !!}
                                </div>
                            @else
                                <p class="text-muted mb-0 fst-italic">No additional details provided.</p>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold"><i class="fas fa-hands-helping text-success me-2"></i> Help History</h5>
                            <a href="{{ route('admin.beneficiaries.edit', $beneficiary) }}" class="btn btn-sm btn-outline-primary rounded-pill">Update Record</a>
                        </div>
                        <div class="card-body pt-0">
                            @if($beneficiary->help_history)
                                <div class="timeline ps-4 position-relative border-start border-success border-2 pb-2">
                                    <div class="bg-light p-4 rounded-3 text-dark ms-2 position-relative shadow-sm">
                                        <!-- Note: this is a simple text area display, can be upgraded to JSON array for proper timeline if needed -->
                                        {!! nl2br(e($beneficiary->help_history)) !!}
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-5 bg-light rounded-4">
                                    <i class="fas fa-book-open fa-3x text-muted mb-3 opacity-25"></i>
                                    <h6 class="text-dark fw-bold">No History Found</h6>
                                    <p class="text-muted small mb-0">Record assistance provided to this beneficiary.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
