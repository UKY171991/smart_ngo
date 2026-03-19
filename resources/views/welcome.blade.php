@extends('layouts.app')
@section('meta_title', 'Home - Smart NGO')
@section('meta_description', 'Empowering lives and building futures. Smart NGO provides transparency and technology to create sustainable social change across education, healthcare, and community growth.')
@section('meta_keywords', 'ngo, charity, donation, social impact, volunteer, samrat foundation, india')

@section('content')
<div class="hero-wrapper overflow-hidden position-relative" style="background: url('https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat; min-height: 100vh; display: flex; align-items: center; margin-top: -80px;">
    <!-- Dark overlay as described in reference -->
    <div class="hero-bg-overlay position-absolute top-0 start-0 w-100 h-100" style="background: rgba(17, 17, 17, 0.75); z-index: 1;"></div>
    
    <div class="container position-relative" style="z-index: 2; padding-top: 180px; padding-bottom: 80px;">
        <div class="row align-items-center g-5">
            <div class="col-lg-8 col-xl-7 text-white animate-fade-in-up">
                <span class="badge px-3 py-2 rounded-pill mb-4 shadow-sm" style="background-color: var(--primary-color); font-size: 0.85rem; letter-spacing: 2px;">{{ $siteSettings['hero_badge'] ?? 'REGISTERED NGO' }}</span>
                <h1 class="display-3 fw-bolder mb-4 text-uppercase" style="line-height: 1.1;">
                    {{ $siteSettings['hero_title'] ?? 'Change lives with SAMRAT FOUNDATION TRUST' }}
                </h1>
                <p class="lead mb-5 fs-4 fw-light" style="opacity: 0.9; max-width: 600px;">
                    {{ $siteSettings['hero_subtitle'] ?? 'Join our mission to create sustainable change. We bridge the gap between resources and those who need them most.' }}
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('donations.index') }}" class="btn btn-donate-pulse btn-lg px-5 py-3 rounded-pill fw-bold text-uppercase d-flex align-items-center gap-2">
                        Donate Now <i class="fas fa-heart"></i>
                    </a>
                    <a href="{{ route('about') }}" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill fw-bold text-uppercase">Learn More</a>
                </div>
            </div>
            <div class="col-lg-4 col-xl-5 d-none d-lg-block animate-fade-in-right">
                <!-- Live Ticker / Recent Donations Card -->
                <div class="floating-card p-4 rounded-4 shadow-lg bg-white text-dark ms-auto" style="max-width: 350px;">
                    <div class="d-flex align-items-center gap-2 mb-4 border-bottom pb-3">
                        <div class="badge bg-danger rounded-circle p-2 animate-pulse" style="width: 12px; height: 12px;"></div>
                        <h6 class="fw-bold mb-0 text-uppercase" style="letter-spacing: 1px;">Live Donations</h6>
                    </div>
                    
                    <div class="live-donations-ticker">
                        <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                            <i class="fas fa-user-circle fs-3 text-muted"></i>
                            <div>
                                <p class="mb-0 fw-bold">Anonymous Donor</p>
                                <small class="text-success fw-bold">₹5,000</small>
                            </div>
                            <small class="text-muted ms-auto">2m ago</small>
                        </div>
                        <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                            <i class="fas fa-user-circle fs-3 text-muted"></i>
                            <div>
                                <p class="mb-0 fw-bold">Rahul Verma</p>
                                <small class="text-success fw-bold">₹2,500</small>
                            </div>
                            <small class="text-muted ms-auto">15m ago</small>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <i class="fas fa-user-circle fs-3 text-muted"></i>
                            <div>
                                <p class="mb-0 fw-bold">Priya Patel</p>
                                <small class="text-success fw-bold">₹10,000</small>
                            </div>
                            <small class="text-muted ms-auto">1h ago</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <!-- Programs & Impact Section (Reference: SFT Programs) -->
    <div class="row g-4 mb-5 pb-5">
        @forelse($programs as $index => $program)
            <div class="col-md-4 animate-fade-in" style="animation-delay: {{ $index * 0.1 }}s;">
                <div class="stat-card p-5 rounded-4 shadow-sm text-center border-0 h-100 position-relative overflow-hidden group-hover {{ $program->is_featured ? 'highlight' : '' }}" style="background-color: {{ $program->is_featured ? 'var(--primary-color)' : 'white' }};">
                    @if(!$program->is_featured)
                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-primary-soft opacity-0 transition group-hover-opacity-100"></div>
                    @endif
                    <div class="icon-box-modern {{ $program->is_featured ? 'highlight-icon' : '' }} mb-4 mx-auto position-relative z-index-1">
                        <i class="{{ $program->icon }} fa-2x {{ $program->is_featured ? 'text-white' : 'text-primary' }}"></i>
                    </div>
                    <h3 class="fw-bold mb-3 position-relative z-index-1 {{ $program->is_featured ? 'text-white' : '' }}">{{ $program->title }}</h3>
                    <p class="small position-relative z-index-1 mb-4 {{ $program->is_featured ? 'text-white opacity-75' : 'text-muted' }}">{{ $program->description }}</p>
                    <div class="d-flex align-items-center justify-content-center gap-2 {{ $program->is_featured ? 'text-white' : 'text-dark' }} fw-bold position-relative z-index-1">
                        <h2 class="mb-0 {{ $program->is_featured ? '' : 'text-primary' }}">{{ $program->statistic_number }}</h2>
                        <span class="small text-uppercase {{ $program->is_featured ? 'opacity-75' : 'text-muted' }}">{{ $program->statistic_label }}</span>
                    </div>
                </div>
            </div>
        @empty
            <!-- Fallback to hardcoded cards if no programs exist -->
            <div class="col-md-4 animate-fade-in" style="animation-delay: 0.1s;">
                <div class="stat-card p-5 rounded-4 shadow-sm text-center border-0 h-100 position-relative overflow-hidden group-hover" style="background-color: white;">
                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-primary-soft opacity-0 transition group-hover-opacity-100"></div>
                    <div class="icon-box-modern mb-4 mx-auto position-relative z-index-1">
                        <i class="fas fa-graduation-cap fa-2x text-primary"></i>
                    </div>
                    <h3 class="fw-bold mb-3 position-relative z-index-1">Education Support</h3>
                    <p class="text-muted small position-relative z-index-1 mb-4">Empowering underprivileged children with quality education and necessary supplies.</p>
                    <div class="d-flex align-items-center justify-content-center gap-2 text-dark fw-bold position-relative z-index-1">
                        <h2 class="mb-0 text-primary">500+</h2>
                        <span class="small text-uppercase text-muted">Students<br>Supported</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 animate-fade-in" style="animation-delay: 0.2s;">
                <div class="stat-card p-5 rounded-4 shadow-lg text-center border-0 h-100 highlight position-relative overflow-hidden group-hover">
                    <div class="icon-box-modern highlight-icon mb-4 mx-auto position-relative z-index-1">
                        <i class="fas fa-heartbeat fa-2x text-white"></i>
                    </div>
                    <h3 class="fw-bold mb-3 position-relative z-index-1 text-white">Healthcare Needs</h3>
                    <p class="text-white small opacity-75 position-relative z-index-1 mb-4">Providing accessible healthcare, medical camps, and emergency funds for the needy.</p>
                    <div class="d-flex align-items-center justify-content-center gap-2 text-white fw-bold position-relative z-index-1">
                        <h2 class="mb-0">2.5k+</h2>
                        <span class="small text-uppercase opacity-75">Lives<br>Touched</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 animate-fade-in" style="animation-delay: 0.3s;">
                <div class="stat-card p-5 rounded-4 shadow-sm text-center border-0 h-100 position-relative overflow-hidden group-hover" style="background-color: white;">
                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-primary-soft opacity-0 transition group-hover-opacity-100"></div>
                    <div class="icon-box-modern mb-4 mx-auto position-relative z-index-1">
                        <i class="fas fa-laptop-code fa-2x text-primary"></i>
                    </div>
                    <h3 class="fw-bold mb-3 position-relative z-index-1">Skill Development</h3>
                    <p class="text-muted small position-relative z-index-1 mb-4">Training youth and women with industry-relevant skills to secure a livelihood.</p>
                    <div class="d-flex align-items-center justify-content-center gap-2 text-dark fw-bold position-relative z-index-1">
                        <h2 class="mb-0 text-primary">12+</h2>
                        <span class="small text-uppercase text-muted">Active<br>Programs</span>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Active Causes / Campaigns Grid -->
    <div id="campaigns" class="py-5 mb-5 bg-white rounded-5 shadow-sm p-4 p-md-5 border" style="border-color: #f1f5f9 !important;">
        <div class="d-flex flex-wrap align-items-end justify-content-between mb-5 pb-3 border-bottom">
            <div>
                <h2 class="display-5 fw-bolder mb-2 text-uppercase" style="letter-spacing: -1px;">Support a <span class="text-primary">Cause</span></h2>
                <div class="underline bg-primary mb-3"></div>
                <p class="text-muted max-w-600 mb-0">Help us reach our goals faster by contributing to these urgent fundraising efforts.</p>
            </div>
            <div class="mt-4 mt-md-0">
                <a href="{{ route('pages.campaigns') }}" class="btn btn-outline-dark rounded-pill px-4 fw-bold">View All Causes <i class="fas fa-arrow-right ms-2"></i></a>
            </div>
        </div>
        
        <div class="row g-4">
            @forelse ($campaigns as $campaign)
                <div class="col-lg-4 col-md-6">
                    <div class="cause-card h-100 d-flex flex-column bg-white rounded-4 overflow-hidden border transition hover-shadow">
                        <div class="position-relative">
                            <img src="{{ $campaign->image ? Storage::url($campaign->image) : 'https://images.unsplash.com/photo-1542810634-71277d95dcbb?q=80&w=600&auto=format&fit=crop' }}" class="w-100" style="height: 220px; object-fit: cover;" alt="{{ $campaign->title }}">
                            <div class="position-absolute top-0 start-0 p-3 w-100 d-flex justify-content-between">
                                <span class="badge bg-primary px-3 py-2 rounded-pill fw-bold text-uppercase shadow-sm" style="font-size: 0.7rem;">Education</span>
                                <span class="badge bg-white text-dark px-3 py-2 rounded-pill fw-bold shadow-sm" style="font-size: 0.7rem;"><i class="fas fa-hand-holding-heart text-primary me-1"></i> Urgent</span>
                            </div>
                        </div>
                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <h5 class="fw-bold mb-3 text-dark">{{ $campaign->title }}</h5>
                            <p class="text-muted small mb-4 line-clamp-2">{{ $campaign->description }}</p>
                            
                            <div class="mt-auto">
                                <div class="progress-wrapper mb-3">
                                    <div class="progress rounded-pill bg-light" style="height: 8px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ ($campaign->goal_amount > 0) ? min(100, (($campaign->raised_amount ?? 0) / $campaign->goal_amount) * 100) : 0 }}%"></div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2 small">
                                        <span class="fw-bold text-dark">Raised: <span class="text-primary">₹{{ number_format($campaign->raised_amount ?? 0) }}</span></span>
                                        <span class="text-muted fw-bold">Goal: ₹{{ number_format($campaign->goal_amount) }}</span>
                                    </div>
                                </div>
                                <a href="{{ route('donations.index', ['campaign_id' => $campaign->id]) }}" class="btn btn-outline-primary w-100 py-2 rounded-pill fw-bold text-uppercase btn-cause-donate">Donate Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="empty-state p-5 rounded-5 border bg-light">
                        <i class="fas fa-box-open fa-3x text-muted mb-3 opacity-50"></i>
                        <h4 class="fw-bold text-muted">No Active Causes</h4>
                        <p class="text-muted small">We currently do not have any active campaigns. Please check back later.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Impact & Feed Grid SFT Style -->
    <div class="row g-5 pt-5 pb-5">
        <div class="col-lg-8">
            <div class="d-flex align-items-end justify-content-between mb-4 border-bottom pb-3">
                <div>
                    <h3 class="display-6 fw-bolder mb-1 text-uppercase" style="letter-spacing: -1px;">Latest <span class="text-primary">Impact</span></h3>
                    <p class="text-muted mb-0 small">Stories from the communities we serve</p>
                </div>
                <a href="{{ route('pages.news') }}" class="btn btn-outline-dark rounded-pill px-4 btn-sm fw-bold">See All News</a>
            </div>
            
            <div class="row g-4">
                @forelse ($news as $item)
                    <div class="col-12">
                        <div class="news-card border rounded-4 overflow-hidden bg-white d-flex flex-column flex-md-row group-hover transition hover-shadow">
                            <div class="news-img position-relative" style="background-image: url('{{ $item->image ? Storage::url($item->image) : 'https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?q=80&w=400' }}'); width: 100%; min-width: 250px; height: 100%; min-height: 200px; background-size: cover; background-position: center;">
                                <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-0 transition group-hover-opacity-50"></div>
                            </div>
                            <div class="p-4 flex-grow-1">
                                <div class="d-flex gap-2 mb-2 align-items-center">
                                    <span class="badge bg-primary-soft text-primary rounded-pill px-3"><i class="fas fa-bullhorn me-1"></i> Update</span>
                                    <span class="text-muted small"><i class="far fa-calendar-alt me-1"></i> {{ $item->created_at->format('M d, Y') }}</span>
                                </div>
                                <h4 class="fw-bold mb-3 text-dark">{{ $item->title }}</h4>
                                <p class="text-muted mb-4 small line-clamp-2">{{ Str::limit(strip_tags($item->content), 120) }}</p>
                                <a href="#" class="text-primary fw-bold text-decoration-none d-flex align-items-center gap-2 group-hover-underline">Read Full Story <i class="fas fa-arrow-right small"></i></a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 p-5 text-center bg-light rounded-4 border">
                        <i class="far fa-newspaper fa-2x text-muted mb-3 opacity-50"></i>
                        <p class="text-muted small mb-0">No updates to share today. Stay tuned!</p>
                    </div>
                @endforelse
            </div>
        </div>
        
        <div class="col-lg-4">
            <h3 class="display-6 fw-bolder mb-4 text-uppercase border-bottom pb-3" style="letter-spacing: -1px;">Community <span class="text-primary">Wall</span></h3>
            <div class="activity-container shadow-sm border rounded-4 bg-white p-4">
                <div class="d-flex align-items-center gap-2 mb-4">
                    <span class="badge bg-danger p-2 rounded-circle animate-pulse"></span>
                    <span class="fw-bold text-dark text-uppercase small" style="letter-spacing: 1px;">Live Activity</span>
                </div>
                <div class="activity-scroll custom-scrollbar">
                    @forelse ($activities as $activity)
                        <div class="activity-item d-flex gap-3 mb-3 pb-3 border-bottom border-light">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($activity->user->name ?? 'User') }}&background=CC0000&color=fff&bold=true" class="rounded-circle" width="45" height="45">
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h6 class="fw-bold text-dark mb-0 fs-6">{{ $activity->user->name ?? 'Friend of NGO' }}</h6>
                                    <span class="text-muted small" style="font-size: 0.75rem;">{{ $activity->created_at->diffForHumans(null, true, true) }}</span>
                                </div>
                                <p class="text-muted small mb-0 bg-light p-2 rounded-3 border mt-2">{{ $activity->caption }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="far fa-comment-dots fa-2x text-muted mb-3 opacity-50"></i>
                            <p class="text-muted small">No community activity yet.</p>
                        </div>
                    @endforelse
                </div>
                <div class="text-center mt-4 pt-3 border-top">
                    <a href="{{ route('register') }}" class="btn btn-outline-danger w-100 rounded-pill py-2 fw-bold text-uppercase" style="font-size: 0.85rem;"><i class="fas fa-users me-2"></i> Join Our Community</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Impact By Numbers Section -->
<div class="py-5 bg-light border-top border-bottom position-relative overflow-hidden">
    <div class="container py-5 position-relative z-index-1">
        <div class="row g-4 text-center">
            <div class="col-6 col-md-3 animate-fade-in-up" style="animation-delay: 0.1s;">
                <div class="p-4 rounded-4 bg-white shadow-sm hover-shadow transition">
                    <i class="fas fa-users fa-3x text-primary mb-3 opacity-75"></i>
                    <h2 class="display-5 fw-bold text-dark mb-0">{{ $siteSettings['stats_volunteers'] ?? '10k+' }}</h2>
                    <p class="text-muted fw-semibold text-uppercase small" style="letter-spacing: 1px;">Volunteers</p>
                </div>
            </div>
            <div class="col-6 col-md-3 animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="p-4 rounded-4 bg-white shadow-sm hover-shadow transition">
                    <i class="fas fa-child fa-3x text-primary mb-3 opacity-75"></i>
                    <h2 class="display-5 fw-bold text-dark mb-0">{{ $siteSettings['stats_children'] ?? '50k+' }}</h2>
                    <p class="text-muted fw-semibold text-uppercase small" style="letter-spacing: 1px;">Children Helped</p>
                </div>
            </div>
            <div class="col-6 col-md-3 animate-fade-in-up" style="animation-delay: 0.3s;">
                <div class="p-4 rounded-4 bg-white shadow-sm hover-shadow transition">
                    <i class="fas fa-globe-asia fa-3x text-primary mb-3 opacity-75"></i>
                    <h2 class="display-5 fw-bold text-dark mb-0">{{ $siteSettings['stats_villages'] ?? '150+' }}</h2>
                    <p class="text-muted fw-semibold text-uppercase small" style="letter-spacing: 1px;">Villages Reached</p>
                </div>
            </div>
            <div class="col-6 col-md-3 animate-fade-in-up" style="animation-delay: 0.4s;">
                <div class="p-4 rounded-4 bg-white shadow-sm hover-shadow transition">
                    <i class="fas fa-hand-holding-dollar fa-3x text-primary mb-3 opacity-75"></i>
                    <h2 class="display-5 fw-bold text-dark mb-0">{{ $siteSettings['stats_funds'] ?? '₹5M+' }}</h2>
                    <p class="text-muted fw-semibold text-uppercase small" style="letter-spacing: 1px;">Funds Raised</p>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- CTA Section -->
<div class="container mb-5 pt-5">
    <div class="cta-banner rounded-5 p-5 text-center text-white shadow-2xl position-relative overflow-hidden" style="background: var(--primary-color);">
        <div class="cta-overlay opacity-25 position-absolute top-0 start-0 w-100 h-100" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
        <div class="position-relative" style="z-index: 2;">
            <h2 class="display-4 fw-bold mb-4">{{ $siteSettings['cta_title'] ?? 'Ready to spark a change?' }}</h2>
            <p class="lead mb-5 opacity-75 max-w-600 mx-auto">{{ $siteSettings['cta_description'] ?? 'Join thousands of members who are making a real difference in the lives of those who need it most.' }}</p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="{{ route('register') }}" class="btn btn-white btn-lg px-5 py-3 rounded-pill fw-bold text-primary shadow-lg hover-scale">{{ $siteSettings['cta_primary_button'] ?? 'Join Us Today' }}</a>
                <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill fw-bold hover-scale">{{ $siteSettings['cta_secondary_button'] ?? 'Contact Us' }}</a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Premium Design System */
    :root {
        --primary-soft: rgba(204, 0, 0, 0.1);
        --primary-light: #ff4d4d;
        --secondary-dark: #0f172a;
        --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        --primary-color: #cc0000;
        --primary-hover: #b30000;
    }

    body { background-color: #fbfcfe; letter-spacing: -0.01em; }

    /* Animations */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInRight {
        from { opacity: 0; transform: translateX(40px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes pulse-red {
        0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(204, 0, 0, 0.7); }
        70% { transform: scale(1.05); box-shadow: 0 0 0 15px rgba(204, 0, 0, 0); }
        100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(204, 0, 0, 0); }
    }
    .animate-fade-in-up { animation: fadeInUp 0.8s ease-out forwards; }
    .animate-fade-in-right { animation: fadeInRight 0.8s ease-out forwards; }
    .animate-bounce-slow { animation: bounce 3s infinite; }
    .animate-pulse { animation: pulse-red 2s infinite; }
    .btn-donate-pulse { background-color: var(--primary-color); color: white; border: none; animation: pulse-red 2s infinite; transition: all 0.3s; }
    .btn-donate-pulse:hover { background-color: var(--primary-hover); color: white; transform: translateY(-3px) !important; animation: none; box-shadow: 0 10px 20px rgba(204, 0, 0, 0.3); }
    
    /* Hero Elements */
    .circle { position: absolute; border-radius: 50%; background: linear-gradient(45deg, var(--primary-color), transparent); opacity: 0.1; }
    .circle-1 { width: 400px; height: 400px; top: -100px; right: -50px; }
    .circle-2 { width: 250px; height: 250px; bottom: 50px; left: -50px; }
    
    .hero-image-stack { position: relative; padding: 20px; }
    .main-img { z-index: 1; position: relative; border: 8px solid rgba(255,255,255,0.1); }
    .floating-card { position: absolute; top: 50%; left: -20px; z-index: 2; min-width: 220px; border: none; transform: translateY(-50%); }
    
    /* Hover Effects Group */
    .group-hover:hover .group-hover-opacity-100 { opacity: 1 !important; }
    .group-hover:hover .group-hover-opacity-50 { opacity: 0.5 !important; }
    .group-hover:hover .group-hover-underline { text-decoration: underline !important; }
    .hover-shadow { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-shadow:hover { transform: translateY(-5px); box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important; }
    .z-index-1 { z-index: 1; }
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    
    /* Elements */
    .icon-box-modern { width: 70px; height: 70px; border-radius: 50%; background: rgba(204, 0, 0, 0.1); display: flex; align-items: center; justify-content: center; transition: 0.3s; }
    .highlight-icon { background: rgba(255, 255, 255, 0.2); }
    .stat-card { transition: 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); }
    .stat-card.highlight { background: var(--primary-color); color: white; }
    .stat-card:hover { transform: translateY(-10px); box-shadow: 0 30px 60px -12px rgba(0,0,0,0.1); }
    .icon-circle { width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 14px; }
    
    /* Premium Cards */
    .btn-cause-donate { border-width: 2px; }
    .btn-cause-donate:hover { background: var(--primary-color); color: white; }
    .premium-card { background: white; border-radius: 24px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid #f1f5f9; transition: 0.3s; }
    .premium-card:hover { transform: translateY(-7px); box-shadow: 0 20px 40px rgba(0,0,0,0.08); }
    
    /* Helpers */
    .underline { width: 80px; height: 4px; border-radius: 2px; }
    .bg-primary-soft { background-color: rgba(204, 0, 0, 0.1); }
    .bg-danger-soft { background-color: rgba(220, 53, 69, 0.1); }
    .bg-success-soft { background-color: rgba(25, 135, 84, 0.1); }
    .max-w-600 { max-width: 600px; }
    .hover-scale:hover { transform: scale(1.05); }
    .btn-white { background: white; color: var(--primary-color); }
    .x-small { font-size: 0.7rem; }
    
    /* Scrollbar */
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: var(--primary-color); border-radius: 10px; }
    .activity-scroll { max-height: 480px; overflow-y: auto; overflow-x: hidden; padding-right: 10px; }
    
    .horizontal-premium { transition: 0.3s; }
</style>
@endsection
