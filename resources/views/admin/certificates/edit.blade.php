@extends('layouts.admin')

@section('title', 'Edit Certificate')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.certificates.index') }}" class="text-muted text-decoration-none small">
        <i class="fas fa-arrow-left me-1"></i> Back to List
    </a>
    <h2 class="page-heading mt-2">Edit Certificate: {{ $certificate->certificate_no }}</h2>
</div>

<div class="row">
    <div class="col-lg-10">
        <div class="card admin-card p-4 p-md-5">
            <form action="{{ route('admin.certificates.update', $certificate->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold small">Company Name</label>
                        <input type="text" name="company_name" class="form-control" placeholder="e.g. ABC Industries Pvt Ltd" required value="{{ old('company_name', $certificate->company_name) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small">Certificate Number</label>
                        <input type="text" name="certificate_no" class="form-control" placeholder="e.g. S2-ISO-24011" required value="{{ old('certificate_no', $certificate->certificate_no) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small">Standard</label>
                        <input type="text" name="standard" class="form-control" placeholder="e.g. ISO 9001:2015" required value="{{ old('standard', $certificate->standard) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small">Status</label>
                        <select name="status" class="form-select">
                            <option value="Active" {{ $certificate->status == 'Active' ? 'selected' : '' }}>Active / Valid</option>
                            <option value="Suspended" {{ $certificate->status == 'Suspended' ? 'selected' : '' }}>Suspended</option>
                            <option value="Expired" {{ $certificate->status == 'Expired' ? 'selected' : '' }}>Expired</option>
                            <option value="Withdrawn" {{ $certificate->status == 'Withdrawn' ? 'selected' : '' }}>Withdrawn</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small">Country</label>
                        <input type="text" name="country" class="form-control" placeholder="e.g. Pakistan" required value="{{ old('country', $certificate->country) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small">City</label>
                        <input type="text" name="city" class="form-control" placeholder="e.g. Karachi" required value="{{ old('city', $certificate->city) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small">Certification Body</label>
                        <input type="text" name="certification_body" class="form-control" placeholder="e.g. S2 Certification" required value="{{ old('certification_body', $certificate->certification_body) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small">Accreditation Body</label>
                        <input type="text" name="accreditation_body" class="form-control" placeholder="e.g. PNAC" required value="{{ old('accreditation_body', $certificate->accreditation_body) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small">Issue Date</label>
                        <input type="date" name="issue_date" class="form-control" required value="{{ old('issue_date', $certificate->issue_date) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small">Expiry Date</label>
                        <input type="date" name="expiry_date" class="form-control" required value="{{ old('expiry_date', $certificate->expiry_date) }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold small">Scope of Certification</label>
                        <textarea name="scope" class="form-control" rows="4" placeholder="Describe the manufacturing or service scope..." required>{{ old('scope', $certificate->scope) }}</textarea>
                    </div>
                    <div class="col-12 pt-3">
                        <button type="submit" class="btn btn-red px-5 py-2">Update Certificate</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
