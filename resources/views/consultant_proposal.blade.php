<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض الاستشاري</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-50 font-sans">
    <div class="container mx-auto p-4 md:p-8">
        <!-- العنوان الرئيسي -->
        <div class="text-center mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">عرض الاستشاري للمشروع</h1>
            <p class="text-gray-600 mt-2">{{ $project->title ?? 'غير محدد' }}</p>
        </div>

        <!-- بطاقة بيانات المشروع -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-3 mb-4 flex items-center">
                    <i class="fas fa-info-circle ml-2 text-blue-500"></i>
                    تفاصيل المشروع
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
                    <div class="flex items-start">
                        <i class="fas fa-heading mt-1 ml-2 text-gray-400"></i>
                        <div>
                            <p class="text-sm text-gray-500">اسم المشروع</p>
                            <p class="font-medium">{{ $project->title ?? 'غير محدد' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-city mt-1 ml-2 text-gray-400"></i>
                        <div>
                            <p class="text-sm text-gray-500">المدينة</p>
                            <p class="font-medium">{{ $project->city ?? 'غير محدد' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-map-marker-alt mt-1 ml-2 text-gray-400"></i>
                        <div>
                            <p class="text-sm text-gray-500">المنطقة</p>
                            <p class="font-medium">{{ $project->region ?? 'غير محدد' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-ruler-combined mt-1 ml-2 text-gray-400"></i>
                        <div>
                            <p class="text-sm text-gray-500">مساحة الأرض</p>
                            <p class="font-medium">{{ $project->land_area ?? 'غير محدد' }} m²</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-drafting-compass mt-1 ml-2 text-gray-400"></i>
                        <div>
                            <p class="text-sm text-gray-500">التصميم</p>
                            <p class="font-medium">{{ $project->design ?? 'غير محدد' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-paint-roller mt-1 ml-2 text-gray-400"></i>
                        <div>
                            <p class="text-sm text-gray-500">مستوى التشطيب</p>
                            <p class="font-medium">{{ $project->finishing_level ?? 'غير محدد' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-building mt-1 ml-2 text-gray-400"></i>
                        <div>
                            <p class="text-sm text-gray-500">عدد الطوابق</p>
                            <p class="font-medium">{{ $project->floors ?? 'غير محدد' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-money-bill-wave mt-1 ml-2 text-gray-400"></i>
                        <div>
                            <p class="text-sm text-gray-500">التكلفة التقديرية</p>
                            <p class="font-medium">{{ $project->estimated_cost ?? 'غير محدد' }} SAR</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- زر فتح المودال -->
        <div class="text-center mb-8">
            @if($project && $project->id)
                <button onclick="openContractorModal({{ $project->id }})"
                        class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-3 rounded-lg hover:from-green-600 hover:to-green-700 transition-all shadow-md flex items-center mx-auto">
                    <i class="fas fa-plus-circle ml-2"></i>
                    تقديم عرض
                </button>
            @else
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative max-w-md mx-auto">
                    <span class="block sm:inline">لا يمكن تقديم عرض: تفاصيل المشروع غير موجودة.</span>
                </div>
            @endif
        </div>

        <!-- نافذة المودال -->
        <div id="contractorOfferModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden transition-opacity duration-300">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
                @if($project && $project->id)
<form id="contractorOfferForm" method="POST">
    @csrf
    <input type="hidden" id="contractor_proposal_id" name="proposal_id" value="">
    <div class="p-6">
        <div class="flex justify-between items-center mb-4 pb-4 border-b">
            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-file-signature ml-2 text-green-500"></i>
                تقديم عرض جديد
            </h2>
            <button type="button" onclick="closeContractorModal()" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="space-y-5">
            <div>
                <label for="contractor_price" class="block text-sm font-medium text-gray-700 mb-1">
                    السعر (SAR) <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input type="number" name="price" id="contractor_price" required 
                           class="block w-full pr-12 pl-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                           min="0" step="0.01" placeholder="0.00">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <span class="text-gray-500">SAR</span>
                    </div>
                </div>
            </div>
            
            <div>
                <label for="contractor_duration" class="block text-sm font-medium text-gray-700 mb-1">
                    المدة الزمنية (أشهر) <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input type="number" name="duration" id="contractor_duration" required 
                           class="block w-full pr-12 pl-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                           min="1" placeholder="عدد الأشهر">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <span class="text-gray-500">شهر</span>
                    </div>
                </div>
            </div>
            
            <div>
                <label for="contractor_notes" class="block text-sm font-medium text-gray-700 mb-1">
                    ملاحظات العرض <span class="text-red-500">*</span>
                </label>
                <textarea name="notes" id="contractor_notes" rows="4" required
                          class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                          placeholder="وصف تفصيلي للعرض والمقترحات..."></textarea>
            </div>

            <div>
                <label for="pdf_file" class="block text-sm font-medium text-gray-700 mb-1">
                    رفع ملف PDF <span class="text-red-500">*</span>
                </label>
                <div class="flex items-center justify-center w-full">
                    <label for="pdf_file" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                            <p class="mb-2 text-sm text-gray-500">اسحب وأسقط الملف هنا أو انقر للاختيار</p>
                            <p class="text-xs text-gray-500">PDF فقط (حتى 5MB)</p>
                        </div>
                        <input id="pdf_file" name="pdf_file" type="file" class="hidden" accept=".pdf" required>
                    </label>
                </div> 
            </div>
        </div>

        @if ($errors->any())
            <div class="mt-4 bg-red-50 border-l-4 border-red-500 p-4 rounded">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-500 ml-2"></i>
                    <p class="text-red-700">{{ $errors->first() }}</p>
                </div>
            </div>
        @endif

        <div class="mt-6 flex justify-end gap-3 border-t pt-4">
            <button type="button" onclick="closeContractorModal()" 
                    class="px-5 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition focus:outline-none focus:ring-2 focus:ring-gray-300">
                <i class="fas fa-times ml-2"></i>
                إلغاء
            </button>
            <button type="submit" id="submitButton"
                    class="px-5 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition flex items-center focus:outline-none focus:ring-2 focus:ring-blue-300">
                <span id="submitText">حفظ العرض</span>
                <i class="fas fa-check ml-2"></i>
            </button>
        </div>
    </div>
</form>
                @else
                    <div class="p-6 text-center">
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                            <span class="block sm:inline">لا يمكن عرض النموذج: تفاصيل المشروع غير موجودة.</span>
                        </div>
                        <button type="button" onclick="closeContractorModal()" class="mt-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            <i class="fas fa-times ml-2"></i>
                            إغلاق
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <!-- قسم عروض الاستشاريين -->
        <section class="mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-file-alt ml-2 text-blue-500"></i>
                عروض الاستشاريين
            </h2>
            
            @if($project->proposals()->count() > 0)
                <div class="space-y-4">
                    @foreach($project->proposals as $proposal)
                        @if(auth()->id() == $project->user_id || auth()->user()->role == 'contractor')
                            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                                <div class="p-5">
                                    <div class="flex flex-col md:flex-row gap-5">
                                        <!-- صورة الاستشاري -->
                                        <div class="flex-shrink-0 flex flex-col items-center text-center">
                                            <img src="{{ $proposal->consultant->image ? asset('storage/' . $proposal->consultant->image) : 'https://randomuser.me/api/portraits/men/32.jpg' }}" 
                                                 alt="صورة الاستشاري" 
                                                 class="w-16 h-16 rounded-full object-cover border-2 border-white shadow mb-2">
                                            <h3 class="font-bold">{{ $proposal->consultant->first_name }} {{ $proposal->consultant->last_name }}</h3>
                                            <p class="text-xs text-gray-500">الحمد للاستشارات الهندسية</p>
                                            <div class="flex items-center mt-1">
                                                @for($i = 0; $i < 5; $i++)
                                                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        
                                        <!-- ملفات العرض -->
                                        <div class="flex-1">
                                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                                                @php
                                                    $files = [
                                                        ['label' => 'مخطط البناء', 'icon' => 'fa-file-pdf', 'file' => $proposal->design_plans[0] ?? null, 'size' => '500 KB'],
                                                        ['label' => 'العرض الفني', 'icon' => 'fa-file-alt', 'file' => $proposal->design_plans[1] ?? null, 'size' => '300 KB'],
                                                        ['label' => 'الكلفة التقديرية', 'icon' => 'fa-file-invoice-dollar', 'file' => $proposal->materials_list ?? null, 'size' => '200 KB'],
                                                    ];
                                                @endphp
                                                @foreach($files as $f)
                                                    <div class="border rounded-lg p-3 bg-gray-50 hover:bg-gray-100 transition">
                                                        <div class="flex items-center mb-2">
                                                            <i class="fas {{ $f['icon'] }} text-red-500 ml-2"></i>
                                                            <h4 class="font-medium text-gray-800">{{ $f['label'] }}</h4>
                                                        </div>
                                                        <p class="text-xs text-gray-500 mb-2">{{ $f['size'] }}</p>
                                                        @if($f['file'])
                                                            <a href="{{ asset('storage/' . $f['file']) }}" 
                                                               class="text-sm text-blue-600 hover:text-blue-800 flex items-center" 
                                                               download>
                                                                <i class="fas fa-download ml-2"></i>
                                                                تنزيل الملف
                                                            </a>
                                                        @else
                                                            <span class="text-sm text-gray-400">غير متاح</span>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                    <i class="fas fa-folder-open text-4xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500">لا يوجد عروض استشارية لهذا المشروع بعد</p>
                </div>
            @endif
        </section>
    </div>

<script>
    // فتح المودال
function openContractorModal(proposalId) {
    const modal = document.getElementById('contractorOfferModal');
    const content = document.getElementById('modalContent');
    const form = document.getElementById('contractorOfferForm');

    document.getElementById('contractor_proposal_id').value = proposalId;
    form.action = '{{ route('contractor.offer.submit', ['proposal' => ':id']) }}'.replace(':id', proposalId);

    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.classList.add('opacity-100');
        content.classList.add('scale-100', 'opacity-100');
    }, 10);
    document.body.classList.add('overflow-hidden');
}

function handleSubmit(event) {
    event.preventDefault();
    const form = document.getElementById('contractorOfferForm');
    const submitBtn = document.getElementById('submitButton');
    const submitText = document.getElementById('submitText');

    submitBtn.disabled = true;
    submitText.innerHTML = `<span class="flex items-center"><svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>جاري الحفظ...</span>`;

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    console.log('Sending request to:', form.action);

    fetch(form.action, {
        method: 'POST',
        body: new FormData(form),
        headers: { 'X-CSRF-TOKEN': csrfToken }
    })
    .then(response => {
        console.log('Response Status:', response.status);
        console.log('Response Text:', response.statusText);
        if (!response.ok) throw new Error('Network response was not ok ' + response.statusText);
        return response.text();
    })
    .then(text => {
        try {
            const data = JSON.parse(text);
            if (data.success) {
                window.location.href = data.redirect;
            } else {
                alert(data.message || 'حدث خطأ أثناء الحفظ');
                submitBtn.disabled = false;
                submitText.textContent = 'حفظ العرض';
            }
        } catch (e) {
            console.log('Raw Response:', text);
            alert('الاستجابة غير صالحة: ' + e.message);
            submitBtn.disabled = false;
            submitText.textContent = 'حفظ العرض';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('حدث خطأ غير متوقع: ' + error.message);
        submitBtn.disabled = false;
        submitText.textContent = 'حفظ العرض';
    });
}

document.getElementById('contractorOfferForm').addEventListener('submit', handleSubmit);

document.getElementById('contractorOfferForm').addEventListener('submit', function(e) {
    handleSubmit(e);
});

    // إضافة Event Listener للـ Form
    document.getElementById('contractorOfferForm').addEventListener('submit', function(e) {
        handleSubmit(e);
    });

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

    // إغلاق بالزر ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeContractorModal();
        }
    });

    // عرض اسم الملف عند اختياره
    document.getElementById('pdf_file').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name || 'لم يتم اختيار ملف';
        const uploadArea = e.target.previousElementSibling;
        uploadArea.innerHTML = `
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <i class="fas fa-file-pdf text-3xl text-red-500 mb-2"></i>
                <p class="mb-1 text-sm text-gray-700 font-medium">${fileName}</p>
                <p class="text-xs text-gray-500">انقر لتغيير الملف</p>
            </div>
        `;
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
</body>
</html>