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
    .min-w-[160px] { min-width: 160px; }
    .min-w-[140px] { min-width: 140px; }
    .min-w-[180px] { min-width: 180px; }
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
                                    @if(auth()->user()->role == 'consultant' && !$projectItem->proposals->where('consultant_id', auth()->id())->count())
                                    <button class="bg-blue-600 text-white text-sm font-medium rounded-lg px-4 py-2 hover:bg-blue-700 transition duration-200 open-offer-modal-btn"
                                        data-project-id="{{ $projectItem->id }}">
                                        {{ __('projects.submit_offer') }}
                                    </button>
                                    @endif
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
                        @foreach($projects as $projectItem)
                            @if(auth()->id() == $projectItem->user_id)
                            @foreach($projectItem->proposals as $proposal)
                                    <div class="flex flex-row-reverse gap-4 items-stretch bg-white shadow-lg rounded-xl mb-4 p-4 border">
                                        <!-- بيانات الاستشاري -->
                                        <div class="flex flex-col items-center justify-center min-w-[180px] border-l pl-4">
                                            <img src="{{ $proposal->consultant->image ? asset('storage/' . $proposal->consultant->image) : 'https://randomuser.me/api/portraits/men/32.jpg' }}" alt="صورة الاستشاري" class="w-14 h-14 rounded-full object-cover mb-2">
                                            <div class="font-bold text-base mb-1">{{ $proposal->consultant->first_name }} {{ $proposal->consultant->last_name }}</div>
                                            <div class="text-xs text-gray-500 mb-1">الحمد للاستشارات الهندسية</div>
                                            <div class="text-xs text-gray-400 mb-1">رقم الترخيص: 8797415</div>
                                            <div class="flex items-center mt-1">
                                                <span class="text-yellow-400 mr-1">
                                                    @for($i = 0; $i < 5; $i++)
                                                        <i class="fas fa-star"></i>
                                                    @endfor
                                                </span>
                                            </div>
                                        </div>
                                        <!-- بطاقات الملفات -->
                                        <div class="flex flex-1 gap-3 flex-wrap items-center justify-center">
                                            @php
                                                $files = [
                                                    ['label' => 'مخطط البناء', 'file' => $proposal->design_plans[0] ?? null, 'size' => '500 KB'],
                                                    ['label' => 'العرض الفني', 'file' => $proposal->design_plans[1] ?? null, 'size' => '300 KB'],
                                                    ['label' => 'الكلفة التقديرية للمشروع', 'file' => $proposal->materials_list ?? null, 'size' => '200 KB'],
                                                ];
                                            @endphp
                                            @foreach($files as $f)
                                                <div class="border rounded-lg p-3 text-center min-w-[160px] bg-white shadow-sm flex flex-col items-center">
                                                    <div class="font-bold mb-1">{{ $f['label'] }}</div>
                                                    <div class="text-xs text-gray-500 mb-2">{{ $f['size'] }}</div>
                                                    @if($f['file'] && (auth()->id() == $projectItem->user_id || (auth()->user()->role == 'contractor' && $projectItem->contractor_id == auth()->id() && $proposal->status == 'accepted')))
                                                        <a href="{{ asset('storage/' . $f['file']) }}" class="text-blue-600 flex items-center gap-1 border border-blue-100 rounded px-3 py-1 hover:bg-blue-50 transition" download>
                                                            <i class="fas fa-download"></i> تنزيل
                                                        </a>
                                                    @else
                                                        <span class="text-gray-400">غير متاح</span>
                                            @endif
                                                </div>
                                            @endforeach
                                        </div>
                                        <!-- أزرار القبول والتواصل -->
                                        <div class="flex flex-col gap-2 min-w-[140px] items-center justify-center border-r pr-4">
                                            <button class="bg-green-500 text-white rounded px-4 py-2 font-bold hover:bg-green-600 transition mb-2">قبول العرض</button>
                                            <a href="mailto:{{ $proposal->consultant->email }}" class="bg-white border border-green-200 text-green-700 rounded px-4 py-2 font-bold text-center hover:bg-green-50 transition">تواصل مع الاستشاري</a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            @endforeach
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
