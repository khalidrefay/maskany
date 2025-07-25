@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">تسليم المشروع النهائي</h4>
        </div>
        
        <div class="card-body">
            <form action="{{ route('submit.final.delivery', $projectId) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="project_id" value="{{ $projectId ?? '' }}">

                <!-- ملفات التسليم -->
                <div class="mb-3">
                    <label class="form-label">رفع ملفات التسليم <span class="text-danger">*</span></label>
                    <input type="file" name="delivery_files[]" multiple class="form-control" required>
                    <small class="text-muted">الامتدادات المسموحة: PDF, JPG, PNG, ZIP (بحد أقصى 2MB لكل ملف)</small>
                </div>

                <!-- ملاحظات -->
                <div class="mb-3">
                    <label class="form-label">ملاحظات إضافية</label>
                    <textarea name="notes" class="form-control" rows="3" placeholder="أي ملاحظات تريد إضافتها..."></textarea>
                </div>

                <!-- زر التسليم -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success px-4 py-2">
                        <i class="fas fa-paper-plane me-2"></i> تأكيد التسليم
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection