@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="mb-0 fw-bold">Record Manual Donation</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.donations.store') }}" method="POST">
                        @csrf
                        
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Link to Member (Optional)</label>
                                <select name="user_id" id="user_id" class="form-select">
                                    <option value="">-- Guest Donor --</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-phone="{{ $user->phone }}">{{ $user->name }} ({{ $user->email }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Select Campaign</label>
                                <select name="campaign_id" class="form-select">
                                    <option value="">General Fund</option>
                                    @foreach($campaigns as $campaign)
                                        <option value="{{ $campaign->id }}">{{ $campaign->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Donor Name <span class="text-danger">*</span></label>
                                <input type="text" name="donor_name" id="donor_name" class="form-control" required>
                                @error('donor_name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Donor Email <span class="text-danger">*</span></label>
                                <input type="email" name="donor_email" id="donor_email" class="form-control" required>
                                @error('donor_email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Donor Phone</label>
                                <input type="text" name="donor_phone" id="donor_phone" class="form-control">
                                @error('donor_phone')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Amount (INR) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">₹</span>
                                    <input type="number" name="amount" class="form-control" required step="0.01">
                                </div>
                                @error('amount')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Payment Method <span class="text-danger">*</span></label>
                                <select name="payment_method" class="form-select" required>
                                    <option value="cash">Cash</option>
                                    <option value="bank">Bank Transfer</option>
                                    <option value="upi">UPI / QR Scan</option>
                                    <option value="online">Online Gateway</option>
                                </select>
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <div class="form-check form-switch mt-4">
                                    <input class="form-check-input" type="checkbox" name="is_80G" id="is_80G">
                                    <label class="form-check-label fw-bold" for="is_80G">Issue 80G Certificate</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.donations.index') }}" class="btn btn-light rounded-pill px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary rounded-pill px-5">Record Donation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('user_id').addEventListener('change', function() {
        const option = this.options[this.selectedIndex];
        if (option.value) {
            document.getElementById('donor_name').value = option.dataset.name;
            document.getElementById('donor_email').value = option.dataset.email;
            document.getElementById('donor_phone').value = option.dataset.phone || '';
        } else {
            document.getElementById('donor_name').value = '';
            document.getElementById('donor_email').value = '';
            document.getElementById('donor_phone').value = '';
        }
    });
</script>
@endsection
