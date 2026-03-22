@extends('layouts.member')

@section('content')
<div class="container py-4">
    @if($is_birthday)
    <div class="alert border-0 shadow-sm rounded-4 text-white mb-4 position-relative overflow-hidden" 
         style="background: linear-gradient(135deg, #FF6B6B 0%, #FF1E1E 100%);">
        <div class="d-flex align-items-center gap-3 p-3">
            <div class="display-5"><i class="fas fa-birthday-cake animate-bounce"></i></div>
            <div>
                <h4 class="fw-bold mb-1">Happy Birthday, {{ $user->name }}! 🎂</h4>
                <p class="mb-0">Wishing you a fantastic day filled with joy and success. Thank you for your continued support to our mission!</p>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <!-- Sidebar/Profile Summary -->
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm rounded-4 text-center p-4">
                <div class="mb-3">
                    <img src="{{ $user->avatar ? (filter_var($user->avatar, FILTER_VALIDATE_URL) ? $user->avatar : Storage::url($user->avatar)) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&size=128&background=0D6EFD&color=fff&bold=true' }}" 
                         class="rounded-circle shadow-sm" alt="Profile" style="width: 128px; height: 128px; object-fit: cover;">
                </div>
                <h4 class="fw-bold mb-0 text-dark">{{ $user->name }}</h4>
                <div class="badge bg-primary-soft text-primary px-3 py-2 rounded-pill mb-3 mt-2">{{ $user->designation->title ?? 'General Member' }}</div>
                
                <hr class="opacity-10">
                
                <div class="text-start mb-4">
                    <p class="mb-2 d-flex justify-content-between"><strong>Member ID:</strong> <span class="text-primary fw-bold">NGO-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</span></p>
                    <p class="mb-2 d-flex justify-content-between"><strong>Phone:</strong> <span class="text-muted">{{ $user->phone }}</span></p>
                    <p class="mb-0 d-flex flex-column gap-2 mt-3">
                        <strong class="small text-uppercase text-muted">Your Referral Code:</strong> 
                        <span class="badge bg-light text-primary border p-3 border-dashed fs-5">{{ $user->referral_code }}</span>
                    </p>
                </div>
                
                <div class="d-grid gap-2">
                    <a href="{{ route('member.id-card') }}" class="btn btn-primary rounded-pill py-2 fw-bold"><i class="fas fa-id-card me-2"></i> View ID Card</a>
                    <a href="{{ route('member.profile') }}" class="btn btn-outline-light text-dark rounded-pill py-2 fw-bold"><i class="fas fa-user-edit me-2"></i> Edit Profile</a>
                </div>
            </div>
            
            <div class="card border-0 shadow-sm rounded-4 mt-4 p-4 text-center bg-dark text-white position-relative overflow-hidden">
                <div class="position-absolute top-0 end-0 p-3 opacity-10">
                    <i class="fas fa-link fa-4x rotate-45"></i>
                </div>
                <h5 class="mb-3 fw-bold">My Referral Link</h5>
                <p class="small opacity-75 mb-3">Share this link to invite others and help our NGO grow!</p>
                <div class="input-group mb-0">
                    <input type="text" id="referral_link" class="form-control form-control-sm bg-white bg-opacity-10 text-white border-0" value="{{ url('/register?ref=' . $user->referral_code) }}" readonly>
                    <button class="btn btn-primary btn-sm px-3" type="button" onclick="copyReferralLink()">Copy</button>
                </div>
            </div>
        </div>
        
        <!-- Main Dashboard Content -->
        <div class="col-lg-8">
            <div class="row g-4 mb-4">
                <div class="col-md-6 col-xl-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-4 bg-white border-start border-primary border-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-2">
                                <i class="fas fa-hand-holding-heart text-primary"></i>
                            </div>
                            <h6 class="mb-0 fw-bold text-muted text-uppercase small">My Donations</h6>
                        </div>
                        <h2 class="fw-bold text-dark">₹{{ number_format($total_donated, 2) }}</h2>
                        <div class="small text-muted"><i class="fas fa-calendar-alt me-1"></i> Total Contributions</div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-4 bg-white border-start border-success border-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-success bg-opacity-10 p-2 rounded-circle me-2">
                                <i class="fas fa-users text-success"></i>
                            </div>
                            <h6 class="mb-0 fw-bold text-muted text-uppercase small">Referral Count</h6>
                        </div>
                        <h2 class="fw-bold text-dark">{{ $referral_members->count() }}</h2>
                        <div class="small text-muted"><i class="fas fa-user-plus me-1"></i> Joined Members</div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-4 bg-white border-start border-info border-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-info bg-opacity-10 p-2 rounded-circle me-2">
                                <i class="fas fa-coins text-info"></i>
                            </div>
                            <h6 class="mb-0 fw-bold text-muted text-uppercase small">Referral Donations</h6>
                        </div>
                        <h2 class="fw-bold text-dark">₹{{ number_format($referral_donations, 2) }}</h2>
                        <div class="small text-muted"><i class="fas fa-chart-line me-1"></i> Raised via Referrals</div>
                    </div>
                </div>
            </div>
            
            <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-receipt text-primary me-2"></i> My Donation History</h5>
                    <a href="{{ route('donations.index') }}" class="btn btn-primary btn-sm rounded-pill px-3">Donate More</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 px-4">Date</th>
                                <th class="border-0">Amount</th>
                                <th class="border-0">Campaign</th>
                                <th class="border-0">Status</th>
                                <th class="border-0 text-end px-4">Receipt</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($donations as $donation)
                            <tr>
                                <td class="px-4 fw-bold small">{{ $donation->created_at->format('M d, Y') }}</td>
                                <td class="fw-bold text-primary">₹{{ number_format($donation->amount, 2) }}</td>
                                <td class="small">{{ $donation->campaign->title ?? 'General Donation' }}</td>
                                <td>
                                    <span class="badge bg-success-soft text-success rounded-pill px-3 py-2">Completed</span>
                                </td>
                                <td class="text-end px-4">
                                    <a href="{{ route('donations.receipt', $donation->id) }}" class="btn btn-outline-primary btn-sm rounded-pill"><i class="fas fa-download"></i> PDF</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="60" class="mb-3 opacity-50">
                                    <p class="mb-0">You haven't made any donations yet.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-share-alt text-primary me-2"></i> Share My Progress</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-outline-primary rounded-pill flex-grow-1 fw-bold"><i class="fab fa-whatsapp me-1"></i> WhatsApp</a>
                        <a href="#" class="btn btn-outline-info rounded-pill flex-grow-1 fw-bold"><i class="fab fa-facebook me-1"></i> Facebook</a>
                        <a href="#" class="btn btn-outline-dark rounded-pill flex-grow-1 fw-bold"><i class="fab fa-twitter me-1"></i> Twitter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyReferralLink() {
    var copyText = document.getElementById("referral_link");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value);
    
    // Show toast or alert
    alert("Referral link copied!");
}
</script>

<style>
    .bg-primary-soft { background-color: rgba(13, 110, 253, 0.1); }
    .bg-success-soft { background-color: rgba(25, 135, 84, 0.1); }
    .rotate-45 { transform: rotate(45deg); }
    .border-dashed { border-style: dashed !important; }
    .animate-bounce { animation: bounce 2s infinite; }
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
        40% {transform: translateY(-20px);}
        60% {transform: translateY(-10px);}
    }
</style>
@endsection
