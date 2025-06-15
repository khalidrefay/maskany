 @if ($useroffers->count() > 0)
     <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
         @foreach ($useroffers as $offer)
             <div class="col">
                 <div class="property-card">
                     <div class="text-center py-3">
                         <img src="{{ $offer->user->image ? asset('storage/' . $offer->user->image) : asset('images/default-avatar.jpg') }}"
                             class="rounded-circle" width="80" height="80" alt="{{ $offer->user->full_name }}">
                         <h4 class="h5 mt-3">{{ $offer->user->full_name }}</h4>
                         <p class="text-muted small">{{ $offer->landExchange->current_location }}</p>
                     </div>

                     <div class="property-details">
                         <h5 class="h6 text-center text-success mb-3">{{ __('land_exchange.offer_details') }}
                         </h5>

                         <div class="bg-light p-3 rounded mb-3">
                             @if ($offer->price)
                                 <div class="d-flex justify-content-between mb-2">
                                     <span>{{ __('land_exchange.offer_price') }}:</span>
                                     <strong>{{ number_format($offer->price) }} SAR</strong>
                                 </div>
                             @else
                                 <div class="text-center">
                                     <span class="badge badge-success">{{ __('land_exchange.exchange_offer') }}</span>
                                 </div>
                             @endif

                             @if ($offer->notes)
                                 <div class="mt-2">
                                     <p class="small mb-1">{{ __('land_exchange.notes') }}:</p>
                                     <p class="small text-muted">{{ $offer->notes }}</p>
                                 </div>
                             @endif
                         </div>

                         <div class="d-flex gap-2">
                             <form method="POST" action="{{ route('offers.accept', $offer->id) }}"
                                 class="flex-grow-1">
                                 @csrf
                                 <button type="submit" class="btn btn-success w-100">
                                     <i class="fas fa-check me-1"></i>
                                     {{ __('land_exchange.accept') }}
                                 </button>
                             </form>
                             <form method="POST" action="{{ route('offers.reject', $offer->id) }}"
                                 class="flex-grow-1">
                                 @csrf
                                 <button type="submit" class="btn btn-outline-secondary w-100">
                                     <i class="fas fa-times me-1"></i>
                                     {{ __('land_exchange.reject') }}
                                 </button>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
         @endforeach
     </div>
 @else
     <div class="empty-state">
         <i class="fas fa-handshake fa-3x mb-3 text-muted"></i>
         <h4 class="h5">{{ __('land_exchange.no_offers') }}</h4>
         <p class="text-muted">{{ __('land_exchange.no_offers_description') }}</p>
         <a href="#browse-offers-tab" class="btn btn-primary mt-3" onclick="switchTab('browse-offers-tab')">
             <i class="fas fa-search me-1"></i>
             {{ __('land_exchange.browse_ads') }}
         </a>
     </div>
 @endif
