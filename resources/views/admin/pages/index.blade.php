@extends('layouts.admin')

@section('page_title', 'Pages Management')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-4 px-4 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0 text-primary"><i class="fas fa-file-alt me-2"></i> Pages Management</h5>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.pages.create') }}" class="btn btn-outline-primary btn-sm btn-fancy">
                        <i class="fas fa-plus me-2"></i> New Page
                    </a>
                </div>
            </div>
            <div class="card-body p-4">
                @if($pages->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>Updated</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pages as $page)
                                    <tr>
                                        <td>
                                            <strong>{{ $page->title }}</strong>
                                            @if($page->slug == 'privacy-policy' || $page->slug == 'terms-of-service' || $page->slug == 'cookie-policy')
                                                <span class="badge bg-primary ms-2">Legal</span>
                                            @endif
                                        </td>
                                        <td><code>{{ $page->slug }}</code></td>
                                        <td>
                                            @if($page->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td><small>{{ $page->updated_at->format('M j, Y') }}</small></td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-center mt-4">
                        {{ $pages->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-file-alt text-muted fs-1 mb-3"></i>
                        <h5 class="text-muted">No pages found</h5>
                        <p class="text-muted">Create your first page or edit the legal pages above.</p>
                        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary btn-fancy">
                            <i class="fas fa-plus me-2"></i> Create First Page
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
