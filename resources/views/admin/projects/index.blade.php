@extends('layouts.admin')

@section('page_title', 'NGO Projects')

@section('content')
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white py-4 px-4 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0 text-primary"><i class="fas fa-tasks me-2"></i>Project Management</h5>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm btn-fancy px-4 shadow">Add New Project</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 border-0">Project Title</th>
                        <th class="border-0">Budget</th>
                        <th class="border-0">Spent</th>
                        <th class="border-0">Balance</th>
                        <th class="border-0">Status</th>
                        <th class="px-4 border-0 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $project)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="fw-bold">{{ $project->title }}</div>
                            <small class="text-muted d-block text-truncate" style="max-width: 250px;">{{ $project->description }}</small>
                        </td>
                        <td class="fw-semibold">₹{{ number_format($project->budget, 2) }}</td>
                        <td class="text-danger">₹{{ number_format($project->spent, 2) }}</td>
                        <td class="text-success fw-bold">₹{{ number_format($project->budget - $project->spent, 2) }}</td>
                        <td>
                            @php
                                $badgeClass = match($project->status) {
                                    'ongoing' => 'bg-primary-subtle text-primary',
                                    'completed' => 'bg-success-subtle text-success',
                                    'on-hold' => 'bg-warning-subtle text-warning',
                                    default => 'bg-secondary-subtle text-secondary'
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }} rounded-pill px-3">{{ ucfirst($project->status) }}</span>
                        </td>
                        <td class="px-4 text-end">
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-light border p-2" title="Edit">
                                    <i class="fas fa-edit text-warning"></i>
                                </a>
                                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Delete this project?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border p-2" title="Delete">
                                        <i class="fas fa-trash text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="fas fa-project-diagram fa-3x text-light mb-3"></i>
                            <p class="text-muted">No projects found. Start by adding one!</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white border-0 py-4 px-4">
        {{ $projects->links() }}
    </div>
</div>
@endsection
