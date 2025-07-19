@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">عروض الموردين لمشروع: {{ $project->title ?? '-' }}</h2>
    @if($offers->isEmpty())
        <div class="alert alert-info">لا توجد عروض مقدمة من الموردين حتى الآن.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>المورد</th>
                        <th>قيمة العرض</th>
                        <th>ملاحظات</th>
                        <th>تاريخ التقديم</th>
                        <th>إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($offers as $offer)
                    <tr>
                        <td>{{ $offer->user->name ?? '-' }}</td>
                        <td>{{ number_format($offer->amount, 2) }} ر.س</td>
                        <td>{{ $offer->note ?? '-' }}</td>
                        <td>{{ $offer->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <form action="{{ route('consultant.supplier-offers.accept', $offer->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm" {{ $offer->status == 'accepted' ? 'disabled' : '' }}>قبول</button>
                            </form>
                            <form action="{{ route('consultant.supplier-offers.reject', $offer->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" {{ $offer->status == 'rejected' ? 'disabled' : '' }}>رفض</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">رجوع</a>
</div>
@endsection
