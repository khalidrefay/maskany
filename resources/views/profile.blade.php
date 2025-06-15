@extends('layouts.app')

@section('css')
<style>
    body {
        font-family: 'Inter', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f8f9fa;
        color: #495057;
    }

    .container {
        min-height: 100vh;
        padding-top: 10rem;
        padding-left: 1rem;
        padding-right: 1rem;
    }

    @media (min-width: 768px) {
        .container {
            padding-top: 12rem;
            padding-left: 2.5rem;
            padding-right: 2.5rem;
        }
    }

    @media (min-width: 1024px) {
        .container {
            margin-left: 15%;
            margin-right: 15%;
        }
    }

    .title {
        font-size: 2rem;
        font-weight: 700;
        color: #3A0CA3;
        margin-bottom: 2.5rem;
    }

    .avatar {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
    }

    @media (min-width: 768px) {
        .avatar {
            margin-left: 0;
        }
    }

    .form-container {
        width: 100%;
        margin-top: 2.5rem;
    }

    .form-row {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    @media (min-width: 768px) {
        .form-row {
            flex-direction: row;
            justify-content: space-between;
        }
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        flex: 1;
    }

    label {
        font-weight: 500;
    }

    input {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ced4da;
        border-radius: 6px;
        font-size: 1rem;
    }

    input:focus {
        outline: none;
        border-color: #3A0CA3;
        box-shadow: 0 0 0 0.2rem rgba(58, 12, 163, 0.25);
    }

    .section-title {
        font-weight: 700;
        font-size: 2rem;
        margin-top: 2.5rem;
    }

    .payment-title {
        font-weight: 700;
        color: #3A0CA3;
        margin-top: 1rem;
    }

    .payment-cards {
        max-width: 100%;
        height: auto;
        margin-top: 1rem;
    }

    .add-button {
        background-color: #3A0CA3;
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .add-button:hover {
        background-color: #2a0877;
    }

    .space-y-10 > * + * {
        margin-top: 2.5rem;
    }

    .my-10 {
        margin-top: 2.5rem;
        margin-bottom: 2.5rem;
    }

    .w-1\/3 {
        width: 33.333333%;
    }
</style>
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">{{ __('messages.profile.title') }}</h1>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center space-x-4 mb-6">
            <img src="{{ asset('images/avatar.png') }}" alt="{{ __('messages.profile.avatar_alt') }}" class="w-20 h-20 rounded-full">
            <div>
                <h2 class="text-xl font-semibold">{{ auth()->user()->name }}</h2>
                <p class="text-gray-600">{{ auth()->user()->email }}</p>
            </div>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">{{ __('messages.profile.address') }}</label>
                <input type="text" name="address" id="address" value="{{ old('address', auth()->user()->address) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">{{ __('messages.profile.phone') }}</label>
                <input type="tel" name="phone" id="phone" value="{{ old('phone', auth()->user()->phone) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">{{ __('messages.profile.username') }}</label>
                <input type="text" name="username" id="username" value="{{ old('username', auth()->user()->username) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">{{ __('messages.profile.email') }}</label>
                <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    {{ __('messages.profile.save') }}
                </button>
            </div>
        </form>
    </div>

    <div class="mt-8 bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4">{{ __('messages.profile.payment_info') }}</h2>

        <div class="mb-6">
            <h3 class="text-lg font-medium mb-2">{{ __('messages.profile.main_payment_methods') }}</h3>
            <img src="{{ asset('images/payment-cards.png') }}" alt="{{ __('messages.profile.payment_cards_alt') }}" class="h-8">
        </div>

        <button class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
            {{ __('messages.profile.add_payment_method') }}
        </button>
    </div>
</div>
@endsection
