@extends('layouts.admin')

@section('page_title', 'My Profile & Security')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <!-- Edit Profile Card -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0 text-primary"><i class="fas fa-user-edit me-2"></i> Edit Profile</h5>
                <p class="text-muted small mb-0">Update your personal information and contact details.</p>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Profile Image Section -->
                    <div class="text-center mb-4">
                        <div class="position-relative d-inline-block">
                            <img id="avatarPreview" 
                                 src="{{ $user->avatar ? (filter_var($user->avatar, FILTER_VALIDATE_URL) ? $user->avatar : Storage::url($user->avatar)) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=4e73df&color=fff&size=200' }}" 
                                 alt="Profile Avatar" 
                                 class="rounded-circle border-4 border-white shadow-lg" 
                                 style="width: 120px; height: 120px; object-fit: cover; cursor: pointer;"
                                 onclick="document.getElementById('avatarInput').click()">
                            <div class="position-absolute bottom-0 end-0 bg-primary rounded-circle p-2 shadow" style="cursor: pointer;" onclick="document.getElementById('avatarInput').click()">
                                <i class="fas fa-camera text-white" style="font-size: 14px;"></i>
                            </div>
                        </div>
                        <input type="file" id="avatarInput" name="avatar" class="d-none" accept="image/*" onchange="previewAvatar(event)">
                        <small class="text-muted d-block mt-2">Click to change profile picture (Max: 2MB, JPG/PNG)</small>
                        @error('avatar')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-muted"></i></span>
                                <input type="text" name="name" class="form-control border-start-0" value="{{ $user->name }}" required>
                            </div>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                                <input type="email" name="email" class="form-control border-start-0" value="{{ $user->email }}" required>
                            </div>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-phone text-muted"></i></span>
                                <input type="tel" name="phone" class="form-control border-start-0" value="{{ $user->phone ?? '' }}" placeholder="+91 98765 43210">
                            </div>
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Date of Birth</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-calendar text-muted"></i></span>
                                <input type="date" name="date_of_birth" class="form-control border-start-0" 
                                       value="{{ $user->date_of_birth ? (\Illuminate\Support\Carbon::parse($user->date_of_birth)->format('Y-m-d')) : '' }}"
                                       placeholder="YYYY-MM-DD"
                                       min="1900-01-01" 
                                       max="{{ date('Y-m-d') }}">
                            </div>
                            <small class="text-muted d-block mt-1">Select your date of birth (Format: YYYY-MM-DD)</small>
                            @error('date_of_birth')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label fw-semibold">Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0" style="padding-top: 12px; padding-bottom: 12px;">
                                    <i class="fas fa-map-marker-alt text-muted"></i>
                                </span>
                                <textarea name="address" class="form-control border-start-0" rows="3" placeholder="Enter your complete address">{{ $user->address ?? '' }}</textarea>
                            </div>
                            @error('address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary btn-fancy px-4 shadow">
                            <i class="fas fa-save me-2"></i> Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>

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
                            <i class="fas fa-lock me-2"></i> Update Password
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
                    <img src="{{ $user->avatar ? (filter_var($user->avatar, FILTER_VALIDATE_URL) ? $user->avatar : Storage::url($user->avatar)) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=4e73df&color=fff' }}" 
                         class="rounded-circle me-3" width="60" height="60" alt="Admin" style="object-fit: cover;">
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
                        <label class="text-muted small d-block">Status</label>
                        <span class="badge bg-success px-3 py-2 rounded-pill fw-bold">{{ strtoupper($user->status) }}</span>
                    </div>
                    <div class="col-6">
                        <label class="text-muted small d-block">Admin Since</label>
                        <span class="fw-bold text-dark">{{ $user->created_at->format('d M, Y') }}</span>
                    </div>
                    <div class="col-6">
                        <label class="text-muted small d-block">Last Updated</label>
                        <span class="fw-bold text-dark">{{ $user->updated_at->format('d M, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewAvatar(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatarPreview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
}

// Fix date input display
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.querySelector('input[type="date"]');
    if (dateInput) {
        // Ensure date input has proper styling
        dateInput.style.color = '#495057';
        dateInput.style.backgroundColor = '#fff';
        
        // Add focus event to ensure proper interaction
        dateInput.addEventListener('focus', function() {
            this.showPicker && this.showPicker();
        });
    }
});
</script>
@endsection
