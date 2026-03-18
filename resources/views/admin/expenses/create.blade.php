@extends('layouts.admin')

@section('page_title', 'Record Expense')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-3 px-4">
                <h5 class="fw-bold mb-0 text-danger">New Expense Details</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.expenses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Expense Category</label>
                            <input type="text" name="category" class="form-control rounded-3" placeholder="e.g. Travel, Utilities, Staff" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Date of Expense</label>
                            <input type="date" name="expense_date" class="form-control rounded-3" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Description / Remarks</label>
                            <textarea name="description" class="form-control rounded-3" rows="3" placeholder="Nature of the expense" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Amount (₹)</label>
                            <input type="number" step="0.01" name="amount" class="form-control rounded-3 border-danger" placeholder="0.00" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Link to Project (Optional)</label>
                            <select name="project_id" class="form-select rounded-3">
                                <option value="">-- General / Operational --</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->title }} (Bal: ₹{{ $project->budget - $project->spent }})</option>
                                @endforeach
                            </select>
                            <div class="form-text">Will automatically update the project's spent amount.</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Upload Bill / Receipt (Optional)</label>
                            <input type="file" name="bill_image" class="form-control rounded-3" accept="image/*">
                            <div class="form-text">Max size: 2MB. Image format only.</div>
                        </div>
                        <div class="col-12 mt-4 pt-2">
                            <hr>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-danger px-5 py-2 rounded-3 fw-bold">Record Expense</button>
                                <a href="{{ route('admin.expenses.index') }}" class="btn btn-light px-4 py-2 rounded-3">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
