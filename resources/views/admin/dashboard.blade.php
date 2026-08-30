@extends('layouts.admin')

@section('title', 'Dashboard')

@section('styles')
<style>
    .welcome-banner {
        background: linear-gradient(120deg, var(--dark-blue) 0%, var(--navy-2) 100%);
        color:#fff; border-radius: 18px; padding: 32px; position: relative; overflow: hidden;
    }
    .welcome-banner::before { content:''; position:absolute; inset:0; background:url('https://www.transparenttextures.com/patterns/carbon-fibre.png'); opacity:0.08; }
    .welcome-banner h3 { font-weight: 800; }

    .stat-card { padding: 24px; display:flex; align-items:center; gap:18px; height:100%; }
    .stat-ico { width:58px; height:58px; border-radius:15px; display:flex; align-items:center; justify-content:center; font-size:1.4rem; flex-shrink:0; }
    .stat-card .n { font-family: var(--heading-font); font-weight:800; font-size:1.9rem; color:var(--dark-blue); line-height:1; }
    .stat-card .l { color: var(--text-muted); font-size:0.85rem; }

    .qa-btn { display:flex; align-items:center; gap:12px; padding:14px 16px; border-radius:12px; border:1px solid var(--line); text-decoration:none; color:var(--dark-blue); font-family:var(--heading-font); font-weight:600; transition:all .25s ease; background:#fff; }
    .qa-btn:hover { border-color: rgba(65,139,44,0.4); background:#f7fbf5; transform: translateY(-2px); color:var(--dark-blue); }
    .qa-btn .qa-ico { width:40px; height:40px; border-radius:10px; background:rgba(65,139,44,0.12); color:var(--theme-green); display:flex; align-items:center; justify-content:center; flex-shrink:0; font-size: 1.1rem; }
</style>
@endsection

@section('content')
<!-- Welcome banner -->
<div class="welcome-banner mb-4">
    <div class="row align-items-center position-relative">
        <div class="col-md-7">
            <h3 class="mb-2">Welcome back, {{ auth()->user()->name }} 👋</h3>
            <p class="mb-0" style="opacity:0.85;">Here is an overview of your certification & training portal today, {{ now()->format('l, d F Y') }}.</p>
        </div>
        <div class="col-md-5 text-md-end mt-3 mt-md-0 d-flex gap-2 justify-content-md-end flex-wrap">
            <a href="{{ route('admin.training-certificates.create') }}" class="btn btn-theme px-3 py-2 shadow-sm">
                <i class="fas fa-user-graduate me-1"></i> Issue Training Cert
            </a>
            <a href="{{ route('admin.certificates.create') }}" class="btn btn-outline-light px-3 py-2">
                <i class="fas fa-building me-1"></i> Add Company Cert
            </a>
        </div>
    </div>
</div>

<!-- Stat cards -->
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card admin-card stat-card border-start border-primary border-4">
            <div class="stat-ico" style="background:rgba(45,86,161,0.12); color:var(--theme-blue);"><i class="fas fa-certificate"></i></div>
            <div>
                <div class="n">{{ $stats['certificates'] }}</div>
                <div class="l">Company Certifications</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card admin-card stat-card border-start border-success border-4">
            <div class="stat-ico" style="background:rgba(65,139,44,0.12); color:var(--theme-green);"><i class="fas fa-user-graduate"></i></div>
            <div>
                <div class="n">{{ $stats['trainings'] }}</div>
                <div class="l">Training & Auditor Certs</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card admin-card stat-card border-start border-info border-4">
            <div class="stat-ico" style="background:rgba(13,202,240,0.15); color:#0dcaf0;"><i class="fas fa-check-circle"></i></div>
            <div>
                <div class="n">{{ $stats['valid_trainings'] }}</div>
                <div class="l">Valid Training Credentials</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card admin-card stat-card border-start border-warning border-4">
            <div class="stat-ico" style="background:rgba(230,162,60,0.15); color:#b8860b;"><i class="fas fa-users"></i></div>
            <div>
                <div class="n">{{ $stats['users'] }}</div>
                <div class="l">Admin Staff</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Recent Training Certificates -->
    <div class="col-lg-7">
        <div class="card admin-card mb-4 shadow-sm">
            <div class="d-flex justify-content-between align-items-center p-4 pb-3 border-bottom">
                <div>
                    <h5 class="fw-bold mb-0 text-navy"><i class="fas fa-user-graduate text-success me-2"></i>Recent Training & Auditor Certificates</h5>
                    <span class="text-muted small">Latest individual course completions & auditor credentials</span>
                </div>
                <a href="{{ route('admin.training-certificates.index') }}" class="text-decoration-none fw-bold small text-success">
                    View All <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Candidate & Cert No</th>
                            <th>Course</th>
                            <th>Category</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentTrainings as $t)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-dark">{{ $t->candidate_name }}</div>
                                <span class="badge bg-light text-primary border font-monospace small">{{ $t->certificate_no }}</span>
                            </td>
                            <td>
                                <div class="small fw-semibold text-navy">{{ $t->course_title }}</div>
                                <div class="text-muted small">{{ $t->standard }}</div>
                            </td>
                            <td>
                                <span class="badge bg-secondary-subtle text-secondary border small">{{ $t->course_category }}</span>
                            </td>
                            <td>
                                @php
                                    $tStatus = strtoupper($t->status);
                                    $tBadge = match($tStatus) {
                                        'VALID' => 'bg-success',
                                        'EXPIRED' => 'bg-warning text-dark',
                                        default => 'bg-danger'
                                    };
                                @endphp
                                <span class="badge {{ $tBadge }} small">{{ $tStatus }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted py-4">No training certificates issued yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Company Certificates -->
        <div class="card admin-card shadow-sm">
            <div class="d-flex justify-content-between align-items-center p-4 pb-3 border-bottom">
                <div>
                    <h5 class="fw-bold mb-0 text-navy"><i class="fas fa-building text-primary me-2"></i>Recent Company Certifications</h5>
                    <span class="text-muted small">Latest ISO corporate audits & certifications</span>
                </div>
                <a href="{{ route('admin.certificates.index') }}" class="text-decoration-none fw-bold small text-primary">
                    View All <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Cert No</th>
                            <th>Company</th>
                            <th>Standard</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentCertificates as $cert)
                        <tr>
                            <td class="ps-4 fw-bold text-primary font-monospace small">{{ $cert->certificate_no }}</td>
                            <td class="fw-semibold">{{ $cert->company_name }}</td>
                            <td><span class="badge bg-light text-dark border">{{ $cert->standard }}</span></td>
                            <td>
                                @if($cert->status === 'Active')
                                    <span class="badge bg-success small">Active</span>
                                @else
                                    <span class="badge bg-danger small">{{ $cert->status }}</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted py-4">No corporate certificates yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Quick actions -->
    <div class="col-lg-5">
        <div class="card admin-card p-4 shadow-sm mb-4">
            <h5 class="fw-bold mb-3 text-navy"><i class="fas fa-bolt text-warning me-2"></i>Quick Actions</h5>
            <div class="d-flex flex-column gap-2">
                <a href="{{ route('admin.training-certificates.create') }}" class="qa-btn">
                    <span class="qa-ico" style="background: rgba(65,139,44,0.15); color: var(--theme-green);"><i class="fas fa-user-graduate"></i></span>
                    <div>
                        <div class="fw-bold">Issue Training Certificate</div>
                        <span class="text-muted small">Register Lead Auditor, Internal Auditor & participants</span>
                    </div>
                </a>
                <a href="{{ route('admin.certificates.create') }}" class="qa-btn">
                    <span class="qa-ico" style="background: rgba(45,86,161,0.15); color: var(--theme-blue);"><i class="fas fa-building"></i></span>
                    <div>
                        <div class="fw-bold">Add Company Certification</div>
                        <span class="text-muted small">Register corporate ISO management systems</span>
                    </div>
                </a>
                <a href="{{ route('verify.training') }}" target="_blank" class="qa-btn">
                    <span class="qa-ico" style="background: rgba(13,202,240,0.15); color: #0dcaf0;"><i class="fas fa-qrcode"></i></span>
                    <div>
                        <div class="fw-bold">Public Training Verification Portal</div>
                        <span class="text-muted small">Test candidate & QR search page</span>
                    </div>
                </a>
                <a href="{{ route('verify') }}" target="_blank" class="qa-btn">
                    <span class="qa-ico" style="background: rgba(108,117,125,0.15); color: #6c757d;"><i class="fas fa-search"></i></span>
                    <div>
                        <div class="fw-bold">Public Company Verification Portal</div>
                        <span class="text-muted small">Test corporate certificate verification</span>
                    </div>
                </a>
            </div>
        </div>

        <div class="card admin-card p-4 shadow-sm bg-light">
            <h6 class="fw-bold text-navy mb-2"><i class="fas fa-shield-halved text-success me-2"></i>S2 Certification Portal Rules</h6>
            <p class="small text-muted mb-2">
                • Every training certificate must have a unique <strong>Certificate No</strong> and <strong>Verification ID</strong>.
            </p>
            <p class="small text-muted mb-2">
                • Any status update (Valid, Expired, Suspended, Revoked) reflects in real-time on public QR searches.
            </p>
            <p class="small text-muted mb-0">
                • Print verification sheets are available directly for verified certificates.
            </p>
        </div>
    </div>
</div>
@endsection
