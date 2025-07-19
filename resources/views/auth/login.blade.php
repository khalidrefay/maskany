@extends('layouts.app')

@section('css')
<style>
    :root {
        --primary-color: #4361ee;
        --primary-hover: #3a56d4;
        --secondary-color: #f8f9fa;
        --text-color: #2b2d42;
        --light-text: #6c757d;
        --border-color: #e9ecef;
        --error-color: #ef233c;
        --success-color: #4cc9f0;
    }

    body {
        background-color: #f8fafc;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        line-height: 1.5;
        color: var(--text-color);
    }

    .auth-container {
        display: flex;
        min-height: 100vh;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }

    .auth-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        width: 100%;
        max-width: 420px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .auth-header {
        padding: 2rem 2rem 1rem;
        text-align: center;
    }

    .auth-logo {
        width: 48px;
        height: 48px;
        margin: 0 auto 1rem;
        display: block;
    }

    .auth-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: var(--text-color);
    }

    .auth-subtitle {
        color: var(--light-text);
        font-size: 0.875rem;
    }

    .auth-tabs {
        display: flex;
        border-bottom: 1px solid var(--border-color);
        margin: 0 2rem;
    }

    .auth-tab {
        flex: 1;
        padding: 0.75rem 1rem;
        text-align: center;
        font-weight: 500;
        color: var(--light-text);
        cursor: pointer;
        position: relative;
        transition: all 0.2s ease;
    }

    .auth-tab.active {
        color: var(--primary-color);
    }

    .auth-tab.active::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        right: 0;
        height: 2px;
        background-color: var(--primary-color);
    }

    .auth-body {
        padding: 1.5rem 2rem 2rem;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--text-color);
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        font-size: 0.9375rem;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
    }

    .form-control.is-invalid {
        border-color: var(--error-color);
    }

    .invalid-feedback {
        display: block;
        margin-top: 0.25rem;
        font-size: 0.75rem;
        color: var(--error-color);
    }

    .form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 1.5rem 0;
        font-size: 0.875rem;
    }

    .remember-me {
        display: flex;
        align-items: center;
    }

    .remember-me input {
        margin-right: 0.5rem;
    }

    .forgot-password {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
    }

    .forgot-password:hover {
        text-decoration: underline;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
    }

    .btn-block {
        display: flex;
        width: 100%;
    }

    .btn-primary {
        background-color: var(--primary-color);
        color: white;
    }

    .btn-primary:hover {
        background-color: var(--primary-hover);
        transform: translateY(-1px);
    }

    .auth-footer {
        text-align: center;
        padding: 1rem 2rem;
        border-top: 1px solid var(--border-color);
        font-size: 0.875rem;
        color: var(--light-text);
    }

    .auth-link {
        color: var(--primary-color);
        font-weight: 500;
        text-decoration: none;
    }

    .auth-link:hover {
        text-decoration: underline;
    }

    /* Animation for form switching */
    .auth-form {
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .auth-form.hidden {
        display: none;
        opacity: 0;
        transform: translateX(20px);
    }

    /* Social login buttons */
    .social-login {
        margin: 1.5rem 0;
    }

    .social-divider {
        display: flex;
        align-items: center;
        margin: 1.5rem 0;
        color: var(--light-text);
        font-size: 0.75rem;
    }

    .social-divider::before,
    .social-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background-color: var(--border-color);
        margin: 0 0.5rem;
    }

    .social-buttons {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
    }

    .social-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        background: white;
        color: var(--text-color);
        font-size: 0.875rem;
        font-weight: 500;
    }

    .social-btn:hover {
        background-color: var(--secondary-color);
    }

    .social-icon {
        width: 18px;
        height: 18px;
        margin-right: 0.5rem;
    }
