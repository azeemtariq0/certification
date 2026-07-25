@extends('layouts.admin')

@section('title', 'Certificates')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="page-heading mb-0">Manage Certificates</h2>
        <p class="text-muted small mb-0">Create, edit and manage issued certificates.</p>
    </div>
    <a href="{{ route('admin.certificates.create') }}" class="btn btn-theme px-3 py-2">
        <i class="fas fa-plus me-1"></i> Add New
    </a>
</div>

<div class="card admin-card overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4">Cert No</th>
                    <th>Company Name</th>
                    <th>Standard</th>
                    <th>Expiry</th>
                    <th>Status</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($certificates as $cert)
                <tr>
                    <td class="ps-4 fw-bold text-primary">{{ $cert->certificate_no }}</td>
                    <td>{{ $cert->company_name }}</td>
                    <td>{{ $cert->standard }}</td>
                    <td>{{ $cert->expiry_date }}</td>
                    <td>
                        @if($cert->status === 'Active')
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">{{ $cert->status }}</span>
                        @endif
                    </td>
                    <td class="text-end pe-4">
                        <div class="btn-group">
                            <a href="{{ route('admin.certificates.edit', $cert->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.certificates.destroy', $cert->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger ms-1">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">No certificates found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4 border-top">
        {{ $certificates->links() }}
    </div>
</div>
@endsection
