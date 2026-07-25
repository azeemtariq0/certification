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

    .qa-btn { display:flex; align-items:center; gap:12px; padding:16px 18px; border-radius:12px; border:1px solid var(--line); text-decoration:none; color:var(--dark-blue); font-family:var(--heading-font); font-weight:600; transition:all .25s ease; background:#fff; }
    .qa-btn:hover { border-color: rgba(65,139,44,0.4); background:#f7fbf5; transform: translateY(-2px); color:var(--dark-blue); }
    .qa-btn .qa-ico { width:42px; height:42px; border-radius:10px; background:rgba(65,139,44,0.12); color:var(--theme-green); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
</style>
@endsection

@section('content')
<!-- Welcome banner -->
<div class="welcome-banner mb-4">
    <div class="row align-items-center position-relative">
        <div class="col-md-8">
            <h3 class="mb-2">Welcome back, {{ auth()->user()->name }} 👋</h3>
            <p class="mb-0" style="opacity:0.8;">Here's an overview of your certification platform today, {{ now()->format('l, d M Y') }}.</p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <a href="{{ route('admin.certificates.create') }}" class="btn btn-theme px-4 py-2"><i class="fas fa-plus me-1"></i> Add Certificate</a>
        </div>
    </div>
</div>

<!-- Stat cards -->
<div class="row g-4 mb-2">
    <div class="col-xl-3 col-md-6">
        <div class="card admin-card stat-card">
            <div class="stat-ico" style="background:rgba(45,86,161,0.12); color:var(--theme-blue);"><i class="fas fa-certificate"></i></div>
            <div><div class="n">{{ $stats['certificates'] }}</div><div class="l">Total Certificates</div></div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card admin-card stat-card">
            <div class="stat-ico" style="background:rgba(65,139,44,0.12); color:var(--theme-green);"><i class="fas fa-circle-check"></i></div>
            <div><div class="n">{{ $stats['active_certificates'] }}</div><div class="l">Active / Valid</div></div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card admin-card stat-card">
            <div class="stat-ico" style="background:rgba(192,57,43,0.12); color:#c0392b;"><i class="fas fa-circle-xmark"></i></div>
            <div><div class="n">{{ $stats['inactive_certificates'] }}</div><div class="l">Inactive / Expired</div></div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card admin-card stat-card">
            <div class="stat-ico" style="background:rgba(230,162,60,0.15); color:#b8860b;"><i class="fas fa-users"></i></div>
            <div><div class="n">{{ $stats['users'] }}</div><div class="l">Admin Users</div></div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent certificates -->
    <div class="col-lg-8">
        <div class="card admin-card">
            <div class="d-flex justify-content-between align-items-center p-4 pb-3">
                <h5 class="fw-bold mb-0" style="color:var(--dark-blue);">Recent Certificates</h5>
                <a href="{{ route('admin.certificates.index') }}" class="text-decoration-none fw-bold small" style="color:var(--theme-green);">View All <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
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
                            <td class="ps-4 fw-bold" style="color:var(--theme-blue);">{{ $cert->certificate_no }}</td>
                            <td>{{ $cert->company_name }}</td>
                            <td>{{ $cert->standard }}</td>
                            <td>
                                @if($cert->status === 'Active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">{{ $cert->status }}</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted py-5">No certificates yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Quick actions -->
    <div class="col-lg-4">
        <div class="card admin-card p-4">
            <h5 class="fw-bold mb-3" style="color:var(--dark-blue);">Quick Actions</h5>
            <div class="d-flex flex-column gap-3">
                <a href="{{ route('admin.certificates.create') }}" class="qa-btn">
                    <span class="qa-ico"><i class="fas fa-plus"></i></span> Add New Certificate
                </a>
                <a href="{{ route('admin.certificates.index') }}" class="qa-btn">
                    <span class="qa-ico"><i class="fas fa-list"></i></span> Manage Certificates
                </a>
                @if(auth()->user()->hasPermission('manage-users'))
                <a href="{{ route('admin.users.index') }}" class="qa-btn">
                    <span class="qa-ico"><i class="fas fa-user-gear"></i></span> Manage Users
                </a>
                @endif
                <a href="{{ route('verify') }}" target="_blank" class="qa-btn">
                    <span class="qa-ico"><i class="fas fa-magnifying-glass"></i></span> Verify Certificate
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
