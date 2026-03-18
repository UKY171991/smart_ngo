@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0 fw-bold">Beneficiaries Management</h3>
        <a href="{{ route('admin.beneficiaries.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="fas fa-plus me-2"></i> Add Beneficiary
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
        {{ session('success') }}
    </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3 border-0">Name</th>
                            <th class="py-3 border-0">Phone</th>
                            <th class="py-3 border-0">Address</th>
                            <th class="py-3 border-0">Added On</th>
                            <th class="px-4 py-3 border-0 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($beneficiaries) > 0)
                            @foreach($beneficiaries as $beneficiary)
                        <tr>
                            <td class="px-4">
                                <div class="fw-bold text-dark">{{ $beneficiary->name }}</div>
                            </td>
                            <td>{{ $beneficiary->phone ?? 'N/A' }}</td>
                            <td>{{ $beneficiary->address ? \Illuminate\Support\Str::limit($beneficiary->address, 30) : 'N/A' }}</td>
                            <td>{{ $beneficiary->created_at->format('M d, Y') }}</td>
                            <td class="px-4 text-end">
                                <div class="btn-group">
                                    <a href="{{ route('admin.beneficiaries.show', $beneficiary) }}" class="btn btn-sm btn-light text-primary" title="View"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('admin.beneficiaries.edit', $beneficiary) }}" class="btn btn-sm btn-light text-info" title="Edit"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.beneficiaries.destroy', $beneficiary) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this beneficiary?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light text-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-users-slash fa-3x mb-3 opacity-50"></i>
                                    <h5>No beneficiaries found</h5>
                                    <p>Start adding beneficiaries to keep track of help history.</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        @if($beneficiaries->hasPages())
        <div class="card-footer bg-white border-0 py-3">
            {{ $beneficiaries->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
