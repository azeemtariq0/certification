@extends('layouts.admin')

@section('title', 'Training & Auditor Certificates')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
    <div>
        <h2 class="page-heading mb-1"><i class="fas fa-user-graduate text-success me-2"></i>Training &amp; Auditor Certificates</h2>
        <p class="text-muted small mb-0">Manage training participants, Lead Auditor credentials, QR verification, and course certifications.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('verify.training') }}" target="_blank" class="btn btn-outline-dark px-3 py-2">
            <i class="fas fa-external-link-alt me-1 text-primary"></i> Public Verification
        </a>
        <a href="{{ route('admin.training-certificates.create') }}" class="btn btn-theme px-3 py-2 shadow-sm">
            <i class="fas fa-plus me-1"></i> Issue Training Certificate
        </a>
    </div>
</div>

<!-- Stats Row -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card admin-card p-3 border-start border-primary border-4 mb-0">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small text-uppercase fw-bold">Total Issued</span>
                    <h3 class="fw-bold mb-0 mt-1">{{ number_format($stats['total']) }}</h3>
                </div>
                <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-3">
                    <i class="fas fa-certificate fa-lg"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card admin-card p-3 border-start border-success border-4 mb-0">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small text-uppercase fw-bold">Valid Credentials</span>
                    <h3 class="fw-bold mb-0 mt-1 text-success">{{ number_format($stats['valid']) }}</h3>
                </div>
                <div class="p-3 bg-success bg-opacity-10 text-success rounded-3">
                    <i class="fas fa-check-circle fa-lg"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card admin-card p-3 border-start border-warning border-4 mb-0">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small text-uppercase fw-bold">Expired</span>
                    <h3 class="fw-bold mb-0 mt-1 text-warning">{{ number_format($stats['expired']) }}</h3>
                </div>
                <div class="p-3 bg-warning bg-opacity-10 text-warning rounded-3">
                    <i class="fas fa-clock fa-lg"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card admin-card p-3 border-start border-danger border-4 mb-0">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small text-uppercase fw-bold">Suspended / Other</span>
                    <h3 class="fw-bold mb-0 mt-1 text-danger">{{ number_format($stats['other']) }}</h3>
                </div>
                <div class="p-3 bg-danger bg-opacity-10 text-danger rounded-3">
                    <i class="fas fa-ban fa-lg"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modern Filter Card -->
