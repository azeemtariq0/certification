<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'S2 Certification - Global ISO Certification & Inspection')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        :root {
            --theme-green: #418b2c;
            --theme-blue: #2d56a1;
            --dark-blue: #1a202c;
            --light-bg: #f8f9fa;
            --text-dark: #212529;
            --text-muted: #6c757d;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            color: var(--text-dark);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Top Bar */
        .top-bar {
            padding: 20px 0;
            background: #fff;
        }

        .top-bar .info-item {
            display: flex;
            align-items: center;
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-left: 25px;
        }

        .top-bar .info-item i {
            width: 32px;
            height: 32px;
            background: var(--theme-green);
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-size: 0.9rem;
        }

        .top-bar .logo-text {
            font-weight: 700;
            color: var(--dark-blue);
            text-decoration: none;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
        }

        .top-bar .logo-text span {
            color: var(--theme-green);
            font-weight: 800;
            margin-right: 5px;
        }

        /* Navbar Styling */
        .navbar {
            background: var(--dark-blue);
            padding: 0;
            z-index: 1000;
        }

        .navbar-nav .nav-link {
            color: #fff !important;
            padding: 15px 20px !important;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            background: var(--theme-green);
        }

        /* Hero and Title Bar */
        .page-title-bar {
            background: var(--light-bg);
            padding: 30px 0;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 50px;
        }

        .page-title-bar h1 {
            font-weight: 700;
            text-transform: uppercase;
            font-size: 1.8rem;
            margin: 0;
            color: var(--dark-blue);
        }

        /* Footer */
        footer {
            background: var(--dark-blue);
            color: #fff;
            padding: 60px 0 20px;
            position: relative;
            overflow: hidden;
        }

        /* Subtle World Map Watermark for Footer */
        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');
            /* Placeholder for world map texture */
            opacity: 0.05;
            pointer-events: none;
        }

        footer h5 {
            font-weight: 700;
            margin-bottom: 25px;
            font-size: 1.1rem;
            text-transform: uppercase;
        }

        footer a {
            color: #adb5bd;
            text-decoration: none;
            transition: color 0.3s ease;
            font-size: 0.9rem;
        }

        footer a:hover {
            color: var(--theme-green);
        }

        footer .social-links a {
            display: inline-flex;
            width: 35px;
            height: 35px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            transition: background 0.3s;
        }

        footer .social-links a:hover {
            background: var(--theme-green);
            color: #fff;
        }

        /* Buttons */
        .btn-theme {
            background-color: var(--theme-green);
            color: #fff;
            font-weight: 700;
            padding: 10px 25px;
            border-radius: 4px;
            text-transform: uppercase;
            border: none;
            transition: background 0.3s;
        }

        .btn-theme:hover {
            background-color: var(--theme-blue);
            color: #fff;
        }

        /* For backward compatibility with elements still using btn-red class */
        .btn-red {
            @extend .btn-theme;
        }
        .btn-red {
            background-color: var(--theme-green);
            color: #fff;
            font-weight: 700;
            padding: 10px 25px;
            border-radius: 4px;
            text-transform: uppercase;
            border: none;
            transition: background 0.3s;
        }
        .btn-red:hover {
            background-color: var(--theme-blue);
            color: #fff;
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 1s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 991px) {
            .top-bar .info-item {
                margin-left: 0;
                margin-bottom: 10px;
            }

            .navbar-nav .nav-link {
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }
        }
    </style>
    @yield('styles')
</head>

<body>

    <!-- Top Bar -->
    <div class="top-bar d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 text-start">
                    <a href="{{ route('home') }}" class="logo-text">
                        <img src="{{ asset('images/logo.png') }}" alt="S2 Certification" style="height: 60px;">
                    </a>
                </div>
                <div class="col-lg-8 d-flex justify-content-end">
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <strong>Email:</strong><br>
                            info@s2cert.com
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <strong>Phone:</strong><br>
                            +92 311 8205671
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <strong>Address:</strong><br>
                            Parco Head Office Rd, Karachi
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand d-lg-none text-white fw-bold" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="S2 Certification" style="height: 40px;">
            </a>
            <button class="navbar-toggler border-white text-white" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="fas fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav w-100">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('about') ? 'active' : '' }}" href="{{ route('about') }}">About
                            Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('services') ? 'active' : '' }}"
                            href="{{ route('services') }}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('verify') ? 'active' : '' }}"
                            href="{{ route('verify') }}">Certificate Verification</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('contact') ? 'active' : '' }}"
                            href="{{ route('contact') }}">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 mb-4 text-start">
                    <a href="{{ route('home') }}" class="logo-text text-white mb-4 d-inline-block bg-white p-2 rounded"
                        style="text-decoration:none;">
                        <img src="{{ asset('images/logo.png') }}" alt="S2 Certification" style="height: 50px;">
                    </a>
                    <p class="small">S2 Certification is a global provider
                        of management system certification and inspection services.</p>
                    <div class="social-links mt-3">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 mb-4">
                    <h5>Our Services</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">ISO 9001:2015</a></li>
                        <li><a href="#">ISO 14001:2015</a></li>
                        <li><a href="#">ISO 45001:2018</a></li>
                        <li><a href="#">ISO 22000</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('services') }}">Services</a></li>
                        <li><a href="{{ route('verify') }}">Verification</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4 text-start">
                    <h5>Connect With Us</h5>
                    <ul class="list-unstyled  small">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2 text-white"></i> Plot no 78 Near Parco
                            Head Office Korangi Creek Road, Karachi</li>
                        <li class="mb-2"><i class="fas fa-phone-alt me-2 text-white"></i> +92 311 8205671</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2 text-white"></i> info@s2cert.com</li>
                        <li class="mb-2"><i class="fab fa-whatsapp me-2 text-white"></i> +92 304 3278467</li>
                    </ul>
                </div>
            </div>
            <hr style="background: rgba(255,255,255,0.1)">
            <div class="row">
                <div class="col-md-12 text-center pt-3">
                    <p class=" small mb-0">&copy; {{ date('Y') }} S2 Certification. All
                        Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>