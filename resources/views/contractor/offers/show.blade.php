<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تفاصيل العرض</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">تفاصيل العرض #{{ $offer->id }}</h1>
        <div class="bg-white p-4 rounded shadow">
            <p><strong>السعر:</strong> {{ number_format($offer->price) }} ر.س</p>
            <p><strong>المدة:</strong> {{ $offer->timeline }} يوم</p>
            <p><strong>الحالة:</strong> {{ $offer->status }}</p>
            <p><strong>تاريخ الإنشاء:</strong> {{ $offer->created_at->format('Y-m-d') }}</p>
            <p><strong>المشروع:</strong> {{ $offer->project->title ?? 'غير محدد' }}</p>
            <a href="{{ route('contractor.offers.list') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">العودة</a>
        </div>
    </div>
</body>
</html>