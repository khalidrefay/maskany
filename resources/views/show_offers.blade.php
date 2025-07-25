<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض الاستشاري</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center mb-8">عرض الاستشاري للمشروع: {{ $project->title }}</h1>

        <!-- بيانات العرض -->
        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-4">تفاصيل العرض</h2>
            <div class="space-y-6">
                @foreach($project->proposals as $proposal)
                    @if(auth()->id() == $project->user_id || (auth()->user()->role == 'contractor' && $project->contractor_id == auth()->id() && $proposal->status == 'accepted'))
                        <div class="flex flex-row-reverse gap-4 items-stretch bg-white shadow-lg rounded-xl mb-4 p-4 border">
                            <!-- بيانات الاستشاري -->
                            <div class="flex flex-col items-center justify-center min-w-[180px] border-l pl-4">
                                <img src="{{ $proposal->consultant->image ? asset('storage/' . $proposal->consultant->image) : 'https://randomuser.me/api/portraits/men/32.jpg' }}" 
                                     alt="صورة الاستشاري" 
                                     class="w-14 h-14 rounded-full object-cover mb-2">
                                <div class="font-bold text-base mb-1">{{ $proposal->consultant->first_name }} {{ $proposal->consultant->last_name }}</div>
                                <div class="text-xs text-gray-500 mb-1">الحمد للاستشارات الهندسية</div>
                                <div class="text-xs text-gray-400 mb-1">رقم الترخيص: 8797415</div>
                                <div class="flex items-center mt-1">
                                    <span class="text-yellow-400 mr-1">
                                        @for($i = 0; $i < 5; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                    </span>
                                </div>
                            </div>
                            <!-- بطاقات الملفات -->
                            <div class="flex flex-1 gap-3 flex-wrap items-center justify-center">
                                @php
                                    $files = [
                                        ['label' => 'مخطط البناء', 'file' => $proposal->design_plans[0] ?? null, 'size' => '500 KB'],
                                        ['label' => 'العرض الفني', 'file' => $proposal->design_plans[1] ?? null, 'size' => '300 KB'],
                                        ['label' => 'الكلفة التقديرية للمشروع', 'file' => $proposal->materials_list ?? null, 'size' => '200 KB'],
                                    ];
                                @endphp
                                @foreach($files as $f)
                                    <div class="border rounded-lg p-3 text-center min-w-[160px] bg-white shadow-sm flex flex-col items-center">
                                        <div class="font-bold mb-1">{{ $f['label'] }}</div>
                                        <div class="text-xs text-gray-500 mb-2">{{ $f['size'] }}</div>
                                        @if($f['file'])
                                            <a href="{{ asset('storage/' . $f['file']) }}" 
                                               class="text-blue-600 flex items-center gap-1 border border-blue-100 rounded px-3 py-1 hover:bg-blue-50 transition" 
                                               download>
                                                <i class="fas fa-download"></i> تنزيل
                                            </a>
                                        @else
                                            <span class="text-gray-400">غير متاح</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </section>
    </div>
</body>
</html>