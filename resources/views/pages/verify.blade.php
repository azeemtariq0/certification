@extends('layouts.app')

@section('title', 'Certificate Verification - S2 Certification')

@section('content')
    <!-- Page Title Bar -->
    <div class="page-title-bar">
        <div class="container text-center">
            <h1>Certificate Verification</h1>
        </div>
    </div>

    <!-- Search Section -->
    <section class="py-5" style="background: linear-gradient(to bottom, #f8f9fa, #ffffff);">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-lg" style="border-radius: 15px; overflow: hidden; border: 1px solid rgba(0,0,0,0.05);">
                        <div class="card-body p-5">
                            <div class="text-center mb-5">
                                <h4 class="fw-bold mb-2" style="color: var(--dark-blue)">Verify Your Certificate</h4>
                                <p class="text-muted small">Enter the company name or standard code to validate certification status</p>
                            </div>
                            <div class="search-box-container mx-auto" style="max-width: 700px;">
                                <form id="searchForm" class="d-flex shadow-sm" style="border-radius: 50px; overflow: hidden; border: 2px solid var(--theme-blue);">
                                    @csrf
                                    <div class="flex-grow-1 bg-white">
                                        <input type="text" id="searchInput" name="query" class="form-control border-0 py-3 ps-4" 
                                               placeholder="Search by Company Name or Standard (e.g. ISO 9001)..." 
                                               style="box-shadow: none; border-radius: 50px 0 0 50px;" 
                                               autocomplete="off">
                                    </div>
                                    <button type="submit" id="searchBtn" class="btn px-5 text-white fw-bold" 
                                            style="background: var(--theme-blue); border-radius: 0 50px 50px 0; transition: all 0.3s;">
                                        <i class="fas fa-search me-2"></i> SEARCH
                                    </button>
                                </form>
                            </div>
                            <div class="text-center mt-4">
                                <span class="badge bg-light text-dark border p-2 px-3 small" style="border-radius: 20px;">
                                    <i class="fas fa-info-circle text-primary me-1"></i>
                                    Example: <strong>ISO 9001</strong> or <strong>ABC Industries</strong>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- AJAX Result Container -->
            <div id="resultContainer" class="row justify-content-center mb-5 d-none">
                <div class="col-lg-8" id="resultContent">
                    <!-- Certificate content will be injected here -->
                </div>
            </div>

            <div id="loadingSpinner" class="text-center d-none my-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2 text-muted">Searching certification database...</p>
            </div>
        </div>
    </section>

    <!-- Guide Section -->
    <section class="py-5 bg-white border-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <h3 class="fw-bold mb-4" style="color: var(--dark-blue)">Verification Guide</h3>
                    <div class="d-flex mb-4">
                        <div class="me-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: var(--theme-green); color: #fff; font-weight: 700;">1</div>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Enter Information</h5>
                            <p class="text-muted small">Type the company name or the ISO standard code you wish to verify.</p>
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="me-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: var(--theme-green); color: #fff; font-weight: 700;">2</div>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Click Search</h5>
                            <p class="text-muted small">The system will securely query our database without reloading the page.</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="me-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: var(--theme-green); color: #fff; font-weight: 700;">3</div>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Verify Status</h5>
                            <p class="text-muted small">Review the certificate details, including status, issue date, and expiry date.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4" style="background: var(--light-bg); border-radius: 8px; border-left: 5px solid var(--theme-green);">
                        <h5 class="fw-bold mb-3">Still need help?</h5>
                        <p class="text-muted mb-4">If you are unable to verify a certificate online, please contact our support team for manual verification.</p>
                        <a href="{{ route('contact') }}" class="btn btn-theme">Contact Support</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    document.getElementById('searchForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const query = document.getElementById('searchInput').value;
        const resultContainer = document.getElementById('resultContainer');
        const resultContent = document.getElementById('resultContent');
        const loadingSpinner = document.getElementById('loadingSpinner');
        const searchBtn = document.getElementById('searchBtn');
        
        if (!query.trim()) return;

        // Reset UI
        resultContainer.classList.add('d-none');
        loadingSpinner.classList.remove('d-none');
        searchBtn.disabled = true;

        fetch('{{ route('verify.search') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ query: query })
        })
        .then(response => response.json())
        .then(data => {
            loadingSpinner.classList.add('d-none');
            searchBtn.disabled = false;
            resultContainer.classList.remove('d-none');

            if (data.success) {
                const cert = data.data;
                resultContent.innerHTML = `
                    <div class="card border-0 shadow-lg overflow-hidden fade-in" style="border-radius: 12px; border-top: 5px solid var(--theme-green);">
                        <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                            <h5 class="fw-bold mb-0" style="color: var(--dark-blue)">Verification Result Found</h5>
                            <span class="badge bg-success px-3 py-2"><i class="fas fa-check-circle me-1"></i> ${cert.status} / Valid</span>
                        </div>
                        <div class="card-body p-4 p-md-5">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted small text-uppercase fw-bold">Company Name</p>
                                    <h5 class="fw-bold" style="color: var(--dark-blue)">${cert.company_name}</h5>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted small text-uppercase fw-bold">Certificate No</p>
                                    <h5 class="fw-bold" style="color: var(--theme-blue)">${cert.certificate_no}</h5>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted small text-uppercase fw-bold">Standard</p>
                                    <p class="fw-bold mb-0">${cert.standard}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted small text-uppercase fw-bold">Verified On</p>
                                    <p class="fw-bold mb-0 text-success">${cert.verified_on}</p>
                                </div>
                                <div class="col-12">
                                    <p class="mb-1 text-muted small text-uppercase fw-bold">Scope of Certification</p>
                                    <p class="mb-0">${cert.scope}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted small text-uppercase fw-bold">Issue Date</p>
                                    <p class="fw-bold mb-0">${cert.issue_date}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted small text-uppercase fw-bold">Expiry Date</p>
                                    <p class="fw-bold mb-0">${cert.expiry_date}</p>
                                </div>
                            </div>
                            
                            <div class="mt-5 pt-4 border-top text-center">
                                <button class="btn btn-outline-dark btn-sm me-2" onclick="window.print()"><i class="fas fa-print me-1"></i> Print Result</button>
                            </div>
                        </div>
                    </div>
                `;
            } else {
                resultContent.innerHTML = `
                    <div class="alert alert-danger p-4 text-center shadow-sm fade-in" style="border-radius: 8px;">
                        <i class="fas fa-times-circle fa-3x mb-3"></i>
                        <h4 class="fw-bold">No Certificate Found</h4>
                        <p class="mb-0">${data.message}</p>
                    </div>
                `;
            }
        })
        .catch(error => {
            loadingSpinner.classList.add('d-none');
            searchBtn.disabled = false;
            console.error('Error:', error);
            alert('An error occurred while searching. Please try again.');
        });
    });
</script>
@endsection
