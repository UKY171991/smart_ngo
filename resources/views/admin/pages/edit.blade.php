@extends('layouts.admin')

@section('page_title', 'Edit Page: ' . $page->title)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-4 px-4">
                <h5 class="fw-bold mb-0 text-primary">
                    <i class="fas fa-edit me-2"></i> Edit Page: {{ $page->title }}
                </h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.pages.update', $page) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label fw-semibold">Page Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $page->title }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Status</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" name="is_active" {{ $page->is_active ? 'checked' : '' }}>
                                <label class="form-check-label">
                                    Active
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">URL Slug</label>
                            <input type="text" name="slug" class="form-control" value="{{ $page->slug }}" required>
                            <small class="text-muted">URL: {{ url('/pages/') }}<span id="slug-preview">{{ $page->slug }}</span></small>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control" value="{{ $page->meta_title ?? '' }}" placeholder="Optional SEO title">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Meta Keywords</label>
                            <input type="text" name="meta_keywords" class="form-control" value="{{ $page->meta_keywords ?? '' }}" placeholder="Optional SEO Keywords">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Meta Description</label>
                            <textarea name="meta_description" class="form-control" rows="1" placeholder="Optional SEO description">{{ $page->meta_description ?? '' }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Page Content</label>
                            <div class="border rounded">
                                <textarea name="content" class="form-control border-0" rows="15" required>{{ $page->content }}</textarea>
                            </div>
                            <small class="text-muted">Use the rich text editor to format your content with headings, lists, bold/italic text, and more.</small>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Back to Pages
                        </a>
                        <div class="d-flex gap-2">
                            <a href="{{ url('/pages/' . $page->slug) }}" target="_blank" class="btn btn-outline-info">
                                <i class="fas fa-external-link-alt me-2"></i> Preview Page
                            </a>
                            <button type="submit" class="btn btn-primary btn-fancy">
                                <i class="fas fa-save me-2"></i> Update Page
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelector('input[name="slug"]').addEventListener('input', function() {
    document.getElementById('slug-preview').textContent = this.value;
});
</script>

@include('admin.pages._tinymce')
@endsection
