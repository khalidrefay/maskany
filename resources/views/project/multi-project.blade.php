@extends('layouts.app')

@section('css')
<style>
    .active-tab {
        color: #1E90FF;
        position: relative;
    }

    .active-tab::after {
        content: '';
        position: absolute;
        bottom: 0;
        right: 0;
        left: 0;
        height: 2px;
        background-color: #1E90FF;
    }

    .progress-bar {
        height: 4px;
        background-color: #e5e7eb;
        width: 100%;
    }

    .progress-bar-fill {
        height: 100%;
        background-color: #1E90FF;
        transition: width 0.3s ease;
    }

    .file-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .message-bubble {
        max-width: 70%;
    }

    .online-dot {
        width: 12px;
        height: 12px;
        bottom: 0;
        right: 0;
        background-color: #10B981;
        border: 2px solid white;
        border-radius: 50%;
        position: absolute;
    }

    .consultant-rating i {
        color: #F59E0B;
    }

    @media (max-width: 768px) {
        .online-dot {
            width: 10px;
            height: 10px;
        }
    }

    /* RTL Support */
    [dir="rtl"] .text-right {
        text-align: right;
    }
    [dir="rtl"] .text-left {
        text-align: left;
    }
    [dir="rtl"] .ml-4 {
        margin-left: 0;
        margin-right: 1rem;
    }
    [dir="rtl"] .mr-3 {
        margin-right: 0;
        margin-left: 0.75rem;
    }
    [dir="rtl"] .space-x-reverse {
        --tw-space-x-reverse: 1;
    }
</style>
@endsection