<div class="card admin-card p-4 mb-4 shadow-sm">
    <form action="{{ route('admin.training-certificates.index') }}" method="GET">
        <div class="row g-3 align-items-end">
            <div class="col-lg-4 col-md-6">
                <label class="form-label small fw-bold text-muted mb-1"><i class="fas fa-search me-1 text-primary"></i> Search Candidate / Certificate No / ID</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-magnifying-glass"></i></span>
                    <input type="text" name="search" class="form-control" placeholder="Type candidate name, S2C/9001-LA..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6">
                <label class="form-label small fw-bold text-muted mb-1"><i class="fas fa-layer-group me-1 text-success"></i> Category</label>
                <select name="category" class="form-select">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6">
                <label class="form-label small fw-bold text-muted mb-1"><i class="fas fa-bookmark me-1 text-info"></i> Standard</label>
                <select name="standard" class="form-select">
                    <option value="">All Standards</option>
                    @foreach($standards as $std)
                        <option value="{{ $std }}" {{ request('standard') == $std ? 'selected' : '' }}>{{ $std }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6">
                <label class="form-label small fw-bold text-muted mb-1"><i class="fas fa-tag me-1 text-warning"></i> Status</label>
                <select name="status" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="VALID" {{ request('status') == 'VALID' ? 'selected' : '' }}>VALID</option>
                    <option value="EXPIRED" {{ request('status') == 'EXPIRED' ? 'selected' : '' }}>EXPIRED</option>
                    <option value="SUSPENDED" {{ request('status') == 'SUSPENDED' ? 'selected' : '' }}>SUSPENDED</option>
                    <option value="REVOKED" {{ request('status') == 'REVOKED' ? 'selected' : '' }}>REVOKED</option>
                    <option value="CANCELLED" {{ request('status') == 'CANCELLED' ? 'selected' : '' }}>CANCELLED</option>
                </select>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6 d-flex gap-2">
                <button type="submit" class="btn btn-theme w-100 py-2">
                    <i class="fas fa-filter me-1"></i> Filter
                </button>
                @if(request()->anyFilled(['search', 'category', 'standard', 'status']))
                    <a href="{{ route('admin.training-certificates.index') }}" class="btn btn-outline-secondary px-3" title="Clear Filters">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </div>
        </div>
    </form>
</div>

<!-- Table Card -->
<div class="card admin-card overflow-hidden shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4">Candidate &amp; Cert No</th>
                    <th>Course &amp; Standard</th>
                    <th>Category</th>
                    <th>Issue Date</th>
                    <th>Valid Until</th>
                    <th>Status</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($trainings as $training)
                <tr>
                    <td class="ps-4">
                        <div class="d-flex align-items-center gap-3">
                            @php
                                $words = explode(' ', $training->candidate_name);
                                $initials = strtoupper(substr($words[0] ?? '', 0, 1) . substr($words[1] ?? '', 0, 1));
                            @endphp
                            <div class="avatar-chip">{{ $initials ?: 'S2' }}</div>
                            <div>
                                <div class="fw-bold text-dark fs-6">{{ $training->candidate_name }}</div>
                                <div class="small d-flex align-items-center gap-2 mt-1">
                                    <span class="badge bg-light text-primary border font-monospace">{{ $training->certificate_no }}</span>
                                    @if($training->candidate_id)
                                        <span class="text-muted small">ID: {{ $training->candidate_id }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="fw-semibold text-navy">{{ $training->course_title }}</div>
                        <div class="text-muted small"><i class="fas fa-bookmark me-1 text-success"></i>{{ $training->standard }}</div>
                    </td>
                    <td>
                        <span class="badge bg-secondary-subtle text-secondary border px-2 py-1">
                            {{ $training->course_category }}
                        </span>
                    </td>
                    <td class="small fw-semibold">{{ $training->issue_date->format('d M Y') }}</td>
                    <td class="small">
                        @if($training->valid_until)
                            <span class="fw-semibold">{{ $training->valid_until->format('d M Y') }}</span>
                        @else
                            <span class="text-muted">Lifetime</span>
                        @endif
                    </td>
                    <td>
                        @php
                            $status = strtoupper($training->status);
                            $pillClass = match($status) {
                                'VALID' => 'status-pill-valid',
                                'EXPIRED' => 'status-pill-expired',
                                'SUSPENDED' => 'status-pill-suspended',
                                'REVOKED' => 'status-pill-revoked',
                                'CANCELLED' => 'status-pill-cancelled',
                                default => 'status-pill-valid'
                            };
                        @endphp
                        <span class="status-pill {{ $pillClass }}">{{ $status }}</span>
                    </td>
                    <td class="text-end pe-4">
                        <div class="table-actions">
                            <a href="{{ route('admin.training-certificates.show', $training->id) }}" class="action-btn action-btn-view" title="View Details &amp; QR">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('verify.training.print', $training->id) }}" target="_blank" class="action-btn action-btn-print" title="Print Verification Sheet">
                                <i class="fas fa-print"></i>
                            </a>
                            <a href="{{ route('admin.training-certificates.edit', $training->id) }}" class="action-btn action-btn-edit" title="Edit Certificate">
                                <i class="fas fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.training-certificates.destroy', $training->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to permanently delete this training certificate record?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn action-btn-delete" title="Delete Certificate">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5">
                        <div class="text-muted">
                            <i class="fas fa-user-graduate fa-3x mb-3 text-secondary opacity-50"></i>
                            <h5 class="fw-bold">No Training Certificates Found</h5>
                            <p class="small mb-3">No certificate records match your active search or filter criteria.</p>
                            <a href="{{ route('admin.training-certificates.create') }}" class="btn btn-theme btn-sm px-3">
                                <i class="fas fa-plus me-1"></i> Issue First Certificate
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($trainings->hasPages())
    <div class="p-4 border-top">
        {{ $trainings->links() }}
    </div>
    @endif
</div>
@endsection
