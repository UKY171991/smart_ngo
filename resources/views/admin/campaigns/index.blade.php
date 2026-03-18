@extends('layouts.admin')

@section('page_title', 'Manage Campaigns')

@section('content')
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white py-4 px-4 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">NGO Campaigns</h5>
        <a href="{{ route('admin.campaigns.create') }}" class="btn btn-primary btn-sm btn-fancy px-4 shadow">
            <i class="fas fa-plus me-1"></i> New Campaign
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 border-0">Campaign Info</th>
                        <th class="border-0">Goal</th>
                        <th class="border-0">Raised</th>
                        <th class="border-0">Status</th>
                        <th class="border-0">Duration</th>
                        <th class="px-4 border-0 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($campaigns as $campaign)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary-subtle p-2 rounded-3 me-3">
                                    <i class="fas fa-bullhorn text-primary"></i>
                                </div>
                                <div>
                                    <p class="mb-0 fw-bold text-dark">{{ $campaign->title }}</p>
                                    <small class="text-muted">{{ Str::limit($campaign->description, 40) }}</small>
                                </div>
                            </div>
                        </td>
                        <td><span class="fw-bold">₹{{ number_format($campaign->goal_amount) }}</span></td>
                        <td><span class="text-success">₹{{ number_format($campaign->current_amount) }}</span></td>
                        <td>
                            @if($campaign->is_active)
                                <span class="badge bg-success-subtle text-success px-3 rounded-pill small">Active</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger px-3 rounded-pill small">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="small fw-semibold">{{ $campaign->start_date }}</div>
                            <div class="x-small text-muted">to {{ $campaign->end_date }}</div>
                        </td>
                        <td class="px-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.campaigns.edit', $campaign) }}" class="btn btn-light btn-sm rounded-3">
                                    <i class="fas fa-edit text-warning"></i>
                                </a>
                                <form action="{{ route('admin.campaigns.destroy', $campaign) }}" method="POST" onsubmit="return confirm('Delete this campaign?')">
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
                        <td colspan="6" class="text-center py-5">
                            <i class="fas fa-bullhorn fa-3x text-light mb-3"></i>
                            <p class="text-muted">No campaigns found.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white border-0 py-4 px-4">
        {{ $campaigns->links() }}
    </div>
</div>
@endsection
