@extends('layouts.app')
@section('meta_title', 'Active Campaigns - Smart NGO')
@section('meta_description', 'Support our active campaigns and help an urgent cause today. Your small contribution powers big dreams. Transparency and efficiency guaranteed.')

@section('content')
<!-- Premium Breadcrumb Header -->
<div class="page-header py-5 mb-5 position-relative" style="background: url('https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat; min-height: 400px; display: flex; align-items: center; margin-top: -80px;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(17, 17, 17, 0.85); z-index: 1;"></div>
    <div class="container position-relative pb-5 text-center text-white w-100" style="z-index: 5; padding-top: 180px !important; padding-bottom: 20px !important;">
        <span class="badge px-3 py-2 rounded-pill mb-3 fw-bold shadow-sm" style="background-color: var(--primary-color); letter-spacing: 1px;">ACTIVE CAUSES</span>
        <h1 class="display-4 fw-bolder mb-3 text-uppercase">Support Our <span style="color: var(--primary-color);">Campaigns</span></h1>
        <p class="lead opacity-75 max-w-700 mx-auto">Your small contribution powers big dreams. Browse our active causes and find one that speaks to your heart.</p>
    </div>
</div>

<div class="container py-5 mb-5">
    <div class="row g-4 justify-content-center">
        @forelse($campaigns as $campaign)
        <div class="col-lg-4 col-md-6 animate-fade-in-up" style="animation-delay: {{ $loop->index * 0.1 }}s">
            <div class="premium-card h-100 border-0 shadow-sm rounded-5 overflow-hidden bg-white">
                <div class="card-img-wrapper position-relative">
                    <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=600&auto=format&fit=crop" class="card-img-top w-100" alt="{{ $campaign->title }}" style="height: 250px; object-fit: cover;">
                    <div class="status-overlay position-absolute top-0 end-0 p-3">
                        <span class="badge bg-white text-primary rounded-pill shadow-sm py-2 px-3 fw-bold">Active</span>
                    </div>
                </div>
                <div class="card-body p-4 p-xl-5">
                    <h4 class="fw-bold mb-3">{{ $campaign->title }}</h4>
                    <p class="text-muted small mb-4 line-clamp-3">{{ $campaign->description }}</p>
                    
                    <div class="funding-status mb-4">
                        <div class="d-flex justify-content-between mb-2 small">
                            <span class="fw-bold text-dark">₹{{ number_format($campaign->current_amount ?? 0) }} raised</span>
                            <span class="text-primary fw-bold">{{ ($campaign->goal_amount > 0) ? round((($campaign->current_amount ?? 0) / $campaign->goal_amount) * 100) : 0 }}%</span>
                        </div>
                        <div class="progress rounded-pill shadow-none border-0" style="height: 12px; background: #f1f5f9;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary rounded-pill" role="progressbar" style="width: {{ ($campaign->goal_amount > 0) ? min(100, (($campaign->current_amount ?? 0) / $campaign->goal_amount) * 100) : 0 }}%"></div>
                        </div>
                        <div class="text-end mt-2">
                            <small class="text-muted fw-semibold">Goal: ₹{{ number_format($campaign->goal_amount) }}</small>
                        </div>
                    </div>
                    
                    <div class="d-grid pt-2">
                        <a href="{{ route('donations.index') }}?campaign_id={{ $campaign->id }}" class="btn btn-primary btn-lg rounded-pill py-3 fw-bold shadow-hover transition hover-scale">Donate Now</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="empty-state p-5 bg-white rounded-5 shadow-sm max-w-600 mx-auto">
                <i class="fas fa-heart-crack fa-4x text-light mb-4"></i>
                <h3 class="fw-bold">No active campaigns</h3>
                <p class="text-muted">We don't have any active campaigns at the moment. Please consider a general donation to support our ongoing work.</p>
                <a href="{{ route('donations.index') }}" class="btn btn-primary rounded-pill px-5 mt-3">General Donation</a>
            </div>
        </div>
        @endforelse
    </div>

    @if($campaigns->hasPages())
    <div class="mt-5 pt-4 d-flex justify-content-center">
        <div class="premium-pagination">
            {{ $campaigns->links('pagination::bootstrap-5') }}
        </div>
    </div>
    @endif
</div>

<style>
    :root {
        --primary-soft: rgba(204, 0, 0, 0.1);
        --primary-color: #cc0000;
        --shadow-premium: 0 20px 40px rgba(0,0,0,0.06);
    }

    body { background-color: #fbfcfe; }

    .header-waves { position: absolute; bottom: -2px; left: 0; width: 100%; z-index: 3; }
    
    .premium-card { transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); border: 1px solid #f1f5f9 !important; }
    .premium-card:hover { transform: translateY(-12px); box-shadow: 0 30px 60px rgba(0,0,0,0.12) !important; border-color: rgba(204,0,0,0.2) !important; }
    
    .card-img-wrapper img { transition: 0.6s; }
    .premium-card:hover .card-img-wrapper img { transform: scale(1.08); }
    
    .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    
    .hover-scale { transition: 0.3s; }
    .hover-scale:hover { transform: scale(1.02); }
    
    .max-w-600 { max-width: 600px; }
    .shadow-hover:hover { box-shadow: 0 10px 25px rgba(204, 0, 0, 0.2); }
    
    .animate-fade-in-up { animation: fadeInUp 0.8s ease-out forwards; opacity: 0; }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Custom Pagination Styling */
    .premium-pagination .page-link { border: none; margin: 0 5px; border-radius: 50% !important; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; color: #64748b; font-weight: 600; transition: 0.3s; }
    .premium-pagination .page-item.active .page-link { background: var(--primary-color); color: white; box-shadow: 0 5px 15px rgba(204, 0, 0, 0.3); }
    .premium-pagination .page-link:hover { background: #f1f5f9; color: var(--primary-color); }
</style>
@endsection
