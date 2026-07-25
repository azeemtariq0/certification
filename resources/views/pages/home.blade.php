@extends('layouts.app')

@section('title', 'S2 Certification - Global Certification & Inspection Services')

@section('content')
    <!-- Hero Slider Segment (Simplified as static for now) -->
    <section class="hero-wrap" style="background: linear-gradient(135deg, rgba(26, 32, 44, 0.85) 0%, rgba(45, 86, 161, 0.7) 100%), url('{{ asset('images/hero_bg.png') }}'); background-size: cover; background-position: center; color: #fff; padding: 150px 0; position: relative; overflow: hidden;">
        <div class="container text-center">
            <h1 class="display-3 fw-bold mb-3 reveal reveal-up" style="text-transform: uppercase; letter-spacing: 2px;">
                <span style="color: #fff;">S2</span> <span style="color: var(--theme-green);">CERTIFICATION</span>
            </h1>
            <p class="lead mb-5 reveal reveal-up delay-200" style="max-width: 800px; margin: 0 auto; opacity: 0.9;">
                Global provider of management system certification and inspection services, helping organizations achieve excellence through international standards.
            </p>
            <div class="d-flex justify-content-center gap-3 reveal reveal-scale delay-400">
                <a href="{{ route('services') }}" class="btn btn-theme btn-premium btn-lg px-4 shadow">Our Services</a>
                <a href="{{ route('about') }}" class="btn btn-outline-light btn-lg px-4" style="border-radius: 4px; transition: all 0.3s;">Learn More</a>
            </div>
        </div>
    </section>

    <!-- Services Overview -->
    <section class="py-5" style="background: var(--light-bg); overflow: hidden;">
        <div class="container text-center mb-5 reveal reveal-up">
            <h2 class="fw-bold" style="color: var(--dark-blue);">Our Certification <span style="color: var(--theme-green);">Standards</span></h2>
            <div class="mx-auto mt-2" style="width: 60px; height: 3px; background: var(--theme-blue);"></div>
        </div>
        <div class="container">
            <div class="row g-4">
                <!-- ISO 9001 -->
                <div class="col-lg-3 col-md-6 reveal reveal-up delay-100">
                    <div class="card h-100 border-0 shadow-sm hover-card-lift p-4 text-start d-flex flex-column justify-content-between" style="border-radius: 8px;">
                        <div>
                            <span class="d-block fw-bold fs-5 mb-1" style="color: var(--dark-blue);">ISO 9001</span>
                            <span class="d-block fw-bold mb-3" style="color: var(--theme-blue); font-size: 0.95rem;">Quality Management Systems</span>
                            <p class="text-muted small mb-4">Focus on quality to win business & retain customers.</p>
                        </div>
                        <div class="text-end mt-auto">
                            <a href="{{ route('services') }}" class="text-decoration-none fw-bold small align-items-center d-inline-flex" style="color: #f05a28; transition: color 0.3s;">
                                Read More <i class="fas fa-caret-right ms-2" style="font-size: 0.85rem;"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- ISO 14001 -->
                <div class="col-lg-3 col-md-6 reveal reveal-up delay-200">
                    <div class="card h-100 border-0 shadow-sm hover-card-lift p-4 text-start d-flex flex-column justify-content-between" style="border-radius: 8px;">
                        <div>
                            <span class="d-block fw-bold fs-5 mb-1" style="color: var(--dark-blue);">ISO 14001</span>
                            <span class="d-block fw-bold mb-3" style="color: var(--theme-blue); font-size: 0.95rem;">Environmental Management Systems</span>
                            <p class="text-muted small mb-4">Showcase your environmental credentials.</p>
                        </div>
                        <div class="text-end mt-auto">
                            <a href="{{ route('services') }}" class="text-decoration-none fw-bold small align-items-center d-inline-flex" style="color: #f05a28; transition: color 0.3s;">
                                Read More <i class="fas fa-caret-right ms-2" style="font-size: 0.85rem;"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- ISO 22301 -->
                <div class="col-lg-3 col-md-6 reveal reveal-up delay-300">
                    <div class="card h-100 border-0 shadow-sm hover-card-lift p-4 text-start d-flex flex-column justify-content-between" style="border-radius: 8px;">
                        <div>
                            <span class="d-block fw-bold fs-5 mb-1" style="color: var(--dark-blue);">ISO 22301</span>
                            <span class="d-block fw-bold mb-3" style="color: var(--theme-blue); font-size: 0.95rem;">Business Continuity Management Systems</span>
                            <p class="text-muted small mb-4">Protect your business from interruptions.</p>
                        </div>
                        <div class="text-end mt-auto">
                            <a href="{{ route('services') }}" class="text-decoration-none fw-bold small align-items-center d-inline-flex" style="color: #f05a28; transition: color 0.3s;">
                                Read More <i class="fas fa-caret-right ms-2" style="font-size: 0.85rem;"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- ISO 27001 -->
                <div class="col-lg-3 col-md-6 reveal reveal-up delay-400">
                    <div class="card h-100 border-0 shadow-sm hover-card-lift p-4 text-start d-flex flex-column justify-content-between" style="border-radius: 8px;">
                        <div>
                            <span class="d-block fw-bold fs-5 mb-1" style="color: var(--dark-blue);">ISO 27001</span>
                            <span class="d-block fw-bold mb-3" style="color: var(--theme-blue); font-size: 0.95rem;">Information Security Management System</span>
                            <p class="text-muted small mb-4">Implement a robust approach to information security.</p>
                        </div>
                        <div class="text-end mt-auto">
                            <a href="{{ route('services') }}" class="text-decoration-none fw-bold small align-items-center d-inline-flex" style="color: #f05a28; transition: color 0.3s;">
                                Read More <i class="fas fa-caret-right ms-2" style="font-size: 0.85rem;"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- ISO 42001 -->
                <div class="col-lg-3 col-md-6 reveal reveal-up delay-100">
                    <div class="card h-100 border-0 shadow-sm hover-card-lift p-4 text-start d-flex flex-column justify-content-between" style="border-radius: 8px;">
                        <div>
                            <span class="d-block fw-bold fs-5 mb-1" style="color: var(--dark-blue);">ISO 42001</span>
                            <span class="d-block fw-bold mb-3" style="color: var(--theme-blue); font-size: 0.95rem;">Artificial Intelligence Management</span>
                            <p class="text-muted small mb-4">Support safe and secure AI operations.</p>
                        </div>
                        <div class="text-end mt-auto">
                            <a href="{{ route('services') }}" class="text-decoration-none fw-bold small align-items-center d-inline-flex" style="color: #f05a28; transition: color 0.3s;">
                                Read More <i class="fas fa-caret-right ms-2" style="font-size: 0.85rem;"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- ISO 45001 -->
                <div class="col-lg-3 col-md-6 reveal reveal-up delay-200">
                    <div class="card h-100 border-0 shadow-sm hover-card-lift p-4 text-start d-flex flex-column justify-content-between" style="border-radius: 8px;">
                        <div>
                            <span class="d-block fw-bold fs-5 mb-1" style="color: var(--dark-blue);">ISO 45001</span>
                            <span class="d-block fw-bold mb-3" style="color: var(--theme-blue); font-size: 0.95rem;">Health & Safety Management</span>
                            <p class="text-muted small mb-4">Implement health & safety systems.</p>
                        </div>
                        <div class="text-end mt-auto">
                            <a href="{{ route('services') }}" class="text-decoration-none fw-bold small align-items-center d-inline-flex" style="color: #f05a28; transition: color 0.3s;">
                                Read More <i class="fas fa-caret-right ms-2" style="font-size: 0.85rem;"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Cyber Essentials -->
                <div class="col-lg-3 col-md-6 reveal reveal-up delay-300">
                    <div class="card h-100 border-0 shadow-sm hover-card-lift p-4 text-start d-flex flex-column justify-content-between" style="border-radius: 8px;">
                        <div>
                            <span class="d-block fw-bold fs-5 mb-1" style="color: var(--dark-blue);">Cyber Essentials</span>
                            <span class="d-block fw-bold mb-3" style="color: var(--theme-blue); font-size: 0.95rem;">Government-Endorsed Cyber Security</span>
                            <p class="text-muted small mb-4">Secure your IT systems and protect your customer data.</p>
                        </div>
                        <div class="text-end mt-auto">
                            <a href="{{ route('services') }}" class="text-decoration-none fw-bold small align-items-center d-inline-flex" style="color: #f05a28; transition: color 0.3s;">
                                Read More <i class="fas fa-caret-right ms-2" style="font-size: 0.85rem;"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- PAS 2030 -->
                <div class="col-lg-3 col-md-6 reveal reveal-up delay-400">
                    <div class="card h-100 border-0 shadow-sm hover-card-lift p-4 text-start d-flex flex-column justify-content-between" style="border-radius: 8px;">
                        <div>
                            <span class="d-block fw-bold fs-5 mb-1" style="color: var(--dark-blue);">PAS 2030</span>
                            <span class="d-block fw-bold mb-3" style="color: var(--theme-blue); font-size: 0.95rem;">Energy Efficiency Installation</span>
                            <p class="text-muted small mb-4">The UK's standard for installing energy efficiency measures.</p>
                        </div>
                        <div class="text-end mt-auto">
                            <a href="{{ route('services') }}" class="text-decoration-none fw-bold small align-items-center d-inline-flex" style="color: #f05a28; transition: color 0.3s;">
                                Read More <i class="fas fa-caret-right ms-2" style="font-size: 0.85rem;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5 reveal reveal-up delay-300">
                <a href="{{ route('services') }}" class="btn btn-red btn-premium px-5 py-3 shadow">View All Certification Services</a>
            </div>
        </div>
    </section>

    <!-- Welcome Section -->
    <section class="py-5 bg-white overflow-hidden">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0 reveal reveal-left">
                    <h5 class="text-uppercase fw-bold" style="color: var(--theme-green); letter-spacing: 2px;">Welcome to S2 Certification</h5>
                    <h2 class="display-6 fw-bold mb-4" style="color: var(--dark-blue);">Global Expertise in Certification & Inspection</h2>
                    <p class="text-muted mb-4">S2 Certification is a leading provider of worldwide certification and accreditation services. We help businesses achieve excellence through international standards like ISO 9001, 14001, and more.</p>
                    <div class="row g-4">
                        <div class="col-md-6 reveal reveal-up delay-100">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span class="fw-bold">Experienced Auditors</span>
                            </div>
                        </div>
                        <div class="col-md-6 reveal reveal-up delay-200">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span class="fw-bold">Global Recognition</span>
                            </div>
                        </div>
                        <div class="col-md-6 reveal reveal-up delay-300">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span class="fw-bold">Transparent Process</span>
                            </div>
                        </div>
                        <div class="col-md-6 reveal reveal-up delay-400">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span class="fw-bold">Value-added Service</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 reveal reveal-right delay-200">
                    <img src="{{ asset('images/corporate_teamwork.png') }}" alt="Team Work" class="img-fluid rounded shadow" style="transition: transform 0.5s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
                </div>
            </div>
        </div>
    </section>

    <!-- Why Us / Stats -->
    <section class="py-5 bg-white reveal reveal-up">
        <div class="container">
            <div class="row text-center align-items-center">
                <div class="col-6 col-md-3 mb-4 mb-md-0">
                    <h2 class="fw-bold display-5" style="color: var(--theme-green);">
                        <span class="stat-count" data-target="2000" data-suffix="+">2000+</span>
                    </h2>
                    <p class="text-muted text-uppercase small">Issued Certificates</p>
                </div>
                <div class="col-6 col-md-3 mb-4 mb-md-0">
                    <h2 class="fw-bold display-5" style="color: var(--theme-green);">
                        <span class="stat-count" data-target="350" data-suffix="+">350+</span>
                    </h2>
                    <p class="text-muted text-uppercase small">Global Partners</p>
                </div>
                <div class="col-6 col-md-3">
                    <h2 class="fw-bold display-5" style="color: var(--theme-green);">
                        <span class="stat-count" data-target="15" data-suffix="+">15+</span>
                    </h2>
                    <p class="text-muted text-uppercase small">Countries Served</p>
                </div>
                <div class="col-6 col-md-3">
                    <h2 class="fw-bold display-5" style="color: var(--theme-green);">
                        <span class="stat-count" data-target="100" data-suffix="%">100%</span>
                    </h2>
                    <p class="text-muted text-uppercase small">Client Satisfaction</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Discover More About ISO -->
    <section class="py-5" style="background: var(--light-bg); overflow: hidden;">
        <div class="container text-center mb-5 reveal reveal-up">
            <h2 class="fw-bold display-6" style="color: var(--dark-blue);">Discover More About ISO</h2>
            <div class="mx-auto mt-2" style="width: 60px; height: 3px; background: var(--theme-blue);"></div>
        </div>
        <div class="container">
            <div class="row g-4">
                <!-- ISO Buyers Guide -->
                <div class="col-md-4 reveal reveal-up delay-100">
                    <div class="card h-100 border-0 shadow-sm overflow-hidden hover-card-lift" style="border-radius: 12px;">
                        <div class="zoom-img-container" style="background: #1a202c; display: flex; align-items: center; justify-content: center; overflow: hidden; height: 220px;">
                            <img src="{{ asset('images/iso_buyers_guide.png') }}" alt="ISO Buyers Guide" class="w-100 h-100" style="object-fit: cover;">
                        </div>
                        <div class="card-body p-4 text-start d-flex flex-column justify-content-between">
                            <div>
                                <h4 class="fw-bold mb-3" style="color: var(--dark-blue); font-size: 1.2rem;">ISO Buyers Guide</h4>
                                <p class="text-muted small mb-4">ISO certification offers you a combination of business and marketing tools. Achieving your standards will deliver improvements to your organisation, and it will also strengthen your ability to tender for new contracts and retain existing clients.</p>
                            </div>
                            <div class="text-end mt-auto">
                                <a href="{{ route('about') }}" class="text-decoration-none fw-bold small align-items-center d-inline-flex" style="color: #f05a28;">
                                    Read More <i class="fas fa-caret-right ms-2" style="font-size: 0.85rem;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 6 steps to ISO certification -->
                <div class="col-md-4 reveal reveal-up delay-200">
                    <div class="card h-100 border-0 shadow-sm overflow-hidden hover-card-lift" style="border-radius: 12px;">
                        <div class="zoom-img-container" style="background: #1a202c; display: flex; align-items: center; justify-content: center; overflow: hidden; height: 220px;">
                            <img src="{{ asset('images/steps_to_iso.png') }}" alt="6 steps to ISO certification" class="w-100 h-100" style="object-fit: cover;">
                        </div>
                        <div class="card-body p-4 text-start d-flex flex-column justify-content-between">
                            <div>
                                <h4 class="fw-bold mb-3" style="color: var(--dark-blue); font-size: 1.2rem;">6 steps to ISO certification</h4>
                                <p class="text-muted small mb-4">The certification process may sound daunting, but it's far more straightforward than you might think. If you want to learn how to get ISO certification but don't know where to start — follow these 6 steps.</p>
                            </div>
                            <div class="text-end mt-auto">
                                <a href="{{ route('services') }}" class="text-decoration-none fw-bold small align-items-center d-inline-flex" style="color: #f05a28;">
                                    Read More <i class="fas fa-caret-right ms-2" style="font-size: 0.85rem;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 3-year ISO certification cycle explained -->
                <div class="col-md-4 reveal reveal-up delay-300">
                    <div class="card h-100 border-0 shadow-sm overflow-hidden hover-card-lift" style="border-radius: 12px;">
                        <div class="zoom-img-container" style="background: #1a202c; display: flex; align-items: center; justify-content: center; overflow: hidden; height: 220px;">
                            <img src="{{ asset('images/iso_cycle.png') }}" alt="3-year ISO certification cycle explained" class="w-100 h-100" style="object-fit: cover;">
                        </div>
                        <div class="card-body p-4 text-start d-flex flex-column justify-content-between">
                            <div>
                                <h4 class="fw-bold mb-3" style="color: var(--dark-blue); font-size: 1.2rem;">3-year ISO certification cycle explained</h4>
                                <p class="text-muted small mb-4">ISO certification is not a single event, but rather an ongoing process that ensures your business complies with the requirements of its chosen standard. In this article we explain the system of audits that are used for assessment.</p>
                            </div>
                            <div class="text-end mt-auto">
                                <a href="{{ route('about') }}" class="text-decoration-none fw-bold small align-items-center d-inline-flex" style="color: #f05a28;">
                                    Read More <i class="fas fa-caret-right ms-2" style="font-size: 0.85rem;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Verification CTA -->
    <section class="py-5 text-white" style="background: linear-gradient(135deg, var(--dark-blue) 0%, #1e293b 100%);">
        <div class="container text-center reveal reveal-scale">
            <h2 class="fw-bold mb-4">Validate Your Certification</h2>
            <p class="mb-5 opacity-75 mx-auto" style="max-width: 700px;">Our online verification system allows you to check the authenticity and current status of any certificate issued by S2 Certification.</p>
            <a href="{{ route('verify') }}" class="btn btn-theme btn-premium btn-lg px-5 shadow">Verify Certificate Now</a>
        </div>
    </section>
@endsection
