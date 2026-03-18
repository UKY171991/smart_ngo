@extends('layouts.admin')

@section('page_title', 'Update Member')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-4 px-4 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0 text-primary"><i class="fas fa-user-edit me-2"></i> Edit Profile</h5>
                <span class="badge bg-light text-muted border px-3 py-2 rounded-pill small">ID: NGO-{{ str_pad($member->id, 5, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.members.update', $member) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $member->name }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" name="email" class="form-control" value="{{ $member->email }}" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Phone Number</label>
                            <input type="text" name="phone" class="form-control" value="{{ $member->phone }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Designation</label>
                            <select name="designation_id" class="form-select" required>
                                @foreach($designations as $designation)
                                    <option value="{{ $designation->id }}" {{ $member->designation_id == $designation->id ? 'selected' : '' }}>
                                        {{ $designation->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-select">
                                <option value="active" {{ $member->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $member->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Update Password (Optional)</label>
                            <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-5">
                        <a href="{{ route('admin.members.index') }}" class="btn btn-light btn-fancy px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-fancy px-5 shadow">Update Member</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
