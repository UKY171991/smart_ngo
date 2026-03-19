@extends('layouts.admin')

@section('page_title', 'Website Settings')

@section('content')
@if(request()->is('*/footer-links'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    const footerSection = document.getElementById('footer-links');
    if (footerSection) {
        setTimeout(() => {
            footerSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 100);
    }
});
</script>
@endif
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
                            @php
                                $logoUrl = $settings['logo'] ?? null;
                                if ($logoUrl && !filter_var($logoUrl, FILTER_VALIDATE_URL)) {
                                    $logoUrl = Storage::url($logoUrl);
                                }
                            @endphp
                            <img src="{{ $logoUrl ?? 'https://via.placeholder.com/150x50?text=Logo' }}" alt="Logo" class="img-fluid border p-2 rounded bg-light" style="max-height: 80px;">
                        </div>
                        <input type="file" name="logo" class="form-control w-50 mx-auto mb-3">
                        @error('logo')
                            <small class="text-danger d-block mb-2">{{ $message }}</small>
                        @enderror
                        <small class="text-muted d-block">Recommended size: 250x80 pixels. PNG or SVG preferred.</small>
                    </div>

                    <div class="mb-4 text-center">
                        <label class="form-label d-block fw-semibold mb-3">Website Favicon</label>
                        <div class="mb-3">
                            @php
                                $faviconUrl = $settings['favicon'] ?? null;
                                if ($faviconUrl && !filter_var($faviconUrl, FILTER_VALIDATE_URL)) {
                                    $faviconUrl = Storage::url($faviconUrl);
                                }
                            @endphp
                            <img src="{{ $faviconUrl ?? asset('favicon.ico') }}" alt="Favicon" class="img-fluid border p-2 rounded bg-light" style="max-height: 32px;">
                        </div>
                        <input type="file" name="favicon" class="form-control w-50 mx-auto mb-3" accept=".ico,.png,.jpg,.jpeg">
                        @error('favicon')
                            <small class="text-danger d-block mb-2">{{ $message }}</small>
                        @enderror
                        <small class="text-muted d-block">Recommended size: 32x32 pixels. ICO, PNG, JPG formats accepted.</small>
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

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Global SEO Keywords</label>
                            <input type="text" name="seo_keywords" class="form-control" value="{{ $settings['seo_keywords'] ?? 'ngo, charity, donation, social impact, volunteer' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Global SEO Description</label>
                            <textarea name="seo_description" class="form-control" rows="1">{{ $settings['seo_description'] ?? 'Smart NGO is dedicated to sustainable social impact. Join our mission today.' }}</textarea>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Address</label>
                        <textarea name="contact_address" class="form-control" rows="3">{{ $settings['contact_address'] ?? "123 Social Avenue,\nNGO Tower, Mumbai 400001" }}</textarea>
                    </div>

                    <h5 class="fw-bold mb-3 mt-5 text-primary border-bottom pb-2"><i class="fas fa-home me-2"></i> Home & Inner Pages Content</h5>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Hero Badge Text</label>
                            <input type="text" name="hero_badge" class="form-control" value="{{ $settings['hero_badge'] ?? 'REGISTERED NGO' }}">
                            <small class="text-muted d-block">Text shown in the badge above hero title</small>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Hero Title (Home)</label>
                            <input type="text" name="hero_title" class="form-control" value="{{ $settings['hero_title'] ?? 'Change lives with SAMRAT FOUNDATION TRUST' }}">
                        </div>
                        <div class="col-md-4">
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

                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="fw-bold mb-0"><i class="fas fa-bullhorn me-2"></i>Call to Action Section (Home)</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3 mb-4">
                                <div class="col-12">
                                    <label class="form-label fw-semibold">CTA Title</label>
                                    <input type="text" name="cta_title" class="form-control" value="{{ $settings['cta_title'] ?? 'Ready to spark a change?' }}">
                                    <small class="text-muted d-block">Main heading for the call-to-action section</small>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">CTA Description</label>
                                    <textarea name="cta_description" class="form-control" rows="2">{{ $settings['cta_description'] ?? 'Join thousands of members who are making a real difference in the lives of those who need it most.' }}</textarea>
                                    <small class="text-muted d-block">Descriptive text below the CTA title</small>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Primary Button Text</label>
                                    <input type="text" name="cta_primary_button" class="form-control" value="{{ $settings['cta_primary_button'] ?? 'Join Us Today' }}">
                                    <small class="text-muted d-block">Text for the main action button (links to registration)</small>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Secondary Button Text</label>
                                    <input type="text" name="cta_secondary_button" class="form-control" value="{{ $settings['cta_secondary_button'] ?? 'Contact Us' }}">
                                    <small class="text-muted d-block">Text for the secondary button (links to contact page)</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Links Section -->
                    <div id="footer-links" class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="fw-bold mb-0"><i class="fas fa-link me-2"></i>Footer Quick Links</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Quick Link 1 - Text</label>
                                    <input type="text" name="footer_quick_link_1_text" class="form-control" value="{{ $settings['footer_quick_link_1_text'] ?? 'Home' }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Quick Link 1 - URL</label>
                                    <input type="text" name="footer_quick_link_1_url" class="form-control" value="{{ $settings['footer_quick_link_1_url'] ?? route('home') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Quick Link 2 - Text</label>
                                    <input type="text" name="footer_quick_link_2_text" class="form-control" value="{{ $settings['footer_quick_link_2_text'] ?? 'Our Mission' }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Quick Link 2 - URL</label>
                                    <input type="text" name="footer_quick_link_2_url" class="form-control" value="{{ $settings['footer_quick_link_2_url'] ?? route('mission') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Quick Link 3 - Text</label>
                                    <input type="text" name="footer_quick_link_3_text" class="form-control" value="{{ $settings['footer_quick_link_3_text'] ?? 'Donate Now' }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Quick Link 3 - URL</label>
                                    <input type="text" name="footer_quick_link_3_url" class="form-control" value="{{ $settings['footer_quick_link_3_url'] ?? route('donations.index') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Quick Link 4 - Text</label>
                                    <input type="text" name="footer_quick_link_4_text" class="form-control" value="{{ $settings['footer_quick_link_4_text'] ?? 'Volunteer' }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Quick Link 4 - URL</label>
                                    <input type="text" name="footer_quick_link_4_url" class="form-control" value="{{ $settings['footer_quick_link_4_url'] ?? route('register') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Quick Link 5 - Text</label>
                                    <input type="text" name="footer_quick_link_5_text" class="form-control" value="{{ $settings['footer_quick_link_5_text'] ?? 'News & Press' }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Quick Link 5 - URL</label>
                                    <input type="text" name="footer_quick_link_5_url" class="form-control" value="{{ $settings['footer_quick_link_5_url'] ?? route('pages.news') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Social Links Section -->
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="fw-bold mb-0"><i class="fas fa-share-alt me-2"></i>Footer Social Links</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Facebook URL</label>
                                    <input type="text" name="social_facebook" class="form-control" value="{{ $settings['social_facebook'] ?? '#' }}" placeholder="https://facebook.com/yourpage">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Twitter URL</label>
                                    <input type="text" name="social_twitter" class="form-control" value="{{ $settings['social_twitter'] ?? '#' }}" placeholder="https://twitter.com/yourhandle">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Instagram URL</label>
                                    <input type="text" name="social_instagram" class="form-control" value="{{ $settings['social_instagram'] ?? '#' }}" placeholder="https://instagram.com/yourprofile">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">LinkedIn URL</label>
                                    <input type="text" name="social_linkedin" class="form-control" value="{{ $settings['social_linkedin'] ?? '#' }}" placeholder="https://linkedin.com/company/yourcompany">
                                </div>
                            </div>
                            <div class="alert alert-info mt-3">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Note:</strong> Legal pages (Privacy Policy, Terms of Service, Cookie Policy) are now managed through the 
                                <a href="{{ route('admin.pages.index') }}" class="alert-link">Pages Management</a> section.
                            </div>
                        </div>
                    </div>

                    <!-- Editor Settings Section -->
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="fw-bold mb-0"><i class="fas fa-edit me-2"></i>Editor Settings</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold">TinyMCE Editor API Key</label>
                                    <input type="text" name="tinymce_api_key" class="form-control" value="{{ $settings['tinymce_api_key'] ?? '' }}" placeholder="Enter your TinyMCE API key (optional)">
                                    <small class="text-muted d-block mt-2">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Leave empty to use the free GPL version. Get your free API key from 
                                        <a href="https://www.tiny.cloud/auth/signup/" target="_blank" class="text-primary">TinyMCE Cloud</a> 
                                        for premium features like spell checker, advanced plugins, and more.
                                    </small>
                                </div>
                                <div class="col-md-12">
                                    <div class="alert alert-light border">
                                        <h6 class="fw-bold mb-2"><i class="fas fa-key me-2"></i>API Key Benefits:</h6>
                                        <ul class="mb-0 small">
                                            <li>Advanced spell checker and grammar checking</li>
                                            <li>Premium plugins (media embed, enhanced image editing)</li>
                                            <li>Cloud-based services and templates</li>
                                            <li>Advanced collaboration features</li>
                                            <li>Priority support and updates</li>
                                        </ul>
                                        <div class="mt-3">
                                            <a href="https://www.tiny.cloud/pricing/" target="_blank" class="btn btn-sm btn-outline-primary me-2">
                                                <i class="fas fa-external-link-alt me-1"></i> View Pricing
                                            </a>
                                            <a href="https://www.tiny.cloud/auth/signup/" target="_blank" class="btn btn-sm btn-primary">
                                                <i class="fas fa-plus me-1"></i> Get Free API Key
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
