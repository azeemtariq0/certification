@extends('layouts.app')

@section('title', 'Our Services - S2 Certification')

@section('content')
    <!-- Page Title Bar -->
    <div class="page-title-bar">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>Our Services</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"
                            style="color: var(--theme-green); text-decoration: none;">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Services</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Services Grid -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Service 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center">
                        <div class="mb-4">
                            <i class="fas fa-check-circle fa-3x" style="color: var(--theme-green);"></i>
                        </div>
                        <h4 class="fw-bold mb-3" style="color: var(--dark-blue);">ISO 9001:2015</h4>
                        <p class="text-muted small">Quality Management Systems (QMS) to improve overall performance and
                            provide a sound basis for sustainable development initiatives.</p>
                        <hr class="w-25 mx-auto" style="border-top: 2px solid var(--theme-blue);">
                        <a href="#" class="text-decoration-none fw-bold small" style="color: var(--theme-blue);">Read
                            More</a>
                    </div>
                </div>
                <!-- Service 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center">
                        <div class="mb-4">
                            <i class="fas fa-leaf fa-3x" style="color: var(--theme-green);"></i>
                        </div>
                        <h4 class="fw-bold mb-3" style="color: var(--dark-blue);">ISO 14001:2015</h4>
                        <p class="text-muted small">Environmental Management Systems (EMS) that help organizations minimize
                            their environmental impact and comply with laws.</p>
                        <hr class="w-25 mx-auto" style="border-top: 2px solid var(--theme-blue);">
                        <a href="#" class="text-decoration-none fw-bold small" style="color: var(--theme-blue);">Read
                            More</a>
                    </div>
                </div>
                <!-- Service 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center">
                        <div class="mb-4">
                            <i class="fas fa-shield-alt fa-3x" style="color: var(--theme-green);"></i>
                        </div>
                        <h4 class="fw-bold mb-3" style="color: var(--dark-blue);">ISO 27001:2022</h4>
                        <p class="text-muted small">Information Security Management Systems (ISMS) to manage and protect
                            your information assets so they remain safe and secure.</p>
                        <hr class="w-25 mx-auto" style="border-top: 2px solid var(--theme-blue);">
                        <a href="#" class="text-decoration-none fw-bold small" style="color: var(--theme-blue);">Read
                            More</a>
                    </div>
                </div>
                <!-- Service 4 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center">
                        <div class="mb-4">
                            <i class="fas fa-hard-hat fa-3x" style="color: var(--theme-green);"></i>
                        </div>
                        <h4 class="fw-bold mb-3" style="color: var(--dark-blue);">ISO 45001:2018</h4>
                        <p class="text-muted small">Occupational Health and Safety (OH&S) management systems that provide a
                            safe and healthy workplace for employees.</p>
                        <hr class="w-25 mx-auto" style="border-top: 2px solid var(--theme-blue);">
                        <a href="#" class="text-decoration-none fw-bold small" style="color: var(--theme-blue);">Read
                            More</a>
                    </div>
                </div>
                <!-- Service 5 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center">
                        <div class="mb-4">
                            <i class="fas fa-utensils fa-3x" style="color: var(--theme-green);"></i>
                        </div>
                        <h4 class="fw-bold mb-3" style="color: var(--dark-blue);">ISO 22000:2018</h4>
                        <p class="text-muted small">Food Safety Management Systems (FSMS) for organizations involved in the
                            food chain to ensure food is safe for consumption.</p>
                        <hr class="w-25 mx-auto" style="border-top: 2px solid var(--theme-blue);">
                        <a href="#" class="text-decoration-none fw-bold small" style="color: var(--theme-blue);">Read
                            More</a>
                    </div>
                </div>
                <!-- Service 6 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center">
                        <div class="mb-4">
                            <i class="fas fa-search fa-3x" style="color: var(--theme-green);"></i>
                        </div>
                        <h4 class="fw-bold mb-3" style="color: var(--dark-blue);">Inspection Services</h4>
                        <p class="text-muted small">Comprehensive third-party inspection services for various industries to
                            ensure equipment and process compliance.</p>
                        <hr class="w-25 mx-auto" style="border-top: 2px solid var(--theme-blue);">
                        <a href="#" class="text-decoration-none fw-bold small" style="color: var(--theme-blue);">Read
                            More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom Section -->
    <section class="py-5" style="background: var(--dark-blue);">
        <div class="container text-center text-white">
            <h3 class="fw-bold mb-4">Request a Proposal for Certification</h3>
            <p class="mb-4 opacity-75">Our experts are available to discuss your specific needs and provide a tailored
                solution.</p>
            <a href="{{ route('contact') }}" class="btn btn-theme btn-lg px-5">Get a Quote</a>
        </div>
    </section>
@endsection