@extends('layouts.app')

@section('content')
<!-- Premium Breadcrumb Header -->
<div class="page-header py-5 mb-5 position-relative" style="background: url('https://images.unsplash.com/photo-1542810634-71277d95dcbb?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat; min-height: 400px; display: flex; align-items: center; margin-top: -80px;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(17, 17, 17, 0.85); z-index: 1;"></div>
    <div class="container position-relative pb-5 text-center text-white w-100" style="z-index: 5; padding-top: 180px !important; padding-bottom: 20px !important;">
        <span class="badge px-3 py-2 rounded-pill mb-3 fw-bold shadow-sm" style="background-color: var(--primary-color); letter-spacing: 1px;">CONTRIBUTE</span>
        <h1 class="display-4 fw-bolder mb-3 text-uppercase">Make a <span style="color: var(--primary-color);">Donation</span></h1>
        <p class="lead opacity-75 max-w-700 mx-auto">Your small contribution can make a big change in the lives of those who need it most.</p>
    </div>
</div>

<div class="container py-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-white py-4 text-center">
                    <h2 class="fw-bold mb-0">Make a Donation</h2>
                    <p class="mb-0 opacity-75">Your small contribution can make a big change.</p>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('donations.store') }}" method="POST" id="donationForm">
                        @csrf
                        
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Full Name</label>
                                <input type="text" name="donor_name" class="form-control form-control-lg" placeholder="Enter your name" value="{{ auth()->user()->name ?? '' }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Email Address</label>
                                <input type="email" name="donor_email" class="form-control form-control-lg" placeholder="Enter your email" value="{{ auth()->user()->email ?? '' }}" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Select Campaign (Optional)</label>
                            <select name="campaign_id" class="form-select form-select-lg">
                                <option value="">General Donation</option>
                                @foreach($campaigns as $campaign)
                                    <option value="{{ $campaign->id }}" {{ request('campaign') == $campaign->id ? 'selected' : '' }}>{{ $campaign->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Donation Amount (₹)</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light">₹</span>
                                <input type="number" name="amount" class="form-control" placeholder="Enter amount" min="1" required>
                            </div>
                            <div class="mt-2 d-flex gap-2">
                                <button type="button" class="btn btn-sm btn-outline-secondary px-3" onclick="document.getElementsByName('amount')[0].value=500">₹500</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary px-3" onclick="document.getElementsByName('amount')[0].value=1000">₹1000</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary px-3" onclick="document.getElementsByName('amount')[0].value=5000">₹5000</button>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-bold d-block mb-3">Payment Method</label>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="radio" class="btn-check" name="payment_method" id="online" value="online" checked required>
                                    <label class="btn btn-outline-primary btn-lg w-100 py-3 rounded-4" for="online">
                                        <i class="fas fa-credit-card me-2"></i> Online Payment
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" class="btn-check" name="payment_method" id="cash" value="cash" required>
                                    <label class="btn btn-outline-primary btn-lg w-100 py-3 rounded-4" for="cash">
                                        <i class="fas fa-money-bill-wave me-2"></i> Cash Donation
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid shadow">
                            <button type="submit" class="btn btn-primary btn-lg py-3 fw-bold rounded-4">Proceed to Donate</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-light py-4 text-center">
                    <p class="mb-0 text-muted small"><i class="fas fa-lock me-1 text-success"></i> Secure 256-bit SSL Encrypted Payment</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
