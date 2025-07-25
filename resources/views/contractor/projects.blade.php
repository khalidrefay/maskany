@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">مشاريعي كمقاول</h2>
    @if($projects->isEmpty())
        <div class="alert alert-info">لا توجد مشاريع مرتبطة بك حالياً.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>اسم المشروع</th>
                        <th>الوصف</th>
                        <th>الاستشاري</th>
                        <th>الملفات</th>
                        <th>تفاصيل</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($projects as $project)
                    <tr>
                        <td>{{ $project->title ?? '-' }}</td>
                        <td>{{ $project->description ?? '-' }}</td>
                        <td>
                           @php
    $acceptedProposal = $project->proposals()
    ->where('status', 'accepted')
    ->whereNotNull('final_delivery_files')
    ->first();

@endphp

                            {{ $acceptedProposal && $acceptedProposal->consultant ? $acceptedProposal->consultant->getFullNameAttribute() : '-' }}
                        </td>
                        <td>
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
                                -
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('contractor.projects.show', $project->id) }}" class="btn btn-sm btn-primary">تفاصيل</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
