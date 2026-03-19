@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0 fw-bold">Certificates Management</h3>
        <a href="{{ route('admin.certificates.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="fas fa-certificate me-2"></i> Issue Certificate
        </a>
    </div>

    @if(session('error'))
    <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
        {{ session('error') }}
    </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3 border-0">Cert No.</th>
                            <th class="py-3 border-0">Recipient Name</th>
                            <th class="py-3 border-0">Email</th>
                            <th class="py-3 border-0">Type</th>
                            <th class="py-3 border-0">Issued On</th>
                            <th class="px-4 py-3 border-0 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($certificates as $cert)
                        <tr>
                            <td class="px-4"><span class="badge bg-secondary-soft text-secondary p-2">{{ $cert->certificate_number }}</span></td>
                            <td>
                                <div class="fw-bold text-dark">{{ $cert->recipient_name }}</div>
                                @if($cert->user_id)
                                    <span class="badge bg-primary-soft text-primary small">Member</span>
                                @else
                                    <span class="badge bg-info-soft text-info small">Visitor/Guest</span>
                                @endif
                            </td>
                            <td>{{ $cert->recipient_email }}</td>
                            <td><span class="badge bg-light text-dark border">{{ ucfirst($cert->type) }}</span></td>
                            <td>{{ $cert->created_at->format('M d, Y') }}</td>
                            <td class="px-4 text-end">
                                <div class="btn-group">
                                    <a href="{{ route('admin.certificates.show', $cert) }}" target="_blank" class="btn btn-sm btn-light text-primary" title="View PDF"><i class="fas fa-file-pdf"></i></a>
                                    <form action="{{ route('admin.certificates.email', $cert) }}" method="POST" class="d-inline" onsubmit="return confirm('Send certificate to {{ $cert->recipient_email }}?');">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-light text-success" title="Email Certificate"><i class="fas fa-envelope"></i></button>
                                    </form>
                                    <form action="{{ route('admin.certificates.destroy', $cert) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this certificate record?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light text-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fas fa-award fa-3x mb-3 opacity-50"></i>
                                <h5>No certificates issued yet</h5>
                                <p>Start issuing certificates to members and visitors.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($certificates->hasPages())
        <div class="card-footer bg-white border-0 py-3">
            {{ $certificates->links() }}
        </div>
        @endif
    </div>
</div>
<style>
    .bg-secondary-soft { background-color: rgba(108, 117, 125, 0.1); }
    .bg-primary-soft { background-color: rgba(13, 110, 253, 0.1); }
    .bg-info-soft { background-color: rgba(13, 202, 240, 0.1); }
</style>
@endsection
