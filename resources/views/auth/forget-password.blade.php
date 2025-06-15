@extends('layouts.app')

@section('css')
<style>
    body {
        margin: 0;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
    }
    .forgot-container {
        min-height: 100vh;
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        background-color: #f0f2f5;
        /* Replace with your actual background image */
        background-image: url('https://example.com/background-login.jpg');
    }
    .forgot-box {
        background-color: rgba(255, 255, 255, 0.9);
        padding: 2rem;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 28rem;
    }
    .forgot-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        text-align: center;
    }
    .form-group {
        margin-bottom: 1rem;
    }
    .form-label {
        display: block;
        margin-bottom: 0.25rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: #344054;
    }
    .form-input {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
    }
    .form-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
    }
    .submit-button {
        width: 100%;
        background-color: #1E90FF;
        color: white;
        padding: 0.75rem;
        border: none;
        border-radius: 0.375rem;
        font-size: 1rem;
        cursor: pointer;
        margin-top: 1rem;
    }
    .submit-button:hover {
        background-color: #1b82e6;
    }
    .back-to-login {
        text-align: center;
        margin-top: 1rem;
        font-size: 0.875rem;
    }
    .back-to-login a {
        color: #3A0CA3;
        text-decoration: none;
    }
    .back-to-login a:hover {
        text-decoration: underline;
    }
</style>
@endsection

@section('content')
<div class="forgot-container">
    <div class="forgot-box">
        <h2 class="forgot-title">{{ __('messages.auth.forgot_password.title') }}</h2>

        <form method="POST" action="{{ route('password.email') }}" class="forgot-form">
            @csrf
            <div class="form-group">
                <label class="form-label">{{ __('messages.auth.forgot_password.email') }}</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="{{ __('messages.auth.forgot_password.email_placeholder') }}" class="form-input @error('email') is-invalid @enderror" required autocomplete="email">
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="submit-button">{{ __('messages.auth.forgot_password.send_reset_link') }}</button>

            <div class="back-to-login">
                <a href="{{ route('login') }}">{{ __('messages.auth.forgot_password.back_to_login') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
