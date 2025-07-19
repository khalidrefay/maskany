@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">عروضي كمستشار</h2>
    @if(isset($proposals) && $proposals->isEmpty())
        <div class="alert alert-info">لم تقم بتقديم أي عروض بعد.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>اسم المشروع</th>
                        <th>الحالة</th>
                        <th>تاريخ التقديم</th>
                        <th>تفاصيل</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($proposals as $proposal)
                    <tr>
                        <td>{{ $proposal->project->title ?? '-' }}</td>
                        <td>{{ $proposal->getStatusTextAttribute() }}</td>
                        <td>{{ $proposal->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <a href="{{ route('consultant.projects.show', $proposal->project_id) }}" class="btn btn-sm btn-primary">تفاصيل المشروع</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
