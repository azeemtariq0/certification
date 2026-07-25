@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.users.index') }}" class="text-muted text-decoration-none small">
        <i class="fas fa-arrow-left me-1"></i> Back to List
    </a>
    <h2 class="page-heading mt-2">Edit User: {{ $user->name }}</h2>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card admin-card p-4 p-md-5">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-4">
                    <div class="col-md-12">
                        <label class="form-label fw-bold small">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold small">Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold small">Assign Role</label>
                        <select name="role_id" class="form-select" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <div class="alert alert-info py-2 small mb-0">
                            Leave password fields empty if you don't want to change it.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small">New Password</label>
                        <input type="password" name="password" class="form-control" placeholder="••••••••">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••">
                    </div>
                    <div class="col-12 pt-3">
                        <button type="submit" class="btn btn-red px-5 py-2">Update User Account</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
