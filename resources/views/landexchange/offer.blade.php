  @if ($ads->count() > 0)
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
          @foreach ($ads as $ad)
              <div class="col">
                  <div class="property-card">
                      <img src="{{ $ad->image ? Storage::url($ad->image) : asset('images/default-land.jpg') }}"
                          class="property-image" alt="{{ $ad->title }}">

                      <div class="property-details">
                          <h3 class="property-title">{{ $ad->title }}</h3>
                          <div class="property-location">
                              <i class="fas fa-map-marker-alt me-1 text-danger"></i>
                              {{ $ad->current_location }}
                          </div>

                          <div class="d-flex justify-content-between align-items-center mb-3">
                              <div>
                                  <span class="text-muted small">{{ __('land_exchange.area') }}:</span>
                                  <span class="fw-medium">{{ $ad->current_area }} m²</span>
                              </div>
                              <div>
                                  @if ($ad->price)
                                      <span class="property-price">{{ number_format($ad->price) }} SAR</span>
                                  @else
                                      <span class="badge badge-success">{{ __('land_exchange.exchange_only') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="d-grid gap-2">
                              <button class="btn btn-primary" onclick="openOfferModal({{ $ad->id }})">
                                  <i class="fas fa-handshake me-1"></i>
                                  {{ __('land_exchange.make_offer') }}
                              </button>
                              <a href="tel:{{ $ad->phone_number }}" class="btn btn-outline-secondary">
                                  <i class="fas fa-phone-alt me-1"></i>
                                  {{ __('land_exchange.contact_seller') }}
                              </a>
                          </div>
                      </div>
                  </div>
              </div>
          @endforeach
      </div>

      <div class="mt-4">
          {{ $ads->links() }}
      </div>
  @else
      <div class="empty-state">
          <i class="fas fa-search fa-3x mb-3 text-muted"></i>
          <h4 class="h5">{{ __('land_exchange.no_ads_found') }}</h4>
          <p class="text-muted">{{ __('land_exchange.no_ads_description') }}</p>
      </div>
  @endif
