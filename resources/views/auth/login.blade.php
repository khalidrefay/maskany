@extends('layouts.app')

@section('css')
<style>
    body {
        margin: 0;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
    }
    .login-container {
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
    .login-box {
        background-color: rgba(255, 255, 255, 0.9);
        padding: 1.5rem;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 28rem;
    }
    .login-header {
        margin-bottom: 1.5rem;
        text-align: center;
    }
    .login-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    .login-subtitle {
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
    .remember-forgot {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        font-size: 0.875rem;
    }
    .remember-me {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .forgot-password {
        color: #3A0CA3;
        text-decoration: none;
    }
    .forgot-password:hover {
        text-decoration: underline;
    }
    .login-button {
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
    .login-button:hover {
        background-color: #1b82e6;
    }
    .register-prompt {
        text-align: center;
        font-size: 0.875rem;
    }
    .register-link {
        color: #3A0CA3;
        text-decoration: none;
        font-weight: 500;
    }
    .register-link:hover {
        text-decoration: underline;
    }
    .login-type-toggle {
        display: flex;
        gap: 1rem;
        margin-bottom: 1rem;
    }
    .login-type-option {
        flex: 1;
        text-align: center;
        padding: 0.5rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        cursor: pointer;
        font-size: 0.875rem;
        color: #667085;
    }
    .login-type-option.active {
        background-color: #1E90FF;
        color: white;
        border-color: #1E90FF;
    }
</style>
@endsection

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                {{ __('messages.auth.login.welcome') }}
            </h2>
        </div>

        <!-- Login Tabs -->
        <div class="flex border-b border-gray-200">
            <button id="emailTab" class="flex-1 py-2 px-4 text-center text-sm font-medium text-blue-600 border-b-2 border-blue-600">
                {{ __('messages.auth.login.email') }}
            </button>
            <button id="phoneTab" class="flex-1 py-2 px-4 text-center text-sm font-medium text-gray-500 hover:text-gray-700">
                {{ __('messages.auth.login.phone') }}
            </button>
        </div>

        <!-- Email Login Form -->
        <form id="emailForm" class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
            @csrf
            <input type="hidden" name="login_type" value="email">
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="email" class="sr-only">{{ __('messages.auth.login.email_label') }}</label>
                    <input id="email" name="email" type="email" required
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                           placeholder="{{ __('messages.auth.login.email_placeholder') }}">
                </div>
                <div>
                    <label for="password" class="sr-only">{{ __('messages.auth.login.password_label') }}</label>
                    <input id="password" name="password" type="password" required
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                           placeholder="{{ __('messages.auth.login.password_placeholder') }}">
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox"
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                        {{ __('messages.auth.login.remember_me') }}
                    </label>
                </div>

                {{--  <div class="text-sm">
                    <a href="{{ route('password.request') }}" class="font-medium text-blue-600 hover:text-blue-500">
                        {{ __('messages.auth.login.forgot_password') }}
                    </a>
                </div>  --}}
            </div>

            <div>
                <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    {{ __('messages.auth.login.sign_in') }}
                </button>
            </div>
        </form>

        <!-- Phone Login Form -->
        <form id="phoneForm" class="mt-8 space-y-6 hidden" action="{{ route('login') }}" method="POST">
            @csrf
            <input type="hidden" name="login_type" value="phone">
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="phone" class="sr-only">{{ __('messages.auth.login.phone_label') }}</label>
                    <input id="phone" name="phone" type="tel" required
                           class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                           placeholder="{{ __('messages.auth.login.phone_placeholder') }}">
                </div>
            </div>

            <div>
                <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    {{ __('messages.auth.login.sign_in') }}
                </button>
            </div>
        </form>

        <div class="text-center">
            <p class="text-sm text-gray-600">
                {{ __('messages.auth.login.no_account') }}
                <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500">
                    {{ __('messages.auth.login.create_account') }}
                </a>
            </p>
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
        emailTab.classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
        emailTab.classList.remove('text-gray-500');
        phoneTab.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
        phoneTab.classList.add('text-gray-500');
        emailForm.classList.remove('hidden');
        phoneForm.classList.add('hidden');
    }

    function switchToPhone() {
        phoneTab.classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
        phoneTab.classList.remove('text-gray-500');
        emailTab.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
        emailTab.classList.add('text-gray-500');
        phoneForm.classList.remove('hidden');
        emailForm.classList.add('hidden');
    }

    emailTab.addEventListener('click', switchToEmail);
    phoneTab.addEventListener('click', switchToPhone);
});
</script>
@endsection
