@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Roles & Permissions</h2>
    <a href="{{ route('admin.roles.create') }}" class="btn btn-red">
        <i class="fas fa-plus me-1"></i> Add New Role
    </a>
</div>

<div class="row g-4">
    @foreach($roles as $role)
    <div class="col-md-6 col-lg-4">
        <div class="card admin-card h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="fw-bold mb-0 text-primary">{{ $role->name }}</h5>
                    <div class="dropdown">
                        <button class="btn btn-link btn-sm text-muted p-0" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('admin.roles.edit', $role->id) }}">Edit Role</a></li>
                            @if($role->slug !== 'admin')
                            <li>
                                <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Delete this role?')">Delete Role</button>
                                </form>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                
                <h6 class="small fw-bold text-muted mb-3 text-uppercase">Permissions:</h6>
                <div class="d-flex flex-wrap gap-1">
                    @forelse($role->permissions as $permission)
                        <span class="badge bg-light text-dark border">{{ $permission->name }}</span>
                    @empty
                        <span class="text-muted small italic text-center w-100">No permissions assigned.</span>
                    @endforelse
                </div>
            </div>
            <div class="card-footer bg-white border-top-0 p-4 pt-0">
                <small class="text-muted"><i class="fas fa-users me-1"></i> {{ $role->users()->count() }} Users Assigned</small>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
