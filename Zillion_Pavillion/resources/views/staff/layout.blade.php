<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Staff Panel') - Zillion Pavillion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --sidebar-width: 280px;
            --primary-color: #ff3b30;
            --primary-dark: #e62e24;
            --sidebar-bg: #2c3e50;
            --sidebar-hover: #34495e;
        }
        body {
            min-height: 100vh;
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            padding: 0;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        .sidebar .brand {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            padding: 25px 20px;
            text-align: center;
            margin-bottom: 0;
        }
        .sidebar .brand img {
            height: 60px;
            margin-bottom: 10px;
            filter: brightness(0) invert(1);
        }
        .sidebar .brand h4 {
            color: #fff;
            font-size: 1.3rem;
            font-weight: 700;
            margin: 0;
            letter-spacing: 1px;
        }
        .sidebar .brand p {
            color: rgba(255,255,255,0.9);
            font-size: 0.85rem;
            margin: 5px 0 0 0;
            letter-spacing: 0.5px;
        }
        .sidebar .nav {
            padding: 20px 0;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 15px 25px;
            transition: all 0.3s;
            border-left: 3px solid transparent;
            font-weight: 500;
            display: flex;
            align-items: center;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background: var(--sidebar-hover);
            border-left-color: var(--primary-color);
        }
        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
        }
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 30px 30px 30px 30px;
        }
        .top-bar {
            background: #fff;
            padding: 18px 35px;
            margin: -30px -30px 30px -30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            transition: transform 0.15s;
        }

        .stat-card .icon {
            font-size: 1.6rem;
            margin-bottom: 8px;
        }

        .stat-card:hover { transform: translateY(-4px); }

        .card { box-shadow: 0 2px 8px rgba(0,0,0,0.06); border: none; }
    </style>
    @stack('styles')
</head>
<body>
    <div class="sidebar">
        <div class="brand">
            <img src="{{ asset('images/logo.png') }}" alt="Zillion Pavillion" style="height:48px; display:block; margin:0 auto 8px; filter:brightness(0) invert(1);">
            <h4 style="color:#fff; font-weight:700; font-size:1.1rem; margin:0; text-align:center;">STAFF PANEL</h4>
            <p style="color:rgba(255,255,255,0.9); font-size:0.85rem; text-align:center; margin-top:6px;">Operations</p>
        </div>
        <nav class="nav flex-column">
            <a class="nav-link {{ request()->routeIs('staff.dashboard') ? 'active' : '' }}" href="{{ route('staff.dashboard') }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs('staff.bookings.*') ? 'active' : '' }}" href="{{ route('staff.bookings.index') }}">
                <i class="bi bi-calendar-check"></i> Bookings
            </a>
            <a class="nav-link {{ request()->routeIs('staff.service-requests.*') ? 'active' : '' }}" href="{{ route('staff.service-requests.index') }}">
                <i class="bi bi-tools"></i> Service Requests
            </a>
        </nav>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <h4 class="mb-0">@yield('page-title', 'Dashboard')</h4>
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle"></i> {{ auth()->guard('staff')->user()->full_name }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><span class="dropdown-item-text"><small>{{ auth()->guard('staff')->user()->email }}</small></span></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('staff.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
