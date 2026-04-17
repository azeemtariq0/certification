@extends('layouts.app')

@section('title', 'S2 Certification - Global Certification & Inspection Services')

@section('content')
    <!-- Hero Slider Segment (Simplified as static for now) -->
    <section class="hero-wrap" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset('images/hero_bg.png') }}'); background-size: cover; background-position: center; color: #fff; padding: 150px 0;">
        <div class="container text-center fade-in">
            <h1 class="display-3 fw-bold mb-3" style="text-transform: uppercase;"><span style="color: var(--theme-blue);">S2</span> <span style="color: var(--theme-green);">CERTIFICATION</span></h1>
            <p class="lead mb-5" style="max-width: 800px; margin: 0 auto;">Global provider of management system certification and inspection services, helping organizations achieve excellence through international standards.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('services') }}" class="btn btn-theme btn-lg">Our Services</a>
                <a href="{{ route('about') }}" class="btn btn-outline-light btn-lg" style="border-radius: 4px;">Learn More</a>
            </div>
        </div>
    </section>

    <!-- Welcome Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h5 class="text-uppercase fw-bold" style="color: var(--theme-green); letter-spacing: 2px;">Welcome to S2 Certification</h5>
                    <h2 class="display-6 fw-bold mb-4" style="color: var(--dark-blue);">Global Expertise in Certification & Inspection</h2>
                    <p class="text-muted mb-4">S2 Certification is a leading provider of worldwide certification and accreditation services. We help businesses achieve excellence through international standards like ISO 9001, 14001, and more.</p>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span class="fw-bold">Experienced Auditors</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span class="fw-bold">Global Recognition</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span class="fw-bold">Transparent Process</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span class="fw-bold">Value-added Service</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('images/corporate_teamwork.png') }}" alt="Team Work" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Overview -->
    <section class="py-5" style="background: var(--light-bg);">
        <div class="container text-center mb-5">
            <h2 class="fw-bold" style="color: var(--dark-blue);">Our Core <span style="color: var(--theme-green);">Services</span></h2>
            <div class="mx-auto mt-2" style="width: 60px; height: 3px; background: var(--theme-blue);"></div>
        </div>
        <div class="container">
            <div class="row g-4 text-center">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-4">
                        <div class="mb-4">
                            <i class="fas fa-award fa-3x" style="color: var(--theme-green);"></i>
                        </div>
                        <h4 class="fw-bold mb-3">ISO 9001:2015</h4>
                        <p class="text-muted small">Quality Management Systems (QMS) to improve performance and build customer trust.</p>
                        <a href="{{ route('services') }}" class="text-decoration-none fw-bold" style="color: var(--theme-blue);">Details <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-4">
                        <div class="mb-4">
                            <i class="fas fa-leaf fa-3x" style="color: var(--theme-green);"></i>
                        </div>
                        <h4 class="fw-bold mb-3">ISO 14001:2015</h4>
                        <p class="text-muted small">Environmental Management Systems to minimize ecological footprint and ensure compliance.</p>
                        <a href="{{ route('services') }}" class="text-decoration-none fw-bold" style="color: var(--theme-blue);">Details <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-4">
                        <div class="mb-4">
                            <i class="fas fa-shield-alt fa-3x" style="color: var(--theme-green);"></i>
                        </div>
                        <h4 class="fw-bold mb-3">ISO 45001:2018</h4>
                        <p class="text-muted small">Occupational Health and Safety management systems for a safer working environment.</p>
                        <a href="{{ route('services') }}" class="text-decoration-none fw-bold" style="color: var(--theme-blue);">Details <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('services') }}" class="btn btn-red px-5 py-3">View All Certification Services</a>
            </div>
        </div>
    </section>

    <!-- Why Us / Stats -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row text-center align-items-center">
                <div class="col-6 col-md-3 mb-4 mb-md-0">
                    <h2 class="fw-bold" style="color: var(--theme-green);">2000+</h2>
                    <p class="text-muted text-uppercase small">Issued Certificates</p>
                </div>
                <div class="col-6 col-md-3 mb-4 mb-md-0">
                    <h2 class="fw-bold" style="color: var(--theme-green);">350+</h2>
                    <p class="text-muted text-uppercase small">Global Partners</p>
                </div>
                <div class="col-6 col-md-3">
                    <h2 class="fw-bold" style="color: var(--theme-green);">15+</h2>
                    <p class="text-muted text-uppercase small">Countries Served</p>
                </div>
                <div class="col-6 col-md-3">
                    <h2 class="fw-bold" style="color: var(--theme-green);">100%</h2>
                    <p class="text-muted text-uppercase small">Client Satisfaction</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Verification CTA -->
    <section class="py-5 text-white" style="background: var(--dark-blue);">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Validate Your Certification</h2>
            <p class="mb-5 opacity-75 mx-auto" style="max-width: 700px;">Our online verification system allows you to check the authenticity and current status of any certificate issued by S2 Certification.</p>
            <a href="{{ route('verify') }}" class="btn btn-theme btn-lg px-5">Verify Certificate Now</a>
        </div>
    </section>
@endsection
