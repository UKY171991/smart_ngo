@extends('layouts.admin')

@section('page_title', 'Create New Campaign')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-4 px-4">
                <h5 class="fw-bold mb-0 text-primary"><i class="fas fa-plus-circle me-2"></i> Campaign Information</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.campaigns.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Campaign Title</label>
                        <input type="text" name="title" class="form-control" placeholder="e.g. Rural Education Drive 2026" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Describe the purpose of this campaign..."></textarea>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Goal Amount (₹)</label>
                            <input type="number" name="goal_amount" class="form-control" value="0" required>
                        </div>
                        <div class="col-md-6 d-flex align-items-center mt-auto">
                            <div class="form-check form-switch mb-2 ms-3">
                                <input class="form-check-input" type="checkbox" name="is_active" id="isActive" checked>
                                <label class="form-check-label fw-semibold" for="isActive">Set as Active</label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-5">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Start Date</label>
                            <input type="date" name="start_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">End Date</label>
                            <input type="date" name="end_date" class="form-control" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.campaigns.index') }}" class="btn btn-light btn-fancy px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-fancy px-5 shadow">Save Campaign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
