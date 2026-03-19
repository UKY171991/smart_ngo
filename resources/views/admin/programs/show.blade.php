@extends('layouts.admin')

@section('page_title', 'Program Details')

@section('content')
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white py-4 px-4 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">Program Details</h5>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.programs.edit', $program) }}" class="btn btn-outline-primary btn-sm btn-fancy rounded-pill px-3">
                <i class="fas fa-edit me-1"></i> Edit
            </a>
            <a href="{{ route('admin.programs.index') }}" class="btn btn-light btn-sm btn-fancy rounded-pill px-3">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>
    <div class="card-body p-4">
        <div class="row g-4">
            <div class="col-md-8">
                <div class="mb-4">
                    <h6 class="text-muted small text-uppercase mb-2">Program Information</h6>
                    <div class="bg-light rounded-3 p-4">
                        <div class="d-flex align-items-start mb-3">
                            <div class="bg-primary-subtle p-3 rounded-3 me-3">
                                <i class="{{ $program->icon }} fa-2x text-primary"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h4 class="fw-bold mb-2">{{ $program->title }}</h4>
                                <p class="text-muted mb-0">{{ $program->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <h6 class="text-muted small text-uppercase mb-2">Statistics</h6>
                    <div class="bg-light rounded-3 p-4">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="text-center">
                                    <h2 class="fw-bold text-primary mb-0">{{ $program->statistic_number }}</h2>
                                    <small class="text-muted">{{ $program->statistic_label }}</small>
                                </div>
                            </div>
                            <div class="col">
                                <div class="d-flex gap-2 flex-wrap">
                                    @if($program->is_featured)
                                        <span class="badge bg-warning-subtle text-warning px-3 rounded-pill">
                                            <i class="fas fa-star me-1"></i> Featured
                                        </span>
                                    @endif
                                    @if($program->is_active)
                                        <span class="badge bg-success-subtle text-success px-3 rounded-pill">
                                            <i class="fas fa-check me-1"></i> Active
                                        </span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger px-3 rounded-pill">
                                            <i class="fas fa-times me-1"></i> Inactive
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="mb-4">
                    <h6 class="text-muted small text-uppercase mb-2">Settings</h6>
                    <div class="bg-light rounded-3 p-4">
                        <div class="mb-3">
                            <small class="text-muted d-block">Sort Order</small>
                            <span class="fw-bold">{{ $program->sort_order }}</span>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block">Status</small>
                            <span class="fw-bold">{{ $program->is_active ? 'Active' : 'Inactive' }}</span>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block">Featured</small>
                            <span class="fw-bold">{{ $program->is_featured ? 'Yes' : 'No' }}</span>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block">Created</small>
                            <span class="fw-bold">{{ $program->created_at->format('M d, Y') }}</span>
                        </div>
                        <div>
                            <small class="text-muted d-block">Last Updated</small>
                            <span class="fw-bold">{{ $program->updated_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.programs.edit', $program) }}" class="btn btn-primary btn-fancy rounded-pill">
                        <i class="fas fa-edit me-2"></i> Edit Program
                    </a>
                    <form action="{{ route('admin.programs.destroy', $program) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this program?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-fancy rounded-pill w-100">
                            <i class="fas fa-trash me-2"></i> Delete Program
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
