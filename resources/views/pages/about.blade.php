@extends('layouts.app')
@section('meta_title', 'About Us - Smart NGO')
@section('meta_description', 'Discover the passion, transparency, and technology behind our mission to transform lives. Read about our journey and the vision that drives our NGO.')
@section('meta_keywords', 'about ngo, mission, transparency, social impact journey')

@section('content')
<!-- Premium Breadcrumb Header -->
<div class="page-header py-5 mb-5 position-relative" style="background: url('https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat; min-height: 400px; display: flex; align-items: center; margin-top: -80px;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(17, 17, 17, 0.85); z-index: 1;"></div>
    <div class="container position-relative pb-5 text-center text-white w-100" style="z-index: 5; padding-top: 180px !important; padding-bottom: 20px !important;">
        <span class="badge px-3 py-2 rounded-pill mb-3 fw-bold shadow-sm" style="background-color: var(--primary-color); letter-spacing: 1px;">ABOUT {{ strtoupper($siteSettings['ngo_name'] ?? config('app.name', 'SAMRAT FOUNDATION')) }}</span>
        <h1 class="display-4 fw-bolder mb-3 text-uppercase">Who <span style="color: var(--primary-color);">We Are</span></h1>
        <p class="lead opacity-75 max-w-700 mx-auto">{{ $siteSettings['about_text'] ?? 'Discover the passion, transparency, and technology behind our mission to transform lives.' }}</p>
    </div>
</div>

<div class="container py-5">
    <div class="row g-5 align-items-center mb-5 pb-5">
        <div class="col-lg-6 position-relative animate-fade-in-left">
            <div class="about-img-stack">
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=800&auto=format&fit=crop" class="img-fluid rounded-4 shadow-2xl main-image" alt="Our Team">
                <div class="experience-badge bg-primary text-white p-4 rounded-4 shadow-lg d-flex align-items-center gap-3">
                    <span class="display-4 fw-bold">10+</span>
                    <span class="fw-semibold">Years of <br>Social Impact</span>
                </div>
            </div>
        </div>
        <div class="col-lg-6 animate-fade-in-right">
            <h2 class="display-5 fw-bold mb-4">Our Commitment to <span class="text-primary">Measurable Change</span></h2>
            <p class="text-muted mb-4 fs-5 leading-relaxed">Founded with a vision to redefine social welfare, Smart NGO bridges the gap between those who want to help and those in need. We believe that compassion should be paired with uncompromising transparency.</p>
            
            <div class="feature-list mt-5">
                <div class="feature-item d-flex gap-4 mb-4">
                    <div class="feature-icon bg-primary-soft text-primary rounded-circle">
                        <i class="fas fa-eye fa-lg"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Total Transparency</h5>
                        <p class="text-muted small mb-0">Track every penny from donation to delivery. Our real-time reports ensure your trust is honored.</p>
                    </div>
                </div>
                <div class="feature-item d-flex gap-4 mb-4">
                    <div class="feature-icon bg-success-soft text-success rounded-circle">
                        <i class="fas fa-users-gear fa-lg"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Community Driven</h5>
                        <p class="text-muted small mb-0">We don't just provide aid; we build self-sustaining communities through localized leadership.</p>
                    </div>
                </div>
                <div class="feature-item d-flex gap-4">
                    <div class="feature-icon bg-warning-soft text-warning rounded-circle">
                        <i class="fas fa-bolt fa-lg"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Efficient technology</h5>
                        <p class="text-muted small mb-0">Leveraging digital platforms to reduce overhead, ensuring 95% of funds go directly to the cause.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mission Context Section -->
<div class="container-fluid py-5 bg-white border-top border-bottom">
    <div class="container py-5">
        <div class="row justify-content-center text-center mb-5 pb-3">
            <div class="col-lg-8">
                <h2 class="display-6 fw-bold mb-4">Core Values That <span class="text-primary">Drive Us</span></h2>
                <div class="underline bg-primary mx-auto mb-4"></div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="value-card p-5 rounded-4 shadow-hover text-center h-100">
                    <div class="value-icon mb-4"><i class="fas fa-shield-halved fa-2x text-primary op-8"></i></div>
                    <h4 class="fw-bold mb-3 text-dark">Integrity</h4>
                    <p class="text-muted mb-0 small">We operate with honesty and honor, holding ourselves accountable to our donors and beneficiaries alike.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="value-card p-5 rounded-4 shadow-hover text-center h-100 active">
                    <div class="value-icon mb-4"><i class="fas fa-lightbulb fa-2x text-white op-8"></i></div>
                    <h4 class="fw-bold mb-3 text-white">Innovation</h4>
                    <p class="text-white op-8 mb-0 small">Using modern tools and data to solve age-old social problems more effectively every single day.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="value-card p-5 rounded-4 shadow-hover text-center h-100">
                    <div class="value-icon mb-4"><i class="fas fa-hands-holding-child fa-2x text-primary op-8"></i></div>
                    <h4 class="fw-bold mb-3 text-dark">Empathy</h4>
                    <p class="text-muted mb-0 small">At the heart of every decision is a deep understanding and respect for human dignity and diversity.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-soft: rgba(204, 0, 0, 0.1);
        --success-soft: rgba(25, 135, 84, 0.1);
        --warning-soft: rgba(255, 193, 7, 0.1);
        --primary-color: #cc0000;
        --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    body { background-color: #fbfcfe; }

    .max-w-700 { max-width: 700px; }
    .header-waves { position: absolute; bottom: -2px; left: 0; width: 100%; z-index: 3; }
    
    .about-img-stack { position: relative; padding: 30px; }
    .main-image { position: relative; z-index: 1; border: 10px solid white; }
    .experience-badge { position: absolute; bottom: 0; right: 0; z-index: 2; min-width: 250px; }
    
    .feature-icon { width: 55px; height: 55px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    
    .value-card { background: #f8fafc; border: 1px solid #f1f5f9; transition: 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); }
    .value-card.active { background: var(--primary-color); color: white; border: none; transform: scale(1.05); box-shadow: 0 30px 60px rgba(204, 0, 0, 0.25); }
    .value-card:hover:not(.active) { transform: translateY(-10px); background: white; box-shadow: 0 20px 40px rgba(0,0,0,0.05); }
    
    .op-2 { opacity: 0.8; }
    .op-8 { opacity: 0.8; }
    .underline { width: 60px; height: 4px; border-radius: 2px; }
    
    .animate-fade-in-left { animation: fadeInLeft 0.8s ease-out forwards; }
    .animate-fade-in-right { animation: fadeInRight 0.8s ease-out forwards; }
    
    @keyframes fadeInLeft {
        from { opacity: 0; transform: translateX(-40px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes fadeInRight {
        from { opacity: 0; transform: translateX(40px); }
        to { opacity: 1; transform: translateX(0); }
    }
</style>
@endsection
