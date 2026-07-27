@extends('layouts.app')

@section('title', 'Contact Us - S2 Certification')

@section('content')
    <!-- Page Title Bar -->
    <div class="page-title-bar">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>Contact Us</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: var(--theme-green); text-decoration: none;">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Contact Form & Info -->
    <section class="py-5">
        <div class="container">
            <div class="row g-5">
                <!-- Info -->
                <div class="col-lg-4">
                    <div class="p-4 rounded shadow-sm h-100" style="background: var(--dark-blue); color: #fff;">
                        <h3 class="fw-bold mb-4">Contact Details</h3>
                        <p class="mb-5 opacity-75">Connect with our team for any inquiries regarding international standards and certification.</p>
                        
                        <div class="d-flex mb-4">
                            <div class="me-3">
                                <i class="fas fa-map-marker-alt fa-lg" style="color: var(--theme-green);"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Corporate Office</h6>
                                <p class="mb-0 small opacity-75">S2 Certification Ltd Rivington, Great Eastern Street, London EC2A 3JF, United Kingdom</p>
                            </div>
                        </div>

                        <div class="d-flex mb-4">
                            <div class="me-3">
                                <i class="fas fa-phone-alt fa-lg" style="color: var(--theme-blue);"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Contact</h6>
                                <p class="mb-0 small opacity-75">0800 691 1208<br>0800 691 1327</p>
                            </div>
                        </div>

                        <div class="d-flex mb-4">
                            <div class="me-3">
                                <i class="fas fa-envelope fa-lg" style="color: var(--theme-green);"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Email Support</h6>
                                <p class="mb-0 small opacity-75">s2certificationsystem@gmail.com<br>info@s2cert.com</p>
                            </div>
                        </div>

                        <div class="mt-5 pt-4 border-top border-secondary">
                            <h6 class="fw-bold mb-3">Follow S2 Certification</h6>
                            <div class="d-flex gap-3">
                                <a href="#" class="btn btn-sm btn-outline-light rounded-circle" style="width: 35px; height: 35px; padding: 5px;"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-light rounded-circle" style="width: 35px; height: 35px; padding: 5px;"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-light rounded-circle" style="width: 35px; height: 35px; padding: 5px;"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm p-4 p-md-5">
                        <h3 class="fw-bold mb-4" style="color: var(--dark-blue);">Direct Inquiry</h3>
                        <form action="#" method="POST">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Full Name</label>
                                    <input type="text" class="form-control" placeholder="Your Name" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Email Address</label>
                                    <input type="email" class="form-control" placeholder="email@address.com" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Target Standard</label>
                                    <select class="form-select">
                                        <option selected>ISO 9001:2015</option>
                                        <option>ISO 14001:2015</option>
                                        <option>ISO 45001:2018</option>
                                        <option>Other Certification</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Phone Number</label>
                                    <input type="text" class="form-control" placeholder="+92 xxx xxx xxxx">
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Message / Requirements</label>
                                    <textarea class="form-control" rows="5" placeholder="Please describe your organization size and certification goals..." required></textarea>
                                </div>
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-theme px-5">Send Inquiry</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="mt-5 border-top">
        <div class="ratio ratio-21x9">
           <iframe
    src="https://www.google.com/maps?q=Great%20Eastern%20Street,%20London%20EC2A%203JF,%20United%20Kingdom&output=embed"
    style="border:0;"
    allowfullscreen=""
    loading="lazy"
    referrerpolicy="no-referrer-when-downgrade">
</iframe>
        </div>
    </section>
@endsection
