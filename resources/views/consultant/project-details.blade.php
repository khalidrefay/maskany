@extends('layouts.app')
@section('title')
    تفاصيل المشروع
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

        .project-details-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
        }

        .project-header {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
        }

        .project-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .project-meta {
            display: flex;
            gap: 2rem;
            margin-bottom: 1.5rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-light);
        }

        .meta-item i {
            color: var(--primary-color);
        }

        .project-description {
            color: var(--text-dark);
            line-height: 1.8;
            margin-bottom: 2rem;
        }

        .project-specs {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .spec-card {
            background: var(--secondary-color);
            border-radius: 8px;
            padding: 1.5rem;
        }

        .spec-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .spec-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .spec-item {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .spec-item:last-child {
            border-bottom: none;
        }

        .spec-label {
            color: var(--text-light);
        }

        .spec-value {
            font-weight: 600;
            color: var(--text-dark);
        }

        .project-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 2rem;
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

        .project-documents {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            margin-top: 2rem;
            box-shadow: var(--shadow);
        }

        .documents-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .documents-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .document-card {
            background: var(--secondary-color);
            border-radius: 8px;
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .document-card:hover {
            background: #e9ecef;
        }

        .document-icon {
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        .document-info {
            flex: 1;
        }

        .document-name {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }

        .document-type {
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .contact-section {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            margin-top: 2rem;
            box-shadow: var(--shadow);
        }

        .contact-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .contact-form {
            display: grid;
            gap: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-group label {
            font-weight: 600;
            color: var(--text-dark);
        }

        .form-control {
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(44, 90, 160, 0.1);
            outline: none;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .file-upload {
            position: relative;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .file-upload-input {
            display: none;
        }

        .file-upload-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem;
            background: var(--secondary-color);
            border: 2px dashed var(--border-color);
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
            text-align: center;
        }

        .file-upload-label i {
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        .file-upload-label:hover {
            border-color: var(--primary-color);
            background: #f0f5ff;
        }

        .file-upload-label span {
            font-weight: 500;
            color: var(--text-dark);
        }

        .file-list {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .file-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem;
            background: var(--secondary-color);
            border-radius: 8px;
            margin-bottom: 0.5rem;
        }

        .file-item-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .file-item i {
            font-size: 1.25rem;
            color: var(--primary-color);
        }

        .file-item-name {
            font-weight: 500;
            color: var(--text-dark);
        }

        .file-item-size {
            font-size: 0.875rem;
            color: var(--text-light);
        }

        .file-item-remove {
            color: #dc3545;
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 4px;
            transition: var(--transition);
        }

        .file-item-remove:hover {
            background: #ffebee;
        }

        .submit-btn {
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .submit-btn:hover {
            background-color: #1a4580;
            transform: translateY(-2px);
        }

        .submit-btn:disabled {
            background-color: var(--border-color);
            cursor: not-allowed;
            transform: none;
        }

        .file-types {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .file-type-item {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .file-item-actions {
            display: flex;
            gap: 0.5rem;
        }

        .file-item-actions .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        .file-item-actions .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
        }

        .file-item-actions .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        @media (max-width: 768px) {
            .project-details-container {
                padding: 1rem;
            }

            .project-meta {
                flex-direction: column;
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
    <div class="project-details-container">
        <div class="project-header">
            <h1 class="project-title">{{ $project->title }}</h1>
            <div class="project-meta">
                <div class="meta-item">
                    <i class="bi bi-geo-alt"></i>
                    <span>{{ $project->city }} - {{ $project->district }}</span>
                </div>
                <div class="meta-item">
                    <i class="bi bi-calendar"></i>
                    <span>تاريخ النشر: {{ $project->created_at->format('Y/m/d') }}</span>
                </div>
                <div class="meta-item">
                    <i class="bi bi-person"></i>
                    <span>صاحب المشروع: {{ $project->user->full_name }}</span>
                </div>
            </div>
            <p class="project-description">{{ $project->description }}</p>
        </div>

        <div class="project-specs">
            <div class="spec-card">
                <h3 class="spec-title">المواصفات الأساسية</h3>
                <ul class="spec-list">
                    <li class="spec-item">
                        <span class="spec-label">المساحة</span>
                        <span class="spec-value">{{ $project->land_area }} م²</span>
                    </li>
                    <li class="spec-item">
                        <span class="spec-label">عدد الطوابق</span>
                        <span class="spec-value">{{ $project->floors }}</span>
                    </li>
                    <li class="spec-item">
                        <span class="spec-label">غرف النوم</span>
                        <span class="spec-value">{{ $project->bedrooms }}</span>
                    </li>
                    <li class="spec-item">
                        <span class="spec-label">الحمامات</span>
                        <span class="spec-value">{{ $project->bathrooms }}</span>
                    </li>
                </ul>
            </div>

            <div class="spec-card">
                <h3 class="spec-title">الغرف الإضافية</h3>
                <ul class="spec-list">
                    <li class="spec-item">
                        <span class="spec-label">الصالات</span>
                        <span class="spec-value">{{ $project->living_rooms }}</span>
                    </li>
                    <li class="spec-item">
                        <span class="spec-label">المطابخ</span>
                        <span class="spec-value">{{ $project->kitchens }}</span>
                    </li>
                </ul>
            </div>
        </div>

        {{--  <div class="project-documents">
            <h2 class="documents-title">المستندات المرفقة</h2>
            <div class="documents-grid">
                <div class="document-card" onclick="viewDocument('design')">
                    <i class="bi bi-file-earmark-image document-icon"></i>
                    <div class="document-info">
                        <div class="document-name">الرسومات التصميمية</div>
                        <div class="document-type">PDF</div>
                    </div>
                </div>
                <div class="document-card" onclick="viewDocument('specs')">
                    <i class="bi bi-file-earmark-text document-icon"></i>
                    <div class="document-info">
                        <div class="document-name">المواصفات الفنية</div>
                        <div class="document-type">PDF</div>
                    </div>
                </div>
            </div>
        </div>  --}}

        {{--  <div class="contact-section">
            <h2 class="contact-title">تواصل مع صاحب المشروع</h2>
            <form class="contact-form" id="messageForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="project_id" value="{{ $project->id }}">

                <div class="form-group">
                    <label for="message">الرسالة</label>
                    <textarea class="form-control" id="message" name="message" required
                        placeholder="اكتب رسالتك هنا..."></textarea>
                </div>

                <div class="form-group">
                    <label>المرفقات (اختياري)</label>
                    <div class="file-upload">
                        <div class="file-types">
                            <div class="file-type-item">
                                <label class="file-upload-label" for="architectural_plan">
                                    <i class="bi bi-building"></i>
                                    <span>المخطط المعماري</span>
                                </label>
                                <input type="file" class="file-upload-input" id="architectural_plan" name="files[]" accept=".pdf,.dwg">
                            </div>
                            <div class="file-type-item">
                                <label class="file-upload-label" for="structural_plan">
                                    <i class="bi bi-diagram-3"></i>
                                    <span>المخطط الإنشائي</span>
                                </label>
                                <input type="file" class="file-upload-input" id="structural_plan" name="files[]" accept=".pdf,.dwg">
                            </div>
                            <div class="file-type-item">
                                <label class="file-upload-label" for="technical_plan">
                                    <i class="bi bi-gear"></i>
                                    <span>المخطط الفني</span>
                                </label>
                                <input type="file" class="file-upload-input" id="technical_plan" name="files[]" accept=".pdf,.dwg">
                            </div>
                        </div>
                        <div class="file-list" id="fileList"></div>
                    </div>
                </div>

                <button type="submit" class="submit-btn" id="submitContact">
                    <i class="bi bi-send"></i>
                    إرسال الرسالة
                </button>
            </form>
        </div>  --}}

        <div class="project-actions">
            <button class="btn btn-outline" onclick="window.history.back()">
                <i class="bi bi-arrow-right"></i>
                رجوع
            </button>
            <a href="{{ route('consultant.proposals.create', $project->id) }}" class="btn btn-primary" >
                <i class="bi bi-send"></i>
                تقديم عرض
            </a>
            @if($project->user)
                <a href="{{ route('messages.chat', ['recipient_id' => $project->user->id]) }}" class="btn btn-success">
                    تواصل مع صاحب المشروع
                </a>
            @else
                <button class="btn btn-secondary" disabled>لا يوجد مالك للمشروع</button>
            @endif
        </div>
    </div>
@endsection

@section('js')
    <script>
        function viewDocument(type) {
            // Add document viewing logic here
            console.log('Viewing document:', type);
        }
    </script>
@endsection
