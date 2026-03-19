@extends('layouts.app')

@section('meta_title', $page->meta_title ?? $page->title)
@section('meta_description', $page->meta_description ?? 'Smart NGO - ' . $page->title)
@section('meta_keywords', $page->meta_keywords ?? 'smart ngo, charity, social impact')

@section('content')
<section class="hero-section bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-3">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">Home</a></li>
                        <li class="breadcrumb-item active text-white">{{ $page->title }}</li>
                    </ol>
                </nav>
                <h1 class="display-4 fw-bold text-center mb-0">{{ $page->title }}</h1>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4 p-lg-5">
                        <div class="page-content">
                            {!! $page->content !!}
                        </div>
                        
                        <div class="mt-5 pt-4 border-top">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="text-muted small mb-0">
                                        <i class="fas fa-calendar-alt me-2"></i>
                                        Last updated: {{ $page->updated_at->format('F j, Y') }}
                                    </p>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <a href="{{ route('home') }}" class="btn btn-outline-primary btn-sm rounded-pill">
                                        <i class="fas fa-arrow-left me-2"></i> Back to Home
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Actions -->
                <div class="row mt-4">
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('privacy') }}" class="card text-decoration-none h-100 border-0 shadow-sm rounded-4 hover-shadow transition">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-shield-alt text-primary fs-2 mb-3"></i>
                                <h6 class="fw-bold mb-2">Privacy Policy</h6>
                                <p class="text-muted small mb-0">How we protect your data</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('terms') }}" class="card text-decoration-none h-100 border-0 shadow-sm rounded-4 hover-shadow transition">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-file-contract text-success fs-2 mb-3"></i>
                                <h6 class="fw-bold mb-2">Terms of Service</h6>
                                <p class="text-muted small mb-0">Terms and conditions</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('cookies') }}" class="card text-decoration-none h-100 border-0 shadow-sm rounded-4 hover-shadow transition">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-cookie text-info fs-2 mb-3"></i>
                                <h6 class="fw-bold mb-2">Cookie Policy</h6>
                                <p class="text-muted small mb-0">Cookie usage information</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
