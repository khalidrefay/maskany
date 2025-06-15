   @if ($myOffers->count() > 0)
       <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
           @foreach ($myOffers as $offer)
               <div class="col">
                   <div class="property-card">
                       <img src="{{ $offer->image ? asset('storage/' . $offer->image) : asset('images/default-land.jpg') }}"
                           class="property-image" alt="{{ $offer->title }}">

                       <div class="property-details">
                           <h3 class="property-title">{{ $offer->title }}</h3>
                           <div class="property-location">
                               <i class="fas fa-map-marker-alt me-1 text-danger"></i>
                               {{ $offer->current_location }}
                           </div>

                           <div class="d-flex justify-content-between align-items-center mb-3">
                               <div>
                                   <span class="text-muted small">{{ __('land_exchange.area') }}:</span>
                                   <span class="fw-medium">{{ $offer->current_area }} m²</span>
                               </div>
                               <div>
                                   @if ($offer->price)
                                       <span class="property-price">{{ number_format($offer->price) }} SAR</span>
                                   @else
                                       <span class="badge badge-success">{{ __('land_exchange.exchange_only') }}</span>
                                   @endif
                               </div>
                           </div>

                           <div class="d-grid gap-2">
                               <a href="{{ route('land-exchange.edit', $offer->id) }}" class="btn btn-outline-primary">
                                   <i class="fas fa-edit me-1"></i>
                                   {{ __('land_exchange.edit') }}
                               </a>
                               <form action="{{ route('land-exchange.destroy', $offer->id) }}" method="POST">
                                   @csrf
                                   @method('DELETE')
                                   <button type="submit" class="btn btn-outline-danger w-100"
                                       onclick="return confirm('{{ __('land_exchange.delete_confirmation') }}')">
                                       <i class="fas fa-trash-alt me-1"></i>
                                       {{ __('land_exchange.delete') }}
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
           <i class="fas fa-bullhorn fa-3x mb-3 text-muted"></i>
           <h4 class="h5">{{ __('land_exchange.no_my_ads') }}</h4>
           <p class="text-muted">{{ __('land_exchange.no_my_ads_description') }}</p>
           <a href="#advertisement-tab" class="btn btn-primary mt-3" onclick="switchTab('advertisement-tab')">
               <i class="fas fa-plus me-1"></i>
               {{ __('land_exchange.post_first_ad') }}
           </a>
       </div>
   @endif
