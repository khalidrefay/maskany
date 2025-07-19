@extends('layouts.app')
@section('title')
    تقدير تكلفة المشروع
@endsection
@section('css')
    <style>
        :root {
            --primary-color: #2c5aa0;
            --secondary-color: #f8f9fa;
            --accent-color: #4CAF50;
            --text-dark: #333;
            --text-light: #6c757d;
            --border-color: #e9ecef;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f5f7fa;
            color: var(--text-dark);
            direction: rtl;
        }

        .step-container {
            max-width: 900px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 12px;
            box-shadow: var(--shadow);
        }

        .step-header {
            text-align: center;
            margin-bottom: 2.5rem;
            position: relative;
        }

        .step-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .step-subtitle {
            color: var(--text-light);
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }

        .step-navigation {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            margin-bottom: 3rem;
            position: relative;
        }

        .step-progress {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--border-color);
            z-index: 1;
            transform: translateY(-50%);
        }

        .step-progress-bar {
            height: 100%;
            background: var(--primary-color);
            transition: var(--transition);
        }

        .step-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .step-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            margin-bottom: 0.5rem;
            transition: var(--transition);
        }

        .step-item.active .step-number {
            background-color: var(--primary-color);
            color: white;
            box-shadow: 0 4px 8px rgba(44, 90, 160, 0.3);
        }

        .step-item.completed .step-number {
            background-color: var(--accent-color);
            color: white;
        }

        .step-item.inactive .step-number {
            background-color: var(--border-color);
            color: var(--text-light);
        }

        .step-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-light);
            white-space: nowrap;
        }

        .step-item.active .step-label,
        .step-item.completed .step-label {
            color: var(--primary-color);
        }

        .step-content {
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--border-color);
        }

        .option-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .option-card {
            background: white;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .option-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow);
            border-color: var(--primary-color);
        }

        .option-card.selected {
            border-color: var(--primary-color);
            background-color: #f0f5ff;
        }

        .option-card.selected::after {
            content: '\2713';
            position: absolute;
            top: 10px;
            left: 10px;
            width: 24px;
            height: 24px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .option-image-container {
            width: 100%;
            height: 140px;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 1rem;
            position: relative;
        }

        .option-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .option-card:hover .option-image {
            transform: scale(1.05);
        }

        .option-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .option-description {
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
            background-color: #f8f9fa;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(44, 90, 160, 0.2);
            background-color: white;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-next {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-next:hover {
            background-color: #1a4580;
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .btn-prev {
            background-color: white;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
        }

        .btn-prev:hover {
            background-color: #f0f5ff;
        }

        .btn-submit {
            background-color: var(--accent-color);
            color: white;
        }

        .btn-submit:hover {
            background-color: #3d8b40;
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .btn-icon {
            margin-right: 0.5rem;
        }

        .badge-container {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .badge-primary {
            background-color: #e0e8f5;
            color: var(--primary-color);
        }

        .badge-secondary {
            background-color: #f0f0f0;
            color: var(--text-light);
        }

        .badge-success {
            background-color: #e8f5e9;
            color: var(--accent-color);
        }

        .form-check {
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .form-check-input {
            margin-left: 0.5rem;
            width: 1.2em;
            height: 1.2em;
        }

        .form-check-label {
            font-size: 0.95rem;
        }

        .location-selectors {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .summary-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
            border-left: 4px solid var(--primary-color);
        }

        .summary-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px dashed var(--border-color);
        }

        .summary-label {
            font-weight: 600;
        }

        .summary-value {
            color: var(--primary-color);
        }

        .total-estimate {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--accent-color);
            text-align: center;
            margin: 2rem 0;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 8px;
            border: 2px dashed var(--accent-color);
        }

        .estimate-breakdown {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin: 1rem 0;
            box-shadow: var(--shadow);
        }

        .estimate-breakdown h4 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .breakdown-item {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .breakdown-item:last-child {
            border-bottom: none;
        }

        .breakdown-item.total {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 2px solid var(--accent-color);
            font-weight: 600;
            color: var(--accent-color);
        }

        .breakdown-item span:first-child {
            color: var(--text-dark);
        }

        .breakdown-item span:last-child {
            color: var(--primary-color);
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .step-container {
                padding: 1.5rem;
            }

            .step-navigation {
                flex-wrap: wrap;
            }

            .step-item {
                margin-bottom: 1rem;
            }

            .option-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 576px) {
            .option-grid {
                grid-template-columns: 1fr;
            }

            .location-selectors {
                grid-template-columns: 1fr;
            }

            .btn-container {
                flex-direction: column-reverse;
                gap: 1rem;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
@endsection

@section('content')
    <div class="step-container">
        <form method="POST" action="{{ route('project.store') }}" id="estimateForm">
            @csrf
            <!-- Hidden fields to store selections from JS -->
            <input type="hidden" name="city" id="input-city">
            <input type="hidden" name="district" id="input-district">
            <input type="hidden" name="land_area" id="input-landArea">
            <input type="hidden" name="design" id="input-design">
            <input type="hidden" name="finishing" id="input-finishing">
            <input type="hidden" name="shape" id="input-shape">
            <input type="hidden" name="floors" id="input-floors">
            <input type="hidden" name="bedrooms" id="input-bedrooms">
            <input type="hidden" name="living_rooms" id="input-livingRooms">
            <input type="hidden" name="bathrooms" id="input-bathrooms">
            <input type="hidden" name="kitchens" id="input-kitchens">
            <input type="hidden" name="annexes" id="input-annexes">
            <input type="hidden" name="parking" id="input-parking">
            <input type="hidden" name="required_area" id="input-requiredArea">
            <input type="hidden" name="terms" id="input-terms">
            <input type="hidden" name="contact" id="input-contact">
            <input type="hidden" name="estimate" id="input-estimate">

            <div id="step1" class="step-content">
                <div class="step-header">
                    <h2 class="step-title">{{ __('estimate.title') }}</h2>
                    <p class="step-subtitle">{{ __('estimate.subtitle_location') }}</p>
                    <div class="step-navigation">
                        <div class="step-progress">
                            <div class="step-progress-bar" style="width: 0%"></div>
                        </div>
                        <div class="step-item active">
                            <div class="step-number">1</div>
                            <span class="step-label">{{ __('estimate.step_location') }}</span>
                        </div>
                        <div class="step-item inactive">
                            <div class="step-number">2</div>
                            <span class="step-label">{{ __('estimate.step_design') }}</span>
                        </div>
                        <div class="step-item inactive">
                            <div class="step-number">3</div>
                            <span class="step-label">{{ __('estimate.step_details') }}</span>
                        </div>
                    </div>
                </div>
                <div class="location-selectors">
                    <div class="form-group">
                        <label>{{ __('estimate.city') }}</label>
                        <select class="form-control" id="city">
                            <option value="">{{ __('estimate.choose_city') }}</option>
                            <option value="riyadh">{{ __('estimate.riyadh') }}</option>
                            <option value="jeddah">{{ __('estimate.jeddah') }}</option>
                            <option value="dammam">{{ __('estimate.dammam') }}</option>
                            <option value="khobar">{{ __('estimate.khobar') }}</option>
                            <option value="makkah">{{ __('estimate.makkah') }}</option>
                            <option value="medina">{{ __('estimate.medina') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{ __('estimate.district') }}</label>
                        <select class="form-control" id="district" disabled>
                            <option value="">{{ __('estimate.choose_district') }}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{ __('estimate.land_area') }}</label>
                    <input type="number" class="form-control" placeholder="{{ __('estimate.enter_land_area') }}"
                        id="landArea">
                </div>
                <div class="btn-container">
                    <div></div>
                    <button type="button" class="btn btn-next" onclick="nextStep(2)">
                        {{ __('estimate.next') }} <i class="bi bi-arrow-left btn-icon"></i>
                    </button>
                </div>
            </div>

            <!-- Step 2: Design Selection -->
            <div id="step2" class="step-content" style="display: none;">
                <div class="step-header">
                    <h2 class="step-title">{{ __('estimate.design_title') }}</h2>
                    <p class="step-subtitle">{{ __('estimate.design_subtitle') }}</p>
                    <div class="step-navigation">
                        <div class="step-progress">
                            <div class="step-progress-bar" style="width: 50%"></div>
                        </div>
                        <div class="step-item completed">
                            <div class="step-number"><i class="bi bi-check"></i></div>
                            <span class="step-label">{{ __('estimate.step_location') }}</span>
                        </div>
                        <div class="step-item active">
                            <div class="step-number">2</div>
                            <span class="step-label">{{ __('estimate.step_design') }}</span>
                        </div>
                        <div class="step-item inactive">
                            <div class="step-number">3</div>
                            <span class="step-label">{{ __('estimate.step_details') }}</span>
                        </div>
                    </div>
                </div>
                <div class="badge-container">
                    <span class="badge badge-success">{{ __('estimate.badge_one_section') }}</span>
                    <span class="badge badge-primary">{{ __('estimate.badge_choose_plan') }}</span>
                    <span class="badge badge-secondary">{{ __('estimate.badge_choose_floors') }}</span>
                </div>
                <h3 class="section-title">{{ __('estimate.choose_design_style') }}</h3>
                <div class="option-grid">
                    <div class="option-card" onclick="selectOption(this, 'design')">
                        <div class="option-image-container">
                            <img src="https://images.unsplash.com/photo-1513584684374-8bab748fbf90" class="option-image"
                                alt="{{ __('estimate.traditional') }}">
                        </div>
                        <h4 class="option-title">{{ __('estimate.traditional') }}</h4>
                        <p class="option-description">{{ __('estimate.traditional_desc') }}</p>
                    </div>
                    <div class="option-card" onclick="selectOption(this, 'design')">
                        <div class="option-image-container">
                            <img src="https://images.unsplash.com/photo-1480074568708-e7b720bb3f09" class="option-image"
                                alt="{{ __('estimate.classic') }}">
                        </div>
                        <h4 class="option-title">{{ __('estimate.classic') }}</h4>
                        <p class="option-description">{{ __('estimate.classic_desc') }}</p>
                    </div>
                    <div class="option-card" onclick="selectOption(this, 'design')">
                        <div class="option-image-container">
                            <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750" class="option-image"
                                alt="{{ __('estimate.modern') }}">
                        </div>
                        <h4 class="option-title">{{ __('estimate.modern') }}</h4>
                        <p class="option-description">{{ __('estimate.modern_desc') }}</p>
                    </div>
                </div>
                <h3 class="section-title">{{ __('estimate.choose_finishing_level') }}</h3>
                <div class="option-grid">
                    <div class="option-card" onclick="selectOption(this, 'finishing')">
                        <div class="option-image-container">
                            <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7" class="option-image"
                                alt="{{ __('estimate.economic') }}">
                        </div>
                        <h4 class="option-title">{{ __('estimate.economic') }}</h4>
                        <p class="option-description">{{ __('estimate.economic_desc') }}</p>
                        <div class="price-estimate">~ 500 {{ __('estimate.sar_per_m') }}</div>
                    </div>
                    <div class="option-card" onclick="selectOption(this, 'finishing')">
                        <div class="option-image-container">
                            <img src="https://images.unsplash.com/photo-1560440021-33f9b867899d" class="option-image"
                                alt="{{ __('estimate.medium') }}">
                        </div>
                        <h4 class="option-title">{{ __('estimate.medium') }}</h4>
                        <p class="option-description">{{ __('estimate.medium_desc') }}</p>
                        <div class="price-estimate">~ 800 {{ __('estimate.sar_per_m') }}</div>
                    </div>
                    <div class="option-card" onclick="selectOption(this, 'finishing')">
                        <div class="option-image-container">
                            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c" class="option-image"
                                alt="{{ __('estimate.luxury') }}">
                        </div>
                        <h4 class="option-title">{{ __('estimate.luxury') }}</h4>
                        <p class="option-description">{{ __('estimate.luxury_desc') }}</p>
                        <div class="price-estimate">~ 1200 {{ __('estimate.sar_per_m') }}</div>
                    </div>
                </div>
                <h3 class="section-title">{{ __('estimate.choose_building_shape') }}</h3>
                <div class="option-grid">
                    <div class="option-card" onclick="selectOption(this, 'shape')">
                        <div class="option-image-container">
                            <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c" class="option-image"
                                alt="{{ __('estimate.l_shape') }}">
                        </div>
                        <h4 class="option-title">{{ __('estimate.l_shape') }}</h4>
                        <p class="option-description">{{ __('estimate.l_shape_desc') }}</p>
                    </div>
                    <div class="option-card" onclick="selectOption(this, 'shape')">
                        <div class="option-image-container">
                            <img src="https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3" class="option-image"
                                alt="{{ __('estimate.u_shape') }}">
                        </div>
                        <h4 class="option-title">{{ __('estimate.u_shape') }}</h4>
                        <p class="option-description">{{ __('estimate.u_shape_desc') }}</p>
                    </div>
                    <div class="option-card" onclick="selectOption(this, 'shape')">
                        <div class="option-image-container">
                            <img src="https://images.unsplash.com/photo-1600210492486-724fe5c67fb0" class="option-image"
                                alt="{{ __('estimate.rectangle') }}">
                        </div>
                        <h4 class="option-title">{{ __('estimate.rectangle') }}</h4>
                        <p class="option-description">{{ __('estimate.rectangle_desc') }}</p>
                    </div>
                </div>
                <div class="btn-container">
                    <button type="button" class="btn btn-prev" onclick="prevStep(1)">
                        <i class="bi bi-arrow-right btn-icon"></i> {{ __('estimate.previous') }}
                    </button>
                    <button type="button" class="btn btn-next" onclick="nextStep(3)">
                        {{ __('estimate.next') }} <i class="bi bi-arrow-left btn-icon"></i>
                    </button>
                </div>
            </div>

            <!-- Step 3: Interior Details -->
            <div id="step3" class="step-content" style="display: none;">
                <div class="step-header">
                    <h2 class="step-title">{{ __('estimate.details_title') }}</h2>
                    <p class="step-subtitle">{{ __('estimate.details_subtitle') }}</p>
                    <div class="step-navigation">
                        <div class="step-progress">
                            <div class="step-progress-bar" style="width: 100%"></div>
                        </div>
                        <div class="step-item completed">
                            <div class="step-number"><i class="bi bi-check"></i></div>
                            <span class="step-label">{{ __('estimate.step_location') }}</span>
                        </div>
                        <div class="step-item completed">
                            <div class="step-number"><i class="bi bi-check"></i></div>
                            <span class="step-label">{{ __('estimate.step_design') }}</span>
                        </div>
                        <div class="step-item active">
                            <div class="step-number">3</div>
                            <span class="step-label">{{ __('estimate.step_details') }}</span>
                        </div>
                    </div>
                </div>
                <div class="summary-card">
                    <h3 class="summary-title">{{ __('estimate.summary_title') }}</h3>
                    <div class="summary-item">
                        <span class="summary-label">{{ __('estimate.city') }}:</span>
                        <span class="summary-value" id="summary-city">--</span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-label">{{ __('estimate.district') }}:</span>
                        <span class="summary-value" id="summary-district">--</span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-label">{{ __('estimate.land_area') }}:</span>
                        <span class="summary-value" id="summary-area">-- {{ __('estimate.m2') }}</span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-label">{{ __('estimate.design_style') }}:</span>
                        <span class="summary-value" id="summary-design">--</span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-label">{{ __('estimate.finishing_level') }}:</span>
                        <span class="summary-value" id="summary-finishing">--</span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-label">{{ __('estimate.building_shape') }}:</span>
                        <span class="summary-value" id="summary-shape">--</span>
                    </div>
                </div>
                <h3 class="section-title">{{ __('estimate.details_title') }}</h3>
                <div class="form-grid">
                    <div class="form-group">
                        <label>{{ __('estimate.floors') }}</label>
                        <input type="number" class="form-control" placeholder="{{ __('estimate.enter_floors') }}"
                            id="floors">
                    </div>
                    <div class="form-group">
                        <label>{{ __('estimate.bedrooms') }}</label>
                        <input type="number" class="form-control" placeholder="{{ __('estimate.enter_bedrooms') }}"
                            id="bedrooms">
                    </div>
                    <div class="form-group">
                        <label>{{ __('estimate.living_rooms') }}</label>
                        <input type="number" class="form-control" placeholder="{{ __('estimate.enter_living_rooms') }}"
                            id="living-rooms">
                    </div>
                    <div class="form-group">
                        <label>{{ __('estimate.bathrooms') }}</label>
                        <input type="number" class="form-control" placeholder="{{ __('estimate.enter_bathrooms') }}"
                            id="bathrooms">
                    </div>
                    <div class="form-group">
                        <label>{{ __('estimate.kitchens') }}</label>
                        <input type="number" class="form-control" placeholder="{{ __('estimate.enter_kitchens') }}"
                            id="kitchens">
                    </div>
                    <div class="form-group">
                        <label>{{ __('estimate.annexes') }}</label>
                        <input type="number" class="form-control" placeholder="{{ __('estimate.enter_annexes') }}"
                            id="annexes">
                    </div>
                    <div class="form-group">
                        <label>{{ __('estimate.parking_spots') }}</label>
                        <input type="number" class="form-control"
                            placeholder="{{ __('estimate.enter_parking_spots') }}" id="parking">
                    </div>
                    <div class="form-group">
                        <label>{{ __('estimate.required_area') }}</label>
                        <input type="number" class="form-control"
                            placeholder="{{ __('estimate.enter_required_area') }}" id="required-area">
                    </div>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="terms">
                    <label class="form-check-label" for="terms">
                        {{ __('estimate.accept_terms') }}
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="contact">
                    <label class="form-check-label" for="contact">
                        {{ __('estimate.contact_me_later') }}
                    </label>
                </div>
                <div class="total-estimate" id="total-estimate" style="display: none;">
                    {{ __('estimate.total_estimate') }}: <span id="estimate-value">0</span> {{ __('estimate.sar') }}
                </div>
                <div class="btn-container">
                    <button type="button" class="btn btn-prev" onclick="prevStep(2)">
                        <i class="bi bi-arrow-right btn-icon"></i> {{ __('estimate.previous') }}
                    </button>
                    <button type="button" class="btn btn-submit" onclick="calculateEstimate()">
                        {{ __('estimate.calculate') }} <i class="bi bi-calculator btn-icon"></i>
                    </button>
                    <button type="submit" class="btn btn-submit" id="submitBtn" style="display:none;">
                        {{ __('estimate.save_estimate') }} <i class="bi bi-save btn-icon"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form data object
        const formData = {
            city: '',
            district: '',
            landArea: '',
            design: '',
            finishing: '',
            shape: '',
            floors: '',
            bedrooms: '',
            livingRooms: '',
            bathrooms: '',
            kitchens: '',
            annexes: '',
            parking: '',
            requiredArea: '',
            terms: false,
            contact: false,
            estimate: ''
        };

        // City to district mapping
        const districts = {
            riyadh: ['المعذر', 'النخيل', 'الملز', 'الشفا', 'العليا', 'اليرموك'],
            jeddah: ['الزمالك', 'الصفا', 'الروضة', 'النسيم', 'الخالدية', 'الشاطئ'],
            dammam: ['الخليج', 'الرحاب', 'النهضة', 'الغدير', 'المرجان', 'الكورنيش'],
            khobar: ['الغرابي', 'الروضة', 'الهدا', 'الحمراء', 'الرمال', 'الخبر الشمالية'],
            makkah: ['العزيزية', 'الزاهر', 'الشبيكة', 'الرصيفة', 'الهجرة', 'الشرائع'],
            medina: ['العيون', 'السيح', 'الخالدية', 'المناخة', 'العاقول', 'قباء']
        };

        // Price estimates
        const priceEstimates = {
            finishing: {
                'تشطيب اقتصادي': 500,
                'تشطيب متوسط': 800,
                'تشطيب فاخر': 1200
            },
            design: {
                'النمط التراثي': 1.0,
                'النمط الكلاسيكي': 1.2,
                'النمط العصري': 1.1
            },
            shape: {
                'شكل L': 1.05,
                'شكل U': 1.1,
                'مستطيل': 1.0
            },
            city: {
                'riyadh': 1.0,
                'jeddah': 0.9,
                'dammam': 0.85,
                'khobar': 0.9,
                'makkah': 1.1,
                'medina': 1.05
            },
            rooms: {
                'bedrooms': 50000,
                'bathrooms': 30000,
                'living_rooms': 40000,
                'kitchens': 60000,
                'annexes': 25000
            }
        };

        // DOM elements
        const citySelect = document.getElementById('city');
        const districtSelect = document.getElementById('district');
        const landAreaInput = document.getElementById('landArea');
        const summaryCity = document.getElementById('summary-city');
        const summaryDistrict = document.getElementById('summary-district');
        const summaryArea = document.getElementById('summary-area');
        const summaryDesign = document.getElementById('summary-design');
        const summaryFinishing = document.getElementById('summary-finishing');
        const summaryShape = document.getElementById('summary-shape');
        const totalEstimate = document.getElementById('total-estimate');
        const estimateValue = document.getElementById('estimate-value');

        // Hidden fields
        function syncHiddenInputs() {
            document.getElementById('input-city').value = formData.city;
            document.getElementById('input-district').value = formData.district;
            document.getElementById('input-landArea').value = formData.landArea;
            document.getElementById('input-design').value = formData.design;
            document.getElementById('input-finishing').value = formData.finishing;
            document.getElementById('input-shape').value = formData.shape;
            document.getElementById('input-floors').value = formData.floors;
            document.getElementById('input-bedrooms').value = formData.bedrooms;
            document.getElementById('input-livingRooms').value = formData.livingRooms;
            document.getElementById('input-bathrooms').value = formData.bathrooms;
            document.getElementById('input-kitchens').value = formData.kitchens;
            document.getElementById('input-annexes').value = formData.annexes;
            document.getElementById('input-parking').value = formData.parking;
            document.getElementById('input-requiredArea').value = formData.requiredArea;
            document.getElementById('input-terms').value = formData.terms ? 1 : 0;
            document.getElementById('input-contact').value = formData.contact ? 1 : 0;
            document.getElementById('input-estimate').value = formData.estimate;
        }

        // Event listeners
        citySelect.addEventListener('change', function() {
            const city = this.value;
            formData.city = city;
            updateDistrictOptions(city);
            updateSummary();
            syncHiddenInputs();
        });

        districtSelect.addEventListener('change', function() {
            formData.district = this.value;
            updateSummary();
            syncHiddenInputs();
        });

        landAreaInput.addEventListener('input', function() {
            formData.landArea = this.value;
            updateSummary();
            syncHiddenInputs();
        });

        // Step 3 fields
        document.getElementById('floors').addEventListener('input', function() {
            formData.floors = this.value;
            syncHiddenInputs();
        });
        document.getElementById('bedrooms').addEventListener('input', function() {
            formData.bedrooms = this.value;
            syncHiddenInputs();
        });
        document.getElementById('living-rooms').addEventListener('input', function() {
            formData.livingRooms = this.value;
            syncHiddenInputs();
        });
        document.getElementById('bathrooms').addEventListener('input', function() {
            formData.bathrooms = this.value;
            syncHiddenInputs();
        });
        document.getElementById('kitchens').addEventListener('input', function() {
            formData.kitchens = this.value;
            syncHiddenInputs();
        });
        document.getElementById('annexes').addEventListener('input', function() {
            formData.annexes = this.value;
            syncHiddenInputs();
        });
        document.getElementById('parking').addEventListener('input', function() {
            formData.parking = this.value;
            syncHiddenInputs();
        });
        document.getElementById('required-area').addEventListener('input', function() {
            formData.requiredArea = this.value;
            syncHiddenInputs();
        });

        document.getElementById('terms').addEventListener('change', function() {
            formData.terms = this.checked;
            syncHiddenInputs();
        });
        document.getElementById('contact').addEventListener('change', function() {
            formData.contact = this.checked;
            syncHiddenInputs();
        });

        // Functions
        function updateDistrictOptions(city) {
            districtSelect.innerHTML = '<option value="">اختر الحي</option>';
            if (city && districts[city]) {
                districtSelect.disabled = false;
                districts[city].forEach(district => {
                    const option = document.createElement('option');
                    option.value = district;
                    option.textContent = district;
                    districtSelect.appendChild(option);
                });
            } else {
                districtSelect.disabled = true;
            }
        }

        function nextStep(step) {
            // Validate current step before proceeding
            if (step === 2 && (!formData.city || !formData.district || !formData.landArea)) {
                alert('الرجاء إكمال جميع حقول الموقع ومساحة الأرض');
                return;
            }
            // Hide all steps
            document.querySelectorAll('.step-content').forEach(content => {
                content.style.display = 'none';
            });
            // Show target step
            document.getElementById('step' + step).style.display = 'block';
            // Update progress bar
            const progress = (step - 1) * 50;
            document.querySelector('.step-progress-bar').style.width = progress + '%';
        }

        function prevStep(step) {
            document.querySelectorAll('.step-content').forEach(content => {
                content.style.display = 'none';
            });
            document.getElementById('step' + step).style.display = 'block';
            const progress = (step - 1) * 50;
            document.querySelector('.step-progress-bar').style.width = progress + '%';
        }

        function selectOption(element, type) {
            // Remove selection from siblings
            const parent = element.parentNode;
            parent.querySelectorAll('.option-card').forEach(card => {
                card.classList.remove('selected');
            });
            // Add selection to clicked element
            element.classList.add('selected');
            // Update form data
            const title = element.querySelector('.option-title').textContent;
            if (type === 'design') {
                formData.design = title;
            } else if (type === 'finishing') {
                formData.finishing = title;
            } else if (type === 'shape') {
                formData.shape = title;
            }
            updateSummary();
            syncHiddenInputs();
        }

        function updateSummary() {
            if (formData.city) {
                const cityText = citySelect.options[citySelect.selectedIndex].text;
                summaryCity.textContent = cityText;
            }
            if (formData.district) {
                summaryDistrict.textContent = formData.district;
            }
            if (formData.landArea) {
                summaryArea.textContent = formData.landArea + ' م²';
            }
            if (formData.design) {
                summaryDesign.textContent = formData.design;
            }
            if (formData.finishing) {
                summaryFinishing.textContent = formData.finishing;
            }
            if (formData.shape) {
                summaryShape.textContent = formData.shape;
            }
        }

        function calculateEstimate() {
            // Validate form
            if (!formData.design || !formData.finishing || !formData.shape || !formData.landArea) {
                alert('الرجاء إكمال جميع الحقول المطلوبة');
                return;
            }

            // Get base values
            const finishingPrice = priceEstimates.finishing[formData.finishing] || 0;
            const designMultiplier = priceEstimates.design[formData.design] || 1;
            const shapeMultiplier = priceEstimates.shape[formData.shape] || 1;
            const cityMultiplier = priceEstimates.city[formData.city] || 1;
            const area = parseFloat(formData.landArea) || 0;

            // Calculate base estimate
            let estimate = finishingPrice * area * designMultiplier * shapeMultiplier * cityMultiplier;

            // Add room costs
            if (formData.bedrooms) {
                estimate += formData.bedrooms * priceEstimates.rooms.bedrooms;
            }
            if (formData.bathrooms) {
                estimate += formData.bathrooms * priceEstimates.rooms.bathrooms;
            }
            if (formData.livingRooms) {
                estimate += formData.livingRooms * priceEstimates.rooms.living_rooms;
            }
            if (formData.kitchens) {
                estimate += formData.kitchens * priceEstimates.rooms.kitchens;
            }
            if (formData.annexes) {
                estimate += formData.annexes * priceEstimates.rooms.annexes;
            }

            // Apply floor multiplier
            if (formData.floors && formData.floors > 1) {
                estimate *= (1 + (formData.floors * 0.05));
            }

            // Add parking cost
            if (formData.parking) {
                estimate += formData.parking * 25000; // 25,000 ريال لكل موقف سيارات
            }

            // Round to nearest 1000
            estimate = Math.round(estimate / 1000) * 1000;

            // Display result
            estimateValue.textContent = estimate.toLocaleString('ar-SA');
            totalEstimate.style.display = 'block';

            // Save estimate to formData and hidden input
            formData.estimate = estimate;
            syncHiddenInputs();

            // Show submit button
            document.getElementById('submitBtn').style.display = 'inline-block';

            // Scroll to result
            totalEstimate.scrollIntoView({
                behavior: 'smooth'
            });

            // Show detailed breakdown
            showEstimateBreakdown(estimate, finishingPrice, area, designMultiplier, shapeMultiplier, cityMultiplier);
        }

        function showEstimateBreakdown(total, finishingPrice, area, designMultiplier, shapeMultiplier, cityMultiplier) {
            const breakdown = document.createElement('div');
            breakdown.className = 'estimate-breakdown';
            breakdown.innerHTML = `
                <h4>تفاصيل التكلفة:</h4>
                <div class="breakdown-item">
                    <span>تكلفة التشطيب الأساسية:</span>
                    <span>${(finishingPrice * area).toLocaleString('ar-SA')} ريال</span>
                </div>
                <div class="breakdown-item">
                    <span>معامل النمط المعماري:</span>
                    <span>${designMultiplier}x</span>
                </div>
                <div class="breakdown-item">
                    <span>معامل شكل المبنى:</span>
                    <span>${shapeMultiplier}x</span>
                </div>
                <div class="breakdown-item">
                    <span>معامل المدينة:</span>
                    <span>${cityMultiplier}x</span>
                </div>
                <div class="breakdown-item total">
                    <span>التكلفة الإجمالية:</span>
                    <span>${total.toLocaleString('ar-SA')} ريال</span>
                </div>
            `;
            totalEstimate.parentNode.insertBefore(breakdown, totalEstimate.nextSibling);
        }

        // Prevent form submission unless estimate is calculated and terms are accepted
        document.getElementById('estimateForm').addEventListener('submit', function(e) {
            if (!formData.estimate) {
                alert('يرجى حساب التكلفة أولاً');
                e.preventDefault();
                return false;
            }
            if (!formData.terms) {
                alert('يجب الموافقة على الشروط والأحكام');
                e.preventDefault();
                return false;
            }
            // All good, allow submit
        });

        // Initial sync
        syncHiddenInputs();
    </script>
@endsection
