@extends('layouts.admin')

@section('page_title', 'Edit Campaign')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-4 px-4 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0 text-primary"><i class="fas fa-edit me-2"></i> Update Campaign</h5>
                <span class="badge bg-light text-muted border px-3 py-2 rounded-pill small">ID: {{ $campaign->id }}</span>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.campaigns.update', $campaign) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Campaign Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $campaign->title }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" class="form-control" rows="4">{{ $campaign->description }}</textarea>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Goal Amount (₹)</label>
                            <input type="number" name="goal_amount" class="form-control" value="{{ $campaign->goal_amount }}" required>
                        </div>
                        <div class="col-md-6 d-flex align-items-center mt-auto">
                            <div class="form-check form-switch mb-2 ms-3">
                                <input class="form-check-input" type="checkbox" name="is_active" id="isActive" {{ $campaign->is_active ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="isActive">Set as Active</label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-5">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Start Date</label>
                            <input type="date" name="start_date" class="form-control" value="{{ $campaign->start_date }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">End Date</label>
                            <input type="date" name="end_date" class="form-control" value="{{ $campaign->end_date }}" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.campaigns.index') }}" class="btn btn-light btn-fancy px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-fancy px-5 shadow">Update Campaign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
