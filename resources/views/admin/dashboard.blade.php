@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Dashboard Overview</h2>
    <div class="text-muted">Welcome back, {{ auth()->user()->name }}</div>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card admin-card p-4">
            <div class="d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded me-3">
                    <i class="fas fa-certificate fa-2x"></i>
                </div>
                <div>
                    <h5 class="text-muted small mb-0">Total Certificates</h5>
                    <h3 class="fw-bold mb-0">{{ $stats['certificates'] }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card admin-card p-4">
            <div class="d-flex align-items-center">
                <div class="bg-success bg-opacity-10 text-success p-3 rounded me-3">
                    <i class="fas fa-check-circle fa-2x"></i>
                </div>
                <div>
                    <h5 class="text-muted small mb-0">Active / Valid</h5>
                    <h3 class="fw-bold mb-0">{{ $stats['active_certificates'] }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card admin-card p-4">
            <div class="d-flex align-items-center">
                <div class="bg-info bg-opacity-10 text-info p-3 rounded me-3">
                    <i class="fas fa-users fa-2x"></i>
                </div>
                <div>
                    <h5 class="text-muted small mb-0">Admin Users</h5>
                    <h3 class="fw-bold mb-0">{{ $stats['users'] }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card admin-card p-4">
            <h5 class="fw-bold mb-4">Quick Actions</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.certificates.create') }}" class="btn btn-red">
                    <i class="fas fa-plus me-1"></i> Add New Certificate
                </a>
                <a href="{{ route('admin.certificates.index') }}" class="btn btn-outline-dark">
                    <i class="fas fa-list me-1"></i> View All Records
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
