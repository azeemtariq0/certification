<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'S2 Certification - Global ISO Certification & Inspection')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='14' fill='%23418b2c'/%3E%3Ctext x='32' y='45' font-family='Arial,sans-serif' font-size='34' font-weight='bold' fill='white' text-anchor='middle'%3ES2%3C/text%3E%3C/svg%3E">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        :root {
            --theme-green: #418b2c;
            --theme-green-dark: #35701f;
            --theme-blue: #2d56a1;
            --dark-blue: #14213d;
            --navy-2: #1b2b52;
            --light-bg: #f5f8fc;
            --soft-bg: #eef3fa;
            --text-dark: #1a2233;
            --text-muted: #667085;
            --line: #e6ebf3;
            --heading-font: 'Plus Jakarta Sans', sans-serif;
        }

        * {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            color: var(--text-dark);
            line-height: 1.7;
            overflow-x: hidden;
            background: #fff;
        }

        h1, h2, h3, h4, h5, h6, .display-3, .display-4, .display-5, .display-6 {
            font-family: var(--heading-font);
            letter-spacing: -0.01em;
        }

        .text-green { color: var(--theme-green) !important; }
        .text-navy { color: var(--dark-blue) !important; }
        .bg-soft { background: var(--light-bg) !important; }

        /* Eyebrow label */
        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: var(--heading-font);
            font-weight: 700;
            font-size: 0.78rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--theme-green);
        }
        .eyebrow::before {
            content: '';
            width: 26px;
            height: 2px;
            background: var(--theme-green);
            display: inline-block;
        }
        .eyebrow.eyebrow-center::before { display: none; }

        .section-title {
            font-weight: 800;
            color: var(--dark-blue);
            font-size: clamp(1.7rem, 3vw, 2.5rem);
            line-height: 1.15;
        }

        /* ============ TOP BAR ============ */
        .top-bar {
            padding: 8px 0;
            background: var(--dark-blue);
            color: #cdd7ea;
            font-size: 0.82rem;
        }
        .top-bar a { color: #cdd7ea; text-decoration: none; transition: color .2s; }
        .top-bar a:hover { color: #fff; }
        .top-bar .tb-item { display: inline-flex; align-items: center; gap: 8px; }
        .top-bar .tb-item i { color: var(--theme-green); }

        /* ============ HEADER ============ */
        .site-header {
            background: #fff;
            box-shadow: 0 2px 20px rgba(20, 33, 61, 0.06);
            position: sticky;
            top: 0;
            z-index: 1030;
        }
        .navbar { padding: 0; }
        .navbar-brand img { height: 56px; transition: height .3s; }
        .navbar-nav .nav-link {
            color: var(--dark-blue) !important;
            padding: 28px 16px !important;
            font-family: var(--heading-font);
            font-weight: 600;
            font-size: 0.95rem;
            position: relative;
            transition: color .25s;
        }
        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            left: 16px;
            right: 16px;
            bottom: 20px;
            height: 3px;
            border-radius: 3px;
            background: var(--theme-green);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active { color: var(--theme-green) !important; }
        .navbar-nav .nav-link:hover::after,
        .navbar-nav .nav-link.active::after { transform: scaleX(1); }

        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
            animation: fadeInDown 0.25s ease forwards;
        }
        .dropdown-menu {
            border: 1px solid var(--line);
            border-radius: 12px;
            box-shadow: 0 14px 35px rgba(20, 33, 61, 0.12);
            padding: 8px;
        }
        .dropdown-item {
            font-family: var(--heading-font);
            font-weight: 600;
            font-size: 0.88rem;
            color: var(--dark-blue);
            padding: 10px 16px;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .dropdown-item:hover, .dropdown-item.active {
            background: #f0fdf4;
            color: var(--theme-green);
        }
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .nav-cta {
            background: var(--theme-green);
            color: #fff !important;
            padding: 12px 26px !important;
            border-radius: 50px;
            font-family: var(--heading-font);
            font-weight: 700;
            font-size: 0.9rem;
            box-shadow: 0 8px 20px rgba(65, 139, 44, 0.28);
            transition: all .3s ease;
        }
        .nav-cta:hover { background: var(--theme-green-dark); color:#fff !important; transform: translateY(-2px); box-shadow: 0 12px 26px rgba(65, 139, 44, 0.35); }
        .nav-cta::after { display: none; }

        /* ============ PAGE TITLE / BREADCRUMB HERO ============ */
        .page-hero {
            background:
                linear-gradient(120deg, rgba(20,33,61,0.94) 0%, rgba(45,86,161,0.86) 100%),
                url('{{ asset('images/hero_bg.png') }}');
            background-size: cover;
            background-position: center;
            color: #fff;
            padding: 90px 0 80px;
            position: relative;
        }
        .page-hero h1 {
            font-weight: 800;
            font-size: clamp(2rem, 4vw, 3rem);
            margin: 0 0 12px;
        }
        .page-hero .breadcrumb {
            justify-content: center;
            --bs-breadcrumb-divider-color: rgba(255,255,255,0.5);
        }
        .page-hero .breadcrumb-item, .page-hero .breadcrumb-item a { color: rgba(255,255,255,0.85); text-decoration: none; }
        .page-hero .breadcrumb-item.active { color: var(--theme-green); font-weight: 600; }

        /* ============ BUTTONS ============ */
        .btn-theme, .btn-red {
            background: var(--theme-green);
            color: #fff;
            font-family: var(--heading-font);
            font-weight: 700;
            padding: 13px 30px;
            border-radius: 50px;
            border: none;
            transition: all .3s ease;
            box-shadow: 0 10px 24px rgba(65, 139, 44, 0.25);
        }
        .btn-theme:hover, .btn-red:hover {
            background: var(--theme-green-dark);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(65, 139, 44, 0.35);
        }
        .btn-outline-theme {
            border: 2px solid var(--theme-green);
            color: var(--theme-green);
            background: transparent;
            font-family: var(--heading-font);
            font-weight: 700;
            padding: 11px 28px;
            border-radius: 50px;
            transition: all .3s ease;
        }
        .btn-outline-theme:hover { background: var(--theme-green); color: #fff; }
        .btn-ghost-light {
            border: 2px solid rgba(255,255,255,0.6);
            color: #fff;
            background: transparent;
            font-family: var(--heading-font);
            font-weight: 700;
            padding: 11px 28px;
            border-radius: 50px;
            transition: all .3s ease;
        }
        .btn-ghost-light:hover { background: #fff; color: var(--dark-blue); border-color: #fff; }

        .link-more {
            color: var(--theme-green);
            font-family: var(--heading-font);
            font-weight: 700;
            font-size: 0.88rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: gap .25s ease, color .25s;
        }
        .link-more i { transition: transform .25s ease; }
        .link-more:hover { color: var(--theme-green-dark); }
        .link-more:hover i { transform: translateX(4px); }

        /* ============ FOOTER ============ */
        .footer-cta {
            background: linear-gradient(120deg, var(--theme-green) 0%, #2f6a20 100%);
            color: #fff;
            border-radius: 20px;
            padding: 48px;
            box-shadow: 0 24px 50px rgba(65, 139, 44, 0.28);
        }
        footer {
            background: var(--dark-blue);
            color: #c3cee0;
            padding: 80px 0 0;
            position: relative;
            overflow: hidden;
        }
        footer::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');
            opacity: 0.06;
            pointer-events: none;
        }
        footer h5 {
            color: #fff;
            font-weight: 700;
            margin-bottom: 22px;
            font-size: 1.05rem;
        }
        footer a { color: #a9b6cf; text-decoration: none; transition: color .3s ease; font-size: 0.92rem; }
        footer a:hover { color: var(--theme-green); padding-left: 3px; }
        footer .footer-links li { margin-bottom: 10px; }
        footer .social-links a {
            display: inline-flex;
            width: 38px; height: 38px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 10px;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
            color:#fff;
            transition: all .3s;
        }
        footer .social-links a:hover { background: var(--theme-green); transform: translateY(-3px); padding-left: 0; }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,0.08); margin-top: 60px; padding: 22px 0; font-size: 0.85rem; }

        /* ============ ANIMATIONS ============ */
        .reveal {
            opacity: 0;
            transition: all 0.9s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: transform, opacity;
        }
        .reveal-up { transform: translateY(40px); }
        .reveal-left { transform: translateX(-40px); }
        .reveal-right { transform: translateX(40px); }
        .reveal-scale { transform: scale(0.95); }
        .reveal.active { opacity: 1; transform: translate(0) scale(1); }
        .delay-100 { transition-delay: 100ms !important; }
        .delay-200 { transition-delay: 200ms !important; }
        .delay-300 { transition-delay: 300ms !important; }
        .delay-400 { transition-delay: 400ms !important; }
        .delay-500 { transition-delay: 500ms !important; }
        .delay-600 { transition-delay: 600ms !important; }

        /* ============ CARDS ============ */
        .hover-card-lift {
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important;
            position: relative;
            top: 0;
            border: 1px solid var(--line) !important;
            background: #fff;
        }
        .hover-card-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 22px 45px rgba(20, 33, 61, 0.12) !important;
            border-color: rgba(65, 139, 44, 0.35) !important;
        }
        .hover-card-lift i { transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1); }

        .btn-premium { position: relative; overflow: hidden; z-index: 1; }
        .btn-premium::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.25), transparent);
            transition: all 0.6s ease;
            z-index: -1;
        }
        .btn-premium:hover::before { left: 100%; }

        .zoom-img-container { overflow: hidden; position: relative; }
        .zoom-img-container img {
            transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
            width: 100%; height: 100%; display: block; object-fit: cover;
        }
        .card:hover .zoom-img-container img { transform: scale(1.07); }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 991px) {
            .navbar-nav .nav-link { padding: 12px 8px !important; border-bottom: 1px solid var(--line); }
            .navbar-nav .nav-link::after { display: none; }
            .nav-cta { display: inline-block; margin: 12px 0; text-align: center; }
            .navbar-collapse { padding-bottom: 16px; }
            .footer-cta { padding: 32px 24px; }
        }
    </style>
    @yield('styles')
