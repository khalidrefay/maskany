@extends('layouts.app')

@section('css')
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }
        .register-container {
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
        .register-box {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 28rem;
        }
    .register-header {
        margin-bottom: 1.5rem;
        text-align: center;
    }
        .register-title {
            font-size: 1.5rem;
            font-weight: 700;
        margin-bottom: 0.5rem;
    }
    .register-subtitle {
        color: #667085;
        font-size: 0.875rem;
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
    .error-message {
        color: #ef4444;
            font-size: 0.875rem;
        }
        .register-button {
            width: 100%;
            background-color: #1E90FF;
            color: white;
            padding: 0.75rem;
            border: none;
            border-radius: 0.375rem;
            font-size: 1rem;
            cursor: pointer;
            margin-bottom: 1rem;
        }
        .register-button:hover {
            background-color: #1b82e6;
        }
        .login-prompt {
            text-align: center;
            font-size: 0.875rem;
        }
        .login-link {
            color: #3A0CA3;
            font-weight: 500;
            cursor: pointer;
        }
        .login-link:hover {
            text-decoration: underline;
        }
    .role-select {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        background-color: white;
    }
    .role-select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
    }
    .name-group {
        display: flex;
        gap: 1rem;
    }
    .name-group .form-group {
        flex: 1;
    }
    .phone-group {
        display: flex;
        gap: 0.5rem;
    }
    .phone-group .form-group {
        flex: 1;
    }
    .phone-prefix {
        width: 80px;
    }
    </style>
@endsection

@section('content')
    <div class="register-container">
        <div class="register-box">
        <div class="register-header">
            <h2 class="register-title">{{ __('messages.auth.register.title') }}</h2>
            <p class="register-subtitle">{{ __('messages.auth.register.subtitle') }}</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="register-form">
            @csrf
            <div class="name-group">
                <div class="form-group">
                    <label class="form-label">{{ __('messages.auth.register.first_name') }}</label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="{{ __('messages.auth.register.first_name_placeholder') }}" class="form-input @error('first_name') is-invalid @enderror" required autocomplete="given-name">
                    @error('first_name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">{{ __('messages.auth.register.last_name') }}</label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="{{ __('messages.auth.register.last_name_placeholder') }}" class="form-input @error('last_name') is-invalid @enderror" required autocomplete="family-name">
                    @error('last_name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                </div>

                <div class="form-group">
                <label class="form-label">{{ __('messages.auth.register.email') }}</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="{{ __('messages.auth.register.email_placeholder') }}" class="form-input @error('email') is-invalid @enderror" required autocomplete="email">
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
                </div>

            <div class="phone-group">
                <div class="form-group">
                    <label class="form-label">{{ __('messages.auth.register.phone') }}</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="{{ __('messages.auth.register.phone_placeholder') }}" class="form-input @error('phone') is-invalid @enderror" required autocomplete="tel">
                    @error('phone')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">{{ __('messages.auth.register.password') }}</label>
                <input type="password" name="password" placeholder="{{ __('messages.auth.register.password_placeholder') }}" class="form-input @error('password') is-invalid @enderror" required autocomplete="new-password">
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">{{ __('messages.auth.register.confirm_password') }}</label>
                <input type="password" name="password_confirmation" placeholder="{{ __('messages.auth.register.confirm_password_placeholder') }}" class="form-input" required autocomplete="new-password">
                </div>

            <div class="form-group">
                <label class="form-label">{{ __('messages.auth.register.role') }}</label>
                <select name="role" class="role-select @error('role') is-invalid @enderror" required>
                    <option value="">{{ __('messages.auth.register.select_role') }}</option>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>{{ __('messages.auth.register.roles.user') }}</option>
                    <option value="consultant" {{ old('role') == 'consultant' ? 'selected' : '' }}>{{ __('messages.auth.register.roles.consultant') }}</option>
                    <option value="contractor" {{ old('role') == 'contractor' ? 'selected' : '' }}>{{ __('messages.auth.register.roles.contractor') }}</option>
                </select>
                @error('role')
                    <span class="error-message">{{ $message }}</span>
                @enderror
                </div>

            <button type="submit" class="register-button">{{ __('messages.auth.register.create_account') }}</button>

                <p class="login-prompt">
                {{ __('messages.auth.register.have_account') }} <a href="{{ route('login') }}" class="login-link">{{ __('messages.auth.register.login_now') }}</a>
                </p>
            </form>
        </div>
    </div>
@endsection
