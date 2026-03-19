@extends('layouts.app')
@section('meta_title', $news->meta_title ?? $news->title)
@section('meta_description', $news->meta_description ?? Str::limit(strip_tags($news->content), 160))
@section('meta_keywords', $news->meta_keywords ?? 'ngo news, impact stories, charity updates')

@section('content')
<section class="py-5 bg-light">
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-8">
                <!-- Main News Content -->
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                    @if($news->image)
                        <img src="{{ asset('storage/' . $news->image) }}" class="card-img-top" alt="{{ $news->title }}" style="max-height: 500px; object-fit: cover;">
                    @else
                        <div class="bg-primary-soft p-5 text-center">
                            <i class="fas fa-newspaper fa-5x text-primary opacity-25"></i>
                        </div>
                    @endif
                    <div class="card-body p-4 p-lg-5">
                        <div class="d-flex align-items-center mb-4 text-muted small">
                            <span class="me-3"><i class="far fa-calendar-alt me-1"></i> {{ $news->created_at->format('M d, Y') }}</span>
                            <span class="badge bg-primary rounded-pill px-3">{{ $news->category ?? 'News' }}</span>
                        </div>
                        <h1 class="display-6 fw-bold mb-4">{{ $news->title }}</h1>
                        <div class="news-content fs-5 text-dark lh-base">
                            {!! $news->content !!}
                        </div>
                        
                        <div class="border-top mt-5 pt-4">
                            <h6 class="fw-bold mb-3">Share this story:</h6>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-outline-primary rounded-pill btn-sm px-3"><i class="fab fa-facebook-f me-2"></i> Facebook</a>
                                <a href="#" class="btn btn-outline-info rounded-pill btn-sm px-3"><i class="fab fa-twitter me-2"></i> Twitter</a>
                                <a href="#" class="btn btn-outline-success rounded-pill btn-sm px-3"><i class="fab fa-whatsapp me-2"></i> WhatsApp</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <!-- Sidebar -->
                <div class="position-sticky" style="top: 100px;">
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4 pb-2 border-bottom">Recent News</h5>
                            @foreach($recentNews as $item)
                            <div class="d-flex mb-3 pb-3 border-bottom-dashed">
                                <div class="flex-shrink-0">
                                    <div class="bg-light rounded-3" style="width: 60px; height: 60px; background-image: url('{{ $item->image ? asset('storage/'.$item->image) : 'https://via.placeholder.com/60' }}'); background-size: cover; background-position: center;"></div>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-1 fw-bold">
                                        <a href="{{ route('pages.news-detail', $item->slug) }}" class="text-dark text-decoration-none hover-primary">{{ Str::limit($item->title, 40) }}</a>
                                    </h6>
                                    <small class="text-muted">{{ $item->created_at->format('M d, Y') }}</small>
                                </div>
                            </div>
                            @endforeach
                            <a href="{{ route('pages.news') }}" class="btn btn-light w-100 rounded-pill mt-2">View All News</a>
                        </div>
                    </div>
                    
                    <div class="card border-0 bg-primary rounded-4 shadow-sm text-white overflow-hidden">
                        <div class="card-body p-4 text-center position-relative">
                            <div class="position-absolute top-0 end-0 p-3 opacity-25">
                                <i class="fas fa-hand-holding-heart fa-4x"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Support Our Cause</h4>
                            <p class="mb-4 small opacity-75">Your small contribution can bring a massive change in someone's life.</p>
                            <a href="{{ route('donations.index') }}" class="btn btn-white text-primary fw-bold rounded-pill px-4">Donate Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .bg-primary-soft { background-color: rgba(13, 110, 253, 0.05); }
    .border-bottom-dashed { border-bottom: 1px dashed #dee2e6; }
    .hover-primary:hover { color: #0d6efd !important; }
    .news-content p { margin-bottom: 1.5rem; }
    .btn-white { background: #fff; color: #0d6efd; }
    .btn-white:hover { background: #f8f9fa; }
</style>
@endsection
