@extends('layouts.app')

@section('title', 'About Us - S2 Certification')

@section('content')
    <!-- Page Title Bar -->
    <div class="page-title-bar">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>About Us</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: var(--theme-green); text-decoration: none;">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About Us</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Company Story -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4">
                    <img src="{{ asset('images/corporate_teamwork.png') }}" alt="Team" class="img-fluid rounded shadow">
                </div>
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4" style="color: var(--dark-blue);">Our Mission and Vision</h2>
                    <p class="mb-4 text-muted">S2 Certification has been at the forefront of the certification industry, helping thousands of businesses worldwide achieve excellence through international standards. Our goal is to empower organizations by providing reliable, independent, and professional certification services.</p>
                    <div class="mb-4 d-flex align-items-start">
                        <div class="me-3">
                            <i class="fas fa-bullseye fa-2x" style="color: var(--theme-green);"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold" style="color: var(--dark-blue);">Our Mission</h5>
                            <p class="text-muted small">To provide high-quality, value-added certification services that enable our clients to demonstrate their commitment to excellence, quality, and sustainability.</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start">
                        <div class="me-3">
                            <i class="fas fa-eye fa-2x" style="color: var(--theme-blue);"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold" style="color: var(--dark-blue);">Our Vision</h5>
                            <p class="text-muted small">To be the world’s most trusted partner in certification, recognized for our integrity, technical expertise, and customer-centric approach.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values -->
    <section class="py-5 bg-white border-top">
        <div class="container text-center mb-5">
            <h2 class="fw-bold" style="color: var(--dark-blue);">Our Core <span style="color: var(--theme-green);">Values</span></h2>
            <div class="mx-auto mt-2" style="width: 60px; height: 3px; background: var(--theme-blue);"></div>
        </div>
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-4">
                    <div class="p-4 card border-0 h-100 shadow-sm">
                        <div class="mb-3">
                            <i class="fas fa-handshake fa-3x" style="color: var(--theme-green);"></i>
                        </div>
                        <h4 class="fw-bold" style="color: var(--dark-blue);">Integrity</h4>
                        <p class="text-muted small">We maintain the highest ethical standards in all our dealings, ensuring impartiality and transparency.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 card border-0 h-100 shadow-sm">
                        <div class="mb-3">
                            <i class="fas fa-user-graduate fa-3x" style="color: var(--theme-blue);"></i>
                        </div>
                        <h4 class="fw-bold" style="color: var(--dark-blue);">Expertise</h4>
                        <p class="text-muted small">Our team of auditors is composed of industry experts with deep technical knowledge and experience.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 card border-0 h-100 shadow-sm">
                        <div class="mb-3">
                            <i class="fas fa-heart fa-3x" style="color: var(--theme-green);"></i>
                        </div>
                        <h4 class="fw-bold" style="color: var(--dark-blue);">Customer Care</h4>
                        <p class="text-muted small">We build long-lasting relationships with our clients, providing support and guidance throughout the process.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Global Reach Section -->
    <section class="py-5" style="background: var(--dark-blue); color: #fff;">
        <div class="container py-4 text-center">
            <h2 class="fw-bold mb-4">A Global Network of Trust</h2>
            <p class="mb-0 opacity-75 mx-auto" style="max-width: 800px;">With representatives in over 15 countries and auditors across the globe, S2 Certification offers a truly international perspective with local expertise.</p>
        </div>
    </section>
@endsection
