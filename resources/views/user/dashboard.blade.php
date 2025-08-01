@extends('layouts.app')

@section('css')
<style>
    .dashboard-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .profile-header {
        background: white;
        border-radius: 8px;
        padding: 2rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 2rem;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: #1E90FF;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2.5rem;
        font-weight: bold;
    }

    .profile-info h1 {
        margin: 0;
        font-size: 1.8rem;
        color: #1a1a1a;
    }

    .profile-info p {
        margin: 0.5rem 0 0;
        color: #666;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 8px;
        padding: 1.5rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .stat-title {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .stat-value {
        color: #1a1a1a;
        font-size: 1.8rem;
        font-weight: bold;
    }

    .profile-section {
        background: white;
        border-radius: 8px;
        padding: 2rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    .section-title {
        color: #1a1a1a;
        font-size: 1.2rem;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #f0f0f0;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .info-item {
        margin-bottom: 1rem;
    }

    .info-label {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
    }

    .info-value {
        color: #1a1a1a;
        font-size: 1rem;
    }

    .edit-button {
        background: #1E90FF;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 6px;
        text-decoration: none;
        display: inline-block;
        margin-top: 1rem;
        transition: background-color 0.2s;
    }

    .edit-button:hover {
        background: #1a7ad9;
    }

    @media (max-width: 768px) {
        .profile-header {
            flex-direction: column;
            text-align: center;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            font-size: 2rem;
        }
    }
</style>
@endsection

@section('content')
<div class="dashboard-container">
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="profile-avatar">
            @if(auth()->user()->image)
                <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="Profile Picture" style="width: 100%; height: 100%; border-radius: 50%;">
            @else
                    {{ substr(auth()->user()->first_name, 0, 1) }}{{ substr(auth()->user()->last_name, 0, 1) }}
            @endif
                </div>
        <div class="profile-info">
            <h1>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h1>
                    <p>{{ auth()->user()->email }}</p>
            <p>{{ auth()->user()->phone }}</p>
            <a href="{{ route('profile.edit') }}" class="edit-button">{{ __('messages.user.update_photo') }}</a>
                </div>
            </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-title">{{ __('messages.user.total_projects') }}</div>
            <div class="stat-value">{{ $totalProjects }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-title">{{ __('messages.user.active_projects') }}</div>
            <div class="stat-value">{{ $activeProjects }}</div>
        </div>
            <div class="stat-card">
            <div class="stat-title">{{ __('messages.user.completed_projects') }}</div>
            <div class="stat-value">{{ $completedProjects }}</div>
        </div>
    </div>

    <!-- Personal Information -->
    <div class="profile-section">
        <h2 class="section-title">{{ __('messages.user.personal_info') }}</h2>
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">{{ __('messages.user.full_name') }}</div>
                <div class="info-value">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">{{ __('messages.user.email') }}</div>
                <div class="info-value">{{ auth()->user()->email }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">{{ __('messages.user.phone') }}</div>
                <div class="info-value">{{ auth()->user()->phone }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">{{ __('messages.user.address') }}</div>
                <div class="info-value">{{ auth()->user()->address }}</div>
            </div>
        </div>
        <a href="{{ route('user.profile.edit') }}" class="edit-button">{{ __('messages.user.edit_profile') }}</a>
        </div>

    <!-- عروض مقدمة على مشاريعي -->
    <div class="profile-section">
        <h2 class="section-title">العروض المقدمة على مشاريعي</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>المشروع</th>
                        <th>مقدم العرض</th>
                        <th>نوع العرض</th>
                        <th>القيمة</th>
                        <th>الحالة</th>
                        <th>تاريخ التقديم</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($consultantOffers as $offer)
                        <tr>
                            <td>{{ $offer->project->title ?? '-' }}</td>
                            <td>{{ $offer->consultant->name ?? '-' }}</td>
                            <td>استشاري</td>
                            <td>{{ $offer->price ?? '-' }}</td>
                            <td>{{ $offer->getStatusTextAttribute() }}</td>
                            <td>{{ $offer->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                    @foreach($contractorOffers as $offer)
                        <tr>
                            <td>{{ $offer->project->title ?? '-' }}</td>
                            <td>{{ $offer->user->name ?? '-' }}</td>
                            <td>مورد/مقاول</td>
                            <td>{{ $offer->amount ?? '-' }}</td>
                            <td>{{ $offer->status }}</td>
                            <td>{{ $offer->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
