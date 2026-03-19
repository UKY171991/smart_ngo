@extends('layouts.admin')

@section('page_title', 'Manage Programs')

@section('content')
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white py-4 px-4 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">Programs & Statistics</h5>
        <a href="{{ route('admin.programs.create') }}" class="btn btn-primary btn-sm btn-fancy px-4 shadow">
            <i class="fas fa-plus me-1"></i> New Program
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 border-0">Program Info</th>
                        <th class="border-0">Statistic</th>
                        <th class="border-0">Sort Order</th>
                        <th class="border-0">Status</th>
                        <th class="px-4 border-0 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($programs as $program)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary-subtle p-2 rounded-3 me-3">
                                    <i class="{{ $program->icon }} text-primary"></i>
                                </div>
                                <div>
                                    <p class="mb-0 fw-bold text-dark">{{ $program->title }}</p>
                                    <small class="text-muted">{{ Str::limit($program->description, 50) }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-primary-subtle text-primary fw-bold me-2">{{ $program->statistic_number }}</span>
                                <small class="text-muted">{{ $program->statistic_label }}</small>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark">{{ $program->sort_order }}</span>
                        </td>
                        <td>
                            @if($program->is_active)
                                <span class="badge bg-success-subtle text-success px-3 rounded-pill small">Active</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger px-3 rounded-pill small">Inactive</span>
                            @endif
                            @if($program->is_featured)
                                <span class="badge bg-warning-subtle text-warning px-2 rounded-pill small ms-1">
                                    <i class="fas fa-star"></i> Featured
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-end">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light border-0 rounded-3 dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                                    <li>
                                        <a href="{{ route('admin.programs.show', $program) }}" class="dropdown-item">
                                            <i class="fas fa-eye me-2 text-muted"></i> View
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.programs.edit', $program) }}" class="dropdown-item">
                                            <i class="fas fa-edit me-2 text-muted"></i> Edit
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('admin.programs.destroy', $program) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this program?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="fas fa-trash me-2"></i> Delete
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="empty-state py-5">
                                <i class="fas fa-layer-group fa-3x text-muted mb-3 opacity-50"></i>
                                <h5 class="fw-bold text-muted">No Programs Found</h5>
                                <p class="text-muted small">Start by creating your first program to display on the homepage.</p>
                                <a href="{{ route('admin.programs.create') }}" class="btn btn-primary btn-sm rounded-pill px-4 mt-3">
                                    <i class="fas fa-plus me-1"></i> Create Program
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
