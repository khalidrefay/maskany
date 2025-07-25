<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>معاينة عرض المقاول</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center mb-8">معاينة عرض المقاول للمشروع: {{ $project->title }}</h1>

        <!-- بيانات العرض -->
        <section class="mb-6 bg-white shadow-lg rounded-xl p-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">تفاصيل العرض</h2>
            <div class="space-y-4 text-sm text-gray-600">
                <div><strong>اسم المشروع:</strong> {{ $project->title ?? 'Untitled Project' }}</div>
                <div><strong>السعر:</strong> {{ isset($offer['price']) ? $offer['price'] : ($offer->price ?? 'غير محدد') }} {{ __('projects.currency') }}</div>
                <div><strong>المدة الزمنية:</strong> {{ isset($offer['timeline']) ? $offer['timeline'] : ($offer->timeline ?? 'غير محدد') }} يوم</div>
                <div><strong>التفاصيل:</strong> {{ isset($offer['details']) ? $offer['details'] : ($offer->details ?? 'لا توجد تفاصيل') }}</div>
                @if(isset($offer['pdf_file']) ? $offer['pdf_file'] : ($offer->pdf_file ?? false))
                    <div><strong>ملف PDF:</strong> <a href="{{ asset('storage/' . (isset($offer['pdf_file']) ? $offer['pdf_file'] : $offer->pdf_file)) }}" class="text-blue-600 underline" download>تنزيل الملف</a></div>
                @else
                    <div><strong>ملف PDF:</strong> غير مرفق</div>
                @endif
            </div>
        </section>

        <div class="text-center">
            <!-- Form لحفظ العرض -->
            <form id="contractorOfferForm" method="POST" action="{{ route('contractor.offers.store', ['project' => $project->id]) }}" enctype="multipart/form-data">
    @csrf
    <!-- ... الحقول الأخرى ... -->
    <div class="mt-8 flex justify-end gap-3 border-t pt-6">
        <button type="button" onclick="closeContractorModal()" class="px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition focus:outline-none focus:ring-2 focus:ring-gray-500">إلغاء</button>
        <button type="submit" id="submitButton" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center focus:outline-none focus:ring-2 focus:ring-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                <path fill-rule="evenodd" d="M2 10a8 8 0 1116 0 8 8 0 01-16 0zm8-6a6 6 0 100 12 6 6 0 000-12z" clip-rule="evenodd" />
            </svg>
            <span id="submitText">حفظ العرض</span>
        </button>
    </div>
</form>

            <!-- زر العودة -->
            <a href="{{ route('projects.showConsultantProposal', ['project' => $project->id]) }}"
               class="mt-4 inline-block px-6 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
                العودة لعرض الاستشاري
            </a>

            <!-- زر الحذف (لو العرض محفوظ) -->
            @if(isset($offer->id))
                <form action="{{ route('contractor.offers.destroy', ['project' => $project->id, 'offer' => $offer->id]) }}" method="POST" class="inline-block mt-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition" onclick="return confirm('هل أنت متأكد من حذف العرض؟')">
                        حذف العرض
                    </button>
                </form>
            @endif
        </div>
    </div>
</body>
</html>