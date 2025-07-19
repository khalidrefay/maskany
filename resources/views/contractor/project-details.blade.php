@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">تفاصيل المشروع</h2>
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">{{ $project->title ?? '-' }}</h4>
            <p class="card-text">{{ $project->description ?? '-' }}</p>
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item"><strong>المدينة:</strong> {{ $project->location ?? '-' }}</li>
                <li class="list-group-item"><strong>الميزانية:</strong> {{ $project->budget ?? '-' }}</li>
                <li class="list-group-item"><strong>الحالة:</strong> {{ $project->getStatusTextAttribute() }}</li>
            </ul>
            <h5>الاستشاري:</h5>
            @if($acceptedProposal && $acceptedProposal->consultant)
                <div>{{ $acceptedProposal->consultant->getFullNameAttribute() }}</div>
                <div>{{ $acceptedProposal->consultant->email }}</div>
            @else
                <div>لا يوجد استشاري مرتبط</div>
            @endif
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">ملفات الاستشاري</div>
        <div class="card-body">
            @if($acceptedProposal)
                @if($acceptedProposal->design_plans)
                    <div>المخططات:</div>
                    <ul>
                    @foreach((array)$acceptedProposal->design_plans as $file)
                        <li><a href="{{ asset('storage/' . $file) }}" target="_blank">تحميل {{ basename($file) }}</a></li>
                    @endforeach
                    </ul>
                @endif
                @if($acceptedProposal->materials_list)
                    <div>قائمة المواد: <a href="{{ asset('storage/' . $acceptedProposal->materials_list) }}" target="_blank">تحميل الملف</a></div>
                @endif
            @else
                <div>لا توجد ملفات متاحة.</div>
            @endif
        </div>
    </div>
    <a href="{{ route('contractor.projects') }}" class="btn btn-secondary">رجوع إلى قائمة المشاريع</a>
</div>
@endsection
