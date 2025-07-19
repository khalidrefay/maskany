@extends('layouts.app')
@section('title')
    المشاريع المتاحة
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

        .projects-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
        }

        .project-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow);
            border-right: 4px solid var(--primary-color);
            transition: var(--transition);
        }

        .project-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .project-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .project-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .project-location {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-light);
        }

        .project-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .detail-label {
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .detail-value {
            font-weight: 600;
            color: var(--text-dark);
        }

        .project-description {
            color: var(--text-light);
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .project-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: #1a4580;
            transform: translateY(-2px);
        }

        .btn-outline {
            background-color: white;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
        }

        .btn-outline:hover {
            background-color: #f0f5ff;
        }

        .filters {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
        }

        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(44, 90, 160, 0.2);
        }

        @media (max-width: 768px) {
            .projects-container {
                padding: 1rem;
            }

            .project-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .project-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
@endsection

@section('content')
    <div class="projects-container">
        <div class="filters">
            <h3 class="mb-4">تصفية المشاريع</h3>
            <div class="filters-grid">
                <div class="form-group">
                    <label>المدينة</label>
                    <select class="form-control" id="city-filter">
                        <option value="">جميع المدن</option>
                        <option value="riyadh">الرياض</option>
                        <option value="jeddah">جدة</option>
                        <option value="dammam">الدمام</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>نوع المشروع</label>
                    <select class="form-control" id="type-filter">
                        <option value="">جميع الأنواع</option>
                        <option value="residential">سكني</option>
                        <option value="commercial">تجاري</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>المساحة</label>
                    <select class="form-control" id="area-filter">
                        <option value="">جميع المساحات</option>
                        <option value="0-200">حتى 200 م²</option>
                        <option value="200-500">200 - 500 م²</option>
                        <option value="500+">أكثر من 500 م²</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="projects-list">
            @foreach ($projects as $project)
                <div class="project-card">
                    <div class="project-header">
                        <h3 class="project-title">{{ $project->title }}</h3>
                        <div class="project-location">
                            <i class="bi bi-geo-alt"></i>
                            <span>{{ $project->city }} - {{ $project->district }}</span>
                        </div>
                    </div>
                    <div class="project-details">
                        <div class="detail-item">
                            <span class="detail-label">المساحة</span>
                            <span class="detail-value">{{ $project->land_area }} م²</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">عدد الطوابق</span>
                            <span class="detail-value">{{ $project->floors }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">غرف النوم</span>
                            <span class="detail-value">{{ $project->bedrooms }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">الحمامات</span>
                            <span class="detail-value">{{ $project->bathrooms }}</span>
                        </div>
                    </div>
                    <p class="project-description">{{ $project->description }}</p>
                    <div class="project-actions">
                        <a href="{{ route('consultant.projects.details', $project->id) }}" class="btn btn-outline">
                            <i class="bi bi-eye"></i>
                            عرض التفاصيل
                        </a>
                        <a class="btn btn-primary" href="{{ route('consultant.proposals.create', $project->id) }}">
                            <i class="bi bi-send"></i>
                            تقديم عرض
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('js')
    <script>
        function viewProjectDetails(projectId) {
            window.location.href = `/consultant/projects/${projectId}`;
        }

        function submitProposal(projectId) {
            window.location.href = `/consultant/projects/${projectId}/proposal`;
        }

        // Filter functionality
        document.getElementById('city-filter').addEventListener('change', applyFilters);
        document.getElementById('type-filter').addEventListener('change', applyFilters);
        document.getElementById('area-filter').addEventListener('change', applyFilters);

        function applyFilters() {
            const city = document.getElementById('city-filter').value;
            const type = document.getElementById('type-filter').value;
            const area = document.getElementById('area-filter').value;

            // Add your filter logic here
            console.log('Applying filters:', {
                city,
                type,
                area
            });
        }
    </script>
@endsection
