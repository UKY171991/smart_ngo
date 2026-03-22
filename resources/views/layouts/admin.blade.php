<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel - {{ config('app.name', 'Smart NGO') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Favicon -->
    @if(isset($siteSettings['favicon']))
        @php
            $favUrl = $siteSettings['favicon'];
            if ($favUrl && !filter_var($favUrl, FILTER_VALIDATE_URL)) {
                $favUrl = Storage::url($favUrl);
            }
        @endphp
        <link rel="icon" type="image/x-icon" href="{{ $favUrl }}">
    @else
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @endif
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap 5 -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        :root {
            --sidebar-width: 260px;
            --primary-color: #4e73df;
            --sidebar-bg: #1e293b;
            --content-bg: #f8fafc;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--content-bg);
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: var(--sidebar-bg);
            color: #fff;
            transition: all 0.3s;
            z-index: 1000;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: rgba(0,0,0,0.1);
            text-align: center;
            flex-shrink: 0;
        }

        #sidebar .mt-4 {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
        }

        /* Custom scrollbar for sidebar */
        #sidebar .mt-4::-webkit-scrollbar {
            width: 6px;
        }

        #sidebar .mt-4::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }

        #sidebar .mt-4::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        #sidebar .mt-4::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        #sidebar .nav-link {
            color: rgba(255,255,255,0.7);
            padding: 12px 20px;
            margin: 4px 12px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            font-weight: 500;
            transition: 0.2s;
        }

        #sidebar .nav-link:hover {
            color: var(--primary-color);
            background: rgba(255,255,255,0.9);
            transform: translateX(5px);
        }

        #sidebar .nav-link.active {
            color: #fff;
            background: linear-gradient(45deg, var(--primary-color), #224abe);
            box-shadow: 0 4px 15px rgba(78, 115, 223, 0.4);
        }

        #sidebar .nav-link i {
            width: 24px;
            font-size: 1rem;
            margin-right: 12px;
            transition: 0.3s;
        }

        #sidebar .nav-link:hover i {
            transform: scale(1.2);
        }

        #sidebar .nav-category {
            font-size: 0.65rem;
            text-transform: uppercase;
            color: rgba(255,255,255,0.3);
            padding: 25px 25px 10px;
            letter-spacing: 1.5px;
            font-weight: 800;
        }

        /* Branding */
        .admin-logo {
            font-size: 1.25rem;
            background: linear-gradient(45deg, #fff, rgba(255,255,255,0.7));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: 1px;
        }

        /* Main Content */
        #main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s;
            background: #f8fafc;
        }

        .top-navbar {
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            height: 70px;
            padding: 0 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 1px 0 rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .content-body {
            padding: 35px;
        }

        /* Cards and Elements */
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            transition: 0.3s;
        }

        .btn-fancy {
            border-radius: 12px;
            padding: 10px 22px;
            font-weight: 600;
            transition: 0.3s;
        }

        @media (max-width: 992px) {
            #sidebar { 
                left: calc(-1 * var(--sidebar-width)); 
                opacity: 0;
                visibility: hidden;
            }
            #main-content { 
                margin-left: 0; 
                width: 100%;
            }
            #sidebar.active { 
                left: 0; 
                opacity: 1;
                visibility: visible;
            }
            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                background: rgba(0,0,0,0.5);
                z-index: 999;
                backdrop-filter: blur(4px);
            }
            #sidebar.active + .sidebar-overlay {
                display: block;
            }
            .content-body {
                padding: 15px;
            }
            .top-navbar {
                padding: 0 15px;
            }
            .card-header {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 12px;
                padding: 1.5rem !important;
            }
            .card-header .d-flex, .card-header .btn-group {
                width: 100%;
                justify-content: flex-start !important;
                flex-wrap: wrap;
            }
            .card-header h5 {
                font-size: 1.1rem;
            }
            .stat-card-title {
                font-size: 0.7rem !important;
            }
        }

        /* Mobile Typography and UI tweaks */
        @media (max-width: 576px) {
            .btn-fancy {
                padding: 8px 16px;
                font-size: 0.85rem;
                width: 100%;
                margin-bottom: 5px;
            }
            .table th, .table td {
                font-size: 0.85rem;
                padding: 12px 10px !important;
            }
            .card-body.p-0 {
                overflow: hidden;
            }
            h3 { font-size: 1.5rem; }
            h5 { font-size: 1.1rem; }
        }
        
        /* Table Responsiveness Improvements */
        .table-responsive {
            border-radius: 12px;
            border: 1px solid #f1f5f9;
            background: #fff;
            box-shadow: inset 0 0 10px rgba(0,0,0,0.02);
        }
    </style>
