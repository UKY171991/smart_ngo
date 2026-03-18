@extends('layouts.admin')

@section('page_title', 'Post New Activity')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-4 px-4">
                <h5 class="fw-bold mb-0 text-primary"><i class="fas fa-camera-retro me-2"></i> What's happening?</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.activities.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Write a Caption</label>
                        <textarea name="caption" class="form-control" rows="5" placeholder="Share a success story or update with the community..." required></textarea>
                        <small class="text-muted">Maximum 500 characters.</small>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.activities.index') }}" class="btn btn-light btn-fancy px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-fancy px-5 shadow">Post Activity</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
