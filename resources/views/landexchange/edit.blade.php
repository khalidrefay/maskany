@extends('layouts.app')

@section('title', 'تعديل إعلان تبادل الأرض')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h2 class="mb-0">تعديل إعلان تبادل الأرض</h2>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('land-exchange.update', $ad->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Column 1 -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">عنوان الإعلان</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            value="{{ old('title', $ad->title) }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="current_location" class="form-label">الموقع الحالي</label>
                                        <input type="text" class="form-control" id="current_location"
                                            name="current_location"
                                            value="{{ old('current_location', $ad->current_location) }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">المواقع المطلوبة (يمكنك إضافة أكثر من موقع)</label>
                                        <div id="desired-locations-list">
                                            @php
                                                $desired_locations = is_array($ad->desired_locations)
                                                    ? $ad->desired_locations
                                                    : json_decode($ad->desired_locations, true);
                                            @endphp
                                            @if ($desired_locations)
                                                @foreach ($desired_locations as $i => $loc)
                                                    <div class="input-group mb-2 desired-location-row">
                                                        <input type="text" name="desired_locations[]"
                                                            class="form-control"
                                                            value="{{ old('desired_locations.' . $i, $loc) }}" required>
                                                        <button type="button"
                                                            class="btn btn-danger remove-location-btn">حذف</button>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="input-group mb-2 desired-location-row">
                                                    <input type="text" name="desired_locations[]" class="form-control"
                                                        value="" required>
                                                    <button type="button"
                                                        class="btn btn-danger remove-location-btn">حذف</button>
                                                </div>
                                            @endif
                                        </div>
                                        <button type="button" class="btn btn-primary mt-2" id="add-location-btn">إضافة
                                            موقع</button>
                                    </div>

                                    <div class="mb-3">
                                        <label for="current_area" class="form-label">المساحة الحالية (متر مربع)</label>
                                        <input type="number" class="form-control" id="current_area" name="current_area"
                                            value="{{ old('current_area', $ad->current_area) }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">الوصف</label>
                                        <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $ad->description) }}</textarea>
                                    </div>
                                </div>

                                <!-- Column 2 -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="image" class="form-label">صورة الأرض</label>
                                        <div class="mb-2">
                                            @if ($ad->image)
                                                <img id="preview-image" src="{{ asset('storage/' . $ad->image) }}"
                                                    alt="صورة الأرض"
                                                    style="max-width: 200px; max-height: 150px; display: block; margin-bottom: 10px;">
                                            @else
                                                <img id="preview-image"
                                                    src="https://via.placeholder.com/200x150?text=No+Image" alt="صورة الأرض"
                                                    style="max-width: 200px; max-height: 150px; display: block; margin-bottom: 10px;">
                                            @endif
                                        </div>
                                        <input type="file" class="form-control" id="image" name="image"
                                            accept="image/*">
                                        <small class="text-muted">يمكنك ترك الحقل فارغاً إذا لم ترغب في تغيير
                                            الصورة.</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone_number" class="form-label">رقم الجوال</label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                                            value="{{ old('phone_number', $ad->phone_number) }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="price" class="form-label">السعر (اختياري)</label>
                                        <input type="number" class="form-control" id="price" name="price"
                                            value="{{ old('price', $ad->price) }}">
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="for_sale"
                                                name="for_sale" value="1"
                                                {{ old('for_sale', $ad->for_sale) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="for_sale">للبيع</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="for_exchange"
                                                name="for_exchange" value="1"
                                                {{ old('for_exchange', $ad->for_exchange) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="for_exchange">للتبادل</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="map_coordinates" class="form-label">إحداثيات الموقع (اختياري)</label>
                                        <input type="text" class="form-control" id="map_coordinates"
                                            name="map_coordinates"
                                            value="{{ old('map_coordinates', $ad->map_coordinates) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('land.exchange.index') }}" class="btn btn-secondary">إلغاء</a>
                                <button type="submit" class="btn btn-success">تحديث الإعلان</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add new desired location input
            document.getElementById('add-location-btn').addEventListener('click', function() {
                let list = document.getElementById('desired-locations-list');
                let div = document.createElement('div');
                div.className = 'input-group mb-2 desired-location-row';
                div.innerHTML = `
                <input type="text" name="desired_locations[]" class="form-control" required>
                <button type="button" class="btn btn-danger remove-location-btn">حذف</button>
            `;
                list.appendChild(div);
            });

            // Remove desired location input
            document.getElementById('desired-locations-list').addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-location-btn')) {
                    let row = e.target.closest('.desired-location-row');
                    if (row) row.remove();
                }
            });

            // Enhanced image preview
            document.getElementById('image').addEventListener('change', function(e) {
                const [file] = this.files;
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(evt) {
                        document.getElementById('preview-image').src = evt.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
