@extends('layouts.app')

@section('title', 'Accredited Certification Verification - S2 Certification')

@section('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

    /* Global Typography Override for Premium Feel */
    .verification-page-container {
        font-family: 'Inter', sans-serif;
        color: #1e293b;
        background-color: #f8fafc;
        min-height: 80vh;
        overflow: hidden;
    }

    /* Primary layout elements */
    .search-hero-section {
        padding: 90px 0 100px 0;
        background: radial-gradient(circle at 50% 50%, #ffffff 0%, #f1f5f9 100%);
        transition: all 0.7s cubic-bezier(0.25, 1, 0.5, 1);
        border-bottom: 1px solid #e2e8f0;
    }

    .welcome-header {
        max-height: 300px;
        opacity: 1;
        transition: all 0.6s cubic-bezier(0.25, 1, 0.5, 1);
        transform: translateY(0);
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
        max-width: 720px;
        margin: 0 auto;
        z-index: 100;
    }

    .search-input-group {
        display: flex;
        align-items: center;
        background: #ffffff;
        border: 2px solid #cbd5e1;
        border-radius: 9999px;
        padding: 6px 10px 6px 22px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .search-input-group:focus-within {
        border-color: var(--theme-blue);
        box-shadow: 0 12px 30px -5px rgba(45, 86, 161, 0.2), 0 8px 10px -6px rgba(45, 86, 161, 0.1);
    }

    .search-icon-left {
        color: #94a3b8;
        font-size: 1.15rem;
        margin-right: 14px;
        flex-shrink: 0;
    }

    .search-input-field {
        flex-grow: 1;
        min-width: 0;
        border: none;
        outline: none;
        font-size: 1.05rem;
        font-weight: 500;
        color: #0f172a;
        padding: 10px 0;
        background: transparent;
    }

    .search-input-field::placeholder {
        color: #94a3b8;
        font-size: 0.98rem;
    }

    .input-action-buttons {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
    }

    .clear-search-btn {
        background: none;
        border: none;
        color: #94a3b8;
        cursor: pointer;
        padding: 6px 8px;
        display: none;
        font-size: 0.95rem;
        transition: color 0.2s;
    }

    .clear-search-btn:hover {
        color: #475569;
    }

    .search-loading-spinner {
        display: none;
        width: 1.25rem;
        height: 1.25rem;
        border: 2px solid #e2e8f0;
        border-top-color: var(--theme-blue);
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .submit-search-btn {
        background: var(--theme-blue);
        border: none;
        color: #ffffff;
        border-radius: 9999px;
        padding: 11px 28px;
        font-weight: 600;
        font-size: 0.95rem;
        letter-spacing: 0.3px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.25s ease;
        box-shadow: 0 4px 10px rgba(45, 86, 161, 0.25);
    }

    .submit-search-btn:hover {
        background: #1e3a8a;
        transform: translateY(-1px);
        box-shadow: 0 6px 14px rgba(45, 86, 161, 0.35);
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
            width: calc(100% - 40px);
        }
        .input-action-buttons {
            width: 100%;
            justify-content: flex-end;
        }
        .submit-search-btn {
            width: 100%;
            justify-content: center;
            padding: 10px;
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
    }

    .autocomplete-item:last-child {
        border-bottom: none;
    }

    .autocomplete-item:hover, .autocomplete-item.active {
        background: #f8fafc;
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

    /* Filter Sidebar Accordions */
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

    .filter-search-box {
        margin-bottom: 12px;
        position: relative;
    }

    .filter-search-box input {
        width: 100%;
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        padding: 6px 12px 6px 30px;
        font-size: 0.8rem;
        outline: none;
    }

    .filter-search-box input:focus {
        border-color: var(--theme-green);
    }

    .filter-search-box i {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 0.75rem;
    }

    /* Premium Locked Filter Look */
    .filter-locked {
        opacity: 0.65;
        position: relative;
        cursor: not-allowed;
    }

    .filter-locked-badge {
        font-size: 0.7rem;
        background: #f1f5f9;
        border: 1px solid #cbd5e1;
        color: #475569;
        padding: 2px 8px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
        font-weight: 600;
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
        padding: 30px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        display: flex;
        gap: 24px;
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
        width: 60px;
        height: 60px;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--theme-blue) 0%, #1e3a8a 100%);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        font-weight: 700;
        flex-shrink: 0;
        box-shadow: 0 4px 6px rgba(45, 86, 161, 0.2);
    }

    .entity-details-pane {
        flex-grow: 1;
    }

    .entity-company-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
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
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 20px;
    }

    .detail-item-small {
        display: flex;
        flex-direction: column;
    }

    .detail-item-small span.lbl {
        font-size: 0.75rem;
        text-transform: uppercase;
        color: #94a3b8;
        font-weight: 700;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }

    .detail-item-small span.val {
        font-size: 0.95rem;
        color: #334155;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .detail-item-small span.val i {
        color: #64748b;
        font-size: 0.85rem;
    }

    .view-profile-cta-btn {
        background: #ffffff;
        border: 1px solid #cbd5e1;
        color: #475569;
        font-weight: 600;
        font-size: 0.85rem;
        padding: 8px 20px;
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

    /* Premium signup prompt */
    .premium-restricted-callout {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        color: #ffffff;
        border-radius: 16px;
        padding: 40px;
        text-align: center;
        position: relative;
        overflow: hidden;
        border: 1px solid #334155;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15);
    }

    .premium-restricted-callout h4 {
        font-weight: 800;
        margin-bottom: 12px;
        font-size: 1.5rem;
    }

    .premium-restricted-callout p {
        color: #94a3b8;
        font-size: 0.95rem;
        max-width: 600px;
        margin: 0 auto 24px auto;
    }

    .premium-lock-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
        color: #fd2240;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        margin: 0 auto 20px auto;
        border: 1px solid rgba(255,255,255,0.1);
    }

    /* Profile Detail Modal Override */
    .premium-modal-header {
        background: linear-gradient(135deg, var(--theme-blue) 0%, #1e3a8a 100%);
        color: #ffffff;
        border-bottom: none;
        padding: 24px 30px;
    }

    .premium-modal-body {
        padding: 40px 30px;
    }

    .modal-detail-table th {
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        color: #94a3b8;
        letter-spacing: 0.5px;
        width: 30%;
        padding: 12px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .modal-detail-table td {
        font-size: 0.95rem;
        color: #1e293b;
        font-weight: 600;
        padding: 12px 0;
        border-bottom: 1px solid #f1f5f9;
    }

</style>
@endsection

@section('content')
<div class="verification-page-container" id="pageContainer">
    
    <!-- Hero / Search Section -->
    <section class="search-hero-section">
        <div class="container text-center">
            
            <div class="welcome-header mb-5">
                <h1 class="display-5 fw-bold mb-3" style="color: var(--dark-blue); text-transform: uppercase; letter-spacing: -0.5px;">
                    Authenticate Accredited Certifications
                </h1>
                <p class="text-muted fs-5 mx-auto" style="max-width: 650px;">
                    Verify the validity and accreditation status of organization management system certifications in real time.
                </p>
            </div>

            <!-- Centralized Search Box -->
            <div class="search-box-outer">
                <form id="verifySearchForm">
                    <div class="search-input-group">
                        <i class="fas fa-magnifying-glass search-icon-left"></i>
                        <input type="text" id="verifySearchInput" name="query" class="search-input-field" 
                               placeholder="Search by Company Name or Certificate / Challan No..." 
                               autocomplete="off" 
                               value="{{ request('query', request('search', request('certificate_no', request('company_name', '')))) }}">
                        <div class="input-action-buttons">
                            <!-- Clear Search Input Button -->
                            <button type="button" id="clearSearchBtn" class="clear-search-btn" title="Clear search">
                                <i class="fas fa-times"></i>
                            </button>

                            <!-- Loading Spinner inside search bar -->
                            <div id="searchSpinner" class="search-loading-spinner"></div>
                            
                            <button type="submit" class="submit-search-btn">
                                <i class="fas fa-search me-1"></i> Search
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
                        <h5 class="fw-bold mb-2">Smart Search</h5>
                        <p class="text-muted small mb-0">Search instantly by Company Name, Certificate No, or Challan ID.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="guide-card text-center">
                        <div class="guide-icon-wrapper mx-auto" style="background: rgba(45,86,161,0.1); color: var(--theme-blue);">
                            <i class="fas fa-shield-halved"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Instant Verification</h5>
                        <p class="text-muted small mb-0">Validate accreditation validity, scopes, and active certification status.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="guide-card text-center">
                        <div class="guide-icon-wrapper mx-auto">
                            <i class="fas fa-filter"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Filter Results</h5>
                        <p class="text-muted small mb-0">Refine matches by Country, City, Standard, or status instantly on the fly.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="guide-card text-center">
                        <div class="guide-icon-wrapper mx-auto" style="background: rgba(45,86,161,0.1); color: var(--theme-blue);">
                            <i class="fas fa-file-arrow-down"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Print & Verify</h5>
                        <p class="text-muted small mb-0">View complete ledger profiles, download PDFs, and print certificate copies.</p>
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
                            <span><i class="fas fa-sliders-h text-primary me-2"></i>Filter by</span>
                            <span class="filter-clear-all" id="clearFiltersBtn">Clear All</span>
                        </div>

                        <!-- Accordion Filter: Standard -->
                        <div class="filter-accordion-item" id="filterStandardPanel">
                            <button class="filter-accordion-btn">
                                <span>Standard</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="filter-accordion-content" id="standardCheckboxes">
                                <!-- Checkboxes will be dynamically rendered here -->
                            </div>
                        </div>

                        <!-- Accordion Filter: Country -->
                        <div class="filter-accordion-item" id="filterCountryPanel">
                            <button class="filter-accordion-btn">
                                <span>Country</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="filter-accordion-content">
                                <div class="filter-search-box">
                                    <i class="fas fa-search"></i>
                                    <input type="text" class="sub-filter-search" placeholder="Search countries..." data-target="countryCheckboxes">
                                </div>
                                <div id="countryCheckboxes">
                                    <!-- Checkboxes will be dynamically rendered here -->
                                </div>
                            </div>
                        </div>

                        <!-- Accordion Filter: City -->
                        <div class="filter-accordion-item" id="filterCityPanel">
                            <button class="filter-accordion-btn">
                                <span>City</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="filter-accordion-content">
                                <div class="filter-search-box">
                                    <i class="fas fa-search"></i>
                                    <input type="text" class="sub-filter-search" placeholder="Search cities..." data-target="cityCheckboxes">
                                </div>
                                <div id="cityCheckboxes">
                                    <!-- Checkboxes will be dynamically rendered here -->
                                </div>
                            </div>
                        </div>

                        <!-- Accordion Filter: Status -->
                        <div class="filter-accordion-item" id="filterStatusPanel">
                            <button class="filter-accordion-btn">
                                <span>Certification Status</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="filter-accordion-content" id="statusCheckboxes">
                                <!-- Checkboxes will be dynamically rendered here -->
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Right Side Results Display Panel -->
                <div class="col-lg-8">
                    
                    <!-- Search Stats Bar -->
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="results-count-header" id="resultsCountHeader">
                            0 certified entities found
                        </div>
                        <div class="text-muted small font-medium" id="filterStatsDisplay">
                            <!-- Applied filters summary -->
                        </div>
                    </div>

                    <!-- Cards Listing Container -->
                    <div id="resultsCardContainer">
                        <!-- Result cards dynamically injected -->
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>

<!-- Certificate Details Modal -->
<div class="modal fade" id="certificateDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 overflow-hidden" style="border-radius: 20px;">
            <div class="modal-header premium-modal-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="modal-title fw-bold fs-4" id="modalCompanyTitle">Company Name</h5>
                    <p class="mb-0 small text-white-50" id="modalSubtitle">Accredited Certificate Ledger</p>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body premium-modal-body bg-white">
                <div class="text-center mb-4">
                    <div id="modalStatusBadge" class="entity-badge-valid fs-6 py-2 px-4 mb-2">
                        <i class="fas fa-check-circle"></i> Active / Valid
                    </div>
                </div>
                
                <table class="table modal-detail-table">
                    <tbody>
                        <tr>
                            <th>Company Name</th>
                            <td id="tdCompanyName">ABC Industries Pvt Ltd</td>
                        </tr>
                        <tr>
                            <th>Certificate No</th>
                            <td id="tdCertificateNo" class="text-primary fw-bold">S2-ISO-24011</td>
                        </tr>
                        <tr>
                            <th>Standard</th>
                            <td id="tdStandard">ISO 9001:2015</td>
                        </tr>
                        <tr>
                            <th>Scope of Certification</th>
                            <td id="tdScope">Manufacturing of Plastic Packaging Products</td>
                        </tr>
                        <tr>
                            <th>Issue Date</th>
                            <td id="tdIssueDate">10 Jan 2025</td>
                        </tr>
                        <tr>
                            <th>Expiry Date</th>
                            <td id="tdExpiryDate">09 Jan 2028</td>
                        </tr>
                        <tr>
                            <th>Country / City</th>
                            <td id="tdLocation">Pakistan / Karachi</td>
                        </tr>
                        <tr>
                            <th>Certification Body</th>
                            <td id="tdCertificationBody">S2 Certification</td>
                        </tr>
                        <!-- <tr>
                            <th>Accreditation Body</th>
                            <td id="tdAccreditationBody">PNAC (Pakistan National Accreditation Council)</td>
                        </tr> -->
                        <tr>
                            <th>Verification Status</th>
                            <td class="text-success"><i class="fas fa-shield-alt me-1"></i> Verified on <span id="tdVerifiedOn">18 Jul 2026</span></td>
                        </tr>
                    </tbody>
                </table>

                <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-secondary px-4 py-2" data-bs-dismiss="modal" style="border-radius: 50px;">Close</button>
                    <div class="d-flex gap-2">
                        <a href="#" target="_blank" class="btn btn-outline-primary px-4 py-2" id="printCertificateModalBtn" style="border-radius: 50px;">
                            <i class="fas fa-print me-2"></i> Print
                        </a>
                        <a href="#" target="_blank" class="btn btn-theme px-4 py-2" id="downloadCertificateModalBtn" style="background: var(--theme-green); border-radius: 50px;">
                            <i class="fas fa-file-arrow-down me-2"></i> Download PDF
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
    const searchForm = document.getElementById('verifySearchForm');
    const searchInput = document.getElementById('verifySearchInput');
    const clearSearchBtn = document.getElementById('clearSearchBtn');
    const searchSpinner = document.getElementById('searchSpinner');
    const autocompletePopover = document.getElementById('autocompletePopover');
    const resultsCardContainer = document.getElementById('resultsCardContainer');
    const resultsCountHeader = document.getElementById('resultsCountHeader');
    const clearFiltersBtn = document.getElementById('clearFiltersBtn');
    const modalPrintBtn = document.getElementById('printCertificateModalBtn');
    const modalDownloadBtn = document.getElementById('downloadCertificateModalBtn');

    // Build the printable certificate URL for a given certificate id
    function printUrl(id) {
        return '{{ url('verify') }}/' + id + '/print';
    }

    // State Variables
    let currentQuery = '';

    let selectedFilters = {
        countries: [],
        cities: [],
        standards: [],
        statuses: []
    };
    
    // Active filters counts
    let activeResultData = [];
    let currentCertData = null; // for print

    // Initial check: if there are search parameters in URL on load
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

    // Sub-search within side filters (Country/City filtering in list)
    const subFilterInputs = document.querySelectorAll('.sub-filter-search');
    subFilterInputs.forEach(input => {
        input.addEventListener('input', function() {
            const targetId = this.getAttribute('data-target');
            const targetContainer = document.getElementById(targetId);
            const query = this.value.toLowerCase();
            const labels = targetContainer.querySelectorAll('.filter-checkbox-label');
            
            labels.forEach(label => {
                const text = label.textContent.toLowerCase();
                if (text.includes(query)) {
                    label.style.setProperty('display', 'flex', 'important');
                } else {
                    label.style.setProperty('display', 'none', 'important');
                }
            });
        });
    });

    // Clear all filters action
    clearFiltersBtn.addEventListener('click', function() {
        selectedFilters = {
            countries: [],
            cities: [],
            standards: [],
            statuses: []
        };
        // Uncheck all checkboxes
        const checkboxes = document.querySelectorAll('.sidebar-filter-checkbox');
        checkboxes.forEach(cb => cb.checked = false);
        this.style.display = 'none';
        // Execute search with cleared filters
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
        
        fetch('{{ route('verify.search') }}?autocomplete=1&query=' + encodeURIComponent(query), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(res => {
            if (res.success && res.suggestions && res.suggestions.length > 0) {
                renderAutocompleteDropdown(res.suggestions, query);
            } else {
                autocompletePopover.style.display = 'none';
            }
        })
        .catch(err => console.error(err));
    }

    // Render suggestions list
    function renderAutocompleteDropdown(suggestions, query) {
        autocompletePopover.innerHTML = '';
        suggestions.forEach(item => {
            const div = document.createElement('div');
            div.className = 'autocomplete-item';
            
            // Highlight matches
            const highlightedName = highlightQuery(item.company_name, query);
            const highlightedNo = highlightQuery(item.certificate_no, query);

            div.innerHTML = `
                <div>
                    <div style="font-weight:600; color:#0f172a;">${highlightedName}</div>
                    <div class="small text-muted mt-1"><i class="fas fa-file-invoice me-1"></i>${highlightedNo}</div>
                </div>
                <div class="autocomplete-meta">${item.standard}</div>
            `;
            
            div.addEventListener('click', function() {
                const val = (item.certificate_no && item.certificate_no.toLowerCase().includes(query.toLowerCase())) 
                    ? item.certificate_no 
                    : item.company_name;
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
            countries: [],
            cities: [],
            standards: [],
            statuses: []
        };
        
        pageContainer.classList.add('search-active');
        searchSpinner.style.display = 'block';
        
        fetchFilteredResults();
    }

    // Fetch primary query + sidebar filters
    function fetchFilteredResults() {
        searchSpinner.style.display = 'block';
        
        let payload = {
            query: currentQuery,
            countries: selectedFilters.countries,
            cities: selectedFilters.cities,
            standards: selectedFilters.standards,
            statuses: selectedFilters.statuses
        };

        fetch('{{ route('verify.search') }}', {
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
            searchSpinner.style.display = 'none';
            
            if (data.success) {
                activeResultData = data.data;
                renderResults(data);
                updateSidebarFilterCounts(data.filters);
            } else {
                renderEmptyState(data.message || 'No certificates found.');
            }
        })
        .catch(err => {
            searchSpinner.style.display = 'none';
            console.error(err);
            renderEmptyState('An error occurred during query execution. Please try again.');
        });
    }

    // Render results pane
    function renderResults(res) {
        resultsCardContainer.innerHTML = '';
        
        // Result summary text
        const totalFound = res.total;
        const filteredTotal = res.filtered_total;
        const searchLabel = currentQuery ? `"${escapeHtml(currentQuery)}"` : 'search criteria';

        if (totalFound !== filteredTotal) {
            resultsCountHeader.innerHTML = `Showing ${filteredTotal} of ${totalFound} entities matching ${searchLabel}`;
        } else {
            resultsCountHeader.innerHTML = `${totalFound} certified ${totalFound === 1 ? 'entity' : 'entities'} found matching ${searchLabel}`;
        }

        const cardsToRender = res.data;

        cardsToRender.forEach(item => {
            // Compute initials
            const words = item.company_name.split(' ');
            let initials = '';
            if (words[0]) initials += words[0][0];
            if (words[1]) initials += words[1][0];
            initials = initials.slice(0, 2).toUpperCase() || 'CO';

            const card = document.createElement('div');
            card.className = 'entity-result-card';
            
            const badgeClass = item.status.toLowerCase() === 'active' ? 'entity-badge-valid' : 'entity-badge-invalid';
            const statusIcon = item.status.toLowerCase() === 'active' ? 'fa-check-circle' : 'fa-exclamation-circle';

            card.innerHTML = `
                <div class="entity-initials-badge">${initials}</div>
                <div class="entity-details-pane">
                    <div class="entity-company-title">
                        <span>${highlightQuery(item.company_name, currentQuery)}</span>
                        <span class="${badgeClass}"><i class="fas ${statusIcon}"></i>${item.status}</span>
                    </div>
                    
                    <div class="entity-grid-details">
                        <div class="detail-item-small">
                            <span class="lbl">Standard</span>
                            <span class="val"><i class="fas fa-bookmark text-primary"></i>${item.standard}</span>
                        </div>
                        <div class="detail-item-small">
                            <span class="lbl">Certificate / Challan No</span>
                            <span class="val text-primary fw-bold"><i class="fas fa-file-invoice"></i>${highlightQuery(item.certificate_no, currentQuery)}</span>
                        </div>
                        <div class="detail-item-small">
                            <span class="lbl">Location</span>
                            <span class="val"><i class="fas fa-map-marker-alt text-danger"></i>${item.city}, ${item.country}</span>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div class="d-flex gap-2">
                            <button class="view-profile-cta-btn view-btn">
                                <i class="fas fa-eye small"></i> View Details
                            </button>
                            <a href="${printUrl(item.id)}?download=1" target="_blank" class="view-profile-cta-btn" style="text-decoration:none;">
                                <i class="fas fa-file-arrow-down small"></i> PDF
                            </a>
                        </div>
                        <span class="text-muted small" style="font-size:0.75rem;"><i class="fas fa-shield-alt text-success me-1"></i>Verified on ${item.verified_on}</span>
                    </div>
                </div>
            `;

            // Attach Modal event listener
            card.querySelector('.view-btn').addEventListener('click', function() {
                openCertificateDetailsModal(item);
            });

            resultsCardContainer.appendChild(card);
        });

        // Show/hide clear filters button
        const filtersActive = selectedFilters.countries.length > 0 ||
                              selectedFilters.cities.length > 0 ||
                              selectedFilters.standards.length > 0 ||
                              selectedFilters.statuses.length > 0;
        
        clearFiltersBtn.style.display = filtersActive ? 'block' : 'none';
    }

    // Render empty results state
    function renderEmptyState(message) {
        resultsCardContainer.innerHTML = `
            <div class="text-center py-5 bg-white border border-dashed rounded-4 p-4 shadow-sm" style="border-style: dashed !important; border-width: 2px !important;">
                <div class="premium-lock-icon" style="background: rgba(220,38,38,0.05); color: #dc2626; border-color: rgba(220,38,38,0.1)">
                    <i class="fas fa-circle-xmark"></i>
                </div>
                <h4 class="fw-bold mb-2">No Records Found</h4>
                <p class="text-muted mb-0">${escapeHtml(message)}</p>
            </div>
        `;
        resultsCountHeader.innerHTML = `0 certified entities matching "${escapeHtml(currentQuery)}"`;
    }

    // Update filter lists and counts
    function updateSidebarFilterCounts(filters) {
        if (!filters) return;
        renderFilterCategory('standardCheckboxes', filters.standards, 'standards');
        renderFilterCategory('countryCheckboxes', filters.countries, 'countries');
        renderFilterCategory('cityCheckboxes', filters.cities, 'cities');
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

            // Checkbox event binding
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

    // Open detail modal with profile details
    function openCertificateDetailsModal(item) {
        currentCertData = item;
        
        document.getElementById('modalCompanyTitle').textContent = item.company_name;
        document.getElementById('tdCompanyName').textContent = item.company_name;
        document.getElementById('tdCertificateNo').textContent = item.certificate_no;
        document.getElementById('tdStandard').textContent = item.standard;
        document.getElementById('tdScope').textContent = item.scope;
        document.getElementById('tdIssueDate').textContent = item.issue_date;
        document.getElementById('tdExpiryDate').textContent = item.expiry_date;
        document.getElementById('tdLocation').textContent = `${item.city} / ${item.country}`;
        document.getElementById('tdCertificationBody').textContent = item.certification_body;
        document.getElementById('tdVerifiedOn').textContent = item.verified_on;
        
        // Status indicator update
        const statusBadge = document.getElementById('modalStatusBadge');
        statusBadge.className = item.status.toLowerCase() === 'active' ? 'entity-badge-valid fs-6 py-2 px-4 mb-2' : 'entity-badge-invalid fs-6 py-2 px-4 mb-2';
        statusBadge.innerHTML = `<i class="fas ${item.status.toLowerCase() === 'active' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i> ${item.status}`;

        // Wire up print / download buttons to the printable certificate page
        modalPrintBtn.href = printUrl(item.id) + '?print=1';
        modalDownloadBtn.href = printUrl(item.id) + '?download=1';

        // Launch Modal
        const myModal = new bootstrap.Modal(document.getElementById('certificateDetailModal'));
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
