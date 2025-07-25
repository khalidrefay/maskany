@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">العروض المقدمة على مشروع: {{ $project->title }}</h2>

    @if($project->offers->count() > 0)
        @foreach($project->offers as $offer)
            <div class="border p-3 mb-3 rounded shadow-sm">
                <p><strong>المستشار:</strong> {{ $offer->consultant->name }}</p>
                <p><strong>السعر:</strong> {{ $offer->price }} جنيه</p>
                <p><strong>مدة التنفيذ:</strong> {{ $offer->duration }} أيام</p>
                <p><strong>ملاحظات:</strong> {{ $offer->notes }}</p>

                <div class="mt-2">
                    @if($offer->status === 'pending')
                        <form action="{{ route('project-offers.accept', $offer->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">قبول</button>
                        </form>

                        <form action="{{ route('project-offers.reject', $offer->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">رفض</button>
                        </form>
                    @else
                        <span class="badge bg-info">{{ $offer->status == 'accepted' ? 'تم القبول' : 'تم الرفض' }}</span>
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <p>لا يوجد عروض حتى الآن.</p>
    @endif
</div>
@endsection