</head>
<body>
    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <!-- Sidebar -->
    <div id="sidebar">
        <div class="sidebar-header d-flex align-items-center justify-content-center py-4 bg-transparent">
            @if(isset($siteSettings['logo']))
                @php
                    $logoUrl = $siteSettings['logo'];
                    if ($logoUrl && !filter_var($logoUrl, FILTER_VALIDATE_URL)) {
                        $logoUrl = Storage::url($logoUrl);
                    }
                @endphp
                <img src="{{ $logoUrl }}" alt="Logo" style="max-height: 40px;" class="me-2">
            @else
                <i class="fas fa-hand-holding-heart me-2 text-primary fa-lg"></i>
            @endif
            <h5 class="mb-0 fw-bold admin-logo">{{ $siteSettings['ngo_name'] ?? 'NGO PANEL' }}</h5>
        </div>
        
        <div class="mt-4">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i> Dashboard
            </a>

            <div class="nav-category">Management</div>
            
            <a href="{{ route('admin.members.index') }}" class="nav-link {{ Route::is('admin.members.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Members
            </a>
            <a href="{{ route('admin.donations.index') }}" class="nav-link {{ Route::is('admin.donations.*') ? 'active' : '' }}">
                <i class="fas fa-hand-holding-dollar"></i> Donations
            </a>
            <a href="{{ route('admin.campaigns.index') }}" class="nav-link {{ Route::is('admin.campaigns.*') ? 'active' : '' }}">
                <i class="fas fa-bullhorn"></i> Campaigns
            </a>
            <a href="{{ route('admin.beneficiaries.index') }}" class="nav-link {{ Route::is('admin.beneficiaries.*') ? 'active' : '' }}">
                <i class="fas fa-hands-helping"></i> Beneficiaries
            </a>

            <div class="nav-category">Operations</div>
            
            <a href="{{ route('admin.projects.index') }}" class="nav-link {{ Route::is('admin.projects.*') ? 'active' : '' }}">
                <i class="fas fa-tasks"></i> Projects
            </a>
            <a href="{{ route('admin.events.index') }}" class="nav-link {{ Route::is('admin.events.*') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i> Events
            </a>
            <a href="{{ route('admin.expenses.index') }}" class="nav-link {{ Route::is('admin.expenses.*') ? 'active' : '' }}">
                <i class="fas fa-wallet"></i> Expenses
            </a>

            <div class="nav-category">Content</div>
            
            <a href="{{ route('admin.news.index') }}" class="nav-link {{ Route::is('admin.news.*') ? 'active' : '' }}">
                <i class="fas fa-newspaper"></i> News
            </a>
            <a href="{{ route('admin.activities.index') }}" class="nav-link {{ Route::is('admin.activities.*') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt"></i> Activities
            </a>
            <a href="{{ route('admin.programs.index') }}" class="nav-link {{ Route::is('admin.programs.*') ? 'active' : '' }}">
                <i class="fas fa-layer-group"></i> Programs
            </a>
            <a href="{{ route('admin.pages.index') }}" class="nav-link {{ Route::is('admin.pages.*') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i> Pages
            </a>
            <a href="{{ route('admin.enquiries.index') }}" class="nav-link {{ Route::is('admin.enquiries.*') ? 'active' : '' }}">
                <i class="fas fa-question-circle"></i> Enquiries
            </a>
            <a href="{{ route('admin.certificates.index') }}" class="nav-link {{ Route::is('admin.certificates.index') ? 'active' : '' }}">
                <i class="fas fa-certificate"></i> Certificates
            </a>
            <a href="{{ route('admin.settings.certificate') }}" class="nav-link {{ Route::is('admin.settings.certificate') ? 'active' : '' }}">
                <i class="fas fa-palette"></i> Certificate Design
            </a>
            <div class="nav-category">System</div>
            
            <a href="{{ route('admin.settings.index') }}" class="nav-link {{ Route::is('admin.settings.index') ? 'active' : '' }}">
                <i class="fas fa-cog"></i> Website Settings
            </a>
            <a href="{{ route('admin.settings.qr') }}" class="nav-link {{ Route::is('admin.settings.qr') ? 'active' : '' }}">
                <i class="fas fa-qrcode"></i> Website QR Code
            </a>
            <a href="{{ route('admin.settings.footer') }}" class="nav-link {{ Route::is('admin.settings.footer') ? 'active' : '' }}">
                <i class="fas fa-link"></i> Footer Links
            </a>
            <a href="{{ route('admin.settings.mail') }}" class="nav-link {{ Route::is('admin.settings.mail') ? 'active' : '' }}">
                <i class="fas fa-envelope-open-text"></i> Mail Setup
            </a>

            <div class="mt-4 p-3 footer-logout">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-100 btn-fancy btn-sm">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div id="main-content">
        <!-- Top Navbar -->
        <nav class="top-navbar">
            <div class="d-flex align-items-center">
                <button class="btn d-lg-none me-3" id="sidebar-toggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h5 class="mb-0 fw-bold text-muted">@yield('page_title', 'Dashboard')</h5>
            </div>
            
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                        <img src="{{ auth()->user()->avatar ? (filter_var(auth()->user()->avatar, FILTER_VALIDATE_URL) ? auth()->user()->avatar : Storage::url(auth()->user()->avatar)) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=4e73df&color=fff' }}" 
                             class="rounded-circle shadow-sm border me-2" width="40" height="40" alt="Admin" style="object-fit: cover;">
                        <span class="d-none d-md-inline fw-semibold">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                        <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="fas fa-user me-2"></i> Profile & Password</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.settings.index') }}"><i class="fas fa-cog me-2"></i> General Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="content-body">
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger border-0 shadow-sm mb-4">{{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const toggle = document.getElementById('sidebar-toggle');

        function toggleSidebar() {
            sidebar.classList.toggle('active');
        }

        toggle?.addEventListener('click', toggleSidebar);
        overlay?.addEventListener('click', toggleSidebar);
    </script>
</body>
</html>
