@extends('layouts.app')
@section('meta_title', 'Latest News - Smart NGO')
@section('meta_description', 'Stay updated with the latest news, success stories, and impact reports from Smart NGO. See how your donations are making a measurable difference.')

@section('content')
<!-- Premium Breadcrumb Header -->
<div class="page-header py-5 mb-5 position-relative" style="background: url('https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat; min-height: 400px; display: flex; align-items: center; margin-top: -80px;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(17, 17, 17, 0.85); z-index: 1;"></div>
    <div class="container position-relative pb-5 text-center text-white w-100" style="z-index: 5; padding-top: 180px !important; padding-bottom: 20px !important;">
        <span class="badge px-3 py-2 rounded-pill mb-3 fw-bold shadow-sm" style="background-color: var(--primary-color); letter-spacing: 1px;">UPDATES & IMPACT</span>
        <h1 class="display-4 fw-bolder mb-3 text-uppercase">Newsletter & <span style="color: var(--primary-color);">Impact Stories</span></h1>
        <p class="lead opacity-75 max-w-700 mx-auto">Stay connected with our journey. Real stories, real people, and the measurable impact of your generosity.</p>
    </div>
</div>

<div class="container py-5 mb-5">
    <div class="row g-5">
        @forelse($news as $article)
        <div class="col-lg-6 col-xl-4 animate-fade-in-up" style="animation-delay: {{ $loop->index * 0.1 }}s">
            <div class="card h-100 border-0 shadow-sm rounded-5 overflow-hidden bg-white premium-hover">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?q=80&w=600&auto=format&fit=crop" class="card-img-top w-100" alt="{{ $article->title }}" style="height: 240px; object-fit: cover;">
                    <div class="date-overlay position-absolute bottom-0 start-0 m-3">
                        <span class="badge bg-white text-dark rounded-3 px-3 py-2 fw-bold shadow-sm">
                            <i class="far fa-calendar-alt text-primary me-2"></i>{{ $article->created_at->format('d M, Y') }}
                        </span>
                    </div>
                </div>
                <div class="card-body p-4 p-xl-5">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <span class="badge bg-primary-soft text-primary rounded-pill px-3">Press Release</span>
                        <span class="text-muted x-small fw-semibold">{{ $article->created_at->diffForHumans() }}</span>
                    </div>
                    <h4 class="fw-bold mb-3 lh-base">
                        <a href="{{ route('pages.news-detail', $article->slug) }}" class="text-dark text-decoration-none hover-primary">{{ $article->title }}</a>
                    </h4>
                    <p class="text-muted mb-4 line-clamp-4">{{ Str::limit(strip_tags($article->content), 180) }}</p>
                    
                    <div class="mt-auto d-flex align-items-center justify-content-between">
                        <a href="{{ route('pages.news-detail', $article->slug) }}" class="text-primary fw-bold text-decoration-none d-flex align-items-center gap-2 group">
                            <span>Read Full Story</span>
                            <i class="fas fa-arrow-right small group-hover-translate-x"></i>
                        </a>
                        <div class="share-options">
                            <button class="btn btn-icon-sm rounded-circle bg-light border-0"><i class="fas fa-share-alt text-muted small"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="empty-state p-5 bg-white rounded-5 shadow-sm max-w-600 mx-auto">
                <i class="fas fa-newspaper fa-4x text-light mb-4"></i>
                <h3 class="fw-bold">No news articles yet</h3>
                <p class="text-muted">We haven't posted any updates yet. Please stay tuned for our upcoming project reports and mission stories.</p>
            </div>
        </div>
        @endforelse
    </div>

    @if($news->hasPages())
    <div class="mt-5 pt-4 d-flex justify-content-center">
        <div class="premium-pagination">
            {{ $news->links('pagination::bootstrap-5') }}
        </div>
    </div>
    @endif
</div>

<style>
    :root {
        --primary-soft: rgba(204, 0, 0, 0.1);
        --primary-color: #cc0000;
    }

    body { background-color: #fbfcfe; }

    .header-waves { position: absolute; bottom: -2px; left: 0; width: 100%; z-index: 3; }
    
    .premium-hover { transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); border: 1px solid #f1f5f9 !important; }
    .premium-hover:hover { transform: translateY(-10px); box-shadow: 0 30px 60px rgba(0,0,0,0.1) !important; border-color: rgba(204,0,0,0.2) !important; }
    
    .line-clamp-4 { display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; overflow: hidden; }
    .x-small { font-size: 0.75rem; }
    
    .btn-icon-sm { width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; }
    
    .group-hover-translate-x { transition: 0.3s; }
    .group:hover .group-hover-translate-x { transform: translateX(5px); }
    
    .max-w-600 { max-width: 600px; }
    
    .animate-fade-in-up { animation: fadeInUp 0.8s ease-out forwards; opacity: 0; }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Pagination Override */
    .premium-pagination .page-link { border: none; margin: 0 5px; border-radius: 50% !important; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; color: #64748b; font-weight: 600; }
    .premium-pagination .page-item.active .page-link { background: var(--primary-color); color: white; box-shadow: 0 5px 15px rgba(204, 0, 0, 0.2); }
</style>
@endsection
