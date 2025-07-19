@extends('layouts.app')
@section('css')
    <style>
        /* Custom Styles */
        .hero-section {
            background-color: #E7E5F9;
            padding: 100px 0;
        }

        .section-title {
            font-weight: 700;
            color: #333;
        }

        .section-title span {
            color: #1E90FF;
        }

        .section-subtitle {
            color: #808080;
            font-weight: 500;
        }

        .btn-primary {
            background-color: #1E90FF;
            border-color: #1E90FF;
        }

        .steps-section {
            background-color: white;
            padding: 80px 0;
        }

        .step-card {
            text-align: center;
            margin-bottom: 30px;
        }

        .step-card img {
            margin-bottom: 15px;
        }

        .cost-section {
            background: linear-gradient(to bottom, #E7E5F9, #1E90FF);
            padding: 100px 0;
        }

        .cost-step {
            position: relative;
            margin-bottom: 20px;
        }

        .cost-step-number {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: #4361EE;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .about-section {
            background-color: #F3F3F3;
            padding: 80px 0;
            text-align: center;
        }

        .stat-card {
            background-color: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            background-color: #4361EE;
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
        }

        .testimonials-section {
            padding: 80px 0;
            background-color: white;
        }

        .testimonial-card {
            background-color: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .testimonial-icon {
            position: absolute;
            top: 15px;
            right: 15px;
        }

        @media (min-width: 992px) {
            .cost-image {
                margin-left: 80px;
            }
        }
    </style>
@endsection
@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1 class="section-title display-4 mb-4">
                        <span>ابدأ رحلة مشروعك</span>
                    </h1>
                    <p class="section-subtitle fs-4 mb-4">مستقبل أفضل لك ولعائلتك</p>
                    <p class="section-subtitle fs-4 mb-5">
                        تنفيذ أفكارك وأحلامك وكل ما تريده أصبح على بعد خطوة واحدة من الآن
                    </p>
                    <img src="{{ asset('images/startYourProjectImage.png') }}" class="img-fluid mb-4" style="max-width: 590px;"
                        alt="صورة بدء المشروع">
                    <button class="btn btn-primary btn-lg d-lg-none">
                        ابدأ الآن
                        <i class="bi bi-arrow-left ms-2"></i>
                    </button>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="d-flex flex-column justify-content-between h-100">
                        <div class="text-center mb-5">
                            <h2 class="display-3 fw-bold mb-3">اكتشف المزيد</h2>
                            <p class="fs-4" style="width: 80%; margin: 0 auto;">
                                رؤية شاملة لتقدير تكلفة مشروعك مع منصة إنشاء
                            </p>
                        </div>
                        <div>
                            <h3 class="fs-2 fw-bold mb-4">
                                رؤية شاملة لتقدير تكلفة مشروعك مع منصة إنشاء
                            </h3>
                            <button class="btn btn-primary btn-lg">
                                ابدأ الآن
                                <i class="bi bi-arrow-left ms-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Steps Section -->
    <section class="steps-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="section-title display-4 mb-4">خطوات بناء مشروعك</h2>
                    <p class="section-subtitle fs-4 mb-5">تعرف على مراحل ومتطلبات بناء منزلك الخاص</p>

                    <div class="row">
                        <!-- Step 1 -->
                        <div class="col-md-6 col-lg-4">
                            <div class="step-card">
                                <img src="{{ asset('images/step1.png') }}" alt="تعرف على متطلبات بناء منزل"
                                    class="img-fluid">
                                <h4 class="fw-bold mb-2">تعرف على متطلبات بناء منزل</h4>
                                <p class="text-muted">تعرف على كل ما تحتاجه لبناء منزل أحلامك</p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="col-md-6 col-lg-4">
                            <div class="step-card">
                                <img src="{{ asset('images/step2.png') }}" alt="تعيين الاستشارى الخاص بك" class="img-fluid">
                                <h4 class="fw-bold mb-2">تعيين الاستشاري الخاص بك</h4>
                                <p class="text-muted">اختر من بين أفضل الاستشاريين لمساعدتك</p>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="col-md-6 col-lg-4">
                            <div class="step-card">
                                <img src="{{ asset('images/step3.png') }}" alt="مراجعة تصميمك" class="img-fluid">
                                <h4 class="fw-bold mb-2">مراجعة تصميمك</h4>
                                <p class="text-muted">احصل على تصميم مثالي يناسب احتياجاتك</p>
                            </div>
                        </div>

                        <!-- Step 4 -->
                        <div class="col-md-6 col-lg-4">
                            <div class="step-card">
                                <img src="{{ asset('images/step4.png') }}" alt="اختيار المقاول المناسب" class="img-fluid">
                                <h4 class="fw-bold mb-2">اختيار المقاول المناسب</h4>
                                <p class="text-muted">اختر المقاول الأكثر كفاءة لتنفيذ مشروعك</p>
                            </div>
                        </div>

                        <!-- Step 5 -->
                        <div class="col-md-6 col-lg-4">
                            <div class="step-card">
                                <img src="{{ asset('images/step5.png') }}" alt="تتبع اعمال البناء" class="img-fluid">
                                <h4 class="fw-bold mb-2">تتبع أعمال البناء</h4>
                                <p class="text-muted">تابع تقدم مشروعك خطوة بخطوة</p>
                            </div>
                        </div>

                        <!-- Step 6 -->
                        <div class="col-md-6 col-lg-4">
                            <div class="step-card">
                                <img src="{{ asset('images/step6.png') }}" alt="استعد لبناء منزلك" class="img-fluid">
                                <h4 class="fw-bold mb-2">استعد لبناء منزلك</h4>
                                <p class="text-muted">احصل على منزل أحلامك بأعلى معايير الجودة</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 d-flex align-items-center justify-content-center">
                    <img src="{{ asset('images/build-your-project-step.jpg') }}" class="img-fluid rounded-top-right-lg"
                        style="max-height: 530px;" alt="مراحل بناء المشروع">
                </div>
            </div>
        </div>
    </section>

    <!-- Cost Section -->
    <section class="cost-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12">
                    <h5 class="text-primary fw-bold">تقدير التكلفة</h5>
                    <h2 class="text-white fw-bold display-5">احسب تكلفة مشروعك في 3 خطوات بسيطة</h2>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <img src="{{ asset('images/coastImage.svg') }}" class="img-fluid cost-image rounded-top-left-100"
                        alt="تقدير التكلفة">
                </div>

                <div class="col-lg-6">
                    <div class="cost-step">
                        <span class="cost-step-number">1</span>
                        <button class="btn btn-light w-100 py-3 text-start fw-bold shadow-sm">
                            اختر نوع المشروع والمساحة
                        </button>
                    </div>

                    <div class="cost-step">
                        <span class="cost-step-number">2</span>
                        <button class="btn btn-light w-100 py-3 text-start fw-bold shadow-sm">
                            حدد المواصفات والمتطلبات
                        </button>
                    </div>

                    <div class="cost-step">
                        <span class="cost-step-number">3</span>
                        <button class="btn btn-light w-100 py-3 text-start fw-bold shadow-sm">
                            احصل على التكلفة التقديرية
                        </button>
                    </div>

                    <button class="btn btn-primary btn-lg mt-4">
                        جربها الآن
                        <i class="bi bi-arrow-left ms-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <h2 class="section-title text-primary mb-3">عن منصة إنشاء</h2>
            <p class="section-subtitle mb-3">منصة رقمية متكاملة لخدمات البناء والتشييد</p>
            <p class="section-subtitle mb-5">نسهل عليك رحلة بناء منزل أحلامك من البداية للنهاية</p>

            <div class="row">
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-search fs-4"></i>
                        </div>
                        <h3 class="text-primary display-4 fw-bold">500+</h3>
                        <p class="text-muted">مشروع تم تنفيذهم بنجاح</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-person fs-4"></i>
                        </div>
                        <h3 class="text-primary display-4 fw-bold">120+</h3>
                        <p class="text-muted">استشاري بناء محترف</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-house fs-4"></i>
                        </div>
                        <h3 class="text-primary display-4 fw-bold">300+</h3>
                        <p class="text-muted">عميل راضٍ عن خدماتنا</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <p class="text-primary fw-bold fs-5">آراء العملاء</p>
                    <h2 class="section-title mb-4">ما يقولونه عنا</h2>

                    <div class="d-none d-lg-flex gap-3 mt-5">
                        <button class="btn btn-outline-primary rounded-circle p-3">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                        <button class="btn btn-outline-primary rounded-circle p-3">
                            <i class="bi bi-arrow-left"></i>
                        </button>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="testimonial-card">
                        <img src="{{ asset('images/userComment.svg') }}" class="testimonial-icon" width="30"
                            alt="صورة العميل">
                        <p class="fs-5 mb-4">
                            "لقد ساعدتني منصة إنشاء بشكل كبير في تقدير تكلفة مشروعي بدقة، ووفرت علي الكثير من الوقت والجهد
                            في البحث عن مقاولين واستشاريين موثوقين."
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex gap-1 text-warning">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="fw-bold text-primary">أحمد محمد</span>
                                <img src="{{ asset('images/userComment.svg') }}" class="rounded-circle" width="40"
                                    alt="صورة العميل">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-3 mt-4 d-lg-none">
                        <button class="btn btn-outline-primary rounded-circle p-3">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                        <button class="btn btn-outline-primary rounded-circle p-3">
                            <i class="bi bi-arrow-left"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        // Testimonial Carousel
        const testimonials = [{
                text: "لقد ساعدتني منصة إنشاء بشكل كبير في تقدير تكلفة مشروعي بدقة، ووفرت علي الكثير من الوقت والجهد في البحث عن مقاولين واستشاريين موثوقين.",
                name: "أحمد محمد",
                stars: 5
            },
            {
                text: "تجربة ممتازة مع منصة إنشاء، ساعدوني في كل خطوات بناء منزلي من التصميم حتى التنفيذ.",
                name: "سارة عبدالله",
                stars: 5
            },
            {
                text: "الاستشاريون في المنصة محترفون جداً وساعدوني في تحقيق ما أحلم به بدقة واحترافية.",
                name: "خالد علي",
                stars: 4
            }
        ];

        let currentTestimonial = 0;
        const testimonialText = document.querySelector('.testimonial-card p');
        const testimonialName = document.querySelector('.testimonial-card .text-primary');
        const testimonialStars = document.querySelectorAll('.testimonial-card .bi-star-fill');

        function updateTestimonial() {
            testimonialText.textContent = testimonials[currentTestimonial].text;
            testimonialName.textContent = testimonials[currentTestimonial].name;

            // Update stars
            testimonialStars.forEach((star, index) => {
                if (index < testimonials[currentTestimonial].stars) {
                    star.classList.add('bi-star-fill');
                    star.classList.remove('bi-star');
                } else {
                    star.classList.add('bi-star');
                    star.classList.remove('bi-star-fill');
                }
            });
        }

        document.querySelectorAll('.btn-outline-primary').forEach(button => {
            button.addEventListener('click', (e) => {
                const isNext = e.currentTarget.querySelector('i').classList.contains('bi-arrow-left');

                if (isNext) {
                    currentTestimonial = (currentTestimonial + 1) % testimonials.length;
                } else {
                    currentTestimonial = (currentTestimonial - 1 + testimonials.length) % testimonials
                        .length;
                }

                updateTestimonial();
            });
        });

        // Initialize first testimonial
        updateTestimonial();
    </script>
@endsection
