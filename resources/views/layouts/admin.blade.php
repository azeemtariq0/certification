<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - S2 Certification</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='14' fill='%23418b2c'/%3E%3Ctext x='32' y='45' font-family='Arial,sans-serif' font-size='34' font-weight='bold' fill='white' text-anchor='middle'%3ES2%3C/text%3E%3C/svg%3E">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --theme-green: #418b2c;
            --theme-green-dark: #35701f;
            --theme-blue: #2d56a1;
            --dark-blue: #14213d;
            --navy-2: #1b2b52;
            --admin-bg: #f1f5fb;
            --line: #e6ebf3;
            --text-muted: #667085;
            --sidebar-width: 264px;
            --heading-font: 'Plus Jakarta Sans', sans-serif;
        }

        * { scroll-behavior: smooth; }

        body {
            font-family: 'Open Sans', sans-serif;
            background-color: var(--admin-bg);
            color: #1a2233;
        }

        h1,h2,h3,h4,h5,h6 { font-family: var(--heading-font); letter-spacing: -0.01em; }

        /* ============ SIDEBAR ============ */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0; left: 0;
            background: linear-gradient(185deg, var(--dark-blue) 0%, #0f1830 100%);
            color: #fff;
            padding-top: 22px;
            z-index: 1050;
            display: flex;
            flex-direction: column;
            transition: transform .3s cubic-bezier(0.16,1,0.3,1);
        }
        .sidebar::-webkit-scrollbar { width: 6px; }
        .sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.12); border-radius: 3px; }

        .sidebar .logo {
            padding: 0 22px 22px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            margin-bottom: 18px;
        }
        .sidebar .logo .badge-admin {
            font-family: var(--heading-font);
            font-size: 0.66rem; letter-spacing: 0.18em;
            color: #7ed957; font-weight: 700; margin-top: 8px;
        }

        .sidebar .nav-section {
            padding: 14px 22px 6px;
            font-family: var(--heading-font);
            font-size: 0.68rem; letter-spacing: 0.14em; text-transform: uppercase;
            color: rgba(255,255,255,0.35); font-weight: 700;
        }
        .sidebar .nav-links { flex: 1; overflow-y: auto; padding-bottom: 10px; }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.72);
            padding: 12px 22px;
            display: flex; align-items: center; gap: 12px;
            text-decoration: none;
            font-family: var(--heading-font);
            font-weight: 600; font-size: 0.92rem;
            border-left: 3px solid transparent;
            transition: all 0.25s ease;
        }
        .sidebar .nav-link i { width: 20px; text-align: center; font-size: 0.95rem; }
        .sidebar .nav-link:hover {
            color: #fff;
            background: rgba(255,255,255,0.05);
        }
        .sidebar .nav-link.active {
            color: #fff;
            background: linear-gradient(90deg, rgba(65,139,44,0.28), transparent);
            border-left-color: var(--theme-green);
        }

        .sidebar .sidebar-footer {
            padding: 16px 22px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }
        .sidebar .user-chip { display:flex; align-items:center; gap:12px; margin-bottom: 14px; }
        .sidebar .avatar {
            width: 42px; height: 42px; border-radius: 50%;
            background: var(--theme-green); color:#fff;
            display:flex; align-items:center; justify-content:center;
            font-family: var(--heading-font); font-weight: 700; font-size: 1rem; flex-shrink:0;
        }
        .sidebar .user-chip .u-name { font-family: var(--heading-font); font-weight: 700; font-size: 0.9rem; color:#fff; line-height:1.2; }
        .sidebar .user-chip .u-role { font-size: 0.75rem; color: rgba(255,255,255,0.5); }
        .btn-logout {
            display:flex; align-items:center; justify-content:center; gap:8px;
            width:100%; padding: 10px; border-radius: 10px;
            background: rgba(255,255,255,0.06); color:#fff; text-decoration:none;
            font-family: var(--heading-font); font-weight:600; font-size:0.85rem;
            transition: all .25s ease; border: 1px solid rgba(255,255,255,0.08);
        }
        .btn-logout:hover { background: #c0392b; border-color:#c0392b; color:#fff; }

        /* ============ TOPBAR ============ */
        .admin-topbar {
            position: sticky; top: 0; z-index: 1020;
            background: #fff;
            border-bottom: 1px solid var(--line);
            padding: 14px 32px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .admin-topbar .tb-title { font-family: var(--heading-font); font-weight: 800; color: var(--dark-blue); font-size: 1.15rem; margin:0; }
        .admin-topbar .tb-sub { font-size: 0.8rem; color: var(--text-muted); }
        .sidebar-toggle {
            border:none; background: var(--admin-bg); color: var(--dark-blue);
            width:42px; height:42px; border-radius:10px; display:none; align-items:center; justify-content:center;
        }
        .tb-visit { color: var(--theme-blue); text-decoration:none; font-family: var(--heading-font); font-weight:600; font-size:0.85rem; }
        .tb-visit:hover { color: var(--theme-green); }

        /* ============ MAIN CONTENT ============ */
        .main-wrap { margin-left: var(--sidebar-width); min-height: 100vh; transition: margin .3s; }
        .main-content { padding: 32px; }
        .page-heading { font-family: var(--heading-font); font-weight: 800; color: var(--dark-blue); }

        /* ============ CARDS ============ */
        .admin-card, .card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(20,33,61,0.05);
            border: 1px solid var(--line);
        }
        .admin-card { margin-bottom: 28px; }

        /* ============ BUTTONS ============ */
        .btn { font-family: var(--heading-font); font-weight: 600; border-radius: 10px; }
        .btn-theme, .btn-red {
            background: var(--theme-green); color: #fff; border:none;
            box-shadow: 0 8px 18px rgba(65,139,44,0.22);
        }
        .btn-theme:hover, .btn-red:hover { background: var(--theme-green-dark); color: #fff; }
        .btn-outline-dark { border-color: var(--line); color: var(--dark-blue); }
        .btn-outline-dark:hover { background: var(--dark-blue); border-color: var(--dark-blue); }

        /* ============ TABLES ============ */
        .table { margin-bottom: 0; }
        .table thead th {
            font-family: var(--heading-font);
            font-size: 0.74rem; letter-spacing: 0.06em; text-transform: uppercase;
            color: var(--text-muted); font-weight: 700;
            background: #f7f9fc !important; border-bottom: 1px solid var(--line);
            padding-top: 16px; padding-bottom: 16px;
        }
        .table tbody td { padding-top: 16px; padding-bottom: 16px; border-color: var(--line); vertical-align: middle; }
        .table-hover tbody tr:hover { background: #f7fbf5; }

        /* ============ BADGES ============ */
        .badge { font-family: var(--heading-font); font-weight: 600; padding: 6px 12px; border-radius: 50px; font-size: 0.74rem; }
        .badge.bg-success { background: rgba(65,139,44,0.12) !important; color: var(--theme-green) !important; }
        .badge.bg-danger { background: rgba(192,57,43,0.12) !important; color: #c0392b !important; }
        .badge.bg-warning { background: rgba(230,162,60,0.15) !important; color: #b8860b !important; }

        /* ============ FORMS ============ */
        .form-label { font-family: var(--heading-font); font-weight: 600; font-size: 0.85rem; color: var(--dark-blue); }
        .form-control, .form-select {
            border-radius: 10px; border: 1px solid var(--line); padding: 11px 14px; font-size: 0.92rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--theme-green);
            box-shadow: 0 0 0 0.2rem rgba(65,139,44,0.12);
        }

        /* ============ ALERTS ============ */
        .alert { border-radius: 12px; border: none; font-size: 0.9rem; }
        .alert-success { background: rgba(65,139,44,0.1); color: var(--theme-green-dark); }
        .alert-danger { background: rgba(192,57,43,0.1); color: #a5281c; }

        /* Pagination */
        .pagination { --bs-pagination-color: var(--dark-blue); --bs-pagination-active-bg: var(--theme-green); --bs-pagination-active-border-color: var(--theme-green); --bs-pagination-border-radius: 10px; }

        /* Overlay for mobile */
        .sidebar-overlay { display:none; position:fixed; inset:0; background:rgba(20,33,61,0.45); z-index:1040; }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 991px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-wrap { margin-left: 0; }
            .sidebar-toggle { display: flex; }
            .sidebar-overlay.show { display: block; }
            .admin-topbar { padding: 14px 18px; }
            .main-content { padding: 20px; }
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="logo">
            <div class="bg-white p-2 rounded-3 d-inline-block">
                <img src="{{ asset('images/logo.png') }}" alt="S2 Certification" style="height: 40px;">
            </div>
            <div class="badge-admin">ADMIN PANEL</div>
        </div>

        <div class="nav-links">
            <div class="nav-section">Main</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-gauge-high"></i> Dashboard
            </a>

            @if(auth()->user()->hasPermission('manage-certificates'))
            <a href="{{ route('admin.certificates.index') }}" class="nav-link {{ Route::is('admin.certificates.*') ? 'active' : '' }}">
                <i class="fas fa-certificate"></i> Certificates
            </a>
            @endif

            @if(auth()->user()->hasPermission('manage-users') || auth()->user()->hasPermission('manage-roles'))
            <div class="nav-section">Administration</div>
            @endif

            @if(auth()->user()->hasPermission('manage-users'))
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ Route::is('admin.users.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Users
            </a>
            @endif

            @if(auth()->user()->hasPermission('manage-roles'))
            <a href="{{ route('admin.roles.index') }}" class="nav-link {{ Route::is('admin.roles.*') ? 'active' : '' }}">
                <i class="fas fa-user-shield"></i> Roles &amp; Permissions
            </a>
            @endif

            <div class="nav-section">Website</div>
            <a href="{{ route('home') }}" target="_blank" class="nav-link">
                <i class="fas fa-globe"></i> Visit Site
            </a>
        </div>

        <div class="sidebar-footer">
            <div class="user-chip">
                <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div>
                    <div class="u-name">{{ auth()->user()->name }}</div>
                    <div class="u-role">{{ auth()->user()->role->name ?? 'Administrator' }}</div>
                </div>
            </div>
            <a href="#" class="btn-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-right-from-bracket"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">@csrf</form>
        </div>
    </aside>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Main -->
    <div class="main-wrap">
        <!-- Topbar -->
        <div class="admin-topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle menu"><i class="fas fa-bars"></i></button>
                <div>
                    <h1 class="tb-title">@yield('title', 'Dashboard')</h1>
                    <div class="tb-sub d-none d-sm-block">Welcome back, {{ auth()->user()->name }}</div>
                </div>
            </div>
            <a href="{{ route('home') }}" target="_blank" class="tb-visit d-none d-md-inline-flex align-items-center gap-2">
                <i class="fas fa-arrow-up-right-from-square"></i> View Website
            </a>
        </div>

        <div class="main-content">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-circle-check me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-circle-exclamation me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function(){
            const sidebar = document.getElementById('sidebar');
            const toggle = document.getElementById('sidebarToggle');
            const overlay = document.getElementById('sidebarOverlay');
            function open(){ sidebar.classList.add('open'); overlay.classList.add('show'); }
            function close(){ sidebar.classList.remove('open'); overlay.classList.remove('show'); }
            if(toggle){ toggle.addEventListener('click', () => sidebar.classList.contains('open') ? close() : open()); }
            if(overlay){ overlay.addEventListener('click', close); }
        })();
    </script>
    @yield('scripts')
</body>
</html>
