@if ($errors->any())
    <div class="alert alert-danger mb-4">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success mb-4">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('land-exchange.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-6">
            <div class="form-card mb-4">
                <h3 class="h5 mb-4">{{ __('land_exchange.ad_details') }}</h3>

                <div class="mb-4">
                    <label class="form-label">{{ __('land_exchange.ad_title') }}</label>
                    <input type="text" name="title" class="form-control"
                        placeholder="{{ __('land_exchange.ad_title_placeholder') }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">{{ __('land_exchange.current_location') }}</label>
                    <input type="text" name="current_location" class="form-control"
                        placeholder="{{ __('land_exchange.location_placeholder') }}" required>
                    <a href="#"
                        class="text-primary small mt-2 d-inline-block">{{ __('land_exchange.select_on_map') }}</a>
                    <input type="hidden" name="map_coordinates" id="map_coordinates">
                </div>

                <div class="mb-4">
                    <label class="form-label">{{ __('land_exchange.desired_locations') }}</label>
                    <div id="desired-locations-container">
                        <div class="input-group mb-2">
                            <input type="text" name="desired_locations[]" class="form-control"
                                placeholder="{{ __('land_exchange.location_placeholder') }}" required>
                            <button type="button" class="btn btn-outline-danger remove-location">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <button type="button" id="add-location" class="btn btn-sm btn-outline-primary mt-2">
                        <i class="fas fa-plus me-1"></i>
                        {{ __('land_exchange.add_location') }}
                    </button>
                </div>

                <div class="mb-4">
                    <label class="form-label">{{ __('land_exchange.area') }} (m²)</label>
                    <input type="number" name="current_area" class="form-control"
                        placeholder="{{ __('land_exchange.area_placeholder') }}" required min="1"
                        step="0.01">
                </div>

                <div class="mb-4">
                    <label class="form-label">{{ __('land_exchange.description') }}</label>
                    <textarea name="description" class="form-control" rows="3"
                        placeholder="{{ __('land_exchange.description_placeholder') }}"></textarea>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-lg-6">
            <div class="form-card mb-4">
                <h3 class="h5 mb-4">{{ __('land_exchange.additional_details') }}</h3>

                <div class="mb-4">
                    <label class="form-label">{{ __('land_exchange.upload_plan') }}</label>
                    <div class="upload-area" id="upload-area">
                        <div id="upload-content">
                            <i class="fas fa-cloud-upload-alt upload-icon"></i>
                            <p class="mb-2">{{ __('land_exchange.upload_instructions') }}</p>
                            <span class="badge badge-primary">{{ __('land_exchange.max_size') }}: 5MB</span>
                        </div>
                        <input type="file" name="image" id="image-input" accept="image/*" style="display: none;">
                        <img id="image-preview" src="#" alt="Preview"
                            style="display: none; max-width: 100%; max-height: 200px; border-radius: 0.5rem;">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">{{ __('land_exchange.phone_number') }}</label>
                    <input type="text" name="phone_number" class="form-control"
                        placeholder="{{ __('land_exchange.phone_placeholder') }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">{{ __('land_exchange.price') }}
                        ({{ __('land_exchange.optional') }})</label>
                    <div class="input-group">
                        <input type="number" name="price" class="form-control"
                            placeholder="{{ __('land_exchange.price_placeholder') }}" min="0">
                        <span class="input-group-text">SAR</span>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">{{ __('land_exchange.purpose') }}</label>
                    <div class="d-flex flex-wrap gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="for_sale" id="for_sale"
                                value="1">
                            <label class="form-check-label" for="for_sale">{{ __('land_exchange.for_sale') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="for_exchange" id="for_exchange"
                                value="1">
                            <label class="form-check-label"
                                for="for_exchange">{{ __('land_exchange.for_exchange') }}</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane me-2"></i>
                    {{ __('land_exchange.publish_ad') }}
                </button>
            </div>
        </div>
    </div>
</form>