</head>

<body>

    <!-- Top Bar -->
    <div class="top-bar d-none d-lg-block">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex gap-4">
                <span class="tb-item"><i class="fas fa-envelope"></i> <a href="mailto:info@s2cert.com">info@s2cert.com</a></span>
                <span class="tb-item"><i class="fas fa-phone"></i> <a href="tel:08006911208">0800 691 1208</a></span>
            </div>
            <div class="d-flex gap-4 align-items-center">
                <span class="tb-item"><i class="fas fa-phone"></i> <a href="tel:08006911327" target="_blank" rel="noopener">0800 691 1327</a></span>
                <span class="tb-item"><i class="fas fa-award"></i> Accredited Certification Body</span>
            </div>
        </div>
    </div>

    <!-- Header / Navbar -->
    <header class="site-header">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="S2 Certification">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="fas fa-bars" style="color: var(--dark-blue);"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav align-items-lg-center">
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('about') ? 'active' : '' }}" href="{{ route('about') }}">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('services') ? 'active' : '' }}" href="{{ route('services') }}">Services</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ Route::is('verify*') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Verification <i class="fas fa-chevron-down ms-1" style="font-size: 0.75rem;"></i>
                            </a>
                            <ul class="dropdown-menu shadow-lg" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item {{ Route::is('verify') ? 'active' : '' }}" href="{{ route('verify') }}">
                                        <i class="fas fa-building text-primary me-2"></i> Company ISO Verification
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ Route::is('verify.training*') ? 'active' : '' }}" href="{{ route('verify.training') }}">
                                        <i class="fas fa-user-graduate text-success me-2"></i> Training &amp; Auditor Verification
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <!-- Footer CTA band -->
            <div class="footer-cta reveal reveal-up mb-5">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <h3 class="fw-bold mb-2" style="color:#fff;">Ready to get certified?</h3>
                        <p class="mb-0" style="opacity:0.9;">Talk to our experts and receive a tailored certification proposal for your organisation.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="{{ route('contact') }}" class="btn btn-lg px-4 fw-bold" style="background:#fff;color:var(--theme-green);border-radius:50px;">Request a Proposal <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>

            <div class="row gy-4">
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('home') }}" class="d-inline-block bg-white p-2 rounded mb-3">
                        <img src="{{ asset('images/logo.png') }}" alt="S2 Certification" style="height: 50px;">
                    </a>
                    <p class="small pe-lg-4">S2 Certification is a global provider of management system certification, auditor credentialing, and inspection services, helping organisations and professionals achieve excellence.</p>
                    <div class="social-links mt-3">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h5>Our Standards</h5>
                    <ul class="list-unstyled footer-links">
                        <li><a href="{{ route('services') }}">ISO 9001:2015</a></li>
                        <li><a href="{{ route('services') }}">ISO 14001:2015</a></li>
                        <li><a href="{{ route('services') }}">ISO 45001:2018</a></li>
                        <li><a href="{{ route('services') }}">ISO 27001:2022</a></li>
                        <li><a href="{{ route('services') }}">ISO 22000:2018</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h5>Verification</h5>
                    <ul class="list-unstyled footer-links">
                        <li><a href="{{ route('verify.training') }}"><i class="fas fa-user-graduate me-1 text-success"></i> Verify Training Cert</a></li>
                        <li><a href="{{ route('verify') }}"><i class="fas fa-building me-1 text-primary"></i> Verify Company Cert</a></li>
                        <li><a href="{{ route('about') }}">About Accreditation</a></li>
                        <li><a href="{{ route('contact') }}">Report an Issue</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h5>Get In Touch</h5>
                    <ul class="list-unstyled footer-links small">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2 text-green"></i> S2 Certification Ltd Rivington, Great Eastern Street, London EC2A 3JF, United Kingdom</li>
                        <li class="mb-2"><i class="fas fa-phone-alt me-2 text-green"></i> <a href="tel:08006911208">0800 691 1208</a></li>
                        <li class="mb-2"><i class="fas fa-envelope me-2 text-green"></i> <a href="mailto:info@s2cert.com">info@s2cert.com</a></li>
                        <li class="mb-2"><i class="fas fa-phone-alt me-2 text-green"></i> <a href="#">0800 691 1327</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom d-md-flex justify-content-between align-items-center text-center text-md-start">
                <p class="mb-0">&copy; {{ date('Y') }} S2 Certification. All Rights Reserved.</p>
                <p class="mb-0 mt-2 mt-md-0">Globally Recognised &bull; Independently Accredited</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // 1. Intersection Observer for Scroll Reveals
            const revealElements = document.querySelectorAll('.reveal');
            if (revealElements.length > 0) {
                const revealObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('active');
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.1, rootMargin: "0px 0px -50px 0px" });
                revealElements.forEach(el => revealObserver.observe(el));
            }

            // 2. Animated Statistic Counters
            const statElements = document.querySelectorAll('.stat-count');
            if (statElements.length > 0) {
                const statObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const target = entry.target;
                            const limit = parseInt(target.getAttribute('data-target'), 10);
                            const suffix = target.getAttribute('data-suffix') || '';
                            const duration = 2000;
                            const frameRate = 1000 / 60;
                            const totalFrames = Math.round(duration / frameRate);
                            let currentFrame = 0;
                            const animate = () => {
                                currentFrame++;
                                const progress = currentFrame / totalFrames;
                                const easeProgress = progress * (2 - progress);
                                const count = Math.floor(easeProgress * limit);
                                if (currentFrame < totalFrames) {
                                    target.innerText = count + suffix;
                                    requestAnimationFrame(animate);
                                } else {
                                    target.innerText = limit + suffix;
                                }
                            };
                            animate();
                            observer.unobserve(target);
                        }
                    });
                }, { threshold: 0.2 });
                statElements.forEach(el => statObserver.observe(el));
            }
        });
    </script>
    @yield('scripts')
</body>

</html>
