@extends('layouts.app')

@section('css')
<style>
    .offers-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
    }
    
    .offers-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }
    
    .offers-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }
    
    .offers-table th, 
    .offers-table td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .offers-table th {
        background: #f8f9fa;
        font-weight: 600;
    }
    
    .status-badge {
        padding: 0.25rem 0.5rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }
    
    .status-pending {
        background: #fff3cd;
        color: #856404;
    }
    
    .status-active {
        background: #d4edda;
        color: #155724;
    }
    
    .status-completed {
        background: #d1ecf1;
        color: #0c5460;
    }
    
    .action-link {
        color: #1E90FF;
        text-decoration: none;
        margin-right: 1rem;
    }
    
    .action-link:hover {
        text-decoration: underline;
    }
</style>
@endsection

@section('content')
<div class="offers-container">
    <div class="offers-header">
       @if ($projects->isNotEmpty())
    <a href="{{ route('contractor.offers.create', ['project' => $projects->first()->id]) }}" class="btn btn-primary">
        تقديم عرض جديد
    </a>
@else
    <span class="btn btn-primary disabled">لا يوجد مشاريع لتقديم عرض</span>
@endif
    </div>
    
    <table class="offers-table">
        <thead>
            <tr>
                <th>اسم المشروع</th>
                <th>صاحب المشروع</th>
                <th>السعر</th>
                <th>المدة</th>
                <th>الحالة</th>
                <th>التاريخ</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($offers as $offer)
            <tr>
                <td>{{ $offer->project->title }}</td>
                <td>{{ $offer->project->user->name }}</td>
                <td>{{ number_format($offer->price) }} ر.س</td>
                <td>{{ $offer->timeline }} يوم</td>
                <td>
                    <span class="status-badge status-{{ $offer->status }}">
                        @if($offer->status == 'pending')
                            قيد المراجعة
                        @elseif($offer->status == 'active')
                            نشط
                        @else
                            مكتمل
                        @endif
                    </span>
                </td>
                <td>{{ $offer->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('contractor.offers.show', $offer->id) }}" class="action-link">عرض</a>
                    <a href="{{ route('contractor.offers.edit', $offer->id) }}" class="action-link">تعديل</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center;">لا توجد عروض مضافة</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="mt-4">
    </div>
</div>
@endsection