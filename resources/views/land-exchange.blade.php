@extends('layouts.app')

@section('css')
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-light: #6366f1;
            --secondary-color: #6b7280;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --light-bg: #f9fafb;
            --border-color: #e5e7eb;
        }

        body {
            font-family: 'Tajawal', 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
        }

        /* Header Styles */
        .land-exchange-header {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            color: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        /* Tab Navigation */
        .nav-tabs-container {
            border-bottom: 2px solid var(--border-color);
            margin-bottom: 1.5rem;
        }

        .nav-tab {
            position: relative;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            color: var(--secondary-color);
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            background: none;
        }

        .nav-tab:hover {
            color: var(--primary-color);
        }

        .nav-tab.active {
            color: var(--primary-color);
        }

        .nav-tab.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 3px;
            background-color: var(--primary-color);
            border-radius: 3px 3px 0 0;
        }

        /* Form Styles */
        .form-card {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control {
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }

        /* Upload Area */
        .upload-area {
            border: 2px dashed var(--border-color);
            border-radius: 0.75rem;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background-color: var(--light-bg);
        }

        .upload-area:hover {
            border-color: var(--primary-light);
            background-color: rgba(99, 102, 241, 0.05);
        }

        .upload-icon {
            font-size: 2.5rem;
            color: var(--secondary-color);
            margin-bottom: 1rem;
        }

        /* Property Cards */
        .property-card {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .property-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .property-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .property-details {
            padding: 1.25rem;
        }

        .property-title {
            font-weight: 700;
            color: #111827;
            margin-bottom: 0.5rem;
        }

        .property-location {
            color: var(--secondary-color);
            font-size: 0.875rem;
            margin-bottom: 0.75rem;
        }

        .property-price {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.125rem;
        }

        /* Buttons */
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-light);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .nav-tabs-container {
                overflow-x: auto;
                white-space: nowrap;
                padding-bottom: 0.5rem;
            }

            .nav-tab {
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
            }
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--secondary-color);
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            padding: 1rem;
        }

        .modal-content {
            background: white;
            width: 100%;
            max-width: 500px;
            border-radius: 0.75rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
        }

        /* Badges */
        .badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-primary {
            background-color: var(--primary-light);
            color: white;
        }

        .badge-success {
            background-color: var(--success-color);
            color: white;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* RTL Support */
        [dir="rtl"] .property-details {
            text-align: right;
        }

        [dir="rtl"] .form-label {
            text-align: right;
        }
    </style>
@endsection

@section('content')
    <div class="container py-4">
        <!-- Header Section -->
        <div class="land-exchange-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-2">{{ __('land_exchange.marketplace') }}</h1>
                    <p class="mb-0 opacity-75">{{ __('land_exchange.marketplace_description') }}</p>
                </div>
                <div>
                    <i class="fas fa-exchange-alt fa-3x opacity-25"></i>
                </div>
            </div>
        </div>

        <!-- Tab Navigation -->
        <div class="nav-tabs-container">
            <div class="d-flex">
                <button class="nav-tab active" data-tab="advertisement-tab">
                    <i class="fas fa-plus-circle me-2"></i>
                    {{ __('land_exchange.post_ad') }}
                </button>
                <button class="nav-tab" data-tab="browse-offers-tab">
                    <i class="fas fa-search me-2"></i>
                    {{ __('land_exchange.browse_ads') }}
                </button>
                <button class="nav-tab" data-tab="announcements-tab">
                    <i class="fas fa-bullhorn me-2"></i>
                    {{ __('land_exchange.my_ads') }}
                </button>
                <button class="nav-tab" data-tab="offers-tab">
                    <i class="fas fa-handshake me-2"></i>
                    {{ __('land_exchange.my_offers') }}
                </button>
            </div>
        </div>

        <!-- Advertisement Tab Content -->
        <div id="advertisement-tab" class="tab-content active">
            @include('landexchange.land-exchange')
        </div>

        <!-- Browse Offers Tab Content -->
        <div id="browse-offers-tab" class="tab-content">
            @include('landexchange.offer')
        </div>

        <!-- My Ads Tab Content -->
        <div id="announcements-tab" class="tab-content">
            @include('landexchange.ads')
        </div>

        <!-- My Offers Tab Content -->
        <div id="offers-tab" class="tab-content">
            @include('landexchange.offer-tab')
        </div>
    </div>

    <!-- Offer Modal -->
    <div class="modal fade" id="offerModal" tabindex="-1" aria-labelledby="offerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="offerForm" method="POST" action="{{ route('offers.store') }}">
                @csrf
                <input type="hidden" name="offer_id" id="modal_offer_id">
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <input type="hidden" name="land_exchange_id" id="land_exchange_id">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="offerModalLabel">
                            <i class="fas fa-handshake me-2"></i>
                            {{ __('land_exchange.make_offer') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-4">
                            <label for="offer_type" class="form-label">{{ __('land_exchange.offer_type') }}</label>
                            <select class="form-select" id="offer_type" name="offer_type" required>
                                <option value="exchange">{{ __('land_exchange.exchange_only') }}</option>
                                <option value="cash">{{ __('land_exchange.cash_offer') }}</option>
                                <option value="both">{{ __('land_exchange.both') }}</option>
                            </select>
                        </div>

                        <div class="mb-4" id="price-field" style="display: none;">
                            <label for="offer_price" class="form-label">{{ __('land_exchange.offer_price') }}
                                (SAR)</label>
                            <input type="number" class="form-control" name="offer_price" id="offer_price" min="0">
                        </div>

                        <div class="mb-3">
                            <label for="offer_note" class="form-label">{{ __('land_exchange.notes') }}</label>
                            <textarea class="form-control" name="offer_note" id="offer_note" rows="3"
                                placeholder="{{ __('land_exchange.notes_placeholder') }}"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>
                            {{ __('land_exchange.cancel') }}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-1"></i>
                            {{ __('land_exchange.submit_offer') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Enhanced Tab Switching Functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize first tab as active
            switchTab('advertisement-tab');

            // Add click events to all tabs
            document.querySelectorAll('.nav-tab').forEach(tab => {
                tab.addEventListener('click', function() {
                    const tabId = this.getAttribute('data-tab');
                    switchTab(tabId);
                });
            });
        });

        function switchTab(tabId) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });

            // Deactivate all tabs
            document.querySelectorAll('.nav-tab').forEach(tab => {
                tab.classList.remove('active');
            });

            // Activate selected tab and content
            document.getElementById(tabId).classList.add('active');
            document.querySelector(`.nav-tab[data-tab="${tabId}"]`).classList.add('active');

            // Scroll to top of tab content
            document.getElementById(tabId).scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        // Image Upload Preview
        document.getElementById('upload-area').addEventListener('click', function() {
            document.getElementById('image-input').click();
        });

        document.getElementById('image-input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                if (file.size > 5 * 1024 * 1024) {
                    alert('{{ __('land_exchange.file_too_large') }}');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(event) {
                    const preview = document.getElementById('image-preview');
                    preview.src = event.target.result;
                    preview.style.display = 'block';
                    document.getElementById('upload-content').style.display = 'none';
                };
                reader.readAsDataURL(file);
            }
        });

        // Location Management
        document.getElementById('add-location').addEventListener('click', function() {
            const container = document.getElementById('desired-locations-container');
            const div = document.createElement('div');
            div.className = 'input-group mb-2';
            div.innerHTML = `
            <input type="text" name="desired_locations[]" class="form-control" placeholder="{{ __('land_exchange.location_placeholder') }}" required>
            <button type="button" class="btn btn-outline-danger remove-location">
                <i class="fas fa-times"></i>
            </button>
        `;
            container.appendChild(div);
        });

        // Use event delegation for remove location buttons
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-location') ||
                e.target.closest('.remove-location')) {
                const container = document.getElementById('desired-locations-container');
                if (container.children.length > 1) {
                    e.target.closest('.input-group').remove();
                } else {
                    alert('{{ __('land_exchange.min_one_location') }}');
                }
            }
        });

        // Offer Modal Handling
        function openOfferModal(landExchangeId) {
            document.getElementById('land_exchange_id').value = landExchangeId;
            const modal = new bootstrap.Modal(document.getElementById('offerModal'));
            modal.show();

            // Reset form when opening
            document.getElementById('offer_type').value = 'exchange';
            document.getElementById('price-field').style.display = 'none';
            document.getElementById('offer_price').value = '';
            document.getElementById('offer_note').value = '';
        }

        // Dynamic Price Field
        document.getElementById('offer_type').addEventListener('change', function() {
            const priceField = document.getElementById('price-field');
            if (this.value === 'exchange') {
                priceField.style.display = 'none';
                document.getElementById('offer_price').removeAttribute('required');
            } else {
                priceField.style.display = 'block';
                document.getElementById('offer_price').setAttribute('required', 'required');
            }
        });
    </script>
@endsection
