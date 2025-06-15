<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة المشاريع</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
        }
        .active-tab {
            color: #1E90FF;
            position: relative;
        }
        .active-tab::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            left: 0;
            height: 2px;
            background-color: #1E90FF;
        }
        .progress-bar {
            height: 4px;
            background-color: #e5e7eb;
            width: 100%;
        }
        .progress-bar-fill {
            height: 100%;
            background-color: #1E90FF;
            transition: width 0.3s ease;
        }
        .file-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Project Management Container -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-8">إضافة مشروع جديد</h1>

            <!-- Navigation Tabs -->
            <div class="flex flex-col md:flex-row gap-4 md:gap-8 mb-8 border-b border-gray-200">
                <button class="active-tab pb-2 font-bold text-base px-4" data-step="0">
                    إضافة مشروع
                </button>
                <button class="text-gray-500 pb-2 font-bold text-base px-4" data-step="1">
                    عروض المقاولين
                </button>
            </div>

            <!-- Step Content -->
            <div id="step-content">
                <!-- Step 0: New Project -->
                <div id="step-0" class="step-panel">
                    <div class="space-y-6">
                        <!-- Project 1 -->
                        <div class="bg-white shadow-lg rounded-xl">
                            <div class="flex flex-col lg:grid lg:grid-cols-12">
                                <!-- Office Info -->
                                <div class="lg:col-span-3 bg-white p-4 text-center rounded flex flex-col items-center">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="صورة" class="w-16 h-16 rounded-full object-cover mb-2">
                                    <div class="flex justify-center space-x-1 space-x-reverse mb-1">
                                        <i class="fas fa-star text-yellow-400"></i>
                                    </div>
                                    <div class="text-lg lg:text-xl font-medium text-gray-900 mb-1">مكتب هندسي</div>
                                </div>

                                <!-- Files -->
                                <div class="lg:col-span-7 bg-white p-2 rounded md:pt-5">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                                        <!-- File 1 -->
                                        <div class="bg-white border border-blue-500 rounded-lg p-3 text-sm font-semibold flex flex-col justify-between file-card transition duration-200">
                                            <div class="flex gap-2 items-start mb-4">
                                                <i class="fas fa-file-alt mt-1 text-gray-500"></i>
                                                <div>
                                                    <div class="text-gray-700 text-sm font-bold leading-tight">المتطلبات الفنية</div>
                                                    <p class="text-gray-500 text-sm font-semibold">200 KB</p>
                                                </div>
                                            </div>
                                            <button class="bg-purple-100 text-blue-600 text-base font-semibold py-2 rounded-lg flex items-center gap-2 justify-center md:mt-6 cursor-pointer">
                                                <span class="text-base font-medium">رفع</span>
                                                <i class="fas fa-cloud-upload-alt"></i>
                                            </button>
                                        </div>

                                        <!-- File 2 -->
                                        <div class="bg-white border border-blue-500 rounded-lg p-3 text-sm font-semibold flex flex-col justify-between file-card transition duration-200">
                                            <div class="flex gap-2 items-start mb-4">
                                                <i class="fas fa-file-alt mt-1 text-gray-500"></i>
                                                <div>
                                                    <div class="text-gray-700 text-sm font-bold leading-tight">مخطط المشروع</div>
                                                    <p class="text-gray-500 text-sm font-semibold">300 KB</p>
                                                </div>
                                            </div>
                                            <button class="bg-purple-100 text-blue-600 text-base font-semibold py-2 rounded-lg flex items-center gap-2 justify-center md:mt-6 cursor-pointer">
                                                <span class="text-base font-medium">رفع</span>
                                                <i class="fas fa-cloud-upload-alt"></i>
                                            </button>
                                        </div>

                                        <!-- File 3 -->
                                        <div class="bg-white border border-blue-500 rounded-lg p-3 text-sm font-semibold flex flex-col justify-between file-card transition duration-200">
                                            <div class="flex gap-2 items-start mb-4">
                                                <i class="fas fa-file-alt mt-1 text-gray-500"></i>
                                                <div>
                                                    <div class="text-gray-700 text-sm font-bold leading-tight">جدول البناء</div>
                                                    <p class="text-gray-500 text-sm font-semibold">500 KB</p>
                                                </div>
                                            </div>
                                            <button class="bg-purple-100 text-blue-600 text-base font-semibold py-2 rounded-lg flex items-center gap-2 justify-center md:mt-6 cursor-pointer">
                                                <span class="text-base font-medium">رفع</span>
                                                <i class="fas fa-cloud-upload-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="lg:col-span-2 flex flex-col gap-3 mt-4 lg:mt-5">
                                    <button class="bg-blue-600 text-white text-sm lg:text-base font-medium rounded-lg w-full lg:w-[170px] px-5 py-3 md:p-3 cursor-pointer flex items-center justify-center gap-2">
                                        <span>نشر المشروع</span>
                                        <i class="fas fa-arrow-left"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Project 2 -->
                        <div class="bg-white shadow-lg rounded-xl">
                            <div class="flex flex-col lg:grid lg:grid-cols-12">
                                <!-- Office Info -->
                                <div class="lg:col-span-3 bg-white p-4 text-center rounded flex flex-col items-center">
                                    <img src="https://randomuser.me/api/portraits/women/25.jpg" alt="صورة" class="w-16 h-16 rounded-full object-cover mb-2">
                                    <div class="flex justify-center space-x-1 space-x-reverse mb-1">
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <i class="fas fa-star text-yellow-400"></i>
                                    </div>
                                    <div class="text-lg lg:text-xl font-medium text-gray-900 mb-1">مكتب هندسي</div>
                                </div>

                                <!-- Files -->
                                <div class="lg:col-span-7 bg-white p-2 rounded md:pt-5">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                                        <!-- File 1 -->
                                        <div class="bg-white border border-blue-500 rounded-lg p-3 text-sm font-semibold flex flex-col justify-between file-card transition duration-200">
                                            <div class="flex gap-2 items-start mb-4">
                                                <i class="fas fa-file-alt mt-1 text-gray-500"></i>
                                                <div>
                                                    <div class="text-gray-700 text-sm font-bold leading-tight">المتطلبات الفنية</div>
                                                    <p class="text-gray-500 text-sm font-semibold">200 KB</p>
                                                </div>
                                            </div>
                                            <button class="bg-purple-100 text-blue-600 text-base font-semibold py-2 rounded-lg flex items-center gap-2 justify-center md:mt-6 cursor-pointer">
                                                <span class="text-base font-medium">رفع</span>
                                                <i class="fas fa-cloud-upload-alt"></i>
                                            </button>
                                        </div>

                                        <!-- File 2 -->
                                        <div class="bg-white border border-blue-500 rounded-lg p-3 text-sm font-semibold flex flex-col justify-between file-card transition duration-200">
                                            <div class="flex gap-2 items-start mb-4">
                                                <i class="fas fa-file-alt mt-1 text-gray-500"></i>
                                                <div>
                                                    <div class="text-gray-700 text-sm font-bold leading-tight">مخطط المشروع</div>
                                                    <p class="text-gray-500 text-sm font-semibold">300 KB</p>
                                                </div>
                                            </div>
                                            <button class="bg-purple-100 text-blue-600 text-base font-semibold py-2 rounded-lg flex items-center gap-2 justify-center md:mt-6 cursor-pointer">
                                                <span class="text-base font-medium">رفع</span>
                                                <i class="fas fa-cloud-upload-alt"></i>
                                            </button>
                                        </div>

                                        <!-- File 3 -->
                                        <div class="bg-white border border-blue-500 rounded-lg p-3 text-sm font-semibold flex flex-col justify-between file-card transition duration-200">
                                            <div class="flex gap-2 items-start mb-4">
                                                <i class="fas fa-file-alt mt-1 text-gray-500"></i>
                                                <div>
                                                    <div class="text-gray-700 text-sm font-bold leading-tight">جدول البناء</div>
                                                    <p class="text-gray-500 text-sm font-semibold">500 KB</p>
                                                </div>
                                            </div>
                                            <button class="bg-purple-100 text-blue-600 text-base font-semibold py-2 rounded-lg flex items-center gap-2 justify-center md:mt-6 cursor-pointer">
                                                <span class="text-base font-medium">رفع</span>
                                                <i class="fas fa-cloud-upload-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="lg:col-span-2 flex flex-col gap-3 mt-4 lg:mt-5">
                                    <button class="bg-blue-600 text-white text-sm lg:text-base font-medium rounded-lg w-full lg:w-[170px] px-5 py-3 md:p-3 cursor-pointer flex items-center justify-center gap-2">
                                        <span>نشر المشروع</span>
                                        <i class="fas fa-arrow-left"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 1: Contractor Offers -->
                <div id="step-1" class="step-panel hidden">
                    <div class="space-y-6">
                        <!-- Offer 1 -->
                        <div class="bg-white shadow-lg rounded-xl">
                            <div class="flex flex-col lg:grid lg:grid-cols-12">
                                <!-- Office Info -->
                                <div class="lg:col-span-3 bg-white p-4 text-center rounded flex flex-col items-center">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="صورة" class="w-16 h-16 rounded-full object-cover mb-2">
                                    <div class="flex justify-center space-x-1 space-x-reverse mb-1">
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <i class="fas fa-star text-yellow-400"></i>
                                    </div>
                                    <div class="text-lg lg:text-xl font-medium text-gray-900 mb-1">مكتب هندسي</div>
                                    <div class="text-sm text-gray-500">رقم الرخصة: 123456</div>
                                </div>

                                <!-- Files -->
                                <div class="lg:col-span-7 bg-white p-2 rounded md:pt-5">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                                        <!-- File 1 -->
                                        <div class="bg-white border border-blue-500 rounded-lg p-3 text-sm font-semibold flex flex-col justify-between file-card transition duration-200">
                                            <div class="flex gap-2 items-start mb-4">
                                                <i class="fas fa-file-alt mt-1 text-gray-500"></i>
                                                <div>
                                                    <div class="text-gray-700 text-sm font-bold leading-tight">المخطط المعماري</div>
                                                    <p class="text-gray-500 text-sm font-semibold">200 KB</p>
                                                </div>
                                            </div>
                                            <button class="bg-purple-100 text-blue-600 text-base font-semibold py-2 rounded-lg flex items-center gap-2 justify-center md:mt-6 cursor-pointer download-btn">
                                                <span class="text-base font-medium">تحميل</span>
                                                <i class="fas fa-download"></i>
                                            </button>
                                            <div class="progress-bar mt-2 hidden">
                                                <div class="progress-bar-fill" style="width: 0%"></div>
                                            </div>
                                        </div>

                                        <!-- File 2 -->
                                        <div class="bg-white border border-blue-500 rounded-lg p-3 text-sm font-semibold flex flex-col justify-between file-card transition duration-200">
                                            <div class="flex gap-2 items-start mb-4">
                                                <i class="fas fa-file-alt mt-1 text-gray-500"></i>
                                                <div>
                                                    <div class="text-gray-700 text-sm font-bold leading-tight">المخطط الإنشائي</div>
                                                    <p class="text-gray-500 text-sm font-semibold">300 KB</p>
                                                </div>
                                            </div>
                                            <button class="bg-purple-100 text-blue-600 text-base font-semibold py-2 rounded-lg flex items-center gap-2 justify-center md:mt-6 cursor-pointer download-btn">
                                                <span class="text-base font-medium">تحميل</span>
                                                <i class="fas fa-download"></i>
                                            </button>
                                            <div class="progress-bar mt-2 hidden">
                                                <div class="progress-bar-fill" style="width: 0%"></div>
                                            </div>
                                        </div>

                                        <!-- File 3 -->
                                        <div class="bg-white border border-blue-500 rounded-lg p-3 text-sm font-semibold flex flex-col justify-between file-card transition duration-200">
                                            <div class="flex gap-2 items-start mb-4">
                                                <i class="fas fa-file-alt mt-1 text-gray-500"></i>
                                                <div>
                                                    <div class="text-gray-700 text-sm font-bold leading-tight">المخطط الكهربائي</div>
                                                    <p class="text-gray-500 text-sm font-semibold">500 KB</p>
                                                </div>
                                            </div>
                                            <button class="bg-purple-100 text-blue-600 text-base font-semibold py-2 rounded-lg flex items-center gap-2 justify-center md:mt-6 cursor-pointer download-btn">
                                                <span class="text-base font-medium">تحميل</span>
                                                <i class="fas fa-download"></i>
                                            </button>
                                            <div class="progress-bar mt-2 hidden">
                                                <div class="progress-bar-fill" style="width: 0%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="lg:col-span-2 flex flex-col gap-3 mt-4 lg:mt-5">
                                    <button class="bg-green-600 text-white text-sm lg:text-base font-medium rounded-lg w-full lg:w-[170px] px-5 py-3 md:p-5 cursor-pointer accept-offer-btn">
                                        قبول العرض
                                    </button>
                                    <button class="bg-green-100 text-gray-900 text-sm font-medium rounded-lg w-full lg:w-[170px] px-5 py-3 cursor-pointer md:p-5 contact-btn">
                                        التواصل مع المستشار
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Offer 2 -->
                        <div class="bg-white shadow-lg rounded-xl">
                            <div class="flex flex-col lg:grid lg:grid-cols-12">
                                <!-- Office Info -->
                                <div class="lg:col-span-3 bg-white p-4 text-center rounded flex flex-col items-center">
                                    <img src="https://randomuser.me/api/portraits/women/25.jpg" alt="صورة" class="w-16 h-16 rounded-full object-cover mb-2">
                                    <div class="flex justify-center space-x-1 space-x-reverse mb-1">
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <i class="fas fa-star text-yellow-400"></i>
                                    </div>
                                    <div class="text-lg lg:text-xl font-medium text-gray-900 mb-1">مكتب هندسي</div>
                                    <div class="text-sm text-gray-500">رقم الرخصة: 789012</div>
                                </div>

                                <!-- Files -->
                                <div class="lg:col-span-7 bg-white p-2 rounded md:pt-5">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                                        <!-- File 1 -->
                                        <div class="bg-white border border-blue-500 rounded-lg p-3 text-sm font-semibold flex flex-col justify-between file-card transition duration-200">
                                            <div class="flex gap-2 items-start mb-4">
                                                <i class="fas fa-file-alt mt-1 text-gray-500"></i>
                                                <div>
                                                    <div class="text-gray-700 text-sm font-bold leading-tight">المخطط المعماري</div>
                                                    <p class="text-gray-500 text-sm font-semibold">200 KB</p>
                                                </div>
                                            </div>
                                            <button class="bg-purple-100 text-blue-600 text-base font-semibold py-2 rounded-lg flex items-center gap-2 justify-center md:mt-6 cursor-pointer download-btn">
                                                <span class="text-base font-medium">تحميل</span>
                                                <i class="fas fa-download"></i>
                                            </button>
                                            <div class="progress-bar mt-2 hidden">
                                                <div class="progress-bar-fill" style="width: 0%"></div>
                                            </div>
                                        </div>

                                        <!-- File 2 -->
                                        <div class="bg-white border border-blue-500 rounded-lg p-3 text-sm font-semibold flex flex-col justify-between file-card transition duration-200">
                                            <div class="flex gap-2 items-start mb-4">
                                                <i class="fas fa-file-alt mt-1 text-gray-500"></i>
                                                <div>
                                                    <div class="text-gray-700 text-sm font-bold leading-tight">المخطط الإنشائي</div>
                                                    <p class="text-gray-500 text-sm font-semibold">300 KB</p>
                                                </div>
                                            </div>
                                            <button class="bg-purple-100 text-blue-600 text-base font-semibold py-2 rounded-lg flex items-center gap-2 justify-center md:mt-6 cursor-pointer download-btn">
                                                <span class="text-base font-medium">تحميل</span>
                                                <i class="fas fa-download"></i>
                                            </button>
                                            <div class="progress-bar mt-2 hidden">
                                                <div class="progress-bar-fill" style="width: 0%"></div>
                                            </div>
                                        </div>

                                        <!-- File 3 -->
                                        <div class="bg-white border border-blue-500 rounded-lg p-3 text-sm font-semibold flex flex-col justify-between file-card transition duration-200">
                                            <div class="flex gap-2 items-start mb-4">
                                                <i class="fas fa-file-alt mt-1 text-gray-500"></i>
                                                <div>
                                                    <div class="text-gray-700 text-sm font-bold leading-tight">المخطط الكهربائي</div>
                                                    <p class="text-gray-500 text-sm font-semibold">500 KB</p>
                                                </div>
                                            </div>
                                            <button class="bg-purple-100 text-blue-600 text-base font-semibold py-2 rounded-lg flex items-center gap-2 justify-center md:mt-6 cursor-pointer download-btn">
                                                <span class="text-base font-medium">تحميل</span>
                                                <i class="fas fa-download"></i>
                                            </button>
                                            <div class="progress-bar mt-2 hidden">
                                                <div class="progress-bar-fill" style="width: 0%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="lg:col-span-2 flex flex-col gap-3 mt-4 lg:mt-5">
                                    <button class="bg-green-600 text-white text-sm lg:text-base font-medium rounded-lg w-full lg:w-[170px] px-5 py-3 md:p-5 cursor-pointer accept-offer-btn">
                                        قبول العرض
                                    </button>
                                    <button class="bg-green-100 text-gray-900 text-sm font-medium rounded-lg w-full lg:w-[170px] px-5 py-3 cursor-pointer md:p-5 contact-btn">
                                        التواصل مع المستشار
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Offer Acceptance -->
    <div id="offer-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
            <div class="grid grid-cols-12 gap-4 p-5">
                <div class="col-span-2 flex justify-center">
                    <i class="fas fa-check-circle text-green-500 text-4xl"></i>
                </div>
                <div class="col-span-10 px-2 mt-2 text-right">
                    <h2 class="text-lg font-medium text-gray-900 mb-2">
                        تم قبول العرض بنجاح
                    </h2>
                    <p class="text-gray-500 font-medium text-sm leading-relaxed mb-4">
                        شكراً لك على قبول العرض. سيتواصل معك المستشار قريباً لبدء العمل على مشروعك.
                    </p>
                    <div class="flex flex-col-reverse md:flex-row items-center justify-end gap-3">
                        <button type="button" class="px-5 py-2 border border-gray-300 rounded-lg text-gray-700 text-sm font-normal w-full md:w-auto" id="close-modal">
                            إغلاق
                        </button>
                        <button type="button" class="px-5 py-2 bg-blue-500 rounded-lg text-white text-sm font-normal w-full md:w-auto">
                            التواصل مع المستشار
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chat Modal -->
    <div id="chat-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden p-4">
        <div class="bg-white w-full max-w-xl rounded-lg shadow-lg p-6 h-[80vh] flex flex-col relative">
            <button class="absolute top-5 left-4 text-gray-500 hover:text-gray-800 text-xl close-chat">
                <i class="fas fa-times"></i>
            </button>

            <h3 class="text-base font-medium text-gray-500 text-center mb-4">اليوم</h3>

            <div class="flex-1 overflow-auto space-y-4 px-2">
                <!-- Admin Message -->
                <div class="flex items-start gap-2">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Admin" class="w-10 h-10 rounded-full">
                    <div class="text-left">
                        <p class="text-start font-medium text-gray-700 text-sm">مكتب هندسي</p>
                        <div class="flex items-center gap-2">
                            <p class="p-2 rounded-md bg-gray-200 break-all whitespace-pre-wrap w-full text-sm text-gray-800">
                                مرحباً بك! كيف يمكننا مساعدتك في مشروعك اليوم؟
                            </p>
                        </div>
                        <p class="text-xs text-gray-500 text-start">10:30 ص</p>
                    </div>
                </div>

                <!-- User Message -->
                <div class="flex items-start gap-2 flex-row-reverse">
                    <div class="text-right">
                        <p class="text-end font-medium text-gray-700 text-sm">أنت</p>
                        <div class="flex items-center gap-2">
                            <p class="p-2 rounded-md bg-blue-500 text-white text-sm break-all whitespace-pre-wrap w-full">
                                أريد الاستفسار عن التفاصيل الفنية للعرض المقدم
                            </p>
                        </div>
                        <p class="text-xs text-gray-500 text-end">10:35 ص</p>
                    </div>
                </div>
            </div>

            <!-- Message Input -->
            <div class="mt-4 flex items-center gap-2">
                <button class="bg-blue-500 text-white p-3 rounded-lg hover:bg-blue-600">
                    <i class="fas fa-paper-plane"></i>
                </button>
                <textarea class="flex-1 p-2 border border-gray-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" rows="1" placeholder="اكتب رسالتك هنا..."></textarea>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab navigation
            const tabs = document.querySelectorAll('[data-step]');
            const stepPanels = document.querySelectorAll('.step-panel');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const step = this.getAttribute('data-step');

                    // Update active tab
                    tabs.forEach(t => t.classList.remove('active-tab'));
                    tabs.forEach(t => t.classList.add('text-gray-500'));
                    this.classList.add('active-tab');
                    this.classList.remove('text-gray-500');

                    // Show corresponding panel
                    stepPanels.forEach(panel => panel.classList.add('hidden'));
                    document.getElementById(`step-${step}`).classList.remove('hidden');
                });
            });

            // Show offer modal
            const offerButtons = document.querySelectorAll('.accept-offer-btn');
            const offerModal = document.getElementById('offer-modal');
            const closeModal = document.getElementById('close-modal');

            offerButtons.forEach(button => {
                button.addEventListener('click', function() {
                    offerModal.classList.remove('hidden');
                });
            });

            closeModal.addEventListener('click', function() {
                offerModal.classList.add('hidden');
            });

            // Close modal when clicking outside
            offerModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.add('hidden');
                }
            });

            // Show chat modal
            const contactButtons = document.querySelectorAll('.contact-btn');
            const chatModal = document.getElementById('chat-modal');
            const closeChat = document.querySelector('.close-chat');

            contactButtons.forEach(button => {
                button.addEventListener('click', function() {
                    chatModal.classList.remove('hidden');
                });
            });

            closeChat.addEventListener('click', function() {
                chatModal.classList.add('hidden');
            });

            // Close chat modal when clicking outside
            chatModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.add('hidden');
                }
            });

            // File download simulation
            const downloadButtons = document.querySelectorAll('.download-btn');

            downloadButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const card = this.closest('.file-card');
                    const progressBar = card.querySelector('.progress-bar');
                    const progressFill = card.querySelector('.progress-bar-fill');

                    // Hide download button and show progress bar
                    this.classList.add('hidden');
                    progressBar.classList.remove('hidden');

                    // Simulate download progress
                    let progress = 0;
                    const interval = setInterval(() => {
                        progress += 10;
                        progressFill.style.width = `${progress}%`;

                        if (progress >= 100) {
                            clearInterval(interval);
                            setTimeout(() => {
                                progressBar.classList.add('hidden');
                                this.classList.remove('hidden');
                                progressFill.style.width = '0%';
                            }, 1000);
                        }
                    }, 300);
                });
            });
        });
    </script>
</body>
</html>