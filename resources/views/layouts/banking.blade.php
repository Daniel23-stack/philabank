<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banking Dashboard - {{ config('app.name', 'PhilaLink') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #000117;
            --accent-color: #65d393;
            --sidebar-bg: #f8f9fa;
            --border-color: #dee2e6;
            --text-muted: #6c757d;
            --success-color: #65d393;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #0dcaf0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f6fa;
        }

        .sidebar {
            min-height: 100vh;
            background: var(--primary-color);
            border-right: 1px solid var(--border-color);
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            z-index: 1000;
            overflow-y: auto;
        }

        .main-content {
            margin-left: 250px;
            min-height: 100vh;
            padding: 0;
        }

        .user-profile {
            text-align: center;
            padding: 2rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.05);
            margin-bottom: 1rem;
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid var(--primary-color);
            margin-bottom: 1rem;
            object-fit: cover;
        }

        .user-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: white;
            margin: 0;
        }

        .user-role {
            font-size: 0.9rem;
            color: var(--accent-color);
            margin: 0;
        }

        .nav-section {
            padding: 0 1rem;
        }

        .nav-section-title {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 1.5rem 0 0.5rem 0;
            padding: 0 0.5rem;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            padding: 0.8rem 1.5rem;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: var(--accent-color) !important;
            background: rgba(255, 255, 255, 0.1);
        }

        .nav-link.active {
            color: var(--accent-color) !important;
            background: rgba(255, 255, 255, 0.1);
        }

        .nav-link i {
            width: 20px;
            margin-right: 0.75rem;
            font-size: 1rem;
        }

        .badge-status {
            padding: 5px 10px;
            border-radius: 10px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-due {
            background-color: var(--danger-color);
            color: white;
        }

        .status-upcoming {
            background-color: var(--success-color);
            color: white;
        }

        .top-header {
            background: white;
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .content-area {
            padding: 2rem;
        }

        .logout-section {
            border-top: 1px solid var(--border-color);
            padding: 1rem;
            margin-top: auto;
        }

        .btn-logout {
            background: var(--accent-color);
            color: var(--primary-color);
            border: none;
            padding: 0.75rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(101, 211, 147, 0.3);
        }

        .btn-logout:hover {
            background: #4fb87a;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(101, 211, 147, 0.4);
            color: var(--primary-color);
        }

        .dropdown-item.text-danger:hover {
            background-color: var(--danger-color);
            color: white !important;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-toggle {
                display: block !important;
            }
        }

        .mobile-toggle {
            display: none;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 1001;
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.5rem;
            border-radius: 5px;
        }

        /* Custom Scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        .brand-section {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 1rem;
        }

        .brand-section h4 {
            color: var(--accent-color);
            font-weight: 700;
            margin: 0;
        }

        .brand-section small {
            color: rgba(255, 255, 255, 0.6);
        }
    </style>
</head>
<body>
    <!-- Mobile Toggle Button -->
    <button class="mobile-toggle btn" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <div class="container-fluid p-0">
        <div class="row g-0">
            <!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <!-- Brand Section -->
                <div class="brand-section">
                    <h4>PhilaLink</h4>
                    <small>Microloan & Finance</small>
                </div>

                <!-- User Profile Section -->
                <div class="user-profile">
                    @if(Auth::check())
                        <img src="https://via.placeholder.com/80" class="user-avatar" alt="User Avatar">
                        <h5 class="user-name">{{ Auth::user()->name ?? 'John Doe' }}</h5>
                        <p class="user-role">Customer</p>
                    @else
                        <img src="https://via.placeholder.com/80" class="user-avatar" alt="User Avatar">
                        <h5 class="user-name">Guest User</h5>
                        <p class="user-role">Please Login</p>
                    @endif
                </div>

                <!-- Navigation Menu -->
                <nav class="nav-section">
                    <div class="nav-section-title">Main Menu</div>
                    <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>

                    <div class="nav-section-title">Transactions</div>
                    <a class="nav-link" href="#">
                        <i class="fas fa-paper-plane"></i>
                        Send Money
                    </a>
                    <a class="nav-link" href="#">
                        <i class="fas fa-exchange-alt"></i>
                        Exchange Money
                    </a>
                    <a class="nav-link" href="#">
                        <i class="fas fa-university"></i>
                        Wire Transfer
                    </a>
                    <a class="nav-link" href="#">
                        <i class="fas fa-plus-circle"></i>
                        Deposit Money
                    </a>
                    <a class="nav-link" href="#">
                        <i class="fas fa-minus-circle"></i>
                        Withdraw Money
                    </a>

                    <div class="nav-section-title">Services</div>
                    @if(Route::has('loans.my_loans'))
                        <a class="nav-link {{ request()->routeIs('loans.*') ? 'active' : '' }}" href="{{ route('loans.my_loans') }}">
                            <i class="fas fa-hand-holding-usd"></i>
                            Loans
                        </a>
                    @else
                        <a class="nav-link" href="#">
                            <i class="fas fa-hand-holding-usd"></i>
                            Loans
                        </a>
                    @endif
                    <a class="nav-link" href="#">
                        <i class="fas fa-piggy-bank"></i>
                        Fixed Deposit
                    </a>
                    <a class="nav-link" href="#">
                        <i class="fas fa-chart-line"></i>
                        DPS Scheme
                    </a>

                    <div class="nav-section-title">Support</div>
                    <a class="nav-link" href="#">
                        <i class="fas fa-headset"></i>
                        Support Tickets
                    </a>
                    <a class="nav-link" href="#">
                        <i class="fas fa-file-alt"></i>
                        Transaction Report
                    </a>
                    <a class="nav-link" href="#">
                        <i class="fas fa-user-cog"></i>
                        Profile Settings
                    </a>
                </nav>

                <!-- Logout Section -->
                <div class="logout-section">
                    @if(Auth::check())
                        <form method="POST" action="{{ route('logout') }}" id="sidebarLogoutForm">
                            @csrf
                            <button type="submit" class="btn-logout" onclick="return confirmLogout()">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary w-100">
                            <i class="fas fa-sign-in-alt me-2"></i>
                            Login
                        </a>
                    @endif
                </div>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <!-- Top Header -->
                <div class="top-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">@yield('page-title', 'Dashboard')</h4>
                        <div class="d-flex align-items-center">
                            <span class="text-muted me-3">{{ date('M d, Y') }}</span>
                            @if(Auth::check())
                                <span class="badge bg-success me-3">Online</span>
                                <!-- User Dropdown -->
                                <div class="dropdown">
                                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-user-circle me-1"></i>
                                        {{ Auth::user()->name }}
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="fas fa-user me-2"></i>Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="fas fa-cog me-2"></i>Settings
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}" class="d-inline" id="logoutForm">
                                                @csrf
                                                <button type="submit" class="dropdown-item text-danger" onclick="return confirmLogout()">
                                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary">
                                    <i class="fas fa-sign-in-alt me-1"></i>Login
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Content Area -->
                <div class="content-area">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.querySelector('.mobile-toggle');

            if (window.innerWidth <= 768) {
                if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            if (window.innerWidth > 768) {
                sidebar.classList.remove('show');
            }
        });

        // Logout confirmation
        function confirmLogout() {
            return confirm('Are you sure you want to logout?');
        }
    </script>

    @stack('scripts')
</body>
</html>
