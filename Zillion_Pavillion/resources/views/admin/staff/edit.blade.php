@extends('admin.layout')

@section('title', 'Edit Staff Member')
@section('page-title', 'Edit Staff Member')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0">Edit Staff Account - {{ $staff->full_name }}</h5>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> Please fix the following errors:
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('admin.staff.update', $staff) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name', $staff->full_name) }}" required>
                        @error('full_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $staff->username) }}" required>
                        <small class="form-text text-muted">Username cannot be changed.</small>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $staff->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password (Leave blank to keep current)</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" minlength="6">
                        <small class="form-text text-muted">Only fill this if you want to change the password (minimum 6 characters).</small>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $staff->phone) }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" class="form-control @error('position') is-invalid @enderror" id="position" name="position" value="{{ old('position', $staff->position) }}" placeholder="e.g., Receptionist, Manager">
                        @error('position')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <input type="text" class="form-control @error('department') is-invalid @enderror" id="department" name="department" value="{{ old('department', $staff->department) }}" placeholder="e.g., Front Desk, Operations">
                        @error('department')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', $staff->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active Account
                            </label>
                        </div>
                    </div>

                    <hr>

                    <div class="row text-muted small mb-3">
                        <div class="col-md-6">
                            <p><strong>Created:</strong> {{ $staff->created_at->format('M d, Y H:i A') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Last Updated:</strong> {{ $staff->updated_at->format('M d, Y H:i A') }}</p>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-check-circle"></i> Update Staff
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
