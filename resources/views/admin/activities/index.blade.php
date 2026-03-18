@extends('layouts.admin')

@section('page_title', 'NGO Activity Feed')

@section('content')
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white py-4 px-4 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">Manage Activity Feed</h5>
        <a href="{{ route('admin.activities.create') }}" class="btn btn-primary btn-sm btn-fancy px-4 shadow">
            <i class="fas fa-plus me-1"></i> Post Activity
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 border-0">User</th>
                        <th class="border-0">Caption</th>
                        <th class="border-0">Posted</th>
                        <th class="px-4 border-0 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activities as $activity)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($activity->user->name ?? 'A') }}&background=E2E8F0&color=475569" class="rounded-circle me-2" width="30" alt="Avatar">
                                <span class="fw-bold small">{{ $activity->user->name ?? 'Admin' }}</span>
                            </div>
                        </td>
                        <td><span class="small">{{ Str::limit($activity->caption, 80) }}</span></td>
                        <td><span class="text-muted small">{{ $activity->created_at->diffForHumans() }}</span></td>
                        <td class="px-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.activities.edit', $activity) }}" class="btn btn-light btn-sm rounded-3">
                                    <i class="fas fa-edit text-warning"></i>
                                </a>
                                <form action="{{ route('admin.activities.destroy', $activity) }}" method="POST" onsubmit="return confirm('Remove this post?')">
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
                        <td colspan="4" class="text-center py-5">
                            <p class="text-muted">No activities posted yet.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white border-0 py-4 px-4">
        {{ $activities->links() }}
    </div>
</div>
@endsection
