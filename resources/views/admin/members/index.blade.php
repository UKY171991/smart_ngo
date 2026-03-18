@extends('layouts.admin')

@section('page_title', 'All Registered Members')

@section('content')
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white py-4 px-4 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">Member Directory</h5>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.members.create') }}" class="btn btn-primary btn-sm btn-fancy px-4 shadow">Add New Member</a>
            <button class="btn btn-outline-secondary btn-sm rounded-3"><i class="fas fa-file-export me-1"></i> Export CSV</button>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 border-0">Name</th>
                        <th class="border-0">Position</th>
                        <th class="border-0">Contacts</th>
                        <th class="border-0 text-center">Referrals</th>
                        <th class="border-0">Joined</th>
                        <th class="px-4 border-0 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($members as $member)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=E0F2FE&color=0EA5E9" class="rounded-circle me-3" width="40" alt="Avatar">
                                <div>
                                    <p class="mb-0 fw-bold">{{ $member->name }}</p>
                                    <small class="text-muted">ID: NGO-{{ str_pad($member->id, 5, '0', STR_PAD_LEFT) }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-secondary px-3 py-2 rounded-3 small">{{ $member->designation->title ?? 'Volunteer' }}</span>
                        </td>
                        <td>
                            <div class="small fw-semibold text-dark">{{ $member->email }}</div>
                            <div class="x-small text-muted">{{ $member->phone ?? 'No phone' }}</div>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-light text-dark px-3 py-1 border">{{ \App\Models\User::where('referred_by_id', $member->id)->count() }}</span>
                        </td>
                        <td>{{ $member->created_at->format('d M, Y') }}</td>
                        <td class="px-4 text-end">
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('admin.members.edit', $member) }}" class="btn btn-sm btn-light border p-2" title="Edit Profile">
                                    <i class="fas fa-edit text-warning"></i>
                                </a>
                                <form action="{{ route('admin.members.destroy', $member) }}" method="POST" onsubmit="return confirm('Delete this member?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border p-2" title="Remove User">
                                        <i class="fas fa-trash text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="fas fa-user-slash fa-3x text-light mb-3"></i>
                            <p class="text-muted">No members found yet.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white border-0 py-4 px-4">
        {{ $members->links() }}
    </div>
</div>

<style>
    .x-small { font-size: 0.7rem; }
</style>
@endsection
