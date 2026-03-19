@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0 fw-bold">Donations Management</h3>
        <a href="{{ route('admin.donations.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="fas fa-plus me-2"></i> Record Donation
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3 border-0">Receipt #</th>
                            <th class="py-3 border-0">Donor Name</th>
                            <th class="py-3 border-0">Amount</th>
                            <th class="py-3 border-0">Campaign</th>
                            <th class="py-3 border-0">Method</th>
                            <th class="py-3 border-0">Status</th>
                            <th class="px-4 py-3 border-0 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donations as $donation)
                        <tr>
                            <td class="px-4"><span class="badge bg-secondary-soft text-secondary p-2">{{ $donation->receipt_number }}</span></td>
                            <td>
                                <div class="fw-bold text-dark">{{ $donation->donor_name }}</div>
                                <div class="small text-muted">{{ $donation->donor_email }}</div>
                            </td>
                            <td><div class="fw-bold text-dark">₹ {{ number_format($donation->amount, 2) }}</div></td>
                            <td>{{ $donation->campaign->title ?? 'General' }}</td>
                            <td><span class="badge bg-light text-dark border">{{ strtoupper($donation->payment_method) }}</span></td>
                            <td>
                                @if($donation->status == 'completed')
                                    <span class="badge bg-success-soft text-success">Completed</span>
                                @else
                                    <span class="badge bg-warning-soft text-warning">Pending</span>
                                @endif
                            </td>
                            <td class="px-4 text-end">
                                <div class="btn-group">
                                    <a href="{{ route('admin.donations.receipt', $donation->id) }}" target="_blank" class="btn btn-sm btn-light text-primary" title="Download Receipt"><i class="fas fa-file-pdf"></i></a>
                                    <form action="{{ route('admin.donations.email', $donation) }}" method="POST" class="d-inline" onsubmit="return confirm('Send receipt to {{ $donation->donor_email }}?');">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-light text-success" title="Email Receipt"><i class="fas fa-envelope"></i></button>
                                    </form>
                                    <form action="{{ route('admin.donations.destroy', $donation) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this record?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light text-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-hand-holding-heart fa-3x mb-3 opacity-50"></i>
                                <h5>No donations recorded</h5>
                                <p>Start recording donations to build your foundation's impact.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($donations->hasPages())
        <div class="card-footer bg-white border-0 py-3">
            {{ $donations->links() }}
        </div>
        @endif
    </div>
</div>
<style>
    .bg-secondary-soft { background-color: rgba(108, 117, 125, 0.1); }
    .bg-success-soft { background-color: rgba(25, 135, 84, 0.1); }
    .bg-warning-soft { background-color: rgba(255, 193, 7, 0.1); }
</style>
@endsection
