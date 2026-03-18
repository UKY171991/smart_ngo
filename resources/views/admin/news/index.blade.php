@extends('layouts.admin')

@section('page_title', 'Manage News Articles')

@section('content')
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white py-4 px-4 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">Latest NGO News</h5>
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary btn-sm btn-fancy px-4 shadow">
            <i class="fas fa-plus me-1"></i> Add News
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 border-0">Aritcle Title</th>
                        <th class="border-0">Slug</th>
                        <th class="border-0">Status</th>
                        <th class="border-0">Published</th>
                        <th class="px-4 border-0 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($news as $article)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-info-subtle p-2 rounded-3 me-3">
                                    <i class="fas fa-newspaper text-info"></i>
                                </div>
                                <div class="fw-bold text-dark">{{ $article->title }}</div>
                            </div>
                        </td>
                        <td><code class="small">{{ $article->slug }}</code></td>
                        <td>
                            @if($article->is_active)
                                <span class="badge bg-success-subtle text-success px-3 rounded-pill small">Published</span>
                            @else
                                <span class="badge bg-warning-subtle text-warning px-3 rounded-pill small">Draft</span>
                            @endif
                        </td>
                        <td>{{ $article->created_at->format('d M, Y') }}</td>
                        <td class="px-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.news.edit', $article) }}" class="btn btn-light btn-sm rounded-3">
                                    <i class="fas fa-edit text-warning"></i>
                                </a>
                                <form action="{{ route('admin.news.destroy', $article) }}" method="POST" onsubmit="return confirm('Delete this article?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-light btn-sm rounded-3">
                                        <i class="fas fa-trash text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <p class="text-muted">No news articles found.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white border-0 py-4 px-4">
        {{ $news->links() }}
    </div>
</div>
@endsection
