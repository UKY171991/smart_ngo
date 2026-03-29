@extends('layouts.admin')

@section('page_title', 'Dashboard Overview')

@section('content')
<div class="row g-4 mb-5">
    <!-- Stat Card 1 -->
    <div class="col-xl-3 col-sm-6">
        <div class="card bg-white border-0 h-100 overflow-hidden">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-4">
                        <i class="fas fa-users text-primary fa-lg"></i>
                    </div>
                    <div class="text-success small fw-bold">+12% <i class="fas fa-arrow-up"></i></div>
                </div>
                <h6 class="text-muted fw-bold text-uppercase x-small mb-1">Total Members</h6>
                <h3 class="fw-bold mb-0">{{ $stats['total_members'] }}</h3>
            </div>
            <div class="px-3 pb-3">
                <div class="progress" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 75%"></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Stat Card 2 -->
    <div class="col-xl-3 col-sm-6">
        <div class="card bg-white border-0 h-100 overflow-hidden">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="bg-success bg-opacity-10 p-3 rounded-4">
                        <i class="fas fa-hand-holding-dollar text-success fa-lg"></i>
                    </div>
                </div>
                <h6 class="text-muted fw-bold text-uppercase x-small mb-1">Total Donations</h6>
                <h3 class="fw-bold mb-0">₹{{ number_format($stats['total_donations'], 2) }}</h3>
            </div>
            <div class="px-3 pb-3">
                <p class="mb-0 text-muted x-small">Target reached: 85%</p>
                <div class="progress" style="height: 5px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 85%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat Card 3 -->
    <div class="col-xl-3 col-sm-6">
        <div class="card bg-white border-0 h-100 overflow-hidden">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="bg-warning bg-opacity-10 p-3 rounded-4">
                        <i class="fas fa-question-circle text-warning fa-lg"></i>
                    </div>
                </div>
                <h6 class="text-muted fw-bold text-uppercase x-small mb-1">Pending Enquiries</h6>
                <h3 class="fw-bold mb-0">{{ $stats['pending_enquiries'] }}</h3>
            </div>
            <div class="px-3 pb-3">
                <a href="{{ route('admin.enquiries.index') }}" class="text-warning text-decoration-none x-small fw-bold">View and reply →</a>
            </div>
        </div>
    </div>

    <!-- Stat Card 4 -->
    <div class="col-xl-3 col-sm-6">
        <div class="card bg-white border-0 h-100 overflow-hidden">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="bg-danger bg-opacity-10 p-3 rounded-4">
                        <i class="fas fa-bullhorn text-danger fa-lg"></i>
                    </div>
                </div>
                <h6 class="text-muted fw-bold text-uppercase x-small mb-1">Active Campaigns</h6>
                <h3 class="fw-bold mb-0">{{ \App\Models\Campaign::count() }}</h3>
            </div>
            <div class="px-3 pb-3">
                <p class="mb-0 text-muted x-small">Next: Flood Relief Drive</p>
            </div>
        </div>
    </div>
</div>

<!-- System Maintenance -->
<div class="row g-4 mb-5">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 bg-light">
            <div class="card-body p-4">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-dark bg-opacity-10 p-3 rounded-circle d-none d-sm-block">
                                <i class="fas fa-tools text-dark fa-lg"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">System Maintenance</h6>
                                <p class="text-muted small mb-0">Clear temporary files and verify your storage configuration.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row g-2">
                            <div class="col-12">
                                <form action="{{ route('admin.clear-cache') }}" method="POST" class="w-100">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-fancy w-100 rounded-pill fw-bold shadow-sm py-2">
                                        <i class="fas fa-broom me-2"></i> Cache
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Quick Actions -->
    <div class="col-lg-8">
        <div class="card border-0 mb-4 h-100">
            <div class="card-header d-flex justify-content-between align-items-center bg-white border-bottom-0 pt-4 px-4">
                <h5 class="fw-bold mb-0">NGO Performance Monitor</h5>
                <div class="dropdown">
                    <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">Last 30 Days</button>
                    <ul class="dropdown-menu"></ul>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-6 col-md-3">
                        <a href="{{ route('admin.members.create') }}" class="text-decoration-none">
                            <div class="p-3 border rounded-4 text-center hover-shadow transition">
                                <i class="fas fa-user-plus text-primary fs-3 mb-2"></i>
                                <p class="mb-0 small fw-bold text-dark">Add Member</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="{{ route('admin.donations.create') }}" class="text-decoration-none">
                            <div class="p-3 border rounded-4 text-center hover-shadow transition">
                                <i class="fas fa-receipt text-success fs-3 mb-2"></i>
                                <p class="mb-0 small fw-bold text-dark">New Donation</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="{{ route('admin.news.create') }}" class="text-decoration-none">
                            <div class="p-3 border rounded-4 text-center hover-shadow transition">
                                <i class="fas fa-newspaper text-info fs-3 mb-2"></i>
                                <p class="mb-0 small fw-bold text-dark">Post News</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="{{ route('admin.report.export') }}" class="text-decoration-none">
                            <div class="p-3 border rounded-4 text-center hover-shadow transition">
                                <i class="fas fa-file-invoice text-secondary fs-3 mb-2"></i>
                                <p class="mb-0 small fw-bold text-dark">Export Report</p>
                            </div>
                        </a>
                    </div>
                </div>
                
                <div class="mt-5">
                    <h6 class="fw-bold mb-3">Goal Progress</h6>
                    <label class="small text-muted mb-1">Rural Solar Project (75%)</label>
                    <div class="progress mb-3" style="height: 10px; border-radius: 10px;">
                        <div class="progress-bar bg-primary-gradient shadow-sm" style="width: 75%"></div>
                    </div>
                    <label class="small text-muted mb-1">Membership Drive (45%)</label>
                    <div class="progress mb-1" style="height: 10px; border-radius: 10px;">
                        <div class="progress-bar bg-info shadow-sm" style="width: 45%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="col-lg-4">
        <div class="card border-0 mb-4 h-100">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                <h5 class="fw-bold mb-0">Live Activities</h5>
            </div>
            <div class="card-body p-4">
                @forelse(\App\Models\Activity::latest()->take(4)->get() as $activity)
                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($activity->user->name ?? 'A') }}&background=E2E8F0&color=475569" class="rounded-circle" width="35" alt="Avatar">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="mb-0 small"><strong>{{ $activity->user->name ?? 'Admin' }}</strong> {{ $activity->caption }}</p>
                        <span class="x-small text-muted">{{ $activity->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                @empty
                <p class="text-center text-muted small py-5">No recent activity found.</p>
                @endforelse
                
                <div class="d-grid mt-2">
                    <a href="{{ route('admin.activities.index') }}" class="btn btn-light btn-sm fw-bold">View All Feed</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .x-small { font-size: 0.75rem; }
    .bg-primary-gradient { background: linear-gradient(45deg, #4e73df, #224abe); }
    .hover-shadow:hover { box-shadow: 0 5px 15px rgba(0,0,0,0.05); cursor: pointer; border-color: #4e73df !important; }
    .transition { transition: 0.3s; }
</style>
@endsection
