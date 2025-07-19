@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">لوحة تحكم المورد</h2>
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">المشاريع المتاحة</h5>
                    <p class="card-text" style="font-size:2rem;">{{ $availableProjects }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">عروضي</h5>
                    <p class="card-text" style="font-size:2rem;">{{ $myOffers }}</p>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('supplier.projects') }}" class="btn btn-primary">عرض المشاريع المتاحة</a>
</div>
@endsection
