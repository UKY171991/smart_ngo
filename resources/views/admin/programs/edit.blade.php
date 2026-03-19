@extends('layouts.admin')

@section('page_title', 'Edit Program')

@section('content')
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white py-4 px-4">
        <h5 class="fw-bold mb-0">Edit Program</h5>
        <p class="text-muted small mb-0">Update program information and statistics.</p>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('admin.programs.update', $program) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                           value="{{ old('title', $program->title) }}" placeholder="e.g., Education Support" required>
                    @error('title')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Icon Class <span class="text-danger">*</span></label>
                    <input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror" 
                           value="{{ old('icon', $program->icon) }}" placeholder="e.g., fas fa-graduation-cap" required>
                    <small class="text-muted">Use Font Awesome icon classes</small>
                    @error('icon')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12">
                    <label class="form-label fw-semibold">Description <span class="text-danger">*</span></label>
                    <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror" 
                              placeholder="Describe the program and its impact..." required>{{ old('description', $program->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Statistic Number <span class="text-danger">*</span></label>
                    <input type="text" name="statistic_number" class="form-control @error('statistic_number') is-invalid @enderror" 
                           value="{{ old('statistic_number', $program->statistic_number) }}" placeholder="e.g., 500+" required>
                    @error('statistic_number')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Statistic Label <span class="text-danger">*</span></label>
                    <input type="text" name="statistic_label" class="form-control @error('statistic_label') is-invalid @enderror" 
                           value="{{ old('statistic_label', $program->statistic_label) }}" placeholder="e.g., Students Supported" required>
                    @error('statistic_label')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror" 
                           value="{{ old('sort_order', $program->sort_order) }}" min="0" placeholder="0">
                    <small class="text-muted">Lower numbers appear first</small>
                    @error('sort_order')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Featured</label>
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" 
                               {{ old('is_featured', $program->is_featured) ? 'checked' : '' }}>
                        <label class="form-check-label">Display as featured program</label>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Active</label>
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" 
                               {{ old('is_active', $program->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label">Show on homepage</label>
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-between mt-4 pt-4 border-top">
                <a href="{{ route('admin.programs.index') }}" class="btn btn-light btn-fancy rounded-pill px-4">
                    <i class="fas fa-arrow-left me-2"></i> Back to Programs
                </a>
                <div class="d-flex gap-2">
                    <button type="reset" class="btn btn-outline-secondary btn-fancy rounded-pill px-4">
                        <i class="fas fa-undo me-2"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary btn-fancy rounded-pill px-4">
                        <i class="fas fa-save me-2"></i> Update Program
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
