@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="mb-0 fw-bold">Add New Beneficiary</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.beneficiaries.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                            @error('phone')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Address</label>
                            <textarea name="address" class="form-control" rows="2">{{ old('address') }}</textarea>
                            @error('address')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Additional Details</label>
                            <textarea name="details" class="form-control" rows="3">{{ old('details') }}</textarea>
                            @error('details')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Help History</label>
                            <textarea name="help_history" class="form-control" rows="4">{{ old('help_history') }}</textarea>
                            <div class="form-text">Record the dates and types of assistance provided to this beneficiary.</div>
                            @error('help_history')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.beneficiaries.index') }}" class="btn btn-light rounded-pill px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary rounded-pill px-4">Create Beneficiary</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
