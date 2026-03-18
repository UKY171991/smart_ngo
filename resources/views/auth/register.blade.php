@extends('layouts.app')

@section('content')
<!-- Simple Dark Header for Auth -->
<div class="page-header position-relative" style="background: var(--dark-bg); min-height: 150px; margin-top: -80px;"></div>

<div class="container py-5 mb-5 mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold">Member Registration</h2>
                        <p class="text-muted">Join our NGO and start contributing today!</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Full Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="designation_id" class="form-label">Select Position/Designation</label>
                            <select id="designation_id" class="form-select @error('designation_id') is-invalid @enderror" name="designation_id" required>
                                <option value="">Select a designation...</option>
                                @forelse ($designations as $designation)
                                    <option value="{{ $designation->id }}">{{ $designation->title }} (Fees: {{ $designation->fees }})</option>
                                @empty
                                    <option value="" disabled>No designations available</option>
                                @endforelse
                            </select>
                            @error('designation_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="password-confirm" class="form-label">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="referred_by_code" class="form-label">Referral Code (Optional)</label>
                            <input id="referred_by_code" type="text" class="form-control @error('referred_by_code') is-invalid @enderror" name="referred_by_code" value="{{ request('ref') ?? old('referred_by_code') }}">
                            @error('referred_by_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Register as Member
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="mb-0 text-muted">Already have an account? <a href="{{ route('login') }}" class="text-primary fw-bold">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
