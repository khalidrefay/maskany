@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">الملف الشخصي للاستشاري</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>الاسم:</strong> {{ $consultant->name ?? '-' }}</p>
            <p><strong>البريد الإلكتروني:</strong> {{ $consultant->email ?? '-' }}</p>
            <!-- أضف أي بيانات أخرى تحتاجها هنا -->
        </div>
    </div>
</div>
@endsection
