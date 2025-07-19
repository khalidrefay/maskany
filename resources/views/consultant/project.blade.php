<div class="col">
    <div class="card h-100 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">{{ $project->title }}</h5>
        </div>
        <div class="card-body">
            <div class="d-flex align-items-center mb-3">
                <i class="bi bi-geo-alt-fill me-2"></i>
                <span>{{ $project->city }} - {{ $project->district }}</span>
            </div>

            <div class="row g-2 mb-3">
                <div class="col-6">
                    <div class="bg-light p-2 rounded text-center">
                        <small class="text-muted d-block">المساحة</small>
                        <strong>{{ $project->land_area }} م²</strong>
                    </div>
                </div>
                <div class="col-6">
                    <div class="bg-light p-2 rounded text-center">
                        <small class="text-muted d-block">الطوابق</small>
                        <strong>{{ $project->floors }}</strong>
                    </div>
                </div>
                <div class="col-6">
                    <div class="bg-light p-2 rounded text-center">
                        <small class="text-muted d-block">غرف النوم</small>
                        <strong>{{ $project->bedrooms }}</strong>
                    </div>
                </div>
                <div class="col-6">
                    <div class="bg-light p-2 rounded text-center">
                        <small class="text-muted d-block">الحمامات</small>
                        <strong>{{ $project->bathrooms }}</strong>
                    </div>
                </div>
            </div>

            <p class="card-text text-muted">{{ Str::limit($project->description, 120) }}</p>
        </div>
        <div class="card-footer bg-transparent">
            <div class="d-grid gap-2">
                <a href="{{ route('consultant.projects.details', $project->id) }}" class="btn btn-outline-primary">
                    <i class="bi bi-eye"></i> عرض التفاصيل
                </a>
                <a href="{{ route('consultant.proposals.create', $project->id) }}" class="btn btn-primary">
                    <i class="bi bi-send"></i> تقديم عرض
                </a>
            </div>
        </div>
    </div>
</div>
