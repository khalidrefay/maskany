@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">عروضي كمستشار</h2>
        </div>
        
        <div class="card-body">
            @if($proposals->isEmpty())
                <div class="alert alert-info text-center py-4">
                    <i class="fas fa-info-circle fa-2x mb-3"></i>
                    <p class="h5">لم تقم بتقديم أي عروض بعد</p>
                    <a href="{{ route('consultant.available-projects') }}" class="btn btn-primary mt-3">
                        تصفح المشاريع المتاحة
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="25%">اسم المشروع</th>
                                <th width="20%">الحالة</th>
                                <th width="20%">تاريخ التقديم</th>
                                <th width="35%">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($proposals as $proposal)
                            <tr>
                                <td>
                                    <a href="{{ route('consultant.projects.details', $proposal->project_id) }}">
                                        {{ $proposal->project->title ?? 'غير محدد' }}
                                    </a>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $proposal->status_badge }}">
                                        {{ $proposal->getStatusTextAttribute() }}
                                    </span>
                                </td>
                                <td>{{ $proposal->created_at->translatedFormat('d M Y - h:i a') }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('consultant.projects.details', $proposal->project_id) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                           <i class="fas fa-eye"></i> التفاصيل
                                        </a>
@if($proposal->status === 'accepted')
    <a href="{{ route('consultant.final.delivery.form', $proposal->project_id) }}" class="btn btn-sm btn-outline-success">
        <i class="fas fa-paper-plane"></i> تسليم المشروع
    </a>
@endif


                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                
                @if($proposals->hasPages())
                <div class="mt-4">
                    {{ $proposals->links() }}
                </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection