@extends('layouts.admin')

@section('page_title', 'Edit News Article')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-4 px-4 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0 text-primary"><i class="fas fa-edit me-2"></i> Update Article</h5>
                <span class="badge bg-light text-muted border px-3 py-2 rounded-pill small">ID: {{ $news->id }}</span>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.news.update', $news) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Article Title</label>
                        <input type="text" name="title" class="form-control form-control-lg" value="{{ $news->title }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Content</label>
                        <textarea name="content" class="form-control" rows="10" required>{{ $news->content }}</textarea>
                    </div>

                    <div class="mb-5">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" id="isActive" {{ $news->is_active ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="isActive">Published</label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.news.index') }}" class="btn btn-light btn-fancy px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-fancy px-5 shadow">Update Article</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
