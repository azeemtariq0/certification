@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.users.index') }}" class="text-muted text-decoration-none small">
        <i class="fas fa-arrow-left me-1"></i> Back to List
    </a>
    <h2 class="fw-bold mt-2">Create New User</h2>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card admin-card p-4 p-md-5">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="row g-4">
                    <div class="col-md-12">
                        <label class="form-label fw-bold small">Full Name</label>
                        <input type="text" name="name" class="form-control" placeholder="John Doe" required value="{{ old('name') }}">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold small">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="john@example.com" required value="{{ old('email') }}">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold small">Assign Role</label>
                        <select name="role_id" class="form-select" required>
                            <option value="" disabled selected>Select a role...</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
                    </div>
                    <div class="col-12 pt-3">
                        <button type="submit" class="btn btn-red px-5 py-2">Create User Account</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
