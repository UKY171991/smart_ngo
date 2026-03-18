@extends('layouts.admin')

@section('page_title', 'General Settings')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-4 px-4">
                <h5 class="fw-bold mb-0 text-primary"><i class="fas fa-cog me-2"></i> Website Configuration</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4 text-center">
                        <label class="form-label d-block fw-semibold mb-3">Website Logo</label>
                        <div class="mb-3">
                            <img src="{{ $settings['logo'] ?? 'https://via.placeholder.com/150x50?text=Logo' }}" alt="Logo" class="img-fluid border p-2 rounded bg-light" style="max-height: 80px;">
                        </div>
                        <input type="file" name="logo" class="form-control w-50 mx-auto">
                        <small class="text-muted d-block mt-2">Recommended size: 250x80 pixels. PNG or SVG preferred.</small>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NGO Name</label>
                            <input type="text" name="ngo_name" class="form-control" value="{{ $settings['ngo_name'] ?? 'Smart NGO' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" name="contact_email" class="form-control" value="{{ $settings['contact_email'] ?? 'contact@smartngo.in' }}">
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Phone Number</label>
                            <input type="text" name="contact_phone" class="form-control" value="{{ $settings['contact_phone'] ?? '+91 98765 43210' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Website SEO Title</label>
                            <input type="text" name="seo_title" class="form-control" value="{{ $settings['seo_title'] ?? 'Smart NGO - Empowering Lives' }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Address</label>
                        <textarea name="contact_address" class="form-control" rows="3">{{ $settings['contact_address'] ?? "123 Social Avenue,\nNGO Tower, Mumbai 400001" }}</textarea>
                    </div>

                    <h5 class="fw-bold mb-3 mt-5 text-primary border-bottom pb-2"><i class="fas fa-home me-2"></i> Home & Inner Pages Content</h5>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Hero Title (Home)</label>
                            <input type="text" name="hero_title" class="form-control" value="{{ $settings['hero_title'] ?? 'Change lives with SAMRAT FOUNDATION TRUST' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Hero Subtitle (Home)</label>
                            <input type="text" name="hero_subtitle" class="form-control" value="{{ $settings['hero_subtitle'] ?? 'Join our mission to create sustainable change.' }}">
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Stats: Volunteers</label>
                            <input type="text" name="stats_volunteers" class="form-control" value="{{ $settings['stats_volunteers'] ?? '10k+' }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Stats: Children</label>
                            <input type="text" name="stats_children" class="form-control" value="{{ $settings['stats_children'] ?? '50k+' }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Stats: Villages</label>
                            <input type="text" name="stats_villages" class="form-control" value="{{ $settings['stats_villages'] ?? '150+' }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Stats: Funds</label>
                            <input type="text" name="stats_funds" class="form-control" value="{{ $settings['stats_funds'] ?? '₹5M+' }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">About Us Intro (About Page)</label>
                        <textarea name="about_text" class="form-control" rows="3">{{ $settings['about_text'] ?? "Discover the passion, transparency, and technology behind our mission to transform lives." }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Mission Intro (Mission Page)</label>
                        <textarea name="mission_text" class="form-control" rows="3">{{ $settings['mission_text'] ?? "We don't just dream of a better world; we build the infrastructure to make it a reality for everyone." }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end mt-5">
                        <button type="submit" class="btn btn-primary btn-fancy px-5 shadow">Save All Settings</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
