@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Edit Beneficiary</h5>
                    <a href="{{ route('admin.beneficiaries.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
                        <i class="fas fa-arrow-left me-1"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.beneficiaries.update', $beneficiary) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label fw-bold">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $beneficiary->name) }}" required>
                            @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $beneficiary->phone) }}">
                            @error('phone')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Address</label>
                            <textarea name="address" class="form-control" rows="2">{{ old('address', $beneficiary->address) }}</textarea>
                            @error('address')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Additional Details</label>
                            <textarea name="details" class="form-control" rows="3">{{ old('details', $beneficiary->details) }}</textarea>
                            @error('details')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Help History</label>
                            <textarea name="help_history" class="form-control" rows="6">{{ old('help_history', $beneficiary->help_history) }}</textarea>
                            <div class="form-text">Update the dates and types of assistance provided to this beneficiary.</div>
                            @error('help_history')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success rounded-pill px-5">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