</style>
@endsection

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <!-- Replace with your logo -->
            <svg class="auth-logo" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm0 22c-5.523 0-10-4.477-10-10S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z" fill="#4361ee"/>
                <path d="M12 6a1 1 0 011 1v6a1 1 0 01-2 0V7a1 1 0 011-1zM12 16a1 1 0 110 2 1 1 0 010-2z" fill="#4361ee"/>
            </svg>
            <h1 class="auth-title">{{ __('messages.auth.login.welcome') }}</h1>
            <p class="auth-subtitle">{{ __('messages.auth.login.subtitle') }}</p>
        </div>

        <div class="auth-tabs">
            <div class="auth-tab active" id="emailTab">{{ __('messages.auth.login.email') }}</div>
            <div class="auth-tab" id="phoneTab">{{ __('messages.auth.login.phone') }}</div>
        </div>

        <div class="auth-body">
            <!-- Email Login Form -->
            <form id="emailForm" class="auth-form" action="{{ route('login') }}" method="POST">
                @csrf
                <input type="hidden" name="login_type" value="email">

                <div class="form-group">
                    <label for="email" class="form-label">{{ __('messages.auth.login.email_label') }}</label>
                    <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           placeholder="{{ __('messages.auth.login.email_placeholder') }}" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">{{ __('messages.auth.login.password_label') }}</label>
                    <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror"
                           placeholder="{{ __('messages.auth.login.password_placeholder') }}" required>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-footer">
                    <div class="remember-me">
                        <input id="remember_me" name="remember" type="checkbox">
                        <label for="remember_me">{{ __('messages.auth.login.remember_me') }}</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="forgot-password">
                        {{ __('messages.auth.login.forgot_password') }}
                    </a>
                </div>

                <button type="submit" class="btn btn-primary btn-block">
                    {{ __('messages.auth.login.sign_in') }}
                </button>
            </form>

            <!-- Phone Login Form -->
            <form id="phoneForm" class="auth-form hidden" action="{{ route('login') }}" method="POST">
                @csrf
                <input type="hidden" name="login_type" value="phone">

                <div class="form-group">
                    <label for="phone" class="form-label">{{ __('messages.auth.login.phone_label') }}</label>
                    <input id="phone" name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror"
                           placeholder="{{ __('messages.auth.login.phone_placeholder') }}" required>
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">{{ __('messages.auth.login.password_label') }}</label>
                    <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror"
                           placeholder="{{ __('messages.auth.login.password_placeholder') }}" required>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary btn-block">
                    {{ __('messages.auth.login.sign_in') }}
                </button>
            </form>

            <!-- Social Login Divider -->
            <div class="social-login">
                <div class="social-divider">
                    {{ __('messages.auth.or_continue_with') }}
                </div>

                <div class="social-buttons">
                    <button type="button" class="social-btn">
                        <svg class="social-icon" viewBox="0 0 24 24" fill="#4285F4">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        Google
                    </button>
                    <button type="button" class="social-btn">
                        <svg class="social-icon" viewBox="0 0 24 24" fill="#1877F2">
                            <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" fill="#1877F2"/>
                        </svg>
                        Facebook
                    </button>
                </div>
            </div>
        </div>

        <div class="auth-footer">
            {{ __('messages.auth.login.no_account') }}
            <a href="{{ route('register') }}" class="auth-link">
                {{ __('messages.auth.login.create_account') }}
            </a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const emailTab = document.getElementById('emailTab');
    const phoneTab = document.getElementById('phoneTab');
    const emailForm = document.getElementById('emailForm');
    const phoneForm = document.getElementById('phoneForm');

    function switchToEmail() {
        emailTab.classList.add('active');
        phoneTab.classList.remove('active');
        emailForm.classList.remove('hidden');
        phoneForm.classList.add('hidden');
    }

    function switchToPhone() {
        phoneTab.classList.add('active');
        emailTab.classList.remove('active');
        phoneForm.classList.remove('hidden');
        emailForm.classList.add('hidden');
    }

    emailTab.addEventListener('click', switchToEmail);
    phoneTab.addEventListener('click', switchToPhone);

    // Initialize with email form
    switchToEmail();
});
</script>
@endsection
