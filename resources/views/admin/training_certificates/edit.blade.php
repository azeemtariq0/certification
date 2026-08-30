@extends('layouts.admin')

@section('title', 'Edit Training Certificate - ' . $training->certificate_no)

@section('content')
<div class="mb-4 d-flex flex-wrap justify-content-between align-items-center gap-3">
    <div>
        <a href="{{ route('admin.training-certificates.show', $training->id) }}" class="text-muted text-decoration-none small">
            <i class="fas fa-arrow-left me-1"></i> Back to Certificate Details
        </a>
        <h2 class="page-heading mt-2 mb-0"><i class="fas fa-pen-to-square text-primary me-2"></i>Edit Training Certificate</h2>
        <p class="text-muted small mb-0">Updating credentials for <strong>{{ $training->candidate_name }}</strong> ({{ $training->certificate_no }})</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.training-certificates.show', $training->id) }}" class="btn btn-outline-secondary px-3">
            <i class="fas fa-eye me-1"></i> View Record
        </a>
        <a href="{{ route('verify.training.print', $training->id) }}" target="_blank" class="btn btn-outline-dark px-3">
            <i class="fas fa-print me-1"></i> Print Verification
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

<form action="{{ route('admin.training-certificates.update', $training->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
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
                        <input type="text" name="candidate_name" class="form-control form-control-lg" required value="{{ old('candidate_name', $training->candidate_name) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Candidate ID (Optional)</label>
                        <input type="text" name="candidate_id" class="form-control form-control-lg" value="{{ old('candidate_id', $training->candidate_id) }}">
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
                        <span class="text-muted small">Update course title, standard and training parameters</span>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label">Course / Certification Title <span class="text-danger">*</span></label>
                        <input type="text" name="course_title" class="form-control" required value="{{ old('course_title', $training->course_title) }}" list="course_presets">
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
                        </datalist>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Course Category <span class="text-danger">*</span></label>
                        <select name="course_category" class="form-select" required>
                            @php
                                $currentCat = old('course_category', $training->course_category);
                                $catList = ['Lead Auditor', 'Auditor', 'Internal Auditor', 'Awareness Training', 'IMS Lead Auditor', 'IMS Auditor', 'Other'];
                            @endphp
                            @foreach($catList as $cat)
                                <option value="{{ $cat }}" {{ $currentCat == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">ISO Standard / Scheme <span class="text-danger">*</span></label>
                        <input type="text" name="standard" class="form-control" required value="{{ old('standard', $training->standard) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Training Duration</label>
                        <input type="text" name="training_duration" class="form-control" value="{{ old('training_duration', $training->training_duration) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Training Provider <span class="text-danger">*</span></label>
                        <input type="text" name="training_provider" class="form-control" required value="{{ old('training_provider', $training->training_provider) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Issuing Organization <span class="text-danger">*</span></label>
                        <input type="text" name="issuing_organization" class="form-control" required value="{{ old('issuing_organization', $training->issuing_organization) }}">
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
                        <span class="text-muted small">Update score, notes or verification details</span>
                    </div>
                </div>
                <textarea name="remarks" class="form-control" rows="3">{{ old('remarks', $training->remarks) }}</textarea>
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
                    <input type="text" name="certificate_no" class="form-control font-monospace fw-bold text-primary" required value="{{ old('certificate_no', $training->certificate_no) }}">
                </div>
                <div class="mb-2">
                    <label class="form-label">Verification ID (QR Code ID) <span class="text-danger">*</span></label>
                    <input type="text" name="verification_id" class="form-control font-monospace fw-bold text-dark" required value="{{ old('verification_id', $training->verification_id) }}">
                </div>
            </div>

            <!-- Dates & Status Card -->
            <div class="card admin-card p-4 mb-4 shadow-sm">
                <h5 class="fw-bold mb-3 text-dark border-bottom pb-2">
                    <i class="fas fa-calendar-alt text-info me-2"></i>Dates &amp; Status
                </h5>
                <div class="mb-3">
                    <label class="form-label">Completion Date <span class="text-danger">*</span></label>
                    <input type="date" name="completion_date" class="form-control" required value="{{ old('completion_date', $training->completion_date->format('Y-m-d')) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Issue Date <span class="text-danger">*</span></label>
                    <input type="date" name="issue_date" class="form-control" required value="{{ old('issue_date', $training->issue_date->format('Y-m-d')) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Valid Until (Expiry)</label>
                    <input type="date" name="valid_until" class="form-control" value="{{ old('valid_until', $training->valid_until ? $training->valid_until->format('Y-m-d') : '') }}">
                </div>
                <div class="mb-2">
                    <label class="form-label">Certificate Status <span class="text-danger">*</span></label>
                    @php $currentStatus = old('status', $training->status); @endphp
                    <select name="status" class="form-select fw-bold">
                        <option value="VALID" {{ $currentStatus == 'VALID' ? 'selected' : '' }}>VALID (Active &amp; Verified)</option>
                        <option value="EXPIRED" {{ $currentStatus == 'EXPIRED' ? 'selected' : '' }}>EXPIRED (Cycle Ended)</option>
                        <option value="SUSPENDED" {{ $currentStatus == 'SUSPENDED' ? 'selected' : '' }}>SUSPENDED (Under Review)</option>
                        <option value="REVOKED" {{ $currentStatus == 'REVOKED' ? 'selected' : '' }}>REVOKED (Withdrawn)</option>
                        <option value="CANCELLED" {{ $currentStatus == 'CANCELLED' ? 'selected' : '' }}>CANCELLED (Re-issued)</option>
                    </select>
                </div>
            </div>

            <!-- PDF Upload Card -->
            <div class="card admin-card p-4 mb-4 shadow-sm">
                <h5 class="fw-bold mb-3 text-dark border-bottom pb-2">
                    <i class="fas fa-file-pdf text-danger me-2"></i>Official Document
                </h5>
                @if($training->certificate_file)
                    <div class="alert alert-light border d-flex align-items-center justify-content-between p-2 mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-file-pdf text-danger fs-5"></i>
                            <span class="small fw-semibold text-truncate" style="max-width: 140px;">Current File</span>
                        </div>
                        <a href="{{ asset('storage/' . $training->certificate_file) }}" target="_blank" class="btn btn-sm btn-outline-primary">View</a>
                    </div>
                @endif
                <div class="file-upload-box" onclick="document.getElementById('editFileInput').click()">
                    <i class="fas fa-cloud-arrow-up fa-2x text-muted mb-2"></i>
                    <div class="fw-bold small text-dark" id="editFileUploadLabel">Click to replace file</div>
                    <span class="text-muted" style="font-size: 0.76rem;">PDF, PNG, or JPG (Max 5MB)</span>
                    <input type="file" name="certificate_file" id="editFileInput" class="d-none" accept=".pdf,.jpg,.jpeg,.png" onchange="previewEditFileName(this)">
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-theme py-3 fw-bold shadow">
                    <i class="fas fa-save me-2"></i> Update Record
                </button>
                <a href="{{ route('admin.training-certificates.show', $training->id) }}" class="btn btn-outline-secondary py-2">
                    <i class="fas fa-times me-1"></i> Cancel
                </a>
            </div>
        </div>
    </div>
</form>

@section('scripts')
<script>
    function previewEditFileName(input) {
        if (input.files && input.files[0]) {
            const fileName = input.files[0].name;
            document.getElementById('editFileUploadLabel').innerHTML = '<span class="text-success"><i class="fas fa-check me-1"></i> ' + fileName + '</span>';
        }
    }
</script>
@endsection
@endsection
