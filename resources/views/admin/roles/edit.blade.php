@extends('layouts.admin')

@section('title', 'Edit Role')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.roles.index') }}" class="text-muted text-decoration-none small">
        <i class="fas fa-arrow-left me-1"></i> Back to Roles
    </a>
    <h2 class="page-heading mt-2">Edit Role: {{ $role->name }}</h2>
</div>

<div class="row">
    <div class="col-lg-10">
        <div class="card admin-card p-4 p-md-5">
            <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-4 text-start">
                    <div class="col-md-6">
                        <label class="form-label fw-bold small">Role Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $role->name) }}" required {{ $role->slug === 'admin' ? 'readonly' : '' }}>
                    </div>
                </div>

                <div class="mt-5">
                    <h5 class="fw-bold mb-4">Update Permissions</h5>
                    <div class="row g-3">
                        @foreach($permissions as $permission)
                        <div class="col-md-4">
                            <div class="p-3 border rounded">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="perm{{ $permission->id }}" {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} {{ $role->slug === 'admin' ? 'checked disabled' : '' }}>
                                    <label class="form-check-label fw-bold" for="perm{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                    <p class="small text-muted mb-0 opacity-75">Control visibility of {{ $permission->slug }} screen.</p>
                                    @if($role->slug === 'admin')
                                        <input type="hidden" name="permissions[]" value="{{ $permission->id }}">
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-12 pt-5">
                    <button type="submit" class="btn btn-red px-5 py-2">Update Role & Permissions</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
