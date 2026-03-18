@extends('layouts.admin')

@section('page_title', 'Register New Member')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-4 px-4">
                <h5 class="fw-bold mb-0 text-primary"><i class="fas fa-user-plus me-2"></i> Member Profile</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.members.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter full name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="email@example.com" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="+91 ..." required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Designation</label>
                            <select name="designation_id" class="form-select" required>
                                <option value="">Select Position</option>
                                @foreach($designations as $designation)
                                    <option value="{{ $designation->id }}">{{ $designation->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="form-label fw-semibold">Initial Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Create a temporary password" required>
                        <small class="text-muted">Member can change this after their first login.</small>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.members.index') }}" class="btn btn-light btn-fancy px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-fancy px-5 shadow">Register Member</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
