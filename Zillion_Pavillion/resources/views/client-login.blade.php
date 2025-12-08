@extends('layouts.app')

@section('title', 'Client Login - Zillion Pavillion')

@section('content')
<style>
    .login-section {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 60px 20px;
        background: linear-gradient(135deg, rgba(255, 59, 48, 0.05) 0%, rgba(255, 255, 255, 1) 100%);
    }

    .login-container {
        max-width: 450px;
        width: 100%;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .login-header {
        background: linear-gradient(135deg, #ff3b30 0%, #e62e24 100%);
        color: #fff;
        padding: 40px 30px;
        text-align: center;
    }

    .login-header h2 {
        margin: 0 0 10px 0;
        font-size: 2rem;
        font-weight: 700;
    }

    .login-header p {
        margin: 0;
        opacity: 0.95;
    }

    .login-body {
        padding: 40px 30px;
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
        border: 2px solid #dee2e6;
        border-radius: 5px;
        font-size: 1rem;
        transition: all 0.3s;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .form-control:focus {
        outline: none;
        border-color: #ff3b30;
        box-shadow: 0 0 0 3px rgba(255, 59, 48, 0.1);
    }

    .remember-me {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 15px 0;
    }

    .remember-me input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }

    .remember-me label {
        margin: 0;
        color: #7f8c8d;
        cursor: pointer;
    }

    .btn-login {
        width: 100%;
        padding: 15px;
        background: #ff3b30;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-login:hover {
        background: #e62e24;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 59, 48, 0.3);
    }

    .alert {
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .alert-danger {
        background: #f8d7da;
        color: #721c24;
        border-left: 4px solid #dc3545;
    }

    .form-footer {
        text-align: center;
        margin-top: 25px;
        padding-top: 25px;
        border-top: 1px solid #dee2e6;
        color: #7f8c8d;
    }

    .form-footer a {
        color: #ff3b30;
        text-decoration: none;
        font-weight: 600;
    }

    .form-footer a:hover {
        text-decoration: underline;
    }
</style>

<section class="login-section">
    <div class="login-container">
        <div class="login-header">
            <h2><i class="fas fa-user-circle"></i> Client Login</h2>
            <p>Access your bookings and account</p>
        </div>

        <div class="login-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('client.login.submit') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="username">Username or Email</label>
                    <input type="text" name="username" id="username" class="form-control" 
                           value="{{ old('username') }}" placeholder="Enter your username or email" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" 
                           placeholder="Enter your password" required>
                </div>

                <div class="remember-me">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember me</label>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>

                <div class="form-footer">
                    Don't have an account? <a href="{{ route('register') }}">Register here</a>
                    <br><br>
                    <a href="{{ route('home') }}">← Back to Home</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