@section('content')
<body class="bg-gray-50" dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}">
    <div class="container mx-auto px-4 py-8">
        <!-- Project Management Container -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-8">{{ __('projects.my_projects') }}</h1>

            <!-- Navigation Tabs -->
            <div class="flex flex-col md:flex-row gap-4 md:gap-8 mb-8 border-b border-gray-200">
                <button class="active-tab pb-2 font-bold text-base px-4" data-step="0">
                    {{ __('projects.tabs.overview') }}
                </button>
                <button class="text-gray-500 pb-2 font-bold text-base px-4" data-step="1">
                    {{ __('projects.tabs.offers') }}
                </button>
                <button class="text-gray-500 pb-2 font-bold text-base px-4" data-step="2">
                    {{ __('projects.tabs.documents') }}
                </button>
                <button class="text-gray-500 pb-2 font-bold text-base px-4" data-step="3">
                    {{ __('projects.tabs.conversations') }}
                </button>
            </div>

            <!-- Progress Bar -->
            <div class="progress-bar mb-8 hidden">
                <div class="progress-bar-fill" style="width: 25%"></div>
            </div>

            <!-- Step Content -->
            <div id="step-content">
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative text-center my-4"
                        role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-center my-4"
                        role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Step 0: Overview -->
                <div id="step-0" class="step-panel">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 my-8">
                        @forelse($projects as $projectItem)
                            <div class="bg-white rounded-xl shadow-lg p-5 flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center mb-4">
                                        <img src="{{ $projectItem->user->avatar ?? 'https://randomuser.me/api/portraits/men/32.jpg' }}"
                                            alt="{{ __('projects.user_avatar') }}"
                                            class="w-12 h-12 rounded-full object-cover border-2 border-white shadow">
                                        <div class="mr-3">
                                            <p class="font-bold text-gray-800 text-sm">
                                                {{ $projectItem->user->name ?? __('projects.default_user') }}</p>
                                            <p class="text-xs text-gray-500">{{ __('projects.project_owner') }}</p>
                                        </div>
                                    </div>
                                    <h3 class="text-lg font-semibold text-blue-700 mb-2">
                                        {{ $projectItem->title ?? __('projects.untitled_project') }}</h3>

                                    <!-- Project Details -->
                                    <div class="mb-2"><span class="font-semibold text-gray-700">{{ __('projects.city') }}:</span>
                                        <span class="text-gray-900">{{ $projectItem->city ?? '-' }}</span>
                                    </div>
                                    <div class="mb-2"><span class="font-semibold text-gray-700">{{ __('projects.district') }}:</span>
                                        <span class="text-gray-900">{{ $projectItem->district ?? '-' }}</span>
                                    </div>
                                    <div class="mb-2"><span class="font-semibold text-gray-700">{{ __('projects.land_area') }}:</span>
                                        <span class="text-gray-900">{{ $projectItem->land_area ?? '-' }} m²</span>
                                    </div>
                                    <div class="mb-2"><span class="font-semibold text-gray-700">{{ __('projects.design') }}:</span>
                                        <span class="text-gray-900">{{ $projectItem->design ?? '-' }}</span>
                                    </div>
                                    <div class="mb-2"><span class="font-semibold text-gray-700">{{ __('projects.finishing') }}:</span>
                                        <span class="text-gray-900">{{ $projectItem->finishing ?? '-' }}</span>
                                    </div>
                                    <div class="mb-2"><span class="font-semibold text-gray-700">{{ __('projects.floors') }}:</span>
                                        <span class="text-gray-900">{{ $projectItem->floors ?? '-' }}</span>
                                    </div>
                                    <div class="mb-2"><span class="font-semibold text-gray-700">{{ __('projects.estimated_cost') }}:</span>
                                        <span class="text-blue-700 font-bold">{{ number_format($projectItem->estimate) }}
                                            {{ __('projects.currency') }}</span>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center mt-4">
                                    <span class="text-sm text-gray-600">{{ __('projects.offers_count') }}: {{ $projectItem->offers_count }}</span>
                                    <button class="bg-blue-600 text-white text-sm font-medium rounded-lg px-4 py-2 hover:bg-blue-700 transition duration-200 open-offer-modal-btn"
                                        data-project-id="{{ $projectItem->id }}">
                                        {{ __('projects.submit_offer') }}
                                    </button>
                                    <span class="text-xs text-gray-400">{{ $projectItem->created_at->format('Y-m-d') }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-3 text-center text-gray-500 py-8">
                                {{ __('projects.no_projects') }}
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Offer Modal -->
                <div id="submit-offer-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
                        <form method="POST" action="{{ route('project-offers.store') }}" id="offerForm">
                            @csrf
                            <input type="hidden" name="project_id" id="modal_project_id">
                            <div class="p-6">
                                <h2 class="text-xl font-bold mb-4 text-center text-blue-700">{{ __('projects.offer_modal.title') }}</h2>
                                <div class="mb-3">
                                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">
                                        {{ __('projects.offer_modal.amount') }}
                                    </label>
                                    <input type="number" name="amount" id="amount"
                                        class="form-control w-full border border-gray-300 rounded-md px-3 py-2"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="note" class="block text-sm font-medium text-gray-700 mb-1">
                                        {{ __('projects.offer_modal.notes') }}
                                    </label>
                                    <textarea name="note" id="note" rows="3"
                                        class="form-control w-full border border-gray-300 rounded-md px-3 py-2"></textarea>
                                </div>
                                <div class="flex justify-between mt-6">
                                    <button type="button" id="close-offer-modal"
                                        class="px-4 py-2 bg-gray-200 rounded text-gray-700">{{ __('projects.offer_modal.cancel') }}</button>
                                    <button type="submit"
                                        class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">{{ __('projects.offer_modal.submit') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Step 1: Offers -->
                <div id="step-1" class="step-panel hidden">
                    <div class="space-y-6">
                        {{--  @forelse($offers as $offer)  --}}
                        <div class="bg-white shadow-lg rounded-xl">
                            <div class="flex flex-col lg:grid lg:grid-cols-12">
                                <!-- Consultant Info -->
                                <div class="lg:col-span-3 bg-white p-4 text-center rounded flex flex-col items-center">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg"
                                         alt="{{ __('projects.consultant_avatar') }}"
                                         class="w-16 h-16 rounded-full object-cover mb-2">
                                    <div class="consultant-rating flex justify-center space-x-1 space-x-reverse mb-1">
                                        {{--  @for($i = 0; $i < $offer->rating; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor  --}}
                                    </div>
                                    <div class="text-lg lg:text-xl font-medium text-gray-900 mb-1">
                                        {{  __('projects.default_consultant') }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ __('projects.license') }}:
                                    </div>
                                </div>

                                <!-- Offer Details -->
                                <div class="lg:col-span-7 bg-white p-4 rounded md:pt-5">
                                    <div class="mb-4">
                                        <h4 class="font-bold text-gray-800 mb-2">{{ __('projects.offer_details') }}</h4>
                                        <p class="text-gray-700"></p>
                                    </div>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                                        <!-- Offer File 1 -->
                                        <div class="bg-white border border-blue-500 rounded-lg p-3 text-sm font-semibold flex flex-col justify-between">
                                            <div class="flex gap-2 items-start mb-4">
                                                <i class="fas fa-file-alt mt-1 text-gray-500"></i>
                                                <div>
                                                    <div class="text-gray-700 text-sm font-bold leading-tight">
                                                        {{ __('projects.architectural_plan') }}
                                                    </div>
                                                    <p class="text-gray-500 text-sm font-semibold">2.4 MB</p>
                                                </div>
                                            </div>
                                            <button class="offer-download bg-purple-100 text-blue-600 text-base font-semibold py-2 rounded-lg flex items-center gap-2 justify-center md:mt-6 cursor-pointer">
                                                <span class="text-base font-medium">{{ __('projects.download') }}</span>
                                                <i class="fas fa-download"></i>
                                            </button>
                                        </div>

                                        <!-- Offer File 2 -->
                                        <div class="bg-white border border-blue-500 rounded-lg p-3 text-sm font-semibold flex flex-col justify-between">
                                            <div class="flex gap-2 items-start mb-4">
                                                <i class="fas fa-file-alt mt-1 text-gray-500"></i>
                                                <div>
                                                    <div class="text-gray-700 text-sm font-bold leading-tight">
                                                        {{ __('projects.structural_plan') }}
                                                    </div>
                                                    <p class="text-gray-500 text-sm font-semibold">1.8 MB</p>
                                                </div>
                                            </div>
                                            <button class="offer-download bg-purple-100 text-blue-600 text-base font-semibold py-2 rounded-lg flex items-center gap-2 justify-center md:mt-6 cursor-pointer">
                                                <span class="text-base font-medium">{{ __('projects.download') }}</span>
                                                <i class="fas fa-download"></i>
                                            </button>
                                        </div>

                                        <!-- Offer File 3 -->
                                        <div class="bg-white border border-blue-500 rounded-lg p-3 text-sm font-semibold flex flex-col justify-between">
                                            <div class="flex gap-2 items-start mb-4">
                                                <i class="fas fa-file-alt mt-1 text-gray-500"></i>
                                                <div>
                                                    <div class="text-gray-700 text-sm font-bold leading-tight">
                                                        {{ __('projects.electrical_plan') }}
                                                    </div>
                                                    <p class="text-gray-500 text-sm font-semibold">3.2 MB</p>
                                                </div>
                                            </div>
                                            <button class="offer-download bg-purple-100 text-blue-600 text-base font-semibold py-2 rounded-lg flex items-center gap-2 justify-center md:mt-6 cursor-pointer">
                                                <span class="text-base font-medium">{{ __('projects.download') }}</span>
                                                <i class="fas fa-download"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="lg:col-span-2 flex flex-col gap-3 p-4">
                                    <button class="accept-offer bg-green-600 text-white text-sm lg:text-base font-medium rounded-lg w-full px-4 py-3 cursor-pointer"
                                        data-offer-id="">
                                        {{ __('projects.accept_offer') }}
                                    </button>
                                    <button class="bg-green-100 text-gray-900 text-sm font-medium rounded-lg w-full px-4 py-3 cursor-pointer">
                                        {{ __('projects.contact_consultant') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        {{--  @empty  --}}
                        <div class="bg-white shadow-lg rounded-xl p-6 text-center">
                            <i class="fas fa-inbox text-gray-400 text-5xl mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-700 mb-2">{{ __('projects.no_offers_title') }}</h3>
                            <p class="text-gray-500">{{ __('projects.no_offers_message') }}</p>
                        </div>
                        {{--  @endforelse  --}}
                    </div>
                </div>

                <!-- Step 2: Documents -->
                <div id="step-2" class="step-panel hidden">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 max-w-6xl mx-auto">
                        <!-- Contract 1 -->
                        <div class="flex items-center bg-gray-50 shadow p-4 gap-3 file-card transition duration-200">
                            <i class="fas fa-file-pdf text-red-500 text-2xl"></i>
                            <div class="flex-grow">
                                <p class="font-bold text-gray-800 text-sm">{{ __('projects.initial_agreement') }}</p>
                                <p class="text-xs text-gray-500 text-sm">250 KB</p>
                            </div>
                            <button class="document-download flex items-center gap-2 shadow-sm bg-purple-100 text-blue-600 text-base font-semibold px-3 py-1 rounded-md">
                                {{ __('projects.download') }}
                                <i class="fas fa-download text-sm"></i>
                            </button>
                        </div>

                        <!-- Contract 2 -->
                        <div class="flex items-center bg-gray-50 shadow p-4 gap-3 file-card transition duration-200">
                            <i class="fas fa-file-pdf text-red-500 text-2xl"></i>
                            <div class="flex-grow">
                                <p class="font-bold text-gray-800 text-sm">{{ __('projects.final_contract') }}</p>
                                <p class="text-xs text-gray-500 text-sm">320 KB</p>
                            </div>
                            <button class="document-download flex items-center gap-2 shadow-sm bg-purple-100 text-blue-600 text-base font-semibold px-3 py-1 rounded-md">
                                {{ __('projects.download') }}
                                <i class="fas fa-download text-sm"></i>
                            </button>
                        </div>

                        <!-- Contract 3 -->
                        <div class="flex items-center bg-gray-50 shadow p-4 gap-3 file-card transition duration-200">
                            <i class="fas fa-file-pdf text-red-500 text-2xl"></i>
                            <div class="flex-grow">
                                <p class="font-bold text-gray-800 text-sm">{{ __('projects.payment_schedule') }}</p>
                                <p class="text-xs text-gray-500 text-sm">180 KB</p>
                            </div>
                            <button class="document-download flex items-center gap-2 shadow-sm bg-purple-100 text-blue-600 text-base font-semibold px-3 py-1 rounded-md">
                                {{ __('projects.download') }}
                                <i class="fas fa-download text-sm"></i>
                            </button>
                        </div>

                        <!-- Contract 4 -->
                        <div class="flex items-center bg-gray-50 shadow p-4 gap-3 file-card transition duration-200">
                            <i class="fas fa-file-pdf text-red-500 text-2xl"></i>
                            <div class="flex-grow">
                                <p class="font-bold text-gray-800 text-sm">{{ __('projects.technical_specs') }}</p>
                                <p class="text-xs text-gray-500 text-sm">420 KB</p>
                            </div>
                            <button class="document-download flex items-center gap-2 shadow-sm bg-purple-100 text-blue-600 text-base font-semibold px-3 py-1 rounded-md">
                                {{ __('projects.download') }}
                                <i class="fas fa-download text-sm"></i>
                            </button>
                        </div>

                        <!-- Contract 5 -->
                        <div class="flex items-center bg-gray-50 shadow p-4 gap-3 file-card transition duration-200">
                            <i class="fas fa-file-pdf text-red-500 text-2xl"></i>
                            <div class="flex-grow">
                                <p class="font-bold text-gray-800 text-sm">{{ __('projects.blueprints') }}</p>
                                <p class="text-xs text-gray-500 text-sm">1.2 MB</p>
                            </div>
                            <button class="document-download flex items-center gap-2 shadow-sm bg-purple-100 text-blue-600 text-base font-semibold px-3 py-1 rounded-md">
                                {{ __('projects.download') }}
                                <i class="fas fa-download text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Conversations -->
                <div id="step-3" class="step-panel hidden">
                    {{--  <div class="space-y-3">
                        @forelse($conversations as $conversation)
                        <!-- Message -->
                        <div class="flex items-start rounded-lg p-4 bg-white shadow-sm">
                            <div class="relative ml-4">
                                <img src="{{ $conversation->user->avatar ?? 'https://randomuser.me/api/portraits/men/32.jpg' }}"
                                     alt="{{ __('projects.user_avatar') }}"
                                     class="w-12 aspect-square rounded-full object-cover">
                                <span class="online-dot" title="{{ __('projects.online') }}"></span>
                            </div>
                            <div class="flex flex-col px-3 flex-1">
                                <div class="flex justify-between">
                                    <span class="font-semibold text-xs md:text-sm text-gray-700 break-words max-w-[105px] md:max-w-none">
                                        {{ $conversation->user->name ?? __('projects.default_user') }}
                                    </span>
                                    <span class="text-xs text-gray-500">{{ $conversation->created_at->format('h:i A') }}</span>
                                </div>
                                <div class="relative mt-1">
                                    <div class="text-gray-800 bg-gray-100 text-sm rounded-sm pr-10 pt-2 px-2 pb-2 w-full sm:w-[448px] block">
                                        {{ $conversation->message }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="bg-white shadow-lg rounded-xl p-6 text-center">
                            <i class="fas fa-comments text-gray-400 text-5xl mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-700 mb-2">{{ __('projects.no_messages_title') }}</h3>
                            <p class="text-gray-500">{{ __('projects.no_messages_message') }}</p>
                        </div>
                        @endforelse

                        <!-- New Message Input -->
                        <div class="mt-6 bg-white p-4 rounded-lg shadow">
                            <form id="new-message-form">
                                <div class="flex items-center gap-2">
                                    <textarea class="flex-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                                        rows="2" placeholder="{{ __('projects.message_placeholder') }}" required></textarea>
                                    <button type="submit" class="bg-blue-500 text-white p-3 rounded-lg hover:bg-blue-600">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>  --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="offer-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
            <div class="grid grid-cols-12 gap-4 p-5">
                <div class="col-span-2 flex justify-center">
                    <i class="fas fa-check-circle text-green-500 text-4xl"></i>
                </div>
                <div class="col-span-10 px-2 mt-2 text-right">
                    <h2 class="text-lg font-medium text-gray-900 mb-2">
                        {{ __('projects.success_modal.title') }}
                    </h2>
                    <p class="text-gray-500 font-medium text-sm leading-relaxed mb-4">
                        {{ __('projects.success_modal.message') }}
                    </p>
                    <div class="flex flex-col-reverse md:flex-row items-center justify-end gap-3">
                        <button type="button"
                            class="px-5 py-2 border border-gray-300 rounded-lg text-gray-700 text-sm font-normal w-full md:w-auto"
                            id="close-modal">
                            {{ __('projects.success_modal.close') }}
                        </button>
                        <button type="button"
                            class="px-5 py-2 bg-blue-500 rounded-lg text-white text-sm font-normal w-full md:w-auto">
                            {{ __('projects.success_modal.contact') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab switching functionality
        const tabs = document.querySelectorAll('[data-step]');
        const stepPanels = document.querySelectorAll('.step-panel');

        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const step = this.getAttribute('data-step');

                // Update active tab
                tabs.forEach(t => {
                    t.classList.remove('active-tab');
                    t.classList.add('text-gray-500');
                });
                this.classList.add('active-tab');
                this.classList.remove('text-gray-500');

                // Show corresponding panel
                stepPanels.forEach(panel => panel.classList.add('hidden'));
                document.getElementById(`step-${step}`).classList.remove('hidden');

                // Update progress bar
                const progress = ((parseInt(step) + 1) / tabs.length) * 100;
                document.querySelector('.progress-bar-fill').style.width = `${progress}%`;
            });
        });

        // Offer modal handling
        document.querySelectorAll('.open-offer-modal-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('modal_project_id').value = this.getAttribute('data-project-id');
                document.getElementById('submit-offer-modal').classList.remove('hidden');
            });
        });

        // Close modals
        document.getElementById('close-offer-modal').addEventListener('click', function() {
            document.getElementById('submit-offer-modal').classList.add('hidden');
        });

        document.getElementById('close-modal').addEventListener('click', function() {
            document.getElementById('offer-modal').classList.add('hidden');
        });

        // Close when clicking outside
        document.getElementById('submit-offer-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });

        document.getElementById('offer-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });

        // Accept offer functionality
        document.querySelectorAll('.accept-offer').forEach(btn => {
            btn.addEventListener('click', function() {
                const offerId = this.getAttribute('data-offer-id');
                // Here you would typically make an AJAX call to accept the offer
                document.getElementById('offer-modal').classList.remove('hidden');
            });
        });

        // Download buttons simulation
        document.querySelectorAll('.offer-download, .document-download').forEach(btn => {
            btn.addEventListener('click', function() {
                const originalText = this.innerHTML;
                this.innerHTML = `<i class="fas fa-spinner fa-spin"></i> {{ __('projects.downloading') }}`;

                setTimeout(() => {
                    this.innerHTML = originalText;
                    alert('{{ __('projects.download_complete') }}');
                }, 1500);
            });
        });

        // New message form
        document.getElementById('new-message-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const messageInput = this.querySelector('textarea');
            const message = messageInput.value.trim();

            if(message) {
                // Here you would typically make an AJAX call to send the message
                alert('{{ __('projects.message_sent') }}');
                messageInput.value = '';
            }
        });
    });
</script>
@endsection