@extends('layouts.app')

@section('title', 'S2 Certification - Global Certification & Inspection Services')

@section('styles')
<style>
    /* HERO */
    .home-hero {
        background:
            linear-gradient(115deg, rgba(20, 33, 61, 0.93) 0%, rgba(20, 33, 61, 0.72) 45%, rgba(45, 86, 161, 0.55) 100%),
            url('{{ asset('images/hero_bg.png') }}');
        background-size: cover;
        background-position: center;
        color: #fff;
        padding: 120px 0 0;
        position: relative;
        overflow: hidden;
    }
    .home-hero .badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(65, 139, 44, 0.2);
        border: 1px solid rgba(65, 139, 44, 0.5);
        color: #cfeec4;
        padding: 8px 18px;
        border-radius: 50px;
        font-family: var(--heading-font);
        font-weight: 600;
        font-size: 0.82rem;
        letter-spacing: 0.03em;
    }
    .home-hero h1 {
        font-weight: 800;
        font-size: clamp(2.2rem, 5vw, 3.6rem);
        line-height: 1.1;
        margin: 22px 0 20px;
    }
    .home-hero p.lead { font-size: 1.12rem; opacity: 0.9; max-width: 620px; }
    .hero-check { display:flex; align-items:center; gap:10px; font-family: var(--heading-font); font-weight:600; font-size:0.95rem; }
    .hero-check i { color: var(--theme-green); }

    /* Trust strip */
    .trust-strip {
        background: #fff;
        border-radius: 18px 18px 0 0;
        box-shadow: 0 -10px 40px rgba(20,33,61,0.10);
        margin-top: 70px;
        padding: 30px 0;
    }
    .trust-item { display:flex; align-items:center; gap:14px; justify-content:center; }
    .trust-item .ti-icon {
        width: 48px; height: 48px; border-radius: 12px;
        background: var(--soft-bg); color: var(--theme-blue);
        display:flex; align-items:center; justify-content:center; font-size:1.2rem; flex-shrink:0;
    }
    .trust-item strong { display:block; font-family: var(--heading-font); color: var(--dark-blue); font-size:1rem; line-height:1.2; }
    .trust-item span { font-size:0.82rem; color: var(--text-muted); }

    /* Standard cards */
    .std-card { border-radius: 16px; padding: 30px 26px; height: 100%; }
    .std-card .std-icon {
        width: 56px; height: 56px; border-radius: 14px;
        background: linear-gradient(135deg, rgba(65,139,44,0.12), rgba(45,86,161,0.12));
        color: var(--theme-green);
        display:flex; align-items:center; justify-content:center; font-size:1.4rem; margin-bottom: 20px;
    }
    .std-card h4 { font-weight: 800; color: var(--dark-blue); font-size: 1.25rem; margin-bottom: 4px; }
    .std-card .std-sub { color: var(--theme-blue); font-weight: 600; font-size: 0.85rem; display:block; margin-bottom: 12px; font-family: var(--heading-font); }

    /* Why us */
    .why-item { display:flex; gap:16px; }
    .why-item .why-icon {
        width: 52px; height: 52px; border-radius: 14px; flex-shrink:0;
        background: var(--theme-green); color:#fff;
        display:flex; align-items:center; justify-content:center; font-size:1.2rem;
    }
    .why-item h5 { font-weight: 700; color: var(--dark-blue); font-size:1.05rem; margin-bottom:4px; }

    /* Stats band */
    .stats-band {
        background: linear-gradient(120deg, var(--dark-blue) 0%, var(--navy-2) 100%);
        color:#fff; border-radius: 20px; padding: 46px 20px;
        position: relative; overflow:hidden;
    }
    .stats-band::before {
        content:''; position:absolute; inset:0;
        background: url('https://www.transparenttextures.com/patterns/carbon-fibre.png'); opacity:0.08;
    }
    .stat-num { font-family: var(--heading-font); font-weight: 800; font-size: clamp(2rem, 4vw, 3rem); color: #7ed957; }
    .stat-label { text-transform: uppercase; letter-spacing:0.06em; font-size:0.8rem; opacity:0.8; }

    .accred-logo {
        height: 46px; opacity: 0.55; filter: grayscale(1);
        transition: all .3s ease; display:flex; align-items:center; gap:8px;
        font-family: var(--heading-font); font-weight:800; color: var(--dark-blue); font-size:1.1rem;
    }
    .accred-logo:hover { opacity: 1; filter: grayscale(0); }
</style>
@endsection

@section('content')
    <!-- ================= HERO ================= -->
    <section class="home-hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <span class="badge-pill reveal reveal-up"><i class="fas fa-shield-halved"></i> Trusted ISO Certification Body</span>
                    <h1 class="reveal reveal-up delay-100">Certifying Businesses to <span class="text-green">Global Standards</span></h1>
                    <p class="lead reveal reveal-up delay-200">
                        S2 Certification helps organisations achieve internationally recognised ISO certification and inspection — building trust, opening markets and driving continuous improvement.
                    </p>
                    <div class="d-flex flex-wrap gap-3 mt-4 reveal reveal-scale delay-300">
                        <a href="{{ route('contact') }}" class="btn btn-theme btn-premium btn-lg px-4">Get a Free Quote</a>
                        <a href="{{ route('services') }}" class="btn btn-ghost-light btn-lg px-4">Explore Standards</a>
                    </div>
                    <div class="d-flex flex-wrap gap-4 mt-4 pt-2 reveal reveal-up delay-400">
                        <div class="hero-check"><i class="fas fa-check-circle"></i> Globally Recognised</div>
                        <div class="hero-check"><i class="fas fa-check-circle"></i> Expert Auditors</div>
                        <div class="hero-check"><i class="fas fa-check-circle"></i> Fast, Transparent Process</div>
                    </div>
                </div>
            </div>

            <!-- Trust strip -->
            <div class="trust-strip reveal reveal-up delay-200">
                <div class="row g-4">
                    <div class="col-md-3 col-6"><div class="trust-item"><div class="ti-icon"><i class="fas fa-globe"></i></div><div><strong>15+ Countries</strong><span>Served worldwide</span></div></div></div>
                    <div class="col-md-3 col-6"><div class="trust-item"><div class="ti-icon"><i class="fas fa-certificate"></i></div><div><strong>2000+ Certificates</strong><span>Successfully issued</span></div></div></div>
                    <div class="col-md-3 col-6"><div class="trust-item"><div class="ti-icon"><i class="fas fa-user-tie"></i></div><div><strong>Expert Auditors</strong><span>Industry specialists</span></div></div></div>
                    <div class="col-md-3 col-6"><div class="trust-item"><div class="ti-icon"><i class="fas fa-headset"></i></div><div><strong>Dedicated Support</strong><span>Every step of the way</span></div></div></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= STANDARDS GRID ================= -->
    <section class="py-5" style="background:#fff; overflow:hidden;">
        <div class="container py-4">
            <div class="text-center mb-5 reveal reveal-up">
                <span class="eyebrow eyebrow-center">What We Certify</span>
                <h2 class="section-title mt-2">Our Certification Standards</h2>
                <p class="text-muted mx-auto mt-3" style="max-width:640px;">Choose from a comprehensive range of internationally recognised management system standards, delivered by experienced, sector-specific auditors.</p>
            </div>
            <div class="row g-4">
                @php
                    $standards = [
                        ['ISO 9001', 'Quality Management', 'Focus on quality to win business and retain customers.', 'fa-medal'],
                        ['ISO 14001', 'Environmental Management', 'Showcase your environmental credentials and compliance.', 'fa-leaf'],
                        ['ISO 45001', 'Health & Safety', 'Implement robust occupational health & safety systems.', 'fa-hard-hat'],
                        ['ISO 27001', 'Information Security', 'Protect your information assets with a proven ISMS.', 'fa-lock'],
                        ['ISO 22000', 'Food Safety', 'Ensure food safety across the entire supply chain.', 'fa-utensils'],
                        ['ISO 22301', 'Business Continuity', 'Protect your business from disruption and interruption.', 'fa-shield-halved'],
                        ['ISO 42001', 'AI Management', 'Support safe, secure and responsible AI operations.', 'fa-robot'],
                        ['Inspection', 'Third-Party Inspection', 'Independent inspection for equipment and processes.', 'fa-magnifying-glass-chart'],
                    ];
                @endphp
                @foreach($standards as $i => $s)
                <div class="col-lg-3 col-md-6 reveal reveal-up delay-{{ (($i % 4) + 1) * 100 }}">
                    <div class="card std-card border-0 shadow-sm hover-card-lift">
                        <div class="std-icon"><i class="fas {{ $s[3] }}"></i></div>
                        <h4>{{ $s[0] }}</h4>
                        <span class="std-sub">{{ $s[1] }}</span>
                        <p class="text-muted small mb-4">{{ $s[2] }}</p>
                        <a href="{{ route('services') }}" class="link-more mt-auto">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-5 reveal reveal-up">
                <a href="{{ route('services') }}" class="btn btn-theme btn-premium px-5 py-3">View All Certification Services</a>
            </div>
        </div>
    </section>

    <!-- ================= WELCOME / WHAT WE DO ================= -->
    <section class="py-5" style="background: var(--light-bg); overflow:hidden;">
        <div class="container py-4">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 reveal reveal-right delay-100 order-lg-2">
                    <div class="position-relative">
                        <img src="{{ asset('images/corporate_teamwork.png') }}" alt="Certification experts" class="img-fluid rounded-4 shadow-lg" style="border-radius: 20px !important;">
                        <div class="position-absolute bg-white shadow p-4 rounded-4 d-none d-md-block" style="bottom:-24px; left:-24px; border-radius:18px !important; max-width:230px;">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width:48px;height:48px;border-radius:12px;background:var(--theme-green);color:#fff;display:flex;align-items:center;justify-content:center;font-size:1.3rem;"><i class="fas fa-star"></i></div>
                                <div><span class="fw-bold d-block" style="font-family:var(--heading-font);color:var(--dark-blue);">100% Satisfaction</span><span class="small text-muted">Trusted by clients</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 reveal reveal-left order-lg-1">
                    <span class="eyebrow">Welcome to S2 Certification</span>
                    <h2 class="section-title mt-2 mb-3">Global Expertise in Certification &amp; Inspection</h2>
                    <p class="text-muted mb-4">S2 Certification is a leading provider of worldwide certification and accreditation services. We help businesses achieve excellence through international standards like ISO 9001, 14001, 45001 and many more — with a process built around clarity, speed and real business value.</p>
                    <div class="row g-4">
                        <div class="col-md-6"><div class="why-item"><div class="why-icon"><i class="fas fa-user-check"></i></div><div><h5>Experienced Auditors</h5><p class="text-muted small mb-0">Sector specialists who understand your business.</p></div></div></div>
                        <div class="col-md-6"><div class="why-item"><div class="why-icon"><i class="fas fa-globe"></i></div><div><h5>Global Recognition</h5><p class="text-muted small mb-0">Certificates recognised around the world.</p></div></div></div>
                        <div class="col-md-6"><div class="why-item"><div class="why-icon"><i class="fas fa-route"></i></div><div><h5>Transparent Process</h5><p class="text-muted small mb-0">Clear steps, no hidden surprises.</p></div></div></div>
                        <div class="col-md-6"><div class="why-item"><div class="why-icon"><i class="fas fa-hand-holding-heart"></i></div><div><h5>Value-Added Service</h5><p class="text-muted small mb-0">Guidance that improves how you operate.</p></div></div></div>
                    </div>
                    <a href="{{ route('about') }}" class="btn btn-outline-theme mt-4">Learn More About Us</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= STATS BAND ================= -->
    <section class="py-5" style="background:#fff;">
        <div class="container">
            <div class="stats-band reveal reveal-up">
                <div class="row text-center g-4 position-relative">
                    <div class="col-6 col-md-3">
                        <div class="stat-num stat-count" data-target="2000" data-suffix="+">2000+</div>
                        <div class="stat-label">Issued Certificates</div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-num stat-count" data-target="350" data-suffix="+">350+</div>
                        <div class="stat-label">Global Partners</div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-num stat-count" data-target="15" data-suffix="+">15+</div>
                        <div class="stat-label">Countries Served</div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-num stat-count" data-target="100" data-suffix="%">100%</div>
                        <div class="stat-label">Client Satisfaction</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= DISCOVER MORE ================= -->
    <section class="py-5" style="background: var(--light-bg); overflow:hidden;">
        <div class="container py-4">
            <div class="text-center mb-5 reveal reveal-up">
                <span class="eyebrow eyebrow-center">Knowledge Hub</span>
                <h2 class="section-title mt-2">Discover More About ISO</h2>
            </div>
            <div class="row g-4">
                @php
                    $guides = [
                        ['images/iso_buyers_guide.png', 'ISO Buyers Guide', 'ISO certification offers a powerful combination of business and marketing tools. Achieving your standard delivers real improvements and strengthens your ability to win new contracts.', 'about'],
                        ['images/steps_to_iso.png', '6 Steps to ISO Certification', "The certification process is far more straightforward than you might think. If you want to get ISO certified but don't know where to start, follow these six simple steps.", 'services'],
                        ['images/iso_cycle.png', 'The 3-Year Certification Cycle', 'ISO certification is an ongoing process, not a single event. We explain the system of audits used to keep your business compliant with its chosen standard.', 'about'],
                    ];
                @endphp
                @foreach($guides as $i => $g)
                <div class="col-md-4 reveal reveal-up delay-{{ ($i + 1) * 100 }}">
                    <div class="card h-100 border-0 shadow-sm hover-card-lift overflow-hidden" style="border-radius:16px;">
                        <div class="zoom-img-container" style="height:220px;">
                            <img src="{{ asset($g[0]) }}" alt="{{ $g[1] }}">
                        </div>
                        <div class="card-body p-4 d-flex flex-column">
                            <h4 class="fw-bold mb-2" style="color:var(--dark-blue); font-size:1.2rem;">{{ $g[1] }}</h4>
                            <p class="text-muted small mb-4">{{ $g[2] }}</p>
                            <a href="{{ route($g[3]) }}" class="link-more mt-auto">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ================= VERIFICATION CTA ================= -->
    <section class="py-5" style="background:#fff;">
        <div class="container py-3">
            <div class="row align-items-center g-4 p-4 p-lg-5 reveal reveal-scale"
                 style="background: linear-gradient(120deg, var(--dark-blue) 0%, var(--navy-2) 100%); border-radius:24px; color:#fff; overflow:hidden; position:relative;">
                <div class="col-lg-8">
                    <span class="eyebrow eyebrow-center" style="color:#7ed957;">Certificate Verification</span>
                    <h2 class="fw-bold mt-2 mb-3" style="color:#fff;">Validate Any S2 Certificate Instantly</h2>
                    <p class="mb-0" style="opacity:0.85; max-width:640px;">Our online verification system lets you confirm the authenticity and current status of any certificate issued by S2 Certification — securely and in seconds.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('verify') }}" class="btn btn-theme btn-premium btn-lg px-5">Verify Certificate <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
    </section>
@endsection
