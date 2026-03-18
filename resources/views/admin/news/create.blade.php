@extends('layouts.admin')

@section('page_title', 'Create News Article')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-4 px-4">
                <h5 class="fw-bold mb-0 text-primary"><i class="fas fa-plus-circle me-2"></i> Compose Article</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.news.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Article Title</label>
                        <input type="text" name="title" class="form-control form-control-lg" placeholder="Enter headline" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Content</label>
                        <textarea name="content" class="form-control" rows="10" placeholder="Write your news article here..." required></textarea>
                    </div>

                    <div class="mb-5">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" id="isActive" checked>
                            <label class="form-check-label fw-semibold" for="isActive">Publish Immediately</label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.news.index') }}" class="btn btn-light btn-fancy px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-fancy px-5 shadow">Save & Publish</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
