<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', $siteSettings['seo_description'] ?? 'Smart NGO is dedicated to sustainable social impact. Join our mission today.')">

    <title>@yield('meta_title', $siteSettings['seo_title'] ?? config('app.name', 'Smart NGO'))</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        :root {
            --primary-color: #cc0000;
            --primary-hover: #b30000;
            --dark-bg: #111111;
        }
        body { font-family: 'Outfit', sans-serif; background-color: #f8fafc; }
        .footer { background-color: var(--dark-bg); color: #94a3b8; border-top: 1px solid rgba(255,255,255,0.05); }
        .footer h5 { color: #f8fafc; font-weight: 700; }
        .footer-link { color: #94a3b8; text-decoration: none; transition: 0.3s; }
        .footer-link:hover { color: var(--primary-color); padding-left: 5px; }
        .social-icon { width: 35px; height: 35px; background: rgba(255,255,255,0.05); display: flex; align-items: center; justify-content: center; border-radius: 50%; color: #fff; text-decoration: none; transition: 0.3s; }
        .social-icon:hover { background: var(--primary-color); transform: translateY(-3px); color: #fff; }
        .newsletter-input { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #fff; }
        .newsletter-input:focus { background: rgba(255,255,255,0.1); border-color: var(--primary-color); color: #fff; box-shadow: none; }
        
        /* Navbar Styles */
        .navbar { transition: all 0.4s; z-index: 1050; background-color: transparent; }
        .navbar.sticky { background: var(--dark-bg); box-shadow: 0 4px 20px rgba(0,0,0,0.1); padding-top: 10px; padding-bottom: 10px; }
        .navbar-brand { font-weight: 800; color: #ffffff !important; font-size: 1.5rem; text-transform: uppercase; letter-spacing: 1px; }
        .navbar-brand i { color: var(--primary-color); }
        .nav-link { position: relative; color: #ffffff !important; font-weight: 600; text-transform: uppercase; font-size: 0.9rem; margin: 0 5px; }
        .nav-link::after { content: ''; position: absolute; bottom: 0; left: 50%; width: 0; height: 2px; background: var(--primary-color); transition: 0.3s; transform: translateX(-50%); }
        .nav-link:hover::after, .nav-link.active::after { width: 100%; }
        .nav-link:hover { color: var(--primary-color) !important; }
        
        /* Buttons */
        .btn-donate-nav { background-color: var(--primary-color); color: #fff; border-radius: 50px; padding: 8px 24px; font-weight: bold; border: 2px solid var(--primary-color); transition: all 0.3s; text-transform: uppercase; font-size: 0.9rem; }
        .btn-donate-nav:hover { background-color: transparent; color: var(--primary-color); box-shadow: 0 0 15px rgba(204, 0, 0, 0.5); }
        
        .btn-join-nav { background-color: transparent; color: #fff; border-radius: 50px; padding: 8px 24px; font-weight: bold; border: 2px solid rgba(255,255,255,0.5); transition: all 0.3s; text-transform: uppercase; font-size: 0.9rem; }
        .btn-join-nav:hover { border-color: #fff; background-color: rgba(255,255,255,0.1); }
        
        .animate-up { transition: 0.3s; }
        .animate-up:hover { transform: translateY(-5px); }
        
        /* Text Colors override */
        .text-primary { color: var(--primary-color) !important; }
        .bg-primary { background-color: var(--primary-color) !important; }
        .btn-primary { background-color: var(--primary-color) !important; border-color: var(--primary-color) !important; }
        .btn-primary:hover { background-color: var(--primary-hover) !important; border-color: var(--primary-hover) !important; }
    </style>
    <script>
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                nav.classList.add('sticky');
                nav.classList.remove('py-3');
            } else {
                nav.classList.remove('sticky');
                nav.classList.add('py-3');
            }
        });
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md py-3 fixed-top">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    @if(isset($siteSettings['logo']))
                        <img src="{{ $siteSettings['logo'] }}" alt="Logo" style="max-height: 40px;" class="me-2">
                    @else
                        <i class="fas fa-heart text-primary me-2"></i>
                    @endif
                    <span>{{ $siteSettings['ngo_name'] ?? config('app.name', 'SAMRAT FOUNDATION') }}</span>
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <i class="fas fa-bars text-white fs-4"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about') }}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pages.campaigns') }}">Causes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav align-items-center gap-3 mt-3 mt-md-0">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn-join-nav" href="{{ route('register') }}">Join Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn-donate-nav" href="{{ route('donations.index') }}">Donate Now</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-user-circle me-1 fs-5"></i> {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-2" aria-labelledby="navbarDropdown">
                                    @if (auth()->user()->role === 'admin')
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    @else
                                        <a class="dropdown-item" href="{{ route('member.dashboard') }}">Dashboard</a>
                                    @endif
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-0">
            @yield('content')
        </main>

        <footer class="footer pt-5 pb-3">
            <div class="container py-4">
                <div class="row g-5">
                    <div class="col-lg-4 col-md-6">
                        <h4 class="fw-bold mb-4 text-white"><i class="fas fa-hand-holding-heart text-primary me-2"></i>Smart NGO</h4>
                        <p class="mb-4">We are dedicated to creating a better world by empowering organizations with transparent management tools and connecting donors with impactful causes.</p>
                        <div class="d-flex gap-2">
                            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 text-md-center text-lg-start">
                        <h5 class="mb-4">Quick Links</h5>
                        <ul class="list-unstyled d-flex flex-column gap-2 text-md-center text-lg-start">
                            <li><a href="{{ route('home') }}" class="footer-link">Home</a></li>
                            <li><a href="{{ route('mission') }}" class="footer-link">Our Mission</a></li>
                            <li><a href="{{ route('donations.index') }}" class="footer-link">Donate Now</a></li>
                            <li><a href="{{ route('register') }}" class="footer-link">Volunteer</a></li>
                            <li><a href="{{ route('pages.news') }}" class="footer-link">News & Press</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="mb-4">Contact us</h5>
                        <ul class="list-unstyled d-flex flex-column gap-3">
                            <li class="d-flex align-items-start gap-3">
                                <i class="fas fa-map-marker-alt text-primary mt-1"></i>
                                <span>{{ $siteSettings['contact_address'] ?? "123 Social Avenue, NGO Tower, Mumbai 400001" }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-3">
                                <i class="fas fa-phone-alt text-primary"></i>
                                <span>{{ $siteSettings['contact_phone'] ?? "+91 98765 43210" }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-3">
                                <i class="fas fa-envelope text-primary"></i>
                                <span>{{ $siteSettings['contact_email'] ?? "contact@smartngo.in" }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="mb-4">Newsletter</h5>
                        <p class="mb-4">Get monthly updates on our impact and new campaigns.</p>
                        <form class="position-relative">
                            <input type="email" class="form-control newsletter-input py-2 ps-3 pe-5" placeholder="Your email address">
                            <button class="btn btn-primary position-absolute top-50 end-0 translate-middle-y me-1 px-3 py-1" type="button">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <hr class="my-5 border-white opacity-10">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <p class="mb-0 small">&copy; {{ date('Y') }} Smart NGO. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-link small d-flex gap-3 justify-content-center justify-content-md-end">
                            <a href="{{ route('privacy') }}" class="footer-link">Privacy Policy</a>
                            <a href="{{ route('terms') }}" class="footer-link">Terms of Service</a>
                            <a href="{{ route('cookies') }}" class="footer-link">Cookie Policy</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
