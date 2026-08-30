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

        /* ============ ACTION BUTTONS ============ */
        .table-actions {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            justify-content: flex-end;
        }
        .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.92rem;
            border: 1px solid transparent;
            text-decoration: none;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
            background: #fff;
            cursor: pointer;
            padding: 0;
        }
        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
        .action-btn-view {
            background: #eff6ff;
            color: #2563eb;
            border-color: #dbeafe;
        }
        .action-btn-view:hover {
            background: #2563eb;
            color: #fff;
            border-color: #2563eb;
        }
        .action-btn-print {
            background: #f0fdf4;
            color: #16a34a;
            border-color: #bbf7d0;
        }
        .action-btn-print:hover {
            background: #16a34a;
            color: #fff;
            border-color: #16a34a;
        }
        .action-btn-edit {
            background: #fefce8;
            color: #ca8a04;
            border-color: #fef08a;
        }
        .action-btn-edit:hover {
            background: #ca8a04;
            color: #fff;
            border-color: #ca8a04;
        }
        .action-btn-delete {
            background: #fef2f2;
            color: #dc2626;
            border-color: #fecaca;
        }
        .action-btn-delete:hover {
            background: #dc2626;
            color: #fff;
            border-color: #dc2626;
        }

        /* ============ STATUS PILLS ============ */
        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 50px;
            font-family: var(--heading-font);
            font-weight: 700;
            font-size: 0.76rem;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }
        .status-pill::before {
            content: '';
            width: 7px;
            height: 7px;
            border-radius: 50%;
            display: inline-block;
        }
        .status-pill-valid {
            background: #ecfdf5;
            color: #059669;
            border: 1px solid #a7f3d0;
        }
        .status-pill-valid::before { background: #10b981; box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2); }

        .status-pill-expired {
            background: #fffbeb;
            color: #d97706;
            border: 1px solid #fde68a;
        }
        .status-pill-expired::before { background: #f59e0b; }

        .status-pill-suspended {
            background: #f0f9ff;
            color: #0284c7;
            border: 1px solid #bae6fd;
        }
        .status-pill-suspended::before { background: #0ea5e9; }

        .status-pill-revoked {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }
        .status-pill-revoked::before { background: #ef4444; }

        .status-pill-cancelled {
            background: #f8fafc;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }
        .status-pill-cancelled::before { background: #94a3b8; }

        /* ============ PREMIUM FORM ELEMENTS ============ */
        .form-label {
            font-family: var(--heading-font);
            font-weight: 700;
            font-size: 0.84rem;
            color: #1e293b;
            margin-bottom: 6px;
        }
        .form-control, .form-select {
            border-radius: 12px;
            border: 1.5px solid #cbd5e1;
            padding: 11px 16px;
            font-size: 0.92rem;
            color: #0f172a;
            background-color: #ffffff;
            transition: all 0.25s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--theme-green);
            box-shadow: 0 0 0 3.5px rgba(65, 139, 44, 0.18);
            background-color: #fff;
        }
        .form-control::placeholder {
            color: #94a3b8;
        }
        .input-group-text {
            border-radius: 12px 0 0 12px;
            border: 1.5px solid #cbd5e1;
            border-right: none;
            background: #f8fafc;
            color: #64748b;
        }
        .input-group .form-control {
            border-radius: 0 12px 12px 0;
        }

        /* File dropzone / upload box */
        .file-upload-box {
            border: 2px dashed #cbd5e1;
            border-radius: 14px;
            padding: 24px;
            text-align: center;
            background: #f8fafc;
            cursor: pointer;
            transition: all 0.25s ease;
            position: relative;
        }
        .file-upload-box:hover {
            border-color: var(--theme-green);
            background: #f0fdf4;
        }

        /* Avatar chips */
        .avatar-chip {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #f1f5f9;
            color: var(--theme-blue);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
            font-family: var(--heading-font);
            border: 1px solid #e2e8f0;
            flex-shrink: 0;
        }

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

            <div class="nav-section">Certifications &amp; Training</div>
            @if(auth()->user()->hasPermission('manage-certificates'))
            <a href="{{ route('admin.training-certificates.index') }}" class="nav-link {{ Route::is('admin.training-certificates.*') ? 'active' : '' }}">
                <i class="fas fa-user-graduate"></i> Training &amp; Auditor Certs
            </a>
            <a href="{{ route('admin.certificates.index') }}" class="nav-link {{ Route::is('admin.certificates.*') ? 'active' : '' }}">
                <i class="fas fa-building"></i> Company Certifications
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
