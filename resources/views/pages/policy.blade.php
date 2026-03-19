@extends('layouts.app')
@section('meta_title', $title . ' - Smart NGO')
@section('meta_description', 'Read the ' . strtolower($title) . ' for Smart NGO to understand our data protection, user agreements, and compliance standards.')
@section('meta_keywords', 'ngo policy, privacy, terms of service, legal documents, smart ngo')

@section('content')
<!-- Premium Breadcrumb Header -->
<div class="page-header py-5 mb-5 position-relative" style="background: url('https://images.unsplash.com/photo-1589829085413-56de8ae18c73?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat; min-height: 350px; display: flex; align-items: center; margin-top: -80px;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(17, 17, 17, 0.85); z-index: 1;"></div>
    <div class="container position-relative pb-5 text-center text-white w-100" style="z-index: 5; padding-top: 180px !important; padding-bottom: 20px !important;">
        <span class="badge px-3 py-2 rounded-pill mb-3 fw-bold shadow-sm" style="background-color: var(--primary-color); letter-spacing: 1px;">LEGAL</span>
        <h1 class="display-4 fw-bolder mb-3 text-uppercase">{{ $title }}</h1>
        <p class="lead opacity-75 max-w-700 mx-auto">Transparency and trust are at the core of our operations.</p>
    </div>
</div>

<div class="container py-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 shadow-sm bg-white p-5 rounded-4">
            <h2 class="fw-bold mb-4">1. Introduction</h2>
            <p class="text-muted mb-4">Welcome to Smart NGO. We take your privacy and legal obligations very seriously. This {{ strtolower($title) }} explains how we handle operations, data, and user agreements.</p>
            
            <h4 class="fw-bold mb-3">2. Terms of Use</h4>
            <p class="text-muted mb-4">By using our platform, you agree to comply with our community guidelines and local regulations regarding social welfare activities and donations.</p>
            
            <h4 class="fw-bold mb-3">3. Data Protection</h4>
            <p class="text-muted mb-4">We ensure that your personal information and donation history are kept secure and never shared with third parties without explicit consent.</p>
            
            <h4 class="fw-bold mb-3">4. Updates</h4>
            <p class="text-muted">We reserve the right to modify this document at any time. Significant changes will be announced on our News page.</p>
            
            <div class="mt-5 pt-4 border-top">
                <p class="small text-muted mb-0">Last updated: {{ date('M d, Y') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
