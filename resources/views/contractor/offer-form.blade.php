@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- زر فتح المودال -->
    <button onclick="openContractorModal({{ $project->id ?? 0 }})" 
            class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
        </svg>
        تقديم عرض جديد
    </button>

    <!-- نافذة المودال -->
    <div id="contractorOfferModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden transition-opacity duration-300">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
<form id="contractorOfferForm" method="POST" action="{{ route('contractor.offer.submit', ['project_id' => $project->id]) }}" enctype="multipart/form-data" onsubmit="handleSubmit(event)">                @csrf
                <input type="hidden" name="project_id" id="contractor_project_id" value="{{ $project->id ?? '' }}">
                
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4 border-b pb-4">
                        <h2 class="text-2xl font-bold text-green-700">تقديم عرض للمشروع: {{ $project->title ?? '' }}</h2>
                        <button type="button" onclick="closeContractorModal()" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    
                    <div class="space-y-6">
                        <!-- حقل السعر -->
                        <div>
                            <label for="contractor_price" class="block text-sm font-medium text-gray-700 mb-2">
                                السعر ({{ __('projects.currency') }})
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative mt-1">
                                <input type="number" name="price" id="contractor_price" required 
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                       min="0" step="0.01" placeholder="0.00">
                                <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500">{{ __('projects.currency') }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- حقل المدة الزمنية -->
                        <div>
                            <label for="contractor_timeline" class="block text-sm font-medium text-gray-700 mb-2">
                                المدة الزمنية
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative mt-1">
                                <input type="number" name="timeline" id="contractor_timeline" required 
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                       min="1" placeholder="عدد الأيام">
                                <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500">يوم</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- حقل التفاصيل -->
                        <div>
                            <label for="contractor_details" class="block text-sm font-medium text-gray-700 mb-2">
                                تفاصيل العرض
                                <span class="text-red-500">*</span>
                            </label>
                            <textarea name="details" id="contractor_details" rows="5" required
                                      class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                      placeholder="وصف تفصيلي للعرض والمقترحات..."></textarea>
                        </div>
                    </div>
                    
                    <div class="mt-8 flex justify-end gap-3 border-t pt-6">
                        <button type="button" onclick="closeContractorModal()" 
                                class="px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition focus:outline-none focus:ring-2 focus:ring-gray-500">
                            إلغاء
                        </button>
                        <button type="submit" id="submitButton"
                                class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition flex items-center focus:outline-none focus:ring-2 focus:ring-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span id="submitText">تقديمم العرض</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// فتح وإغلاق المودال بسلاسة
function openContractorModal(projectId) {
    const modal = document.getElementById('contractorOfferModal');
    const content = document.getElementById('modalContent');
    
    document.getElementById('contractor_project_id').value = projectId;
    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.classList.add('opacity-100');
        content.classList.add('scale-100', 'opacity-100');
    }, 10);
    document.body.classList.add('overflow-hidden');
}

function closeContractorModal() {
    const modal = document.getElementById('contractorOfferModal');
    const content = document.getElementById('modalContent');
    
    modal.classList.remove('opacity-100');
    content.classList.remove('scale-100', 'opacity-100');
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
    document.body.classList.remove('overflow-hidden');
    
    // إعادة تعيين حالة زر الإرسال
    const submitBtn = document.getElementById('submitButton');
    submitBtn.disabled = false;
    document.getElementById('submitText').textContent = 'تقديم العرض';
}

// إغلاق عند النقر خارج الصندوق
document.getElementById('contractorOfferModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeContractorModal();
    }
});

// منع إغلاق عند النقر داخل الصندوق
document.getElementById('modalContent').addEventListener('click', function(e) {
    e.stopPropagation();
});

// تعطيل زر الإرسال أثناء التحميل
document.getElementById('contractorOfferForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitButton');
    submitBtn.disabled = true;
    document.getElementById('submitText').innerHTML = `
        <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        جاري الإرسال...
    `;
});

// إغلاق بالزر ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeContractorModal();
    }
});
</script>

<style>
#contractorOfferModal {
    opacity: 0;
    transition: opacity 0.3s ease;
}
#contractorOfferModal.opacity-100 {
    opacity: 1;
}
#modalContent {
    transform: scale(0.95);
    opacity: 0;
    transition: all 0.3s ease;
}
#modalContent.scale-100 {
    transform: scale(1);
}
#modalContent.opacity-100 {
    opacity: 1;
}
</style>
@endsection