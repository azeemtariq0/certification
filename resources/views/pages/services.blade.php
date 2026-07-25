@extends('layouts.app')

@section('title', 'Our Services - S2 Certification')

@section('styles')
<style>
    .svc-card {
        border-radius: 18px;
        padding: 30px 24px;
        height: 100%;
        text-align: left;
        position: relative;
        overflow: hidden;
    }
    .svc-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 5px;
        background: linear-gradient(90deg, var(--theme-green), var(--theme-blue));
        transform: scaleX(0);
        transform-origin: left;
        transition: transform .4s cubic-bezier(0.16,1,0.3,1);
    }
    .svc-card:hover::before { transform: scaleX(1); }
    .svc-icon {
        width: 58px; height: 58px; border-radius: 15px;
        background: linear-gradient(135deg, rgba(65,139,44,0.12), rgba(45,86,161,0.12));
        color: var(--theme-green);
        display:flex; align-items:center; justify-content:center; font-size:1.45rem; margin-bottom: 20px;
    }
    .svc-card h4 { font-weight: 800; color: var(--dark-blue); font-size:1.2rem; margin-bottom: 6px; }
    .svc-card .svc-tag { color: var(--theme-blue); font-weight:600; font-size:0.82rem; font-family: var(--heading-font); text-transform:uppercase; letter-spacing:0.05em; }

    /* Process steps */
    .step-card { text-align:center; padding: 0 12px; position:relative; }
    .step-num {
        width: 74px; height: 74px; margin: 0 auto 20px;
        border-radius: 50%;
        background: #fff; border: 2px dashed var(--theme-green);
        color: var(--theme-green);
        font-family: var(--heading-font); font-weight: 800; font-size: 1.6rem;
        display:flex; align-items:center; justify-content:center;
        position: relative; z-index:2;
    }
    .step-card h5 { font-weight:700; color:var(--dark-blue); font-size:1.05rem; }
    .steps-row { position: relative; }
    .steps-row::before {
        content:''; position:absolute; top:37px; left:12%; right:12%;
        border-top: 2px dashed var(--line); z-index:1;
    }
    @media (max-width: 767px){ .steps-row::before{ display:none; } }

    .feat-item { display:flex; gap:14px; align-items:flex-start; }
    .feat-item i { color: var(--theme-green); font-size:1.2rem; margin-top:3px; }
</style>
@endsection

@section('content')
    <!-- Page Hero -->
    <section class="page-hero text-center">
        <div class="container">
            <h1>Our Certification Services</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Services</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Intro -->
    <section class="py-5" style="background:#fff; overflow:hidden;">
        <div class="container py-4 text-center reveal reveal-up" style="max-width:760px;">
            <span class="eyebrow eyebrow-center">Accredited Certification</span>
            <h2 class="section-title mt-2 mb-3">Standards That Move Your Business Forward</h2>
            <p class="text-muted">From quality and environment to information security and food safety, we deliver independent, internationally recognised certification tailored to your sector — helping you win contracts, reduce risk and operate better.</p>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="pb-5" style="background:#fff; overflow:hidden;">
        <div class="container">
            <div class="row g-4">
                @php
                    $services = [
                        ['ISO 9001:2015', 'Quality Management', 'Quality Management Systems (QMS) to improve overall performance and provide a sound basis for sustainable growth.', 'fa-medal'],
                        ['ISO 14001:2015', 'Environmental', 'Environmental Management Systems that help organisations minimise their impact and stay compliant with regulations.', 'fa-leaf'],
                        ['ISO 27001:2022', 'Information Security', 'Information Security Management Systems (ISMS) to keep your information assets safe, secure and resilient.', 'fa-lock'],
                        ['ISO 45001:2018', 'Health & Safety', 'Occupational health and safety management systems that create a safe, healthy workplace for your people.', 'fa-hard-hat'],
                        ['ISO 22000:2018', 'Food Safety', 'Food Safety Management Systems for organisations across the food chain, ensuring food is safe to consume.', 'fa-utensils'],
                        ['ISO 22301:2019', 'Business Continuity', 'Business Continuity Management Systems that protect your organisation from disruption and keep you operating.', 'fa-shield-halved'],
                        ['ISO 42001:2023', 'AI Management', 'Artificial Intelligence Management Systems supporting the safe, secure and responsible use of AI.', 'fa-robot'],
                        ['Inspection Services', 'Third-Party Inspection', 'Comprehensive independent inspection across industries to ensure equipment and process compliance.', 'fa-magnifying-glass-chart'],
                    ];
                @endphp
                @foreach($services as $i => $s)
                <div class="col-md-6 col-lg-3 reveal reveal-up delay-{{ (($i % 4) + 1) * 100 }}">
                    <div class="card svc-card border-0 shadow-sm hover-card-lift d-flex flex-column">
                        <div class="svc-icon"><i class="fas {{ $s[3] }}"></i></div>
                        <span class="svc-tag">{{ $s[1] }}</span>
                        <h4 class="mt-1">{{ $s[0] }}</h4>
                        <p class="text-muted small mb-4">{{ $s[2] }}</p>
                        <a href="{{ route('contact') }}" class="link-more mt-auto">Request a Quote <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Process Steps -->
    <section class="py-5" style="background: var(--light-bg); overflow:hidden;">
        <div class="container py-4">
            <div class="text-center mb-5 reveal reveal-up">
                <span class="eyebrow eyebrow-center">How It Works</span>
                <h2 class="section-title mt-2">6 Steps to ISO Certification</h2>
                <p class="text-muted mx-auto mt-3" style="max-width:620px;">A clear, straightforward path from first enquiry to certified — with expert support at every stage.</p>
            </div>
            <div class="row steps-row g-4">
                @php
                    $steps = [
                        ['Enquiry', 'Tell us about your business and the standard you need.'],
                        ['Proposal', 'Receive a clear, tailored certification proposal.'],
                        ['Stage 1 Audit', 'A readiness review of your management system.'],
                        ['Stage 2 Audit', 'Full assessment against the chosen standard.'],
                        ['Certification', 'Achieve your accredited certificate.'],
                        ['Surveillance', 'Ongoing audits keep you compliant year on year.'],
                    ];
                @endphp
                @foreach($steps as $i => $step)
                <div class="col-md-4 col-lg-2 col-6 reveal reveal-up delay-{{ ($i + 1) * 100 }}">
                    <div class="step-card">
                        <div class="step-num">{{ $i + 1 }}</div>
                        <h5>{{ $step[0] }}</h5>
                        <p class="text-muted small mb-0">{{ $step[1] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Why choose us split -->
    <section class="py-5" style="background:#fff; overflow:hidden;">
        <div class="container py-4">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 reveal reveal-left">
                    <img src="{{ asset('images/corporate_teamwork.png') }}" alt="Why choose S2 Certification" class="img-fluid shadow-lg" style="border-radius:20px;">
                </div>
                <div class="col-lg-6 reveal reveal-right delay-100">
                    <span class="eyebrow">Why S2 Certification</span>
                    <h2 class="section-title mt-2 mb-4">A Partner Invested in Your Success</h2>
                    <div class="d-flex flex-column gap-3">
                        <div class="feat-item"><i class="fas fa-check-circle"></i><div><h5 class="fw-bold mb-1" style="color:var(--dark-blue);font-size:1.05rem;">Independent &amp; Accredited</h5><p class="text-muted small mb-0">Impartial assessments you and your clients can trust.</p></div></div>
                        <div class="feat-item"><i class="fas fa-check-circle"></i><div><h5 class="fw-bold mb-1" style="color:var(--dark-blue);font-size:1.05rem;">Sector Specialists</h5><p class="text-muted small mb-0">Auditors who genuinely understand your industry.</p></div></div>
                        <div class="feat-item"><i class="fas fa-check-circle"></i><div><h5 class="fw-bold mb-1" style="color:var(--dark-blue);font-size:1.05rem;">Fast Turnaround</h5><p class="text-muted small mb-0">Efficient scheduling to get you certified sooner.</p></div></div>
                        <div class="feat-item"><i class="fas fa-check-circle"></i><div><h5 class="fw-bold mb-1" style="color:var(--dark-blue);font-size:1.05rem;">Transparent Pricing</h5><p class="text-muted small mb-0">Clear proposals with no hidden costs.</p></div></div>
                    </div>
                    <a href="{{ route('contact') }}" class="btn btn-theme btn-premium mt-4 px-4">Request a Proposal</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom CTA -->
    <section class="py-5" style="background: var(--light-bg);">
        <div class="container py-3">
            <div class="text-center reveal reveal-scale p-4 p-lg-5"
                 style="background: linear-gradient(120deg, var(--dark-blue) 0%, var(--navy-2) 100%); border-radius:24px; color:#fff;">
                <h3 class="fw-bold mb-3" style="color:#fff;">Request a Proposal for Certification</h3>
                <p class="mb-4 mx-auto" style="opacity:0.85; max-width:640px;">Our experts are ready to discuss your specific needs and provide a tailored, no-obligation solution for your organisation.</p>
                <a href="{{ route('contact') }}" class="btn btn-theme btn-premium btn-lg px-5">Get a Quote <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </section>
@endsection
