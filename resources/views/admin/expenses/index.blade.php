@extends('layouts.admin')

@section('page_title', 'All Expenses')

@section('content')
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white py-4 px-4 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0 text-danger"><i class="fas fa-file-invoice-dollar me-2"></i>Expense Management</h5>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.expenses.create') }}" class="btn btn-danger btn-sm btn-fancy px-4 shadow">Record Expense</a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 border-0">Date & Category</th>
                        <th class="border-0">Description</th>
                        <th class="border-0">Linked Project</th>
                        <th class="border-0">Amount</th>
                        <th class="px-4 border-0 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($expenses as $expense)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="fw-bold">{{ $expense->category }}</div>
                            <small class="text-muted"><i class="far fa-calendar text-danger me-1"></i>{{ \Carbon\Carbon::parse($expense->expense_date)->format('d M, Y') }}</small>
                        </td>
                        <td>
                            <div class="text-secondary small text-wrap" style="max-width: 250px;">{{ Str::limit($expense->description, 50) }}</div>
                        </td>
                        <td>
                            @if($expense->project)
                                <a href="{{ route('admin.projects.index') }}" class="badge bg-primary-subtle text-primary text-decoration-none px-3 py-2 rounded-pill">
                                    {{ Str::limit($expense->project->title, 20) }}
                                </a>
                            @else
                                <span class="badge bg-light text-muted border px-3 py-2 rounded-pill">General Ops</span>
                            @endif
                        </td>
                        <td>
                            <span class="fs-5 text-dark fw-bold">₹{{ number_format($expense->amount, 2) }}</span>
                        </td>
                        <td class="px-4 text-end">
                            <div class="d-flex gap-2 justify-content-end">
                                @if($expense->bill_image)
                                    <a href="{{ asset('storage/' . $expense->bill_image) }}" target="_blank" class="btn btn-sm btn-light border p-2" title="View Bill">
                                        <i class="fas fa-file-image text-primary"></i>
                                    </a>
                                @endif
                                <a href="{{ route('admin.expenses.edit', $expense) }}" class="btn btn-sm btn-light border p-2" title="Edit Expense">
                                    <i class="fas fa-edit text-warning"></i>
                                </a>
                                <form action="{{ route('admin.expenses.destroy', $expense) }}" method="POST" onsubmit="return confirm('Delete this expense record?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border p-2" title="Remove Expense">
                                        <i class="fas fa-trash text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <i class="fas fa-receipt fa-3x text-light mb-3"></i>
                            <p class="text-muted">No expenses recorded yet.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white border-0 py-4 px-4">
        {{ $expenses->links() }}
    </div>
</div>
@endsection
