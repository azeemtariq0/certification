<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - S2 Certification</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --theme-green: #418b2c;
            --theme-blue: #2d56a1;
            --dark-blue: #1a202c;
            --sidebar-width: 250px;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f4f7f6;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            background: var(--dark-blue);
            color: #fff;
            padding-top: 20px;
            z-index: 1000;
        }

        .sidebar .logo {
            padding: 0 20px 30px;
            font-size: 1.5rem;
            font-weight: 700;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,0.7);
            padding: 12px 20px;
            display: block;
            text-decoration: none;
            transition: all 0.3s;
        }

        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #fff;
            background: rgba(255,255,255,0.05);
            border-left: 4px solid var(--theme-green);
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 40px;
            min-height: 100vh;
        }

        /* Cards */
        .admin-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border: none;
            margin-bottom: 30px;
        }

        .btn-theme {
            background: var(--theme-green);
            color: #fff;
        }

        .btn-theme:hover {
            background: var(--theme-blue);
            color: #fff;
        }

        /* Compatibility */
        .btn-red {
            background: var(--theme-green);
            color: #fff;
        }

        .btn-red:hover {
            background: var(--theme-blue);
            color: #fff;
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <div class="bg-white p-2 rounded d-inline-block">
                <img src="{{ asset('images/logo.png') }}" alt="S2 Certification" style="height: 40px;">
            </div>
            <div class="small mt-1 opacity-50" style="font-size: 0.7rem;">ADMIN PANEL</div>
        </div>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>

            @if(auth()->user()->hasPermission('manage-certificates'))
            <a href="{{ route('admin.certificates.index') }}" class="nav-link {{ Route::is('admin.certificates.*') ? 'active' : '' }}">
                <i class="fas fa-certificate"></i> Certificates
            </a>
            @endif

            @if(auth()->user()->hasPermission('manage-users'))
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ Route::is('admin.users.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Users
            </a>
            @endif

            @if(auth()->user()->hasPermission('manage-roles'))
            <a href="{{ route('admin.roles.index') }}" class="nav-link {{ Route::is('admin.roles.*') ? 'active' : '' }}">
                <i class="fas fa-user-shield"></i> Roles & Permissions
            </a>
            @endif

            <div class="mt-4 pt-4 border-top border-secondary opacity-25"></div>

            <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
