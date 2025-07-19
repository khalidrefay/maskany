@extends('layouts.app')
@section('title')
    لوحة تحكم الاستشاري
@endsection
@section('css')
    <style>
        :root {
            --primary-color: #2c5aa0;
            --secondary-color: #f8f9fa;
            --accent-color: #4CAF50;
            --text-dark: #333;
            --text-light: #6c757d;
            --border-color: #e9ecef;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
        }

        .dashboard-header {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
        }

        .welcome-message {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            border-right: 4px solid var(--primary-color);
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .stat-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-light);
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .stat-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            opacity: 0.2;
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
        }

        .recent-projects {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: var(--shadow);
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--border-color);
        }

        .project-list {
            display: grid;
            gap: 1rem;
        }

        .project-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background: var(--secondary-color);
            border-radius: 8px;
            transition: var(--transition);
        }

        .project-item:hover {
            background: #e9ecef;
        }

        .project-info {
            flex: 1;
        }

        .project-name {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }

        .project-meta {
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .project-status {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-accepted {
            background: #d4edda;
            color: #155724;
        }

        .status-rejected {
            background: #f8d7da;
            color: #721c24;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 2rem;
        }

        .action-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: var(--shadow);
            transition: var(--transition);
            cursor: pointer;
        }

        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .action-icon {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .action-title {
            font-weight: 600;
            color: var(--text-dark);
        }

        @media (max-width: 768px) {
            .dashboard-container {
                padding: 1rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .project-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .project-status {
                align-self: flex-start;
            }
        }
    </style>
@endsection

@section('content')
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1 class="welcome-message">مرحباً، {{ auth()->user()->name }}</h1>
            <p class="text-muted">هذه نظرة عامة على نشاطك في المنصة</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-title">المشاريع النشطة</div>
                <div class="stat-value">{{ $activeProjects }}</div>
                <i class="bi bi-building stat-icon"></i>
            </div>
            <div class="stat-card">
                <div class="stat-title">العروض المقدمة</div>
                <div class="stat-value">{{ $totalProposals }}</div>
                <i class="bi bi-send stat-icon"></i>
            </div>
            <div class="stat-card">
                <div class="stat-title">العروض المقبولة</div>
                <div class="stat-value">{{ $acceptedProposals }}</div>
                <i class="bi bi-check-circle stat-icon"></i>
            </div>
            <div class="stat-card">
                <div class="stat-title">التقييم العام</div>
                <div class="stat-value">{{ number_format($averageRating, 1) }}</div>
                <i class="bi bi-star stat-icon"></i>
            </div>
        </div>

        <div class="recent-projects">
            <h2 class="section-title">آخر المشاريع</h2>
            <div class="project-list">
                @foreach ($recentProjects as $project)
                    <div class="project-item">
                        <div class="project-info">
                            <div class="project-name">{{ $project->title }}</div>
                            <div class="project-meta">
                                <span>{{ $project->city }} - {{ $project->district }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $project->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <div class="project-status status-{{ $project->status }}">
                            {{ $project->status_text }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="quick-actions">
            <a href="{{ route('consultant.available-projects') }}" class="action-card">
                <i class="bi bi-search action-icon"></i>
                <div class="action-title">استعراض المشاريع</div>
            </a>
            <a href="{{ route('consultant.messages') }}" class="action-card">
                <i class="bi bi-chat-dots action-icon"></i>
                <div class="action-title">الرسائل</div>
            </a>
            <a href="{{ route('consultant.my-offers.view') }}" class="action-card">
                <i class="bi bi-clipboard-check action-icon"></i>
                <div class="action-title">عروضي</div>
            </a>
            <a href="{{ route('consultant.profile') }}" class="action-card">
                <i class="bi bi-person action-icon"></i>
                <div class="action-title">الملف الشخصي</div>
            </a>
        </div>
    </div>
@endsection
