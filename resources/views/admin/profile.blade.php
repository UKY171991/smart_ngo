@extends('layouts.admin')

@section('page_title', 'My Profile & Security')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <!-- Change Password Card -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0 text-primary"><i class="fas fa-lock me-2"></i> Update Password</h5>
                <p class="text-muted small mb-0">Ensure your account is using a long, random password to stay secure.</p>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.password.update') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Current Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-key text-muted"></i></span>
                            <input type="password" name="current_password" class="form-control border-start-0" required>
                        </div>
                        @error('current_password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">New Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-shield-alt text-muted"></i></span>
                            <input type="password" name="new_password" class="form-control border-start-0" placeholder="Min 8 characters" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Confirm New Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-check-double text-muted"></i></span>
                            <input type="password" name="new_password_confirmation" class="form-control border-start-0" required>
                        </div>
                        @error('new_password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-fancy py-2 fw-bold shadow">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Account Info Card -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0"><i class="fas fa-info-circle me-2"></i> Account Details</h5>
            </div>
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=4e73df&color=fff" class="rounded-circle me-3" width="60" alt="Admin">
                    <div>
                        <h5 class="fw-bold mb-0 text-dark">{{ $user->name }}</h5>
                        <p class="text-muted small mb-0">{{ $user->email }}</p>
                    </div>
                </div>
                
                <div class="row g-3">
                    <div class="col-6">
                        <label class="text-muted small d-block">Role</label>
                        <span class="badge bg-primary px-3 py-2 rounded-pill fw-bold">{{ strtoupper($user->role) }}</span>
                    </div>
                    <div class="col-6">
                        <label class="text-muted small d-block">Admin Since</label>
                        <span class="fw-bold text-dark">{{ $user->created_at->format('d M, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
