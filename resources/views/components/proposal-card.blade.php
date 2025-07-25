@php
    $user = $proposal->consultant ?? $proposal->contractor;
    $role = $proposal->role == 'consultant' ? 'الاستشاري' : 'المقاول';
@endphp

<div class="flex flex-row-reverse gap-4 items-stretch bg-white shadow-lg rounded-xl mb-4 p-4 border">

    <!-- بيانات المستخدم (استشاري أو مقاول) -->
    <div class="flex flex-col items-center justify-center min-w-[180px] border-l pl-4">
        <img src="{{ $user->image ? asset('storage/' . $user->image) : 'https://randomuser.me/api/portraits/men/32.jpg' }}" 
             alt="صورة {{ $role }}" 
             class="w-14 h-14 rounded-full object-cover mb-2">
        <div class="font-bold text-base mb-1">{{ $user->first_name }} {{ $user->last_name }}</div>
        <div class="text-xs text-gray-500 mb-1">{{ $role }}</div>
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
                @if($f['file'] && (auth()->id() == $projectItem->user_id || (auth()->user()->role == 'contractor' && $projectItem->contractor_id == auth()->id() && $proposal->status == 'accepted')))
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

    <!-- أزرار القبول والتواصل -->
    @auth
        @if (auth()->id() === $projectItem->user_id)
            @if ($proposal->status !== 'accepted')
                <div id="accept-offer-wrapper-{{ $proposal->id }}">
                    <button type="button"
                        class="bg-green-500 text-white rounded px-4 py-2 font-bold hover:bg-green-600 transition mb-2"
                        onclick="acceptOffer({{ $proposal->id }})">
                        قبول العرض
                    </button>
                </div>
            @else
                <div class="bg-green-100 text-green-700 rounded px-4 py-2 font-bold mb-2 text-center">
                    تم القبول وسيتم التواصل معك
                </div>
            @endif
        @endif
    @endauth

    <button 
        onclick="alert('الإيميل: {{ $user->email }}\nرقم الهاتف: {{ $user->phone ?? 'غير متوفر' }}')"
        class="bg-white border border-green-200 text-green-700 rounded px-4 py-2 font-bold text-center hover:bg-green-50 transition"
    >
        تواصل مع {{ $role }}
    </button>
</div>
