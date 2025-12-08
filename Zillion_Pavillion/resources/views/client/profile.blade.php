@extends('client.layout')

@section('title', 'My Profile')
@section('page-title', 'My Profile')
@section('page-subtitle', 'Manage your account settings')

@push('styles')
<style>
    .profile-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
        padding: 30px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        border-radius: 12px;
        color: #fff;
    }

    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: var(--primary-color);
        font-weight: 700;
    }

    .profile-info h2 {
        margin: 0 0 5px 0;
        font-size: 1.8rem;
    }

    .profile-info p {
        margin: 0;
        opacity: 0.9;
    }

    .form-section {
        margin-bottom: 30px;
    }

    .form-section h3 {
        margin: 0 0 20px 0;
        color: #2c3e50;
        padding-bottom: 15px;
        border-bottom: 2px solid #f8f9fa;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #2c3e50;
        font-weight: 500;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        font-size: 1rem;
        transition: all 0.3s;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(255, 59, 48, 0.1);
    }

    .form-control:disabled {
        background: #f8f9fa;
        cursor: not-allowed;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }
</style>
@endpush

@section('content')
<div class="card">
    <div class="profile-header">
        <div class="profile-avatar">
            {{ strtoupper(substr(auth()->guard('web')->user()->full_name, 0, 1)) }}
        </div>
        <div class="profile-info">
            <h2>{{ auth()->guard('web')->user()->full_name }}</h2>
            <p><i class="fas fa-envelope"></i> {{ auth()->guard('web')->user()->email }}</p>
            <p><i class="fas fa-user"></i> Member since {{ auth()->guard('web')->user()->created_at->format('F Y') }}</p>
        </div>
    </div>

    <form action="{{ route('client.profile.update') }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form-section">
            <h3><i class="fas fa-user-circle"></i> Personal Information</h3>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" name="full_name" id="full_name" class="form-control" 
                           value="{{ old('full_name', auth()->guard('web')->user()->full_name) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" class="form-control" 
                           value="{{ old('email', auth()->guard('web')->user()->email) }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" id="phone" class="form-control" 
                           value="{{ old('phone', auth()->guard('web')->user()->phone) }}">
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" class="form-control" 
                           value="{{ auth()->guard('web')->user()->username }}" disabled>
                    <small style="color: #7f8c8d; display: block; margin-top: 5px;">Username cannot be changed</small>
                </div>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea name="address" id="address" class="form-control" rows="3">{{ old('address', auth()->guard('web')->user()->address) }}</textarea>
            </div>
        </div>

        <div class="form-section">
            <h3><i class="fas fa-lock"></i> Change Password</h3>
            <p style="color: #7f8c8d; margin-bottom: 20px;">Leave blank if you don't want to change your password</p>

            <div class="form-row">
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" name="current_password" id="current_password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" name="new_password" id="new_password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="new_password_confirmation">Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control">
                </div>
            </div>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Changes
            </button>
            <a href="{{ route('client.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancel
            </a>
        </div>
    </form>
</div>
@endsection
