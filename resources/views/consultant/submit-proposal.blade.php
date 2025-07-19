@extends('layouts.app')
@section('title')
    تقديم عرض
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

        .proposal-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
        }

        .proposal-header {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
        }

        .proposal-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .project-info {
            color: var(--text-light);
            margin-bottom: 1.5rem;
        }

        .proposal-form {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: var(--shadow);
        }

        .form-section {
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--border-color);
        }

        .form-group {
            margin-bottom: 1.5rem;
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

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .file-upload {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .file-upload-input {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-upload-label {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            border: 2px dashed var(--border-color);
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
        }

        .file-upload-label:hover {
            border-color: var(--primary-color);
            background: #f0f5ff;
        }

        .file-upload-icon {
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        .file-upload-text {
            color: var(--text-light);
        }

        .form-actions {
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

        .price-input {
            position: relative;
        }

        .price-input .form-control {
            padding-left: 3rem;
        }

        .price-input::before {
            content: "ر.س";
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .duration-input {
            position: relative;
        }

        .duration-input .form-control {
            padding-right: 3rem;
        }

        .duration-input::after {
            content: "شهر";
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        @media (max-width: 768px) {
            .proposal-container {
                padding: 1rem;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
@endsection

@section('content')
    <div class="proposal-container">
        <div class="proposal-header">
            <h1 class="proposal-title">{{ isset($editMode) && $editMode ? 'تعديل عرض المشروع' : 'تقديم عرض للمشروع' }}</h1>
            <div class="project-info">
                <p>المشروع: {{ $project->title }}</p>
                <p>الموقع: {{ $project->city }} - {{ $project->district }}</p>
            </div>
        </div>

        <form class="proposal-form" action="{{ isset($editMode) && $editMode ? route('consultant.proposals.update', $proposal->id) : route('consultant.proposals.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @if(isset($editMode) && $editMode)
                @method('PUT')
            @endif
            <input type="hidden" name="project_id" value="{{ $project->id }}">
            <div class="form-section">
                <h2 class="section-title">الرسومات التصميمية</h2>
                <div class="form-group">
                    <label>رفع المخططات</label>
                    <div class="file-upload">
                        <input type="file" name="design_plans[]" class="file-upload-input" multiple
                            accept=".pdf,.dwg,.jpg,.jpeg,.png" {{ isset($editMode) ? '' : 'required' }}>
                        <label class="file-upload-label">
                            <i class="bi bi-cloud-upload file-upload-icon"></i>
                            <span class="file-upload-text">اختر الملفات أو اسحبها هنا</span>
                        </label>
                    </div>
                    @if(isset($editMode) && $editMode && !empty($proposal->design_plans))
                        <div class="mt-2">
                            <strong>الملفات الحالية:</strong>
                            <ul>
                                @foreach((array)$proposal->design_plans as $file)
                                    <li><a href="{{ asset('storage/' . $file) }}" target="_blank">{{ basename($file) }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <small class="text-muted">يمكنك رفع عدة ملفات (PDF, DWG, JPG, PNG)</small>
                </div>
            </div>

            <div class="form-section">
                <h2 class="section-title">قائمة المواد</h2>
                <div class="form-group">
                    <label>رفع قائمة المواد</label>
                    <div class="file-upload">
                        <input type="file" name="materials_list" class="file-upload-input" accept=".pdf,.xlsx,.xls"
                            {{ isset($editMode) ? '' : 'required' }}>
                        <label class="file-upload-label">
                            <i class="bi bi-cloud-upload file-upload-icon"></i>
                            <span class="file-upload-text">اختر الملف أو اسحبه هنا</span>
                        </label>
                    </div>
                    @if(isset($editMode) && $editMode && !empty($proposal->materials_list))
                        <div class="mt-2">
                            <strong>الملف الحالي:</strong>
                            <a href="{{ asset('storage/' . $proposal->materials_list) }}" target="_blank">{{ basename($proposal->materials_list) }}</a>
                        </div>
                    @endif
                    <small class="text-muted">يمكنك رفع ملف (PDF, Excel)</small>
                </div>
            </div>

            <div class="form-section">
                <h2 class="section-title">التكلفة والمدة</h2>
                <div class="form-group">
                    <label>التكلفة الإجمالية</label>
                    <div class="price-input">
                        <input type="number" name="price" class="form-control" required min="0" step="0.01"
                            value="{{ old('price', isset($proposal) ? $proposal->price : '') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>المدة المتوقعة</label>
                    <div class="duration-input">
                        <input type="number" name="duration" class="form-control" required min="1"
                            value="{{ old('duration', isset($proposal) ? $proposal->duration : '') }}">
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h2 class="section-title">ملاحظات إضافية</h2>
                <div class="form-group">
                    <label>ملاحظات</label>
                    <textarea name="notes" class="form-control" rows="4" placeholder="أضف أي ملاحظات أو تفاصيل إضافية هنا...">{{ old('notes', isset($proposal) ? $proposal->notes : '') }}</textarea>
                </div>
            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-outline" onclick="window.history.back()">
                    <i class="bi bi-arrow-right"></i>
                    رجوع
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-send"></i>
                    {{ isset($editMode) && $editMode ? 'تحديث العرض' : 'تقديم العرض' }}
                </button>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        // File upload preview
        document.querySelectorAll('.file-upload-input').forEach(input => {
            input.addEventListener('change', function(e) {
                const label = this.nextElementSibling;
                const text = label.querySelector('.file-upload-text');

                if (this.files.length > 0) {
                    if (this.multiple) {
                        text.textContent = `${this.files.length} ملفات تم اختيارها`;
                    } else {
                        text.textContent = this.files[0].name;
                    }
                } else {
                    text.textContent = 'اختر الملف أو اسحبه هنا';
                }
            });
        });

        // Form validation
        document.querySelector('.proposal-form').addEventListener('submit', function(e) {
            e.preventDefault();

            // Add your validation logic here
            const price = document.querySelector('input[name="price"]').value;
            const duration = document.querySelector('input[name="duration"]').value;

            if (price <= 0) {
                alert('يرجى إدخال تكلفة صحيحة');
                return;
            }

            if (duration <= 0) {
                alert('يرجى إدخال مدة صحيحة');
                return;
            }

            this.submit();
        });
    </script>
@endsection
