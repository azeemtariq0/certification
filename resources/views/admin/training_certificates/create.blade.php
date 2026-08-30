@extends('layouts.admin')

@section('title', 'Issue Training & Auditor Certificate')

@section('content')
<div class="mb-4 d-flex flex-wrap justify-content-between align-items-center gap-3">
    <div>
        <a href="{{ route('admin.training-certificates.index') }}" class="text-muted text-decoration-none small">
            <i class="fas fa-arrow-left me-1"></i> Back to Training Certificates
        </a>
        <h2 class="page-heading mt-2 mb-0"><i class="fas fa-user-graduate text-success me-2"></i>Issue Training &amp; Auditor Certificate</h2>
        <p class="text-muted small mb-0">Register candidate qualification, course completion, verification ID, and certificate credentials.</p>
    </div>
    <div>
        <a href="{{ route('admin.training-certificates.index') }}" class="btn btn-outline-secondary px-3">
            <i class="fas fa-list me-1"></i> View All Certificates
        </a>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show mb-4 shadow-sm" role="alert">
    <strong><i class="fas fa-exclamation-triangle me-2"></i>Please correct the following errors:</strong>
    <ul class="mb-0 mt-2">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<form action="{{ route('admin.training-certificates.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row g-4">
        <!-- Main Form Column -->
        <div class="col-lg-8">
            <!-- Candidate Identity Card -->
            <div class="card admin-card p-4 mb-4 shadow-sm">
                <div class="d-flex align-items-center gap-3 mb-3 border-bottom pb-3">
                    <div class="p-2 bg-primary bg-opacity-10 text-primary rounded-3">
                        <i class="fas fa-user-circle fa-lg"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-dark">1. Candidate Information</h5>
                        <span class="text-muted small">Candidate name and registration credentials</span>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label">Full Candidate Name <span class="text-danger">*</span></label>
                        <input type="text" name="candidate_name" class="form-control form-control-lg" placeholder="e.g. Muhammad Ali Khan" required value="{{ old('candidate_name') }}">
                        <span class="text-muted small mt-1 d-block">Official name as it will appear on the verified certificate.</span>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Candidate ID (Optional)</label>
                        <input type="text" name="candidate_id" class="form-control form-control-lg" placeholder="e.g. CAN-2026-0142" value="{{ old('candidate_id') }}">
                        <span class="text-muted small mt-1 d-block">Internal student or candidate ID.</span>
                    </div>
                </div>
            </div>

            <!-- Course & Qualification Details Card -->
            <div class="card admin-card p-4 mb-4 shadow-sm">
                <div class="d-flex align-items-center gap-3 mb-3 border-bottom pb-3">
                    <div class="p-2 bg-success bg-opacity-10 text-success rounded-3">
                        <i class="fas fa-graduation-cap fa-lg"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-dark">2. Course &amp; Qualification Details</h5>
                        <span class="text-muted small">Select syllabus, ISO scheme, and training details</span>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label">Course / Certification Title <span class="text-danger">*</span></label>
                        <input type="text" name="course_title" id="course_title_input" class="form-control" placeholder="e.g. ISO 9001:2015 QMS Lead Auditor Course" required value="{{ old('course_title') }}" list="course_presets">
                        <datalist id="course_presets">
                            <option value="ISO 9001:2015 QMS Lead Auditor">
                            <option value="ISO 9001:2015 QMS Auditor">
                            <option value="ISO 14001:2015 EMS Lead Auditor">
                            <option value="ISO 14001:2015 EMS Auditor">
                            <option value="ISO 45001:2018 OH&S Lead Auditor">
                            <option value="ISO 45001:2018 OH&S Auditor">
                            <option value="Integrated Management System Lead Auditor (ISO 9001, 14001, 45001)">
                            <option value="Integrated Management System Auditor">
                            <option value="ISO 9001:2015 Internal Auditor Course">
                            <option value="ISO 14001:2015 Internal Auditor Course">
                            <option value="ISO 45001:2018 Internal Auditor Course">
                            <option value="ISO 27001:2022 ISMS Lead Auditor">
                            <option value="ISO 22000:2018 FSMS Lead Auditor">
                            <option value="ISO 50001:2018 EnMS Lead Auditor">
                            <option value="ISO 9001:2015 Awareness Training">
                        </datalist>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Course Category <span class="text-danger">*</span></label>
                        <select name="course_category" class="form-select" required>
                            <option value="Lead Auditor" {{ old('course_category') == 'Lead Auditor' ? 'selected' : '' }}>Lead Auditor</option>
                            <option value="Auditor" {{ old('course_category') == 'Auditor' ? 'selected' : '' }}>Auditor</option>
                            <option value="Internal Auditor" {{ old('course_category') == 'Internal Auditor' ? 'selected' : '' }}>Internal Auditor</option>
                            <option value="Awareness Training" {{ old('course_category') == 'Awareness Training' ? 'selected' : '' }}>Awareness Training</option>
                            <option value="IMS Lead Auditor" {{ old('course_category') == 'IMS Lead Auditor' ? 'selected' : '' }}>IMS Lead Auditor</option>
                            <option value="IMS Auditor" {{ old('course_category') == 'IMS Auditor' ? 'selected' : '' }}>IMS Auditor</option>
                            <option value="Other" {{ old('course_category') == 'Other' ? 'selected' : '' }}>Other Approved Training</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">ISO Standard / Scheme <span class="text-danger">*</span></label>
                        <input type="text" name="standard" class="form-control" placeholder="e.g. ISO 9001:2015" required value="{{ old('standard', 'ISO 9001:2015') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Training Duration</label>
                        <input type="text" name="training_duration" class="form-control" placeholder="e.g. 5 Days (40 Hours)" value="{{ old('training_duration', '5 Days (40 Hours)') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Training Provider <span class="text-danger">*</span></label>
                        <input type="text" name="training_provider" class="form-control" required value="{{ old('training_provider', 'S2 Certification Academy') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Issuing Organization <span class="text-danger">*</span></label>
                        <input type="text" name="issuing_organization" class="form-control" required value="{{ old('issuing_organization', 'S2 Certification') }}">
                    </div>
                </div>
            </div>

            <!-- Remarks & Notes -->
            <div class="card admin-card p-4 shadow-sm">
                <div class="d-flex align-items-center gap-3 mb-3 border-bottom pb-3">
                    <div class="p-2 bg-warning bg-opacity-10 text-warning rounded-3">
                        <i class="fas fa-sticky-note fa-lg"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-dark">3. Remarks &amp; Examination Notes</h5>
                        <span class="text-muted small">Optional score, accreditation details, or verification transcript notes</span>
                    </div>
                </div>
                <textarea name="remarks" class="form-control" rows="3" placeholder="e.g. Passed CQI/IRCA & S2 Accredited Lead Auditor Course with Distinction (Score: 90%).">{{ old('remarks') }}</textarea>
            </div>
        </div>

        <!-- Sidebar / Meta Column -->
        <div class="col-lg-4">
            <!-- Codes & Numbers Card -->
            <div class="card admin-card p-4 mb-4 shadow-sm">
                <h5 class="fw-bold mb-3 text-dark border-bottom pb-2">
                    <i class="fas fa-barcode text-danger me-2"></i>Registration &amp; Codes
                </h5>
                <div class="mb-3">
                    <label class="form-label">Certificate Number <span class="text-danger">*</span></label>
                    <input type="text" name="certificate_no" class="form-control font-monospace fw-bold text-primary" placeholder="e.g. S2C/9001-LA/2026/0001" required value="{{ old('certificate_no', $suggestedCertNo) }}">
                    <span class="text-muted small">Format: <code>S2C/{STD}-{TYPE}/{YEAR}/{NUM}</code></span>
                </div>
                <div class="mb-2">
                    <label class="form-label">Verification ID (QR Code ID) <span class="text-danger">*</span></label>
                    <input type="text" name="verification_id" class="form-control font-monospace fw-bold text-dark" placeholder="e.g. S2C-9001-LA-2026-0001" required value="{{ old('verification_id', $suggestedVerificationId) }}">
                    <span class="text-muted small">Unique electronic token for direct QR scan lookup.</span>
                </div>
            </div>

            <!-- Dates & Status Card -->
            <div class="card admin-card p-4 mb-4 shadow-sm">
                <h5 class="fw-bold mb-3 text-dark border-bottom pb-2">
                    <i class="fas fa-calendar-alt text-info me-2"></i>Dates &amp; Status
                </h5>
                <div class="mb-3">
                    <label class="form-label">Completion Date <span class="text-danger">*</span></label>
                    <input type="date" name="completion_date" class="form-control" required value="{{ old('completion_date', date('Y-m-d')) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Issue Date <span class="text-danger">*</span></label>
                    <input type="date" name="issue_date" class="form-control" required value="{{ old('issue_date', date('Y-m-d')) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Valid Until (Expiry)</label>
                    <input type="date" name="valid_until" class="form-control" value="{{ old('valid_until', date('Y-m-d', strtotime('+3 years'))) }}">
                    <span class="text-muted small">Leave blank for lifetime validity.</span>
                </div>
                <div class="mb-2">
                    <label class="form-label">Certificate Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select fw-bold">
                        <option value="VALID" {{ old('status', 'VALID') == 'VALID' ? 'selected' : '' }}>VALID (Active &amp; Verified)</option>
                        <option value="EXPIRED" {{ old('status') == 'EXPIRED' ? 'selected' : '' }}>EXPIRED (Cycle Ended)</option>
                        <option value="SUSPENDED" {{ old('status') == 'SUSPENDED' ? 'selected' : '' }}>SUSPENDED (Under Review)</option>
                        <option value="REVOKED" {{ old('status') == 'REVOKED' ? 'selected' : '' }}>REVOKED (Withdrawn)</option>
                        <option value="CANCELLED" {{ old('status') == 'CANCELLED' ? 'selected' : '' }}>CANCELLED (Re-issued)</option>
                    </select>
                </div>
            </div>

            <!-- PDF Upload Card -->
            <div class="card admin-card p-4 mb-4 shadow-sm">
                <h5 class="fw-bold mb-3 text-dark border-bottom pb-2">
                    <i class="fas fa-file-pdf text-danger me-2"></i>Certificate Document
                </h5>
                <div class="file-upload-box" onclick="document.getElementById('certFileInput').click()">
                    <i class="fas fa-cloud-arrow-up fa-2x text-muted mb-2"></i>
                    <div class="fw-bold small text-dark" id="fileUploadLabel">Click to upload document</div>
                    <span class="text-muted" style="font-size: 0.76rem;">PDF, PNG, or JPG (Max 5MB)</span>
                    <input type="file" name="certificate_file" id="certFileInput" class="d-none" accept=".pdf,.jpg,.jpeg,.png" onchange="previewFileName(this)">
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-theme py-3 fw-bold shadow">
                    <i class="fas fa-shield-check me-2"></i> Issue &amp; Publish Certificate
                </button>
                <a href="{{ route('admin.training-certificates.index') }}" class="btn btn-outline-secondary py-2">
                    <i class="fas fa-times me-1"></i> Cancel
                </a>
            </div>
        </div>
    </div>
</form>

@section('scripts')
<script>
    function previewFileName(input) {
        if (input.files && input.files[0]) {
            const fileName = input.files[0].name;
            document.getElementById('fileUploadLabel').innerHTML = '<span class="text-success"><i class="fas fa-check me-1"></i> ' + fileName + '</span>';
        }
    }
</script>
@endsection
@endsection
