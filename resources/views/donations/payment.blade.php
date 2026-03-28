@extends('layouts.app')

@section('content')
<!-- Simple Dark Header for Auth -->
<div class="page-header position-relative" style="background: var(--dark-bg); min-height: 150px; margin-top: -80px;"></div>

<div class="container py-5 mb-5 mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-white py-4 text-center border-bottom-0">
                    <h5 class="fw-bold text-muted mb-1 text-uppercase small tracking-widest">Select Payment Method</h5>
                    <h2 class="fw-bold mb-0 text-dark">Amount: ₹{{ number_format($donation->amount, 2) }}</h2>
                    <p class="text-muted small mt-2">Receipt ID: {{ $donation->receipt_number }}</p>
                </div>
                <div class="card-body p-4 pt-0">
                    <div class="list-group rounded-4 overflow-hidden border-0 bg-light p-2">
                        <!-- PhonePe -->
                        <div class="p-3 bg-white mb-2 rounded-4 shadow-sm border border-transparent hover-border-primary">
                            <div class="form-check d-flex align-items-center justify-content-between">
                                <label class="form-check-label w-100 cursor-pointer d-flex align-items-center" for="phonepe">
                                    <div class="bg-purple p-2 rounded-3 me-3">
                                        <i class="fas fa-mobile-alt text-purple fa-lg" style="font-size: 32px;"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0">PhonePe</h6>
                                        <small class="text-muted">UPI, Cards, Netbanking</small>
                                    </div>
                                    <input class="form-check-input ms-auto" type="radio" name="gateway" id="phonepe" value="phonepe" checked>
                                </label>
                            </div>
                        </div>

                        <!-- Razorpay -->
                        <div class="p-3 bg-white mb-2 rounded-4 shadow-sm border border-transparent hover-border-primary">
                            <div class="form-check d-flex align-items-center justify-content-between">
                                <label class="form-check-label w-100 cursor-pointer d-flex align-items-center" for="razorpay">
                                    <div class="bg-blue p-2 rounded-3 me-3">
                                        <i class="fas fa-credit-card text-primary fa-lg" style="font-size: 32px;"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0">Razorpay</h6>
                                        <small class="text-muted">Fast & Secure Payments</small>
                                    </div>
                                    <input class="form-check-input ms-auto" type="radio" name="gateway" id="razorpay" value="razorpay">
                                </label>
                            </div>
                        </div>

                        <!-- PayU Money -->
                        <div class="p-3 bg-white rounded-4 shadow-sm border border-transparent hover-border-primary">
                            <div class="form-check d-flex align-items-center justify-content-between">
                                <label class="form-check-label w-100 cursor-pointer d-flex align-items-center" for="payu">
                                    <div class="bg-green p-2 rounded-3 me-3">
                                        <i class="fas fa-wallet text-success fa-lg" style="font-size: 32px;"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0">PayU Money</h6>
                                        <small class="text-muted">Cards, Wallets, EMI</small>
                                    </div>
                                    <input class="form-check-input ms-auto" type="radio" name="gateway" id="payu" value="payu">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 d-grid gap-2">
                        <button class="btn btn-primary btn-lg py-3 fw-bold rounded-4 shadow" onclick="payNow()">
                            Pay ₹{{ number_format($donation->amount) }} Now
                        </button>
                        <a href="{{ route('donations.index') }}" class="btn btn-link text-muted small">Cancel Transaction</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function payNow() {
        const gateway = document.querySelector('input[name="gateway"]:checked').value;
        alert('Proceeding to ' + gateway + ' payment gateway simulation...');
        // In real app, this would trigger the actual payment sdk or API call
        window.location.href = "{{ route('home') }}";
    }
</script>

<style>
    .cursor-pointer { cursor: pointer; }
    .bg-purple { background-color: #f3e8ff; }
    .bg-blue { background-color: #e0f2fe; }
    .bg-green { background-color: #f0fdf4; }
    .hover-border-primary:hover { border-color: #0d6efd !important; }
    .text-purple { color: #9333ea; }
</style>
@endsection
