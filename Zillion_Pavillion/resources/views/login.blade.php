<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Login - Zillion Pavillion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="nav-container">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Zillion Pavillion" class="logo-img">
            </div>
            <nav>
                <ul>
                    <li><a href="/">Back to Home</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Login Section -->
    <section id="home">
        <div class="slideshow">
            <div class="slide active" style="background-image: url('{{ asset('images/header1.png') }}');"></div>
        </div>
        <div class="home-content">
            <div class="login-container-wrapper">
                <div class="login-card">
                    <div class="login-header-section">
                        <h1 style="color: #ff3b30; font-size: 2.5rem; font-weight: 700; margin-bottom: 0.5rem;">ZILLION PAVILION</h1>
                        <p style="color: #666; font-size: 0.9rem; letter-spacing: 1px; margin-bottom: 2rem;">FAMILY & BUSINESS HOTEL</p>
                        <h2 style="font-size: 2rem; font-weight: 600; margin-bottom: 0.5rem;">Staff Portal</h2>
                        <p style="color: #666; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 2px;">SIGN IN TO ACCESS THE MANAGEMENT SYSTEM</p>
                    </div>

                    <form action="/login" method="POST" class="login-form">
                        @csrf

                        <div class="form-group-login">
                            <label for="email">EMAIL ADDRESS</label>
                            <div class="input-wrapper">
                                <i class="fas fa-envelope"></i>
                                <input type="email" id="email" name="email" placeholder="EmailNAlexander@yahoo.com" required>
                            </div>
                        </div>

                        <div class="form-group-login">
                            <label for="password">PASSWORD</label>
                            <div class="input-wrapper">
                                <i class="fas fa-lock"></i>
                                <input type="password" id="password" name="password" placeholder="••••••••••" required>
                            </div>
                        </div>

                        <div class="form-options-login">
                            <label class="remember-checkbox">
                                <input type="checkbox" name="remember">
                                <span>Remember me</span>
                            </label>
                            <a href="/forgot-password" class="forgot-link">Forgot Password?</a>
                        </div>

                        <button type="submit" class="login-submit-btn">
                            <i class="fas fa-sign-in-alt"></i> Sign In
                        </button>
                    </form>

                    <div class="secure-notice">
                        <i class="fas fa-shield-alt"></i> Secure login for authorized personnel only
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
