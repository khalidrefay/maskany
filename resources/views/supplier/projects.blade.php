@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">المشاريع المتاحة للمورد</h2>
    @if($projects->isEmpty())
        <div class="alert alert-info">لا توجد مشاريع متاحة حالياً.</div>
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
                    @php $acceptedProposal = $project->proposals->first(); @endphp
                    <tr>
                        <td>{{ $project->title ?? '-' }}</td>
                        <td>{{ $project->description ?? '-' }}</td>
                        <td>
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
                            <a href="{{ route('supplier.projects.show', $project->id) }}" class="btn btn-sm btn-primary">تفاصيل</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
