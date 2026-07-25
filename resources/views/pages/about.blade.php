@extends('layouts.app')

@section('title', 'About Us - S2 Certification')

@section('styles')
<style>
    .about-img-wrap { position: relative; }
    .about-img-wrap img { border-radius: 20px; }
    .about-badge {
        position: absolute; bottom: -26px; right: -20px;
        background: linear-gradient(120deg, var(--theme-green), #2f6a20);
        color:#fff; border-radius: 18px; padding: 22px 26px; text-align:center;
        box-shadow: 0 18px 40px rgba(65,139,44,0.35);
    }
    .about-badge .num { font-family: var(--heading-font); font-weight:800; font-size:2rem; line-height:1; }
    .about-badge .lbl { font-size:0.8rem; opacity:0.9; }

    .mv-card { display:flex; gap:18px; padding: 22px; border-radius:16px; background:#fff; border:1px solid var(--line); transition: all .35s ease; }
    .mv-card:hover { border-color: rgba(65,139,44,0.35); box-shadow: 0 16px 34px rgba(20,33,61,0.08); transform: translateY(-4px); }
    .mv-icon { width:56px; height:56px; border-radius:14px; flex-shrink:0; display:flex; align-items:center; justify-content:center; font-size:1.4rem; color:#fff; }

    .value-card { border-radius:18px; padding: 36px 28px; height:100%; text-align:center; }
    .value-icon {
        width:76px; height:76px; margin:0 auto 20px; border-radius:20px;
        background: linear-gradient(135deg, rgba(65,139,44,0.12), rgba(45,86,161,0.12));
        color:var(--theme-green); display:flex; align-items:center; justify-content:center; font-size:1.8rem;
    }
    .value-card h4 { font-weight:800; color:var(--dark-blue); font-size:1.2rem; }

    .global-band {
        background: linear-gradient(120deg, var(--dark-blue) 0%, var(--navy-2) 100%);
        color:#fff; position:relative; overflow:hidden;
    }
    .global-band::before { content:''; position:absolute; inset:0; background:url('https://www.transparenttextures.com/patterns/carbon-fibre.png'); opacity:0.08; }
    .global-stat .n { font-family:var(--heading-font); font-weight:800; font-size:clamp(1.8rem,3.5vw,2.6rem); color:#7ed957; }
    .global-stat .l { text-transform:uppercase; letter-spacing:0.06em; font-size:0.78rem; opacity:0.8; }
</style>
@endsection

@section('content')
    <!-- Page Hero -->
    <section class="page-hero text-center">
        <div class="container">
            <h1>About S2 Certification</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About Us</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Company Story -->
    <section class="py-5" style="background:#fff; overflow:hidden;">
        <div class="container py-4">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 reveal reveal-left">
                    <div class="about-img-wrap">
                        <img src="{{ asset('images/corporate_teamwork.png') }}" alt="S2 Certification team" class="img-fluid shadow-lg">
                        <div class="about-badge d-none d-md-block">
                            <div class="num">10+</div>
                            <div class="lbl">Years of<br>Excellence</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 reveal reveal-right delay-100">
                    <span class="eyebrow">Who We Are</span>
                    <h2 class="section-title mt-2 mb-3">A Trusted Partner in Global Certification</h2>
                    <p class="text-muted mb-4">S2 Certification has been at the forefront of the certification industry, helping thousands of businesses worldwide achieve excellence through international standards. We empower organisations by providing reliable, independent and professional certification and inspection services.</p>
                    <div class="d-flex flex-column gap-3">
                        <div class="mv-card">
                            <div class="mv-icon" style="background:var(--theme-green);"><i class="fas fa-bullseye"></i></div>
                            <div>
                                <h5 class="fw-bold mb-1" style="color:var(--dark-blue);">Our Mission</h5>
                                <p class="text-muted small mb-0">To provide high-quality, value-added certification services that enable our clients to demonstrate their commitment to excellence, quality and sustainability.</p>
                            </div>
                        </div>
                        <div class="mv-card">
                            <div class="mv-icon" style="background:var(--theme-blue);"><i class="fas fa-eye"></i></div>
                            <div>
                                <h5 class="fw-bold mb-1" style="color:var(--dark-blue);">Our Vision</h5>
                                <p class="text-muted small mb-0">To be the world's most trusted partner in certification — recognised for our integrity, technical expertise and customer-centric approach.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats band -->
    <section class="py-5" style="background: var(--light-bg);">
        <div class="container">
            <div class="row text-center g-4 reveal reveal-up">
                <div class="col-6 col-md-3">
                    <div class="stat-num stat-count" data-target="2000" data-suffix="+" style="font-family:var(--heading-font);font-weight:800;font-size:clamp(2rem,4vw,3rem);color:var(--theme-green);">2000+</div>
                    <div class="text-muted text-uppercase small" style="letter-spacing:0.06em;">Certificates Issued</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-num stat-count" data-target="350" data-suffix="+" style="font-family:var(--heading-font);font-weight:800;font-size:clamp(2rem,4vw,3rem);color:var(--theme-green);">350+</div>
                    <div class="text-muted text-uppercase small" style="letter-spacing:0.06em;">Global Partners</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-num stat-count" data-target="15" data-suffix="+" style="font-family:var(--heading-font);font-weight:800;font-size:clamp(2rem,4vw,3rem);color:var(--theme-green);">15+</div>
                    <div class="text-muted text-uppercase small" style="letter-spacing:0.06em;">Countries Served</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-num stat-count" data-target="100" data-suffix="%" style="font-family:var(--heading-font);font-weight:800;font-size:clamp(2rem,4vw,3rem);color:var(--theme-green);">100%</div>
                    <div class="text-muted text-uppercase small" style="letter-spacing:0.06em;">Client Satisfaction</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values -->
    <section class="py-5" style="background:#fff; overflow:hidden;">
        <div class="container py-4">
            <div class="text-center mb-5 reveal reveal-up">
                <span class="eyebrow eyebrow-center">What Drives Us</span>
                <h2 class="section-title mt-2">Our Core Values</h2>
            </div>
            <div class="row g-4">
                @php
                    $values = [
                        ['fa-handshake', 'Integrity', 'We maintain the highest ethical standards in all our dealings, ensuring impartiality and transparency.'],
                        ['fa-user-graduate', 'Expertise', 'Our auditors are industry experts with deep technical knowledge and real-world experience.'],
                        ['fa-heart', 'Customer Care', 'We build long-lasting relationships, supporting and guiding our clients throughout the journey.'],
                        ['fa-scale-balanced', 'Impartiality', 'Independent, objective assessments that give your certification genuine credibility.'],
                    ];
                @endphp
                @foreach($values as $i => $v)
                <div class="col-md-6 col-lg-3 reveal reveal-up delay-{{ ($i + 1) * 100 }}">
                    <div class="card value-card border-0 shadow-sm hover-card-lift">
                        <div class="value-icon"><i class="fas {{ $v[0] }}"></i></div>
                        <h4>{{ $v[1] }}</h4>
                        <p class="text-muted small mb-0">{{ $v[2] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Why choose us -->
    <section class="py-5" style="background: var(--light-bg); overflow:hidden;">
        <div class="container py-4">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 reveal reveal-left">
                    <span class="eyebrow">Why Choose S2</span>
                    <h2 class="section-title mt-2 mb-4">Certification You Can Rely On</h2>
                    <div class="row g-4">
                        @php
                            $why = [
                                ['fa-globe', 'Global Recognition', 'Certificates recognised and respected around the world.'],
                                ['fa-user-tie', 'Experienced Auditors', 'Sector specialists who understand your business.'],
                                ['fa-route', 'Transparent Process', 'Clear steps and pricing, with no hidden surprises.'],
                                ['fa-headset', 'Dedicated Support', 'Guidance at every stage of your certification.'],
                            ];
                        @endphp
                        @foreach($why as $w)
                        <div class="col-md-6">
                            <div class="d-flex gap-3">
                                <div style="width:48px;height:48px;border-radius:12px;background:var(--theme-green);color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><i class="fas {{ $w[0] }}"></i></div>
                                <div>
                                    <h5 class="fw-bold mb-1" style="color:var(--dark-blue);font-size:1.02rem;">{{ $w[1] }}</h5>
                                    <p class="text-muted small mb-0">{{ $w[2] }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <a href="{{ route('services') }}" class="btn btn-theme btn-premium mt-4 px-4">Explore Our Services</a>
                </div>
                <div class="col-lg-6 reveal reveal-right delay-100">
                    <img src="{{ asset('images/iso_cycle.png') }}" alt="Certification process" class="img-fluid shadow-lg" style="border-radius:20px;">
                </div>
            </div>
        </div>
    </section>

    <!-- Global Reach -->
    <section class="global-band py-5">
        <div class="container py-4 position-relative">
            <div class="text-center mb-5 reveal reveal-up">
                <span class="eyebrow eyebrow-center" style="color:#7ed957;">Worldwide Presence</span>
                <h2 class="fw-bold mt-2" style="color:#fff;">A Global Network of Trust</h2>
                <p class="mb-0 mx-auto mt-3" style="opacity:0.8; max-width:760px;">With representatives in over 15 countries and auditors across the globe, S2 Certification offers a truly international perspective backed by genuine local expertise.</p>
            </div>
            <div class="row text-center g-4">
                <div class="col-6 col-md-3 global-stat"><div class="n">15+</div><div class="l">Countries</div></div>
                <div class="col-6 col-md-3 global-stat"><div class="n">50+</div><div class="l">Expert Auditors</div></div>
                <div class="col-6 col-md-3 global-stat"><div class="n">20+</div><div class="l">Industries Served</div></div>
                <div class="col-6 col-md-3 global-stat"><div class="n">24/7</div><div class="l">Client Support</div></div>
            </div>
        </div>
    </section>
@endsection
