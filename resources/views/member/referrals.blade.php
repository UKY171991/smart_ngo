@extends('layouts.member')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold"><i class="fas fa-users-viewfinder text-primary me-2"></i> Volunteer Joining List</h5>
                <div class="badge bg-primary-soft text-primary px-3 py-2 rounded-pill">Total: {{ $referrals->count() }}</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 px-4">Member</th>
                                <th class="border-0">Email</th>
                                <th class="border-0">Phone</th>
                                <th class="border-0">Joined Date</th>
                                <th class="border-0 text-end px-4">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($referrals as $referral)
                            <tr>
                                <td class="px-4">
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($referral->name) }}&background=0d6efd&color=fff&size=32" class="rounded-circle me-2 shadow-sm" alt="U">
                                        <span class="fw-bold">{{ $referral->name }}</span>
                                    </div>
                                </td>
                                <td>{{ $referral->email }}</td>
                                <td>{{ $referral->phone ?? 'N/A' }}</td>
                                <td>{{ $referral->created_at->format('d M, Y') }}</td>
                                <td class="text-end px-4">
                                    <span class="badge bg-success-soft text-success rounded-pill px-3 py-1">Active</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <p class="text-muted mb-0">No members have joined through your referral yet.</p>
                                    <a href="{{ route('member.dashboard') }}" class="btn btn-primary mt-3 rounded-pill px-4 btn-sm">Share My Link</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-primary-soft { background-color: rgba(13, 110, 253, 0.1); }
    .bg-success-soft { background-color: rgba(25, 135, 84, 0.1); }
</style>
@endsection
