@extends('layouts.app')
@section('meta_title', 'Our Mission - Smart NGO')
@section('meta_description', 'Our mission and vision for a better world. We are dedicated to providing sustainable technology and community action to ensure equal opportunities for all.')
@section('meta_keywords', 'ngo vision, social mission, 2030 goals, community action')

@section('content')
<!-- Visionary Header -->
<div class="page-header py-5 mb-5 position-relative" style="background: url('https://images.unsplash.com/photo-1593113565637-bf7f91ea6b97?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat; min-height: 400px; display: flex; align-items: center; margin-top: -80px;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(17, 17, 17, 0.85); z-index: 1;"></div>
    <div class="container position-relative pb-5 text-center text-white w-100" style="z-index: 5; padding-top: 180px !important; padding-bottom: 20px !important;">
        <span class="badge px-3 py-2 rounded-pill mb-3 fw-bold shadow-sm" style="background-color: var(--primary-color); letter-spacing: 1px;">OUR PATH</span>
        <h1 class="display-4 fw-bolder mb-3 text-uppercase">Our <span style="color: var(--primary-color);">Mission & Vision</span></h1>
        <p class="lead opacity-75 max-w-700 mx-auto">{{ $siteSettings['mission_text'] ?? "We don't just dream of a better world; we build the infrastructure to make it a reality for everyone." }}</p>
    </div>
</div>

<div class="container py-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Strategic Goal Card -->
            <div class="strategy-card p-5 rounded-5 shadow-2xl bg-white text-center mb-5 animate-fade-in-up">
                <div class="d-inline-flex align-items-center justify-content-center bg-primary-soft text-primary rounded-circle mb-4" style="width: 100px; height: 100px;">
                    <i class="fas fa-bullseye fa-3x"></i>
                </div>
                <h2 class="display-5 fw-bold mb-3">Vision <span class="text-primary">2030</span></h2>
                <div class="underline bg-primary mx-auto mb-4"></div>
                <p class="text-muted fs-4 leading-relaxed max-w-800 mx-auto">To create a world where every human being has access to basic needs, quality education, and equal opportunities for growth through sustainable technology and community action.</p>
            </div>

            <div class="row g-4 mb-5 pb-5">
                <div class="col-md-4 animate-fade-in-up" style="animation-delay: 0.1s">
                    <div class="mission-pill p-5 rounded-5 shadow-hover text-center h-100 bg-white">
                        <div class="icon-blob bg-primary-soft text-primary mb-4 mx-auto">
                            <i class="fas fa-graduation-cap fa-2x"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Education</h4>
                        <p class="text-muted small mb-0">Bridging the digital divide and providing modern educational resources to rural territories.</p>
                    </div>
                </div>
                <div class="col-md-4 animate-fade-in-up" style="animation-delay: 0.2s">
                    <div class="mission-pill p-5 rounded-5 shadow-hover text-center h-100 bg-white">
                        <div class="icon-blob bg-success-soft text-success mb-4 mx-auto">
                            <i class="fas fa-heartbeat fa-2x"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Healthcare</h4>
                        <p class="text-muted small mb-0">Democratizing access to basic health services through mobile clinics and digital health tracking.</p>
                    </div>
                </div>
                <div class="col-md-4 animate-fade-in-up" style="animation-delay: 0.3s">
                    <div class="mission-pill p-5 rounded-5 shadow-hover text-center h-100 bg-white">
                        <div class="icon-blob bg-warning-soft text-warning mb-4 mx-auto">
                            <i class="fas fa-seedling fa-2x"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Sustainability</h4>
                        <p class="text-muted small mb-0">Implementing circular economy practices within local communities to protect our environment.</p>
                    </div>
                </div>
            </div>

            <!-- Deep Dive Section -->
            <div class="impact-deep-dive pt-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 order-2 order-lg-1 animate-fade-in-left">
                        <h3 class="display-6 fw-bold mb-4">Why We Approach Social Work <span class="text-primary">Differently</span></h3>
                        <p class="text-muted mb-4 fs-5">We believe that institutional support should be as efficient as a modern tech company, but with the heart of a social worker.</p>
                        <ul class="list-unstyled custom-list mb-5">
                            <li class="mb-3 d-flex align-items-center gap-3">
                                <i class="fas fa-check-circle text-primary shadow-sm"></i>
                                <span class="fw-semibold text-dark">Data-driven intervention strategies</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center gap-3">
                                <i class="fas fa-check-circle text-primary shadow-sm"></i>
                                <span class="fw-semibold text-dark">Minimal overhead, maximum delivery</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center gap-3">
                                <i class="fas fa-check-circle text-primary shadow-sm"></i>
                                <span class="fw-semibold text-dark">Global reach with local grassroots impact</span>
                            </li>
                        </ul>
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5 py-3 rounded-pill fw-bold shadow-hover hover-scale">Join Our Movement</a>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 animate-fade-in-right">
                        <div class="img-frame-premium position-relative p-4">
                            <div class="frame-bg bg-primary-soft position-absolute top-0 start-0 w-100 h-100 rounded-5"></div>
                            <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=600&auto=format&fit=crop" class="img-fluid rounded-5 shadow-2xl position-relative z-1" alt="Mission Context">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-soft: rgba(204, 0, 0, 0.1);
        --primary-color: #cc0000;
        --success-soft: rgba(25, 135, 84, 0.1);
        --warning-soft: rgba(255, 193, 7, 0.1);
        --shadow-2xl: 0 30px 60px -12px rgba(204, 0, 0, 0.15);
    }

    body { background-color: #fbfcfe; }

    .header-waves { position: absolute; bottom: -2px; left: 0; width: 100%; z-index: 3; }
    .max-w-700 { max-width: 700px; }
    .max-w-800 { max-width: 800px; }
    .underline { width: 60px; height: 4px; border-radius: 2px; }
    
    .strategy-card { border: 1px solid #f1f5f9; transition: 0.3s; }
    .mission-pill { border: 1px solid #f1f5f9; transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); }
    .mission-pill:hover { transform: translateY(-10px); border-color: rgba(204, 0, 0, 0.2); box-shadow: 0 20px 40px rgba(0,0,0,0.06); }
    
    .icon-blob { width: 70px; height: 70px; display: flex; align-items: center; justify-content: center; border-radius: 24px; transform: rotate(5deg); transition: 0.3s; }
    .mission-pill:hover .icon-blob { transform: rotate(0deg) scale(1.1); }
    
    .custom-list i { font-size: 1.2rem; }
    .img-frame-premium .frame-bg { transform: rotate(-3deg); }
    
    .animate-fade-in-up { animation: fadeInUp 0.8s ease-out forwards; opacity: 0; }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fade-in-left { animation: fadeInLeft 0.8s ease-out forwards; opacity: 0; }
    @keyframes fadeInLeft {
        from { opacity: 0; transform: translateX(-40px); }
        to { opacity: 1; transform: translateX(0); }
    }
    
    .animate-fade-in-right { animation: fadeInRight 0.8s ease-out forwards; opacity: 0; }
    @keyframes fadeInRight {
        from { opacity: 0; transform: translateX(40px); }
        to { opacity: 1; transform: translateX(0); }
    }
</style>
@endsection
