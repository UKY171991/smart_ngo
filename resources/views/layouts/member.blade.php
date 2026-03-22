<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Member Dashboard - {{ config('app.name', 'Smart NGO') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap 5 -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        :root {
            --sidebar-width: 260px;
            --primary-color: #0d6efd;
            --sidebar-bg: #ffffff;
            --content-bg: #f8f9fa;
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
            border-right: 1px solid #eee;
            transition: all 0.3s;
            z-index: 1000;
            overflow-y: auto;
        }

        #sidebar .sidebar-header {
            padding: 30px 20px;
            text-align: center;
        }

        #sidebar .nav-link {
            color: #64748b;
            padding: 12px 25px;
            margin: 4px 15px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            font-weight: 500;
            transition: 0.2s;
        }

        #sidebar .nav-link:hover {
            color: var(--primary-color);
            background: rgba(13, 110, 253, 0.05);
            transform: translateX(5px);
        }

        #sidebar .nav-link.active {
            color: #fff;
            background: var(--primary-color);
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        }

        #sidebar .nav-link i {
            width: 24px;
            font-size: 1.1rem;
            margin-right: 12px;
        }

        #sidebar .nav-category {
            font-size: 0.75rem;
            text-transform: uppercase;
            color: #94a3b8;
            padding: 25px 30px 10px;
            letter-spacing: 1.5px;
            font-weight: 700;
        }

        /* Main Content */
        #main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s;
        }

        .top-navbar {
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            height: 75px;
            padding: 0 35px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 999;
            border-bottom: 1px solid #eee;
        }

        .content-body {
            padding: 35px;
        }

        @media (max-width: 992px) {
            #sidebar { margin-left: calc(-1 * var(--sidebar-width)); }
            #main-content { margin-left: 0; }
            #sidebar.active { margin-left: 0; }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div id="sidebar">
        <div class="sidebar-header">
            <h5 class="mb-0 fw-bold text-primary"><i class="fas fa-hand-holding-heart me-2"></i>Smart NGO</h5>
            <small class="text-muted text-uppercase fw-bold ls-1" style="font-size: 0.6rem;">Member Dashboard</small>
        </div>
        
        <div class="mt-4">
            <a href="{{ route('member.dashboard') }}" class="nav-link {{ Route::is('member.dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i> Overview
            </a>

            <div class="nav-category">Engagement</div>
            
            <a href="{{ route('donations.index') }}" class="nav-link">
                <i class="fas fa-donate"></i> Donate Now
            </a>
            
            <a href="{{ route('member.enquiries') }}" class="nav-link {{ Route::is('member.enquiries') ? 'active' : '' }}">
                <i class="fas fa-question-circle"></i> Support Enquiries
            </a>
            
            <a href="{{ route('member.referrals') }}" class="nav-link {{ Route::is('member.referrals') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Volunteer Joining
            </a>

            <div class="nav-category">Resources</div>
            
            <a href="{{ route('member.id-card') }}" target="_blank" class="nav-link">
                <i class="fas fa-id-card"></i> ID Card (PDF)
            </a>
            <a href="{{ route('member.membership-receipt') }}" target="_blank" class="nav-link">
                <i class="fas fa-file-invoice"></i> Membership Receipt
            </a>
            <a href="{{ route('member.appointment-letter') }}" target="_blank" class="nav-link">
                <i class="fas fa-file-contract"></i> Appointment Letter
            </a>
            <a href="{{ route('member.certificates') }}" class="nav-link {{ Route::is('member.certificates') ? 'active' : '' }}">
                <i class="fas fa-certificate"></i> My Certificates
            </a>

            <div class="mt-5 p-3">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-100 rounded-pill py-2 fw-bold small">
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
                <h5 class="mb-0 fw-bold text-dark">Welcome, {{ auth()->user()->name }}</h5>
            </div>
            
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                        <img src="{{ auth()->user()->avatar ? (filter_var(auth()->user()->avatar, FILTER_VALIDATE_URL) ? auth()->user()->avatar : Storage::url(auth()->user()->avatar)) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=0d6efd&color=fff' }}" 
                             class="rounded-circle me-2 shadow-sm" width="35" height="35" alt="User" style="object-fit: cover;">
                        <span class="d-none d-md-inline fw-semibold text-dark">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                        <li><a class="dropdown-item" href="{{ route('member.profile') }}"><i class="fas fa-user-circle me-2"></i> My Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('home') }}"><i class="fas fa-home me-2"></i> Back to Website</a></li>
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
                <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script>
        document.getElementById('sidebar-toggle')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>
