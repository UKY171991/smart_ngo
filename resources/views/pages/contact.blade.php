@extends('layouts.app')
@section('meta_title', 'Contact Us - Smart NGO')
@section('meta_description', 'Get in touch with Smart NGO. We\'re here to help and listen to your ideas for social change. Visit us or reach out via phone/email.')

@section('content')
<!-- Contact Specific Header -->
<div class="page-header py-5 mb-5 position-relative" style="background: url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat; min-height: 400px; display: flex; align-items: center; margin-top: -80px;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(17, 17, 17, 0.85); z-index: 1;"></div>
    <div class="container position-relative pb-5 text-center text-white w-100" style="z-index: 5; padding-top: 180px !important; padding-bottom: 20px !important;">
        <span class="badge px-3 py-2 rounded-pill mb-3 fw-bold shadow-sm" style="background-color: var(--primary-color); letter-spacing: 1px;">CONTACT US</span>
        <h1 class="display-4 fw-bolder mb-3 text-uppercase">Get in <span style="color: var(--primary-color);">Touch</span></h1>
        <p class="lead opacity-75 max-w-700 mx-auto">Have questions or want to collaborate? We're here to help and listen to your ideas for social change.</p>
    </div>
</div>

<div class="container py-5 mb-5">
    <div class="row g-5">
        <!-- Contact Form Column -->
        <div class="col-lg-7 animate-fade-in-up">
            <div class="contact-card p-4 p-md-5 rounded-5 bg-white shadow-2xl border-0 overflow-hidden position-relative">
                <div class="position-absolute top-0 end-0 p-4 opacity-10">
                    <i class="fas fa-paper-plane fa-5x text-primary rotate-15"></i>
                </div>
                
                @if(session('success'))
                    <div class="alert alert-success border-0 rounded-4 p-4 mb-4 animate-bounce-soft">
                        <div class="d-flex align-items-center gap-3">
                            <i class="fas fa-check-circle fa-2x"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Message Sent Successfully!</h6>
                                <p class="small mb-0 opacity-75">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <h3 class="fw-bold mb-4">Send a <span class="text-primary">Message</span></h3>
                <form action="{{ route('enquiries.submit') }}" method="POST" class="contact-form">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-floating mb-1">
                                <input type="text" name="name" class="form-control rounded-4 border-light bg-light focus-white" id="nameInput" placeholder="Full Name" required>
                                <label for="nameInput">Full Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-1">
                                <input type="email" name="email" class="form-control rounded-4 border-light bg-light focus-white" id="emailInput" placeholder="john@example.com" required>
                                <label for="emailInput">Email Address</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating mb-1">
                                <input type="text" name="subject" class="form-control rounded-4 border-light bg-light focus-white" id="subjectInput" placeholder="Subject" required>
                                <label for="subjectInput">Subject / Purpose</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating mb-1">
                                <textarea name="message" class="form-control rounded-4 border-light bg-light focus-white" id="messageInput" placeholder="Your Message" style="height: 180px" required></textarea>
                                <label for="messageInput">How can we help you?</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary w-100 py-3 rounded-4 fw-bold shadow-lg hover-scale transition d-flex align-items-center justify-content-center gap-2">
                                <span>Submit Message</span>
                                <i class="fas fa-paper-plane small"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Contact Info Column -->
        <div class="col-lg-5 animate-fade-in-right">
            <div class="ps-lg-4">
                <h3 class="fw-bold mb-4">Office <span class="text-primary">Information</span></h3>
                <p class="text-muted mb-5">Visit our headquarters or reach out via phone/email. Our team usually responds within 24 business hours.</p>
                
                <div class="info-grid row g-4 mb-5">
                    <div class="col-12">
                        <div class="info-item p-4 rounded-5 bg-white shadow-sm border-0 d-flex gap-4 align-items-center transition hover-lift">
                            <div class="info-icon bg-primary-soft text-primary rounded-circle">
                                <i class="fas fa-location-dot"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Our Location</h6>
                                <p class="text-muted small mb-0">{{ $siteSettings['contact_address'] ?? '123 Social Avenue, Mumbai 400001' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="info-item p-4 rounded-5 bg-white shadow-sm border-0 d-flex gap-4 align-items-center transition hover-lift">
                            <div class="info-icon bg-success-soft text-success rounded-circle">
                                <i class="fas fa-phone-volume"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Call Support</h6>
                                <p class="text-muted small mb-0">{{ $siteSettings['contact_phone'] ?? '+91 98765 43210' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="info-item p-4 rounded-5 bg-white shadow-sm border-0 d-flex gap-4 align-items-center transition hover-lift">
                            <div class="info-icon bg-warning-soft text-warning rounded-circle">
                                <i class="fas fa-envelope-open-text"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Official Email</h6>
                                <p class="text-muted small mb-0">{{ $siteSettings['contact_email'] ?? 'contact@smartngo.in' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="map-card rounded-5 overflow-hidden shadow-sm shadow-hover transition" style="height: 300px;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d120677.30949786963!2d72.825!3d19.076!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c6306644edc1%3A0x5da4ed8f8d648c69!2sMumbai%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1620000000000!5m2!1sen!2sin" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
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
        --shadow-2xl: 0 30px 60px -12px rgba(204, 0, 0, 0.15);
    }

    body { background-color: #fbfcfe; }

    /* Forms */
    .focus-white:focus { background-color: white !important; border-color: var(--primary-color) !important; box-shadow: 0 0 0 0.25rem rgba(204, 0, 0, 0.1); }
    .form-floating > .form-control { border: 1px solid transparent; }
    
    /* Contact Specifics */
    .header-waves { position: absolute; bottom: -2px; left: 0; width: 100%; z-index: 3; pointer-events: none; }
    .info-icon { width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 20px; }
    .rotate-15 { transform: rotate(15deg); }
    .ls-1 { letter-spacing: 1px; }
    .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,0.05) !important; }
    
    .shadow-2xl { box-shadow: var(--shadow-2xl); }
    
    .animate-bounce-soft { animation: bounceSoft 0.5s ease-out; }
    @keyframes bounceSoft {
        0% { transform: scale(0.9); opacity: 0; }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); opacity: 1; }
    }
    
    .animate-fade-in-up { animation: fadeInUp 0.8s ease-out forwards; }
    .animate-fade-in-right { animation: fadeInRight 0.8s ease-out forwards; }
    
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInRight {
        from { opacity: 0; transform: translateX(40px); }
        to { opacity: 1; transform: translateX(0); }
    }
</style>
@endsection
