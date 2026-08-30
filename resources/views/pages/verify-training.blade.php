@extends('layouts.app')

@section('title', 'Training & Auditor Certificate Verification - S2 Certification')

@section('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap');

    .training-verify-page-container {
        font-family: 'Inter', sans-serif;
        color: #1e293b;
        background-color: #f8fafc;
        min-height: 80vh;
        overflow: hidden;
    }

    /* Primary layout elements */
    .search-hero-section {
        padding: 85px 0 95px 0;
        background: radial-gradient(circle at 50% 50%, #ffffff 0%, #f1f5f9 100%);
        transition: all 0.7s cubic-bezier(0.25, 1, 0.5, 1);
        border-bottom: 1px solid #e2e8f0;
    }

    .welcome-header {
        max-height: 320px;
        opacity: 1;
        transition: all 0.6s cubic-bezier(0.25, 1, 0.5, 1);
        transform: translateY(0);
    }

    .welcome-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(65, 139, 44, 0.12);
        color: #2e691e;
        border: 1px solid rgba(65, 139, 44, 0.3);
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        margin-bottom: 14px;
    }

    /* Active Search State Transformations */
    .search-active .search-hero-section {
        padding: 25px 0;
        background: #ffffff;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
    }

    .search-active .welcome-header {
        max-height: 0;
        opacity: 0;
        margin-bottom: 0 !important;
        transform: translateY(-20px);
        pointer-events: none;
        overflow: hidden;
    }

    .search-active .guides-section {
        max-height: 0;
        opacity: 0;
        padding: 0 !important;
        margin: 0 !important;
        overflow: hidden;
        pointer-events: none;
        transition: all 0.5s ease-out;
    }

    /* Premium Search Bar Styling */
    .search-box-outer {
        position: relative;
        max-width: 760px;
        margin: 0 auto;
        z-index: 100;
    }

    .search-input-group {
        display: flex;
        align-items: center;
        background: #ffffff;
        border: 2px solid #cbd5e1;
        border-radius: 9999px;
        padding: 6px 8px 6px 22px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .search-input-group:focus-within {
        border-color: #418b2c;
        box-shadow: 0 14px 32px -5px rgba(65, 139, 44, 0.22), 0 0 0 4px rgba(65, 139, 44, 0.12);
    }

    .search-icon-left {
        color: #94a3b8;
        font-size: 1.15rem;
        margin-right: 12px;
        flex-shrink: 0;
    }

    .search-input-field {
        flex-grow: 1;
        min-width: 0;
        border: none;
        outline: none;
        font-size: 1rem;
        font-weight: 500;
        color: #0f172a;
        padding: 10px 4px;
        background: transparent;
        text-overflow: ellipsis;
    }

    .search-input-field::placeholder {
        color: #94a3b8;
        font-size: 0.95rem;
    }

    .input-action-buttons {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-shrink: 0;
    }

    .clear-search-btn {
        background: none;
        border: none;
        color: #94a3b8;
        cursor: pointer;
        padding: 6px 10px;
        display: none;
        font-size: 0.95rem;
        transition: color 0.2s, transform 0.2s;
        border-radius: 50%;
    }

    .clear-search-btn:hover {
        color: #334155;
        transform: scale(1.1);
    }

    .search-loading-spinner {
        display: none;
        width: 1.25rem;
        height: 1.25rem;
        border: 2px solid #e2e8f0;
        border-top-color: #418b2c;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .submit-search-btn {
        background: linear-gradient(135deg, #418b2c 0%, #2f6b1e 100%);
        border: none;
        color: #ffffff;
        border-radius: 9999px;
        padding: 11px 26px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 0.88rem;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.25s ease;
        box-shadow: 0 4px 12px rgba(65, 139, 44, 0.28);
        white-space: nowrap;
    }

    .submit-search-btn:hover {
        background: linear-gradient(135deg, #499b31 0%, #367923 100%);
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(65, 139, 44, 0.42);
        color: #ffffff;
    }

    .submit-search-btn:hover .btn-arrow-icon {
        transform: translateX(4px);
    }

    .btn-arrow-icon {
        transition: transform 0.2s ease;
    }

    @media (max-width: 576px) {
        .search-input-group {
            border-radius: 20px;
            padding: 8px 12px;
            flex-wrap: wrap;
            gap: 8px;
        }
        .search-icon-left {
            margin-right: 8px;
        }
        .search-input-field {
            font-size: 0.95rem;
            width: calc(100% - 60px);
        }
        .input-action-buttons {
            width: 100%;
            justify-content: flex-end;
        }
        .submit-search-btn {
            width: 100%;
            justify-content: center;
            padding: 10px;
            border-radius: 12px;
        }
    }

    /* Dynamic Autocomplete Popover */
    .autocomplete-popover {
        position: absolute;
        top: calc(100% + 8px);
        left: 0;
        right: 0;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        border: 1px solid #e2e8f0;
        overflow: hidden;
        display: none;
        z-index: 999;
    }

    .autocomplete-item {
        padding: 14px 24px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #f1f5f9;
        transition: background 0.15s ease;
        text-align: left;
    }

    .autocomplete-item:last-child {
        border-bottom: none;
    }

    .autocomplete-item:hover, .autocomplete-item.active {
        background: #f0fdf4;
    }

    .autocomplete-meta {
        font-size: 0.75rem;
        background: #e2e8f0;
        padding: 2px 8px;
        border-radius: 4px;
        color: #475569;
        font-weight: 600;
    }

    .highlight-text {
        background-color: rgba(253, 224, 71, 0.4);
        padding: 0 2px;
        border-radius: 2px;
        font-weight: 700;
    }

    /* 4-Column Guides Section */
    .guides-section {
        max-height: 600px;
        opacity: 1;
        transition: all 0.6s cubic-bezier(0.25, 1, 0.5, 1);
    }

    .guide-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 30px 24px;
        height: 100%;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
    }

    .guide-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 20px -8px rgba(0, 0, 0, 0.08);
        border-color: #cbd5e1;
    }

    .guide-icon-wrapper {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        background: rgba(65, 139, 44, 0.1);
        color: var(--theme-green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 20px;
    }

    /* Results layout */
    .results-main-wrapper {
        display: none;
        opacity: 0;
        transform: translateY(15px);
        transition: all 0.6s cubic-bezier(0.25, 1, 0.5, 1);
    }

    .search-active .results-main-wrapper {
        display: block;
        opacity: 1;
        transform: translateY(0);
        padding-top: 40px;
        padding-bottom: 60px;
    }

    /* Filter Sidebar */
    .filter-sidebar {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }

    .filter-header-main {
        font-size: 1.15rem;
        font-weight: 700;
        color: #0f172a;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .filter-clear-all {
        font-size: 0.8rem;
        color: var(--theme-blue);
        text-decoration: none;
        font-weight: 600;
        cursor: pointer;
        display: none;
    }

    .filter-clear-all:hover {
        text-decoration: underline;
    }

    .filter-accordion-item {
        border-bottom: 1px solid #f1f5f9;
        padding: 16px 0;
    }

    .filter-accordion-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .filter-accordion-btn {
        width: 100%;
        background: none;
        border: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-weight: 600;
        font-size: 0.95rem;
        color: #334155;
        padding: 8px 0;
        text-align: left;
        cursor: pointer;
    }

    .filter-accordion-btn i.fa-chevron-down {
        font-size: 0.8rem;
        color: #94a3b8;
        transition: transform 0.25s ease;
    }

    .filter-accordion-btn.collapsed i.fa-chevron-down {
        transform: rotate(-90deg);
    }

    .filter-accordion-content {
        max-height: 250px;
        overflow-y: auto;
        padding-top: 10px;
        transition: all 0.3s ease;
    }

    .filter-accordion-item.collapsed .filter-accordion-content {
        display: none;
    }

    .filter-checkbox-label {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 0.875rem;
        color: #475569;
        margin-bottom: 8px;
        cursor: pointer;
        user-select: none;
    }

    .filter-checkbox-label input {
        margin-right: 8px;
        accent-color: var(--theme-green);
    }

    .filter-checkbox-label:hover {
        color: #0f172a;
    }

    .filter-option-count {
        font-size: 0.75rem;
        color: #94a3b8;
        font-weight: 500;
    }

    /* Right Side Results Cards */
    .results-count-header {
        font-weight: 700;
        color: #0f172a;
        font-size: 1.25rem;
    }

    .entity-result-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        margin-bottom: 20px;
        padding: 28px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        display: flex;
        gap: 22px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .entity-result-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background-color: var(--theme-green);
    }

    .entity-result-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.04), 0 4px 6px -2px rgba(0, 0, 0, 0.02);
        border-color: #cbd5e1;
    }

    .entity-initials-badge {
        width: 58px;
        height: 58px;
        border-radius: 14px;
        background: linear-gradient(135deg, #1e3a8a 0%, #14213d 100%);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        font-weight: 700;
        flex-shrink: 0;
        box-shadow: 0 4px 8px rgba(30, 58, 138, 0.25);
    }

    .entity-details-pane {
        flex-grow: 1;
    }

    .entity-candidate-title {
        font-size: 1.22rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }

    .entity-course-sub {
        font-size: 0.95rem;
        color: #2d56a1;
        font-weight: 600;
        margin-bottom: 14px;
    }

    .entity-badge-valid {
        font-size: 0.75rem;
        padding: 4px 12px;
        border-radius: 9999px;
        background: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .entity-badge-invalid {
        font-size: 0.75rem;
        padding: 4px 12px;
        border-radius: 9999px;
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .entity-grid-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 14px;
        margin-bottom: 18px;
        background: #f8fafc;
        padding: 16px 20px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
    }

    .detail-item-small {
        display: flex;
        flex-direction: column;
    }

    .detail-item-small span.lbl {
        font-size: 0.72rem;
        text-transform: uppercase;
        color: #94a3b8;
        font-weight: 700;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }

    .detail-item-small span.val {
        font-size: 0.92rem;
        color: #334155;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .detail-item-small span.val.mono {
        font-family: monospace;
        color: #1e3a8a;
    }

    .view-profile-cta-btn {
        background: #ffffff;
        border: 1px solid #cbd5e1;
        color: #475569;
        font-weight: 600;
        font-size: 0.85rem;
        padding: 8px 18px;
        border-radius: 8px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
    }

    .view-profile-cta-btn:hover {
        background: #f8fafc;
        border-color: #94a3b8;
        color: #0f172a;
    }

    /* Modal Styling */
    .premium-modal-header {
        background: linear-gradient(135deg, #14213d 0%, #1e3a8a 100%);
        color: #ffffff;
        border-bottom: none;
        padding: 24px 30px;
    }

    .premium-modal-body {
        padding: 36px 30px;
    }

    .modal-detail-table th {
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        color: #94a3b8;
        letter-spacing: 0.5px;
        width: 32%;
        padding: 11px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .modal-detail-table td {
        font-size: 0.95rem;
        color: #1e293b;
        font-weight: 600;
        padding: 11px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    /* Verification Statement Box */
    .tv-statement-box {
        background: #f8fafc;
        border: 1.5px solid #dbeafe;
        border-left: 4px solid #2d56a1;
        padding: 16px 20px;
        border-radius: 10px;
        margin-top: 20px;
        font-size: 0.88rem;
        color: #334155;
        line-height: 1.6;
    }

    .qr-badge-box {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 16px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
    }
    .qr-badge-box img {
        width: 130px;
        height: 130px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        padding: 6px;
        background: #fff;
    }
</style>
@endsection

@section('content')
<div class="training-verify-page-container" id="pageContainer">
    
    <!-- Hero / Search Section -->
    <section class="search-hero-section">
        <div class="container text-center">
            
            <div class="welcome-header mb-5">
                <span class="welcome-badge">
                    <i class="fas fa-shield-check"></i> S2 Certification Official Database
                </span>
                <h1 class="display-5 fw-bold mb-3" style="color: var(--dark-blue); text-transform: uppercase; letter-spacing: -0.5px;">
                    Authenticate Training &amp; Auditor Credentials
                </h1>
                <p class="text-muted fs-5 mx-auto" style="max-width: 680px;">
                    Verify individual course qualifications, CQI/IRCA &amp; S2 accredited Lead Auditor credentials, and official training certificates.
                </p>
            </div>

            <!-- Centralized Search Box -->
            <div class="search-box-outer">
                <form id="trainingSearchForm">
                    <div class="search-input-group">
                        <i class="fas fa-magnifying-glass search-icon-left"></i>
                        <input type="text" 
                               id="trainingSearchInput" 
                               name="query" 
                               class="search-input-field" 
                               placeholder="Search by Candidate Name, Certificate No, or Verification ID..." 
                               autocomplete="off" 
                               value="{{ $initialQuery }}">
                        <div class="input-action-buttons">
                            <!-- Clear Search Input Button -->
                            <button type="button" id="clearSearchBtn" class="clear-search-btn" title="Clear search">
                                <i class="fas fa-times"></i>
                            </button>

                            <!-- Loading Spinner inside search bar -->
                            <div id="searchSpinner" class="search-loading-spinner"></div>
                            
                            <button type="submit" class="submit-search-btn" id="searchBtn">
                                <span id="btnText">VERIFY CERTIFICATE</span>
                                <i class="fas fa-arrow-right btn-arrow-icon" id="btnIcon"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Dynamic Autocomplete suggestions -->
                <div id="autocompletePopover" class="autocomplete-popover"></div>
            </div>

        </div>
    </section>

    <!-- Initial state: 4-Column Guides Section -->
    <section class="py-5 guides-section" id="initialGuides">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-3">
                    <div class="guide-card text-center">
                        <div class="guide-icon-wrapper mx-auto">
                            <i class="fas fa-magnifying-glass"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Smart Registry Search</h5>
                        <p class="text-muted small mb-0">Search instantly by Candidate Name, Certificate Number, or Verification ID.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="guide-card text-center">
                        <div class="guide-icon-wrapper mx-auto" style="background: rgba(45,86,161,0.1); color: var(--theme-blue);">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Accredited Credentials</h5>
                        <p class="text-muted small mb-0">Validate CQI/IRCA and S2 accredited Lead Auditor and Training qualifications.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="guide-card text-center">
                        <div class="guide-icon-wrapper mx-auto">
                            <i class="fas fa-filter"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Filter &amp; Refine</h5>
                        <p class="text-muted small mb-0">Refine matches by Course Category, ISO Standard Scheme, or Status on the fly.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="guide-card text-center">
                        <div class="guide-icon-wrapper mx-auto" style="background: rgba(45,86,161,0.1); color: var(--theme-blue);">
                            <i class="fas fa-qrcode"></i>
                        </div>
                        <h5 class="fw-bold mb-2">QR Verified Transcripts</h5>
                        <p class="text-muted small mb-0">View full qualification ledgers, download PDFs, and print official verification sheets.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Active state: Split Column results main layout -->
    <div class="results-main-wrapper" id="resultsLayout">
        <div class="container">
            <div class="row g-4">
                
                <!-- Left Sidebar Filters Panel -->
                <div class="col-lg-4">
                    <div class="filter-sidebar shadow-sm">
                        <div class="filter-header-main mb-4">
                            <span><i class="fas fa-sliders-h text-success me-2"></i>Filter by</span>
                            <span class="filter-clear-all" id="clearFiltersBtn">Clear All</span>
                        </div>

                        <!-- Accordion Filter: Course Category -->
                        <div class="filter-accordion-item" id="filterCategoryPanel">
                            <button class="filter-accordion-btn">
                                <span>Course Category</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="filter-accordion-content" id="categoryCheckboxes">
                                <!-- Checkboxes injected dynamically -->
                            </div>
                        </div>

                        <!-- Accordion Filter: ISO Standard -->
                        <div class="filter-accordion-item" id="filterStandardPanel">
                            <button class="filter-accordion-btn">
                                <span>ISO Standard / Scheme</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="filter-accordion-content" id="standardCheckboxes">
                                <!-- Checkboxes injected dynamically -->
                            </div>
                        </div>

                        <!-- Accordion Filter: Status -->
                        <div class="filter-accordion-item" id="filterStatusPanel">
                            <button class="filter-accordion-btn">
                                <span>Certificate Status</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="filter-accordion-content" id="statusCheckboxes">
                                <!-- Checkboxes injected dynamically -->
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Right Side Results Display Panel -->
                <div class="col-lg-8">
                    
                    <!-- Search Stats Bar -->
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="results-count-header" id="resultsCountHeader">
                            0 certified records found
                        </div>
                    </div>

                    <!-- Cards Listing Container (Pre-Search List) -->
                    <div id="resultsCardContainer">
                        <!-- Result cards dynamically injected -->
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>

<!-- Training Certificate Details Modal -->
<div class="modal fade" id="trainingDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 overflow-hidden" style="border-radius: 20px;">
            <div class="modal-header premium-modal-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="modal-title fw-bold fs-4" id="modalCandidateName">Candidate Name</h5>
                    <p class="mb-0 small text-white-50" id="modalCourseTitle">Course Qualification Ledger</p>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body premium-modal-body bg-white">
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <div id="modalStatusBadge" class="entity-badge-valid fs-6 py-2 px-4 mb-2">
                                <i class="fas fa-check-circle"></i> CERTIFICATE VERIFIED - STATUS: VALID
                            </div>
                        </div>
                        
                        <table class="table modal-detail-table">
                            <tbody>
                                <tr>
                                    <th>Candidate Name</th>
                                    <td id="tdCandidateName" class="fw-bold text-dark">Muhammad Ali Khan</td>
                                </tr>
                                <tr>
                                    <th>Certificate No</th>
                                    <td id="tdCertificateNo" class="text-primary font-monospace fw-bold">S2C/9001-LA/2026/0001</td>
                                </tr>
                                <tr>
                                    <th>Verification ID</th>
                                    <td id="tdVerificationId" class="text-primary font-monospace fw-bold">S2C-9001-LA-2026-0001</td>
                                </tr>
                                <tr>
                                    <th>Course Category</th>
                                    <td id="tdCourseCategory">Lead Auditor Course</td>
                                </tr>
                                <tr>
                                    <th>ISO Standard</th>
                                    <td id="tdStandard">ISO 9001:2015</td>
                                </tr>
                                <tr>
                                    <th>Training Duration</th>
                                    <td id="tdDuration">40 Hours (5 Days)</td>
                                </tr>
                                <tr>
                                    <th>Completion Date</th>
                                    <td id="tdCompletionDate">28 Feb 2026</td>
                                </tr>
                                <tr>
                                    <th>Certificate Issue Date</th>
                                    <td id="tdIssueDate">02 Mar 2026</td>
                                </tr>
                                <tr>
                                    <th>Valid Until</th>
                                    <td id="tdValidUntil">Lifetime Validity</td>
                                </tr>
                                <tr>
                                    <th>Training Provider</th>
                                    <td id="tdTrainingProvider">S2 Certification Academy</td>
                                </tr>
                                <tr>
                                    <th>Issuing Organization</th>
                                    <td id="tdIssuingOrg" class="text-success">S2 Certification</td>
                                </tr>
                                <tr>
                                    <th>Verification Status</th>
                                    <td class="text-success"><i class="fas fa-shield-alt me-1"></i> Verified on <span id="tdVerifiedOn">Today</span></td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Official Verification Statement -->
                        <div class="tv-statement-box">
                            <strong><i class="fas fa-stamp me-1 text-primary"></i> Official Verification Statement:</strong>
                            <p class="mb-0 mt-1">
                                "This certificate has been issued by S2 Certification and may be verified through this official online verification portal. The information displayed represents the certificate record available in the S2 Certification verification system."
                            </p>
                        </div>
                    </div>

                    <!-- QR Code Seal Sidebar -->
                    <div class="col-lg-4">
                        <div class="qr-badge-box">
                            <div class="fw-bold text-dark small mb-2"><i class="fas fa-qrcode text-success me-1"></i> QR Verification Seal</div>
                            <img id="modalQrImage" src="" alt="QR Verification" class="img-fluid mb-2">
                            <div class="small text-muted font-monospace text-truncate mb-2" id="modalQrText" style="font-size: 0.72rem;"></div>
                            <div class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 w-100 mb-2">
                                <i class="fas fa-check-circle me-1"></i> QR RECORD MATCHED
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-secondary w-100" id="modalCopyLinkBtn">
                                <i class="fas fa-copy me-1"></i> Copy Direct Link
                            </button>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-secondary px-4 py-2" data-bs-dismiss="modal" style="border-radius: 50px;">Close</button>
                    <div class="d-flex gap-2">
                        <a href="#" target="_blank" class="btn btn-outline-primary px-4 py-2" id="modalPrintBtn" style="border-radius: 50px;">
                            <i class="fas fa-print me-2"></i> Print Verification
                        </a>
                        <a href="#" target="_blank" class="btn btn-theme px-4 py-2" id="modalPdfBtn" style="background: var(--theme-green); border-radius: 50px;">
                            <i class="fas fa-file-pdf me-2"></i> View PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // Core Elements
    const pageContainer = document.getElementById('pageContainer');
    const initialGuides = document.getElementById('initialGuides');
    const resultsLayout = document.getElementById('resultsLayout');
    const searchForm = document.getElementById('trainingSearchForm');
    const searchInput = document.getElementById('trainingSearchInput');
    const clearSearchBtn = document.getElementById('clearSearchBtn');
    const searchSpinner = document.getElementById('searchSpinner');
    const autocompletePopover = document.getElementById('autocompletePopover');
    const resultsCardContainer = document.getElementById('resultsCardContainer');
    const resultsCountHeader = document.getElementById('resultsCountHeader');
    const clearFiltersBtn = document.getElementById('clearFiltersBtn');
    const btnText = document.getElementById('btnText');
    const btnIcon = document.getElementById('btnIcon');

    // State Variables
    let currentQuery = '';
    let selectedFilters = {
        categories: [],
        standards: [],
        statuses: []
    };
    let activeResultData = [];

    // Initial check: if there is search parameter in URL on load
    if (searchInput && searchInput.value.trim() !== '') {
        if (clearSearchBtn) clearSearchBtn.style.display = 'block';
        triggerSearch(searchInput.value.trim());
    }

    // Input typing listener: toggle clear button & trigger autocomplete
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const q = this.value.trim();
            if (clearSearchBtn) {
                clearSearchBtn.style.display = q.length > 0 ? 'block' : 'none';
            }
            if (q.length >= 2) {
                debouncedAutocomplete(q);
            } else {
                autocompletePopover.style.display = 'none';
            }
        });

        // Hide popover on Escape key
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                autocompletePopover.style.display = 'none';
            }
        });
    }

    // Clear search input button action
    if (clearSearchBtn) {
        clearSearchBtn.addEventListener('click', function() {
            if (searchInput) {
                searchInput.value = '';
                searchInput.focus();
            }
            clearSearchBtn.style.display = 'none';
            autocompletePopover.style.display = 'none';
        });
    }

    // Close Autocomplete Popover when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.search-box-outer')) {
            autocompletePopover.style.display = 'none';
        }
    });

    // Handle Form Submit on Search Button Click
    searchForm.addEventListener('submit', function(e) {
        e.preventDefault();
        autocompletePopover.style.display = 'none';
        const query = searchInput ? searchInput.value.trim() : '';
        triggerSearch(query);
    });

    // Accordion Toggle Behavior
    const accordionButtons = document.querySelectorAll('.filter-accordion-btn');
    accordionButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const item = this.closest('.filter-accordion-item');
            item.classList.toggle('collapsed');
        });
    });

    // Clear all filters action
    clearFiltersBtn.addEventListener('click', function() {
        selectedFilters = {
            categories: [],
            standards: [],
            statuses: []
        };
        const checkboxes = document.querySelectorAll('.sidebar-filter-checkbox');
        checkboxes.forEach(cb => cb.checked = false);
        this.style.display = 'none';
        fetchFilteredResults();
    });

    // Debounce Helper
    let debounceTimer;
    function debouncedAutocomplete(query) {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            fetchAutocompleteSuggestions(query);
        }, 200);
    }

    // Fetch Suggestions
    function fetchAutocompleteSuggestions(query) {
        if (query.length < 2) return;
        
        fetch("{{ route('verify.training.search') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ query: query, autocomplete: true })
        })
        .then(res => res.json())
        .then(res => {
            if (res.success && res.suggestions && res.suggestions.length > 0) {
                renderAutocompleteDropdown(res.suggestions, query);
            } else {
                autocompletePopover.style.display = 'none';
            }
        })
        .catch(() => {
            autocompletePopover.style.display = 'none';
        });
    }

    // Render suggestions list
    function renderAutocompleteDropdown(suggestions, query) {
        autocompletePopover.innerHTML = '';
        suggestions.forEach(item => {
            const div = document.createElement('div');
            div.className = 'autocomplete-item';
            
            const highlightedName = highlightQuery(item.candidate_name, query);
            const highlightedNo = highlightQuery(item.certificate_no, query);

            div.innerHTML = `
                <div>
                    <div style="font-weight:600; color:#0f172a;">${highlightedName}</div>
                    <div class="small text-muted mt-1">
                        <span class="text-primary font-monospace">${highlightedNo}</span> • 
                        <span>${escapeHtml(item.course_title)}</span>
                    </div>
                </div>
                <div class="autocomplete-meta">${escapeHtml(item.standard || '')}</div>
            `;
            
            div.addEventListener('click', function() {
                const val = (item.certificate_no && item.certificate_no.toLowerCase().includes(query.toLowerCase())) 
                    ? item.certificate_no 
                    : item.candidate_name;
                searchInput.value = val;
                if (clearSearchBtn) clearSearchBtn.style.display = 'block';
                autocompletePopover.style.display = 'none';
                triggerSearch(val);
            });
            
            autocompletePopover.appendChild(div);
        });
        autocompletePopover.style.display = 'block';
    }

    // Highlight helper
    function highlightQuery(text, query) {
        if (!text) return '';
        if (!query) return escapeHtml(text);
        const escapeRegex = (str) => str.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
        const regex = new RegExp("(" + escapeRegex(query) + ")", "gi");
        return escapeHtml(text).replace(regex, "<mark class='highlight-text'>$1</mark>");
    }

    // Search trigger on button click or item selection
    function triggerSearch(query) {
        if (!query || query.trim() === '') {
            return;
        }

        currentQuery = query.trim();
        selectedFilters = {
            categories: [],
            standards: [],
            statuses: []
        };
        
        pageContainer.classList.add('search-active');
        setLoadingState(true);
        
        fetchFilteredResults();
    }

    function setLoadingState(isLoading) {
        if (searchSpinner) searchSpinner.style.display = isLoading ? 'block' : 'none';
        if (btnText) btnText.textContent = isLoading ? 'VERIFYING...' : 'VERIFY CERTIFICATE';
        if (btnIcon) btnIcon.className = isLoading ? 'fas fa-circle-notch fa-spin btn-arrow-icon' : 'fas fa-arrow-right btn-arrow-icon';
    }

    // Fetch primary query + sidebar filters
    function fetchFilteredResults() {
        setLoadingState(true);
        
        let payload = {
            query: currentQuery,
            categories: selectedFilters.categories,
            standards: selectedFilters.standards,
            statuses: selectedFilters.statuses
        };

        fetch("{{ route('verify.training.search') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify(payload)
        })
        .then(res => res.json())
        .then(data => {
            setLoadingState(false);
            
            if (data.success && data.data && data.data.length > 0) {
                activeResultData = data.data;
                renderResults(data);
                updateSidebarFilterCounts(data.filters);

                // Auto-open modal if exact single match on certificate_no or verification_id
                if (data.data.length === 1 && (
                    currentQuery.toLowerCase() === (data.data[0].certificate_no || '').toLowerCase() ||
                    currentQuery.toLowerCase() === (data.data[0].verification_id || '').toLowerCase()
                )) {
                    openTrainingDetailsModal(data.data[0]);
                }
            } else {
                renderEmptyState(data.message || 'No training certificates found matching your search.');
            }
        })
        .catch(err => {
            setLoadingState(false);
            console.error(err);
            renderEmptyState('An error occurred during query execution. Please try again.');
        });
    }

    // Render results pane (Pre-Search List)
    function renderResults(res) {
        resultsCardContainer.innerHTML = '';
        
        const totalFound = res.total;
        const filteredTotal = res.filtered_total;
        const searchLabel = currentQuery ? `"${escapeHtml(currentQuery)}"` : 'search criteria';

        if (totalFound !== filteredTotal) {
            resultsCountHeader.innerHTML = `Showing ${filteredTotal} of ${totalFound} records matching ${searchLabel}`;
        } else {
            resultsCountHeader.innerHTML = `${totalFound} certified ${totalFound === 1 ? 'record' : 'records'} found matching ${searchLabel}`;
        }

        const cardsToRender = res.data;

        cardsToRender.forEach(item => {
            // Compute initials from candidate name
            const words = (item.candidate_name || '').split(' ');
            let initials = '';
            if (words[0]) initials += words[0][0];
            if (words[1]) initials += words[1][0];
            initials = initials.slice(0, 2).toUpperCase() || 'TC';

            const card = document.createElement('div');
            card.className = 'entity-result-card';
            
            const isStatusValid = (item.status || '').toUpperCase() === 'VALID';
            const badgeClass = isStatusValid ? 'entity-badge-valid' : 'entity-badge-invalid';
            const statusIcon = isStatusValid ? 'fa-check-circle' : 'fa-exclamation-circle';

            card.innerHTML = `
                <div class="entity-initials-badge">${initials}</div>
                <div class="entity-details-pane">
                    <div class="entity-candidate-title">
                        <span>${highlightQuery(item.candidate_name, currentQuery)}</span>
                        <span class="${badgeClass}"><i class="fas ${statusIcon}"></i>${escapeHtml(item.status)}</span>
                    </div>
                    <div class="entity-course-sub">${escapeHtml(item.course_title)}</div>
                    
                    <div class="entity-grid-details">
                        <div class="detail-item-small">
                            <span class="lbl">Certificate No</span>
                            <span class="val mono">${highlightQuery(item.certificate_no, currentQuery)}</span>
                        </div>
                        <div class="detail-item-small">
                            <span class="lbl">Verification ID</span>
                            <span class="val mono">${highlightQuery(item.verification_id, currentQuery)}</span>
                        </div>
                        <div class="detail-item-small">
                            <span class="lbl">Standard</span>
                            <span class="val"><i class="fas fa-bookmark text-primary"></i>${escapeHtml(item.standard)}</span>
                        </div>
                        <div class="detail-item-small">
                            <span class="lbl">Completion Date</span>
                            <span class="val"><i class="fas fa-calendar-check text-success"></i>${escapeHtml(item.completion_date)}</span>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div class="d-flex gap-2">
                            <button class="view-profile-cta-btn view-btn">
                                <i class="fas fa-eye small text-primary"></i> View Details
                            </button>
                            <a href="${item.print_url}" target="_blank" class="view-profile-cta-btn" style="text-decoration:none;">
                                <i class="fas fa-print small"></i> Print
                            </a>
                            ${item.certificate_file_url ? `
                                <a href="${item.certificate_file_url}" target="_blank" class="view-profile-cta-btn" style="text-decoration:none;">
                                    <i class="fas fa-file-pdf small text-danger"></i> PDF
                                </a>
                            ` : ''}
                        </div>
                        <span class="text-muted small" style="font-size:0.75rem;">
                            <i class="fas fa-shield-alt text-success me-1"></i>Verified on ${item.verified_on}
                        </span>
                    </div>
                </div>
            `;

            // Attach Modal event listener
            card.querySelector('.view-btn').addEventListener('click', function() {
                openTrainingDetailsModal(item);
            });

            resultsCardContainer.appendChild(card);
        });

        // Show/hide clear filters button
        const filtersActive = selectedFilters.categories.length > 0 ||
                              selectedFilters.standards.length > 0 ||
                              selectedFilters.statuses.length > 0;
        
        clearFiltersBtn.style.display = filtersActive ? 'block' : 'none';
    }

    // Render empty results state
    function renderEmptyState(message) {
        resultsCardContainer.innerHTML = `
            <div class="text-center py-5 bg-white border border-dashed rounded-4 p-4 shadow-sm" style="border-style: dashed !important; border-width: 2px !important;">
                <div class="mb-3 text-danger">
                    <i class="fas fa-triangle-exclamation fa-3x"></i>
                </div>
                <h4 class="fw-bold mb-2 text-danger">CERTIFICATE NOT FOUND</h4>
                <p class="text-muted mb-0">${escapeHtml(message)}</p>
                <div class="p-3 bg-light rounded-3 d-inline-block text-start border mt-3 small text-muted">
                    <strong>Please verify the following:</strong>
                    <ul class="mb-0 mt-1 ps-3">
                        <li>Check that the Certificate Number or Verification ID was typed correctly.</li>
                        <li>If verifying a Company ISO certification, please use our <a href="{{ route('verify') }}" class="text-primary fw-bold">Company Verification Portal</a>.</li>
                        <li>Contact S2 Certification Support at <a href="mailto:info@s2cert.com">info@s2cert.com</a> for assistance.</li>
                    </ul>
                </div>
            </div>
        `;
        resultsCountHeader.innerHTML = `0 certified records matching "${escapeHtml(currentQuery)}"`;
    }

    // Update filter lists and counts
    function updateSidebarFilterCounts(filters) {
        if (!filters) return;
        renderFilterCategory('categoryCheckboxes', filters.categories, 'categories');
        renderFilterCategory('standardCheckboxes', filters.standards, 'standards');
        renderFilterCategory('statusCheckboxes', filters.statuses, 'statuses');
    }

    // Dynamic category checkbox injection
    function renderFilterCategory(containerId, items, filterKey) {
        const container = document.getElementById(containerId);
        if (!container) return;
        container.innerHTML = '';
        
        if (!items || items.length === 0) {
            container.innerHTML = '<p class="small text-muted mb-0">No filter options</p>';
            return;
        }

        items.forEach(item => {
            const isChecked = selectedFilters[filterKey].includes(item.name);
            const label = document.createElement('label');
            label.className = 'filter-checkbox-label';
            
            label.innerHTML = `
                <span>
                    <input type="checkbox" class="sidebar-filter-checkbox" data-key="${filterKey}" value="${escapeHtml(item.name)}" ${isChecked ? 'checked' : ''}>
                    ${escapeHtml(item.name)}
                </span>
                <span class="filter-option-count">${item.count}</span>
            `;

            label.querySelector('input').addEventListener('change', function() {
                const val = this.value;
                if (this.checked) {
                    if (!selectedFilters[filterKey].includes(val)) {
                        selectedFilters[filterKey].push(val);
                    }
                } else {
                    selectedFilters[filterKey] = selectedFilters[filterKey].filter(x => x !== val);
                }
                fetchFilteredResults();
            });

            container.appendChild(label);
        });
    }

    // Open detail modal with complete verified profile
    function openTrainingDetailsModal(item) {
        document.getElementById('modalCandidateName').textContent = item.candidate_name;
        document.getElementById('modalCourseTitle').textContent = item.course_title;
        document.getElementById('tdCandidateName').textContent = item.candidate_name;
        document.getElementById('tdCertificateNo').textContent = item.certificate_no;
        document.getElementById('tdVerificationId').textContent = item.verification_id;
        document.getElementById('tdCourseCategory').textContent = item.course_category;
        document.getElementById('tdStandard').textContent = item.standard;
        document.getElementById('tdDuration').textContent = item.training_duration;
        document.getElementById('tdCompletionDate').textContent = item.completion_date;
        document.getElementById('tdIssueDate').textContent = item.issue_date;
        document.getElementById('tdValidUntil').textContent = item.valid_until;
        document.getElementById('tdTrainingProvider').textContent = item.training_provider;
        document.getElementById('tdIssuingOrg').textContent = item.issuing_organization;
        document.getElementById('tdVerifiedOn').textContent = item.verified_on;
        
        // Status indicator update
        const statusBadge = document.getElementById('modalStatusBadge');
        const isStatusValid = (item.status || '').toUpperCase() === 'VALID';
        statusBadge.className = isStatusValid ? 'entity-badge-valid fs-6 py-2 px-4 mb-2' : 'entity-badge-invalid fs-6 py-2 px-4 mb-2';
        statusBadge.innerHTML = `<i class="fas ${isStatusValid ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i> ${item.status_heading || item.status}`;

        // QR Seal & Direct URL
        document.getElementById('modalQrImage').src = item.qr_image_url;
        document.getElementById('modalQrText').textContent = item.qr_url;
        
        document.getElementById('modalCopyLinkBtn').onclick = function() {
            navigator.clipboard.writeText(item.qr_url);
            alert('Direct verification link copied to clipboard!');
        };

        // Wire up print / PDF buttons
        document.getElementById('modalPrintBtn').href = item.print_url;
        const modalPdfBtn = document.getElementById('modalPdfBtn');
        if (item.certificate_file_url) {
            modalPdfBtn.href = item.certificate_file_url;
            modalPdfBtn.style.display = 'inline-flex';
        } else {
            modalPdfBtn.href = item.print_url;
            modalPdfBtn.style.display = 'inline-flex';
        }

        // Launch Modal
        const myModal = new bootstrap.Modal(document.getElementById('trainingDetailModal'));
        myModal.show();
    }

    // Helper functions
    function escapeHtml(string) {
        if (!string) return '';
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return String(string).replace(/[&<>"']/g, function(m) { return map[m]; });
    }

});
</script>
@endsection
