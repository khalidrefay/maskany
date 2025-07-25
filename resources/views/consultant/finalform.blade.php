@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        @isset($project)
            <h1 class="text-2xl font-bold mb-6">تسليم المشروع النهائي: {{ $project->title ?? 'بدون عنوان' }}</h1>
            
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('consultant.final.delivery.submit', $project->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">ملفات التسليم النهائية *</label>
                    <div class="relative border-2 border-dashed rounded-lg p-6 text-center">
                        <input type="file" name="delivery_files[]" multiple 
                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                               accept=".pdf,.jpg,.jpeg,.png,.zip" required>
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            <p class="mt-2 text-sm text-gray-600">اسحب الملفات هنا أو انقر لاختيارها</p>
                            <p class="text-xs text-gray-500 mt-1">الحد الأقصى لكل ملف 2MB، المسموح: PDF, JPG, PNG, ZIP</p>
                        </div>
                    </div>
                    <div id="file-list" class="mt-2"></div>
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">ملاحظات</label>
                    <textarea name="notes" rows="4" 
                              class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="أي ملاحظات أو تعليمات خاصة بالمشروع..."></textarea>
                </div>
                
                <div class="flex items-center justify-end gap-4">
                    <a href="{{ route('consultant.projects.index') }}" 
                       class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                        إلغاء
                    </a>
                    <button type="submit" 
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition flex items-center">
                        <i class="fas fa-check-circle ml-2"></i>
                        تأكيد التسليم
                    </button>
                </div>
            </form>
        @else
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                خطأ: لا يوجد مشروع محدد
            </div>
        @endisset
    </div>
</div>

<script>
    // عرض أسماء الملفات المختارة
    document.querySelector('input[name="delivery_files[]"]').addEventListener('change', function(e) {
        const fileList = document.getElementById('file-list');
        fileList.innerHTML = '';
        
        if (this.files.length > 0) {
            const list = document.createElement('ul');
            list.className = 'divide-y divide-gray-200';
            
            Array.from(this.files).forEach(file => {
                const item = document.createElement('li');
                item.className = 'py-2 flex justify-between items-center';
                
                const fileInfo = document.createElement('div');
                fileInfo.innerHTML = `
                    <span class="text-sm font-medium text-gray-700">${file.name}</span>
                    <span class="text-xs text-gray-500">${(file.size / 1024 / 1024).toFixed(2)} MB</span>
                `;
                
                item.appendChild(fileInfo);
                list.appendChild(item);
            });
            
            fileList.appendChild(list);
        }
    });
</script>
@endsection