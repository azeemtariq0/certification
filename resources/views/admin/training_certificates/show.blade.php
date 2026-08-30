@extends('layouts.admin')

@section('title', 'Training Record - ' . $training->certificate_no)

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
    <div>
        <a href="{{ route('admin.training-certificates.index') }}" class="text-muted text-decoration-none small">
            <i class="fas fa-arrow-left me-1"></i> Back to Training List
        </a>
        <div class="d-flex align-items-center gap-3 mt-2">
            <h2 class="page-heading mb-0">{{ $training->candidate_name }}</h2>
            @php
                $status = strtoupper($training->status);
                $badgeClass = match($status) {
                    'VALID' => 'bg-success',
                    'EXPIRED' => 'bg-warning text-dark',
                    'SUSPENDED' => 'bg-info text-dark',
                    'REVOKED' => 'bg-danger',
                    'CANCELLED' => 'bg-secondary',
                    default => 'bg-primary'
                };
            @endphp
            <span class="badge {{ $badgeClass }} fs-6 px-3 py-2">STATUS: {{ $status }}</span>
        </div>
        <p class="text-muted small mb-0 mt-1 font-monospace">Certificate No: <strong>{{ $training->certificate_no }}</strong> | Verification ID: <strong>{{ $training->verification_id }}</strong></p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('verify.training.print', $training->id) }}" target="_blank" class="btn btn-outline-secondary px-3">
            <i class="fas fa-print me-1"></i> Print Verification Sheet
        </a>
        <a href="{{ route('admin.training-certificates.edit', $training->id) }}" class="btn btn-theme px-3">
            <i class="fas fa-edit me-1"></i> Edit Certificate
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Main Details Column -->
    <div class="col-lg-8">
        <!-- Certificate Summary Card -->
        <div class="card admin-card p-4 mb-4 shadow-sm">
            <h5 class="fw-bold mb-3 text-dark border-bottom pb-2">
                <i class="fas fa-award text-success me-2"></i>Qualification & Standard Details
            </h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <span class="text-muted small d-block">Course Title</span>
                    <strong class="fs-6 text-navy">{{ $training->course_title }}</strong>
                </div>
                <div class="col-md-6">
                    <span class="text-muted small d-block">Course Category</span>
                    <span class="badge bg-secondary-subtle text-secondary border px-2 py-1 fs-6">{{ $training->course_category }}</span>
                </div>
                <div class="col-md-6">
                    <span class="text-muted small d-block">ISO Standard / Scheme</span>
                    <strong class="fs-6">{{ $training->standard }}</strong>
                </div>
                <div class="col-md-6">
                    <span class="text-muted small d-block">Training Duration</span>
                    <span>{{ $training->training_duration ?: 'N/A' }}</span>
                </div>
                <div class="col-md-6">
                    <span class="text-muted small d-block">Training Provider</span>
                    <span>{{ $training->training_provider }}</span>
                </div>
                <div class="col-md-6">
                    <span class="text-muted small d-block">Issuing Organization</span>
                    <span>{{ $training->issuing_organization }}</span>
                </div>
            </div>
        </div>

        <!-- Dates Card -->
        <div class="card admin-card p-4 mb-4 shadow-sm">
            <h5 class="fw-bold mb-3 text-dark border-bottom pb-2">
                <i class="fas fa-calendar-check text-primary me-2"></i>Key Dates & Validity
            </h5>
            <div class="row g-3">
                <div class="col-md-4">
                    <span class="text-muted small d-block">Training Completion Date</span>
                    <strong class="text-dark">{{ $training->completion_date->format('d F Y') }}</strong>
                </div>
                <div class="col-md-4">
                    <span class="text-muted small d-block">Certificate Issue Date</span>
                    <strong class="text-dark">{{ $training->issue_date->format('d F Y') }}</strong>
                </div>
                <div class="col-md-4">
                    <span class="text-muted small d-block">Valid Until</span>
                    <strong class="text-dark">
                        {{ $training->valid_until ? $training->valid_until->format('d F Y') : 'Lifetime Validity' }}
                    </strong>
                </div>
            </div>
        </div>

        <!-- Remarks & Notes -->
        @if($training->remarks)
        <div class="card admin-card p-4 mb-4 shadow-sm">
            <h5 class="fw-bold mb-2 text-dark">
                <i class="fas fa-sticky-note text-warning me-2"></i>Remarks & Administrative Notes
            </h5>
            <div class="p-3 bg-light rounded text-muted">
                {{ $training->remarks }}
            </div>
        </div>
        @endif

        <!-- Uploaded Certificate Document -->
        @if($training->certificate_file)
        <div class="card admin-card p-4 shadow-sm">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0 text-dark">
                    <i class="fas fa-file-pdf text-danger me-2"></i>Official Certificate Document
                </h5>
                <a href="{{ asset('storage/' . $training->certificate_file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-external-link-alt me-1"></i> Open in New Tab
                </a>
            </div>
            <div class="p-3 bg-light rounded border text-center">
                <p class="text-muted small mb-2">Stored path: <code>{{ $training->certificate_file }}</code></p>
                <a href="{{ asset('storage/' . $training->certificate_file) }}" target="_blank" class="btn btn-theme">
                    <i class="fas fa-download me-1"></i> View / Download Document
                </a>
            </div>
        </div>
        @endif
    </div>

    <!-- QR & Meta Sidebar Column -->
    <div class="col-lg-4">
        <!-- QR Code Verification Card -->
        <div class="card admin-card p-4 mb-4 text-center shadow-sm">
            <h5 class="fw-bold mb-3 text-dark border-bottom pb-2">
                <i class="fas fa-qrcode text-dark me-2"></i>Live QR Verification
            </h5>
            <p class="text-muted small mb-3">Scanning this QR code opens the exact live verification record on the public portal.</p>
            
            @php
                $qrUrl = url('/verify/training/' . $training->verification_id);
                $qrImgUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . urlencode($qrUrl);
            @endphp

            <div class="d-inline-block p-3 bg-white border rounded shadow-sm mb-3">
                <img src="{{ $qrImgUrl }}" alt="QR Code" class="img-fluid" style="width: 180px; height: 180px;">
            </div>

            <div class="input-group input-group-sm mb-2">
                <input type="text" class="form-control font-monospace" id="qrLinkInput" value="{{ $qrUrl }}" readonly>
                <button class="btn btn-outline-secondary" type="button" onclick="navigator.clipboard.writeText(document.getElementById('qrLinkInput').value); alert('Verification link copied to clipboard!');">
                    <i class="fas fa-copy"></i>
                </button>
            </div>
            <a href="{{ $qrUrl }}" target="_blank" class="btn btn-sm btn-outline-primary w-100 mt-2">
                <i class="fas fa-external-link-alt me-1"></i> Test Public QR Destination
            </a>
        </div>

        <!-- Audit Details Card -->
        <div class="card admin-card p-4 shadow-sm">
            <h6 class="fw-bold text-muted text-uppercase mb-3 small">
                <i class="fas fa-history me-1"></i> Audit Trail
            </h6>
            <ul class="list-unstyled small mb-0 text-muted">
                <li class="mb-2"><strong>Record Created:</strong> {{ $training->created_at ? $training->created_at->format('d M Y, h:i A') : 'N/A' }}</li>
                <li class="mb-2"><strong>Last Updated:</strong> {{ $training->updated_at ? $training->updated_at->format('d M Y, h:i A') : 'N/A' }}</li>
                @if($training->creator)
                    <li class="mb-2"><strong>Created By:</strong> {{ $training->creator->name }}</li>
                @endif
                @if($training->updater)
                    <li><strong>Updated By:</strong> {{ $training->updater->name }}</li>
                @endif
            </ul>
        </div>
    </div>
</div>
@endsection
