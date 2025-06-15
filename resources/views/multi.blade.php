
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مشاريعي - نظام إدارة المشاريع العقارية</title>
    
    <!-- Bootstrap CSS RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    
    <!-- Cairo Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
            --success-color: #28a745;
            --info-color: #17a2b8;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f5f7fa;
            color: #333;
        }

        .main-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .step-nav {
            background: white;
            border-radius: 12px;
            padding: 0.5rem;
            margin: 1rem 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .step-nav .nav-link {
            color: #6c757d;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
            padding: 0.75rem 1.5rem;
        }

        .step-nav .nav-link.active {
            background-color: var(--primary-color);
            color: white;
        }

        .step-nav .nav-link:hover:not(.active) {
            background-color: #e9ecef;
        }

        .content-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .project-image {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transition: transform 0.3s ease;
        }

        .project-image:hover {
            transform: scale(1.02);
        }

        .agent-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 1rem;
        }

        .agent-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 3px solid #e9ecef;
            margin-bottom: 1rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin: 1.5rem 0;
        }

        .info-item {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            border-right: 4px solid var(--primary-color);
        }

        .info-label {
            font-size: 0.875rem;
            color: #6c757d;
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-weight: 600;
            color: #333;
        }

        .document-card {
            background: white;
            border: 2px dashed #dee2e6;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .document-card:hover {
            border-color: var(--primary-color);
            background-color: rgba(0, 123, 255, 0.05);
        }

        .download-card {
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }

        .download-card:hover {
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .progress-circle {
            width: 200px;
            height: 200px;
            margin: 2rem auto;
        }

        .chart-container {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            margin: 1rem 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
        }

        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
        }

        .step-content {
            display: none;
        }

        .step-content.active {
            display: block;
        }

        .rating {
            color: #ffc107;
        }

        @media (max-width: 768px) {
            .step-nav .nav-link {
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
            }
            
            .content-card {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="main-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="h3 mb-0">مشاريعي</h1>
                    <p class="mb-0 opacity-75">نظام إدارة المشاريع العقارية المتطور</p>
                </div>
                <div class="col-md-4 text-end">
                    <button class="btn btn-outline-light">
                        <i class="fas fa-user me-2"></i>الملف الشخصي
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container mt-4">
        <!-- Step Navigation -->
        <div class="step-nav">
            <ul class="nav nav-pills justify-content-center" id="stepTabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#" data-step="overview">نظرة عامة على المشروع</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-step="documents">المحفوظات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-step="certificates">الشهادات والضمانات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-step="offers">العروض</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-step="statistics">مراحل المشروع</a>
                </li>
            </ul>
        </div>

        <!-- Step 1: Project Overview -->
        <div id="overview" class="step-content active">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="content-card">
                        <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                             alt="مشروع عقاري" class="img-fluid project-image w-100" style="height: 400px; object-fit: cover;">
                        
                        <div class="mt-4">
                            <h3 class="text-primary mb-3">كود على الهنود</h3>
                            <p class="text-muted mb-4">مشروع فلل</p>
                            
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-label">حالة المشروع</div>
                                    <div class="info-value">
                                        <span class="badge bg-success">نشط</span>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">المساحة</div>
                                    <div class="info-value">5 دونم</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">عدد الطوابق</div>
                                    <div class="info-value">2</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">مستوى التشطيب</div>
                                    <div class="info-value">لاكس</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">عدد الغرف</div>
                                    <div class="info-value">5</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">عدد دورات المياه</div>
                                    <div class="info-value">4</div>
                                </div>
                            </div>

                            <h4 class="text-primary mb-3">تفاصيل المشروع</h4>
                            <p class="text-justify">
                                في إطار استراتيجيتنا الطموحة لتطوير القطاع العقاري وتقديم حلول سكنية متطورة تلبي احتياجات السوق المحلي، يأتي مشروع "كود على الهنود" كإضافة نوعية لمحفظتنا الاستثمارية. يقع هذا المشروع الرائد في موقع استراتيجي متميز، حيث يستفيد من القرب من المرافق الأساسية والخدمات الحيوية.

                                يتضمن المشروع مجموعة من الفلل الفاخرة المصممة وفقاً لأحدث المعايير العالمية في التصميم والبناء، مع التركيز على توفير بيئة سكنية صحية ومستدامة. تم تصميم كل فيلا لتوفر أقصى درجات الراحة والخصوصية، مع مساحات واسعة ومرافق عصرية تلبي احتياجات الأسر الحديثة.

                                يتميز المشروع بالمساحات الخضراء الواسعة والمرافق الترفيهية المتنوعة، بالإضافة إلى نظام أمان متطور يعمل على مدار الساعة. كما يضمن الموقع الاستراتيجي سهولة الوصول إلى المدارس والمستشفيات والمراكز التجارية الرئيسية في المنطقة.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="agent-card">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" 
                             alt="كود على الهنود" class="agent-avatar">
                        <h5 class="fw-bold mb-1">كود على الهنود</h5>
                        <p class="text-muted small mb-3">مشروع فلل</p>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary btn-sm">
                                <i class="fas fa-phone me-2"></i>اتصال
                            </button>
                            <button class="btn btn-outline-primary btn-sm">
                                <i class="fab fa-whatsapp me-2"></i>واتساب
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 2: Documents -->
        <div id="documents" class="step-content">
            <div class="content-card">
                <h3 class="text-primary mb-4">المحفوظات</h3>
                
                <div class="row g-4">
                    <!-- Document Upload Sections -->
                    <div class="col-md-4">
                        <div class="document-card">
                            <i class="fas fa-upload fa-3x text-primary mb-3"></i>
                            <h5>قبول العرض</h5>
                            <p class="text-muted small">تواصل مع الاستشاري</p>
                            <button class="btn btn-success mt-2">
                                <i class="fas fa-check me-2"></i>قبول العرض
                            </button>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="document-card">
                            <i class="fas fa-file-alt fa-3x text-info mb-3"></i>
                            <h5>مخطط البناء</h5>
                            <p class="text-muted small">500 KB</p>
                            <button class="btn btn-outline-primary">
                                <i class="fas fa-download me-2"></i>تنزيل
                            </button>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="document-card">
                            <i class="fas fa-file-pdf fa-3x text-danger mb-3"></i>
                            <h5>العرض الفني</h5>
                            <p class="text-muted small">300 KB</p>
                            <button class="btn btn-outline-primary">
                                <i class="fas fa-download me-2"></i>تنزيل
                            </button>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="document-card">
                            <i class="fas fa-file-contract fa-3x text-warning mb-3"></i>
                            <h5>الكلفة التفصيلية للمشروع</h5>
                            <p class="text-muted small">200 KB</p>
                            <button class="btn btn-outline-primary">
                                <i class="fas fa-download me-2"></i>تنزيل
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Download Section -->
                <div class="row mt-5">
                    <div class="col-md-8">
                        <h4 class="text-primary mb-3">المحفوظات المتاحة للتنزيل</h4>
                        
                        <div class="download-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">مخطط البناء</h6>
                                    <small class="text-muted">500 KB</small>
                                </div>
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-download me-2"></i>تنزيل
                                </button>
                            </div>
                        </div>

                        <div class="download-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">العرض الفني</h6>
                                    <small class="text-muted">300 KB</small>
                                </div>
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-download me-2"></i>تنزيل
                                </button>
                            </div>
                        </div>

                        <div class="download-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">الكلفة التفصيلية للمشروع</h6>
                                    <small class="text-muted">200 KB</small>
                                </div>
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-download me-2"></i>تنزيل
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="agent-card">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" 
                                 alt="أحمد للاستشارات الهندسية" class="agent-avatar">
                            <h6 class="fw-bold mb-1">أحمد للاستشارات الهندسية</h6>
                            <p class="text-muted small">رقم الترخيص: 8797415</p>
                            <div class="rating mb-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 3: Certificates -->
        <div id="certificates" class="step-content">
            <div class="content-card">
                <h3 class="text-primary mb-4">الشهادات والضمانات</h3>
                
                <div class="row g-4">
                    <div class="col-md-8">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="download-card text-center">
                                    <i class="fas fa-file-pdf fa-2x text-danger mb-2"></i>
                                    <h6>عقد اتفاق مبدئي</h6>
                                    <small class="text-muted">200 KB</small>
                                    <div class="mt-2">
                                        <button class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="download-card text-center">
                                    <i class="fas fa-file-pdf fa-2x text-danger mb-2"></i>
                                    <h6>عقد اتفاق مبدئي</h6>
                                    <small class="text-muted">200 KB</small>
                                    <div class="mt-2">
                                        <button class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="download-card text-center">
                                    <i class="fas fa-file-pdf fa-2x text-danger mb-2"></i>
                                    <h6>عقد اتفاق مبدئي</h6>
                                    <small class="text-muted">200 KB</small>
                                    <div class="mt-2">
                                        <button class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Simple List View -->
                        <div class="mt-4">
                            <h5 class="mb-3">المستندات والضمانات</h5>
                            
                            <div class="border rounded p-3 mb-2 bg-light">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="fw-bold">الخاتمة للاستشارات الهندسية</span>
                                        <div class="small text-muted">السلام عليكم ورحمة الله</div>
                                        <div class="small text-muted">كيف حالك يا استاذ محمد الرئيسي كل عام وانت بخير</div>
                                    </div>
                                    <div class="small text-muted">الجمعة 26 ديسمبر</div>
                                </div>
                            </div>

                            <div class="border rounded p-3 mb-2 bg-light">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="fw-bold">الخاتمة للاستشارات الهندسية</span>
                                        <div class="small text-muted">السلام عليكم ورحمة الله</div>
                                        <div class="small text-muted">كيف حالك يا استاذ محمد الرئيسي كل عام وانت بخير</div>
                                    </div>
                                    <div class="small text-muted">الجمعة 26 ديسمبر</div>
                                </div>
                            </div>

                            <div class="border rounded p-3 mb-2 bg-light">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="fw-bold">الخاتمة للاستشارات الهندسية</span>
                                        <div class="small text-muted">السلام عليكم ورحمة الله</div>
                                        <div class="small text-muted">كيف حالك يا استاذ محمد الرئيسي كل عام وانت بخير</div>
                                    </div>
                                    <div class="small text-muted">الجمعة 26 ديسمبر</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="agent-card">
                            <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" 
                                 alt="الخاتمة للاستشارات الهندسية" class="agent-avatar">
                            <h6 class="fw-bold mb-1">الخاتمة للاستشارات الهندسية</h6>
                            <p class="text-muted small">رقم الترخيص: 8797415</p>
                            <div class="rating mb-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 4: Offers -->
        <div id="offers" class="step-content">
            <div class="content-card">
                <h3 class="text-primary mb-4">العروض</h3>
                
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="download-card text-center">
                            <i class="fas fa-file-pdf fa-2x text-danger mb-2"></i>
                            <h6>عقد اتفاق مبدئي</h6>
                            <small class="text-muted">200 KB</small>
                            <div class="mt-2">
                                <button class="btn btn-outline-primary btn-sm me-2">
                                    <i class="fas fa-download"></i>
                                </button>
                                <button class="btn btn-primary btn-sm">
                                    تنزيل
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="download-card text-center">
                            <i class="fas fa-file-pdf fa-2x text-danger mb-2"></i>
                            <h6>عقد اتفاق مبدئي</h6>
                            <small class="text-muted">200 KB</small>
                            <div class="mt-2">
                                <button class="btn btn-outline-primary btn-sm me-2">
                                    <i class="fas fa-download"></i>
                                </button>
                                <button class="btn btn-primary btn-sm">
                                    تنزيل
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="download-card text-center">
                            <i class="fas fa-file-pdf fa-2x text-danger mb-2"></i>
                            <h6>عقد اتفاق مبدئي</h6>
                            <small class="text-muted">200 KB</small>
                            <div class="mt-2">
                                <button class="btn btn-outline-primary btn-sm me-2">
                                    <i class="fas fa-download"></i>
                                </button>
                                <button class="btn btn-primary btn-sm">
                                    تنزيل
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="download-card text-center">
                            <i class="fas fa-file-pdf fa-2x text-danger mb-2"></i>
                            <h6>عقد اتفاق مبدئي</h6>
                            <small class="text-muted">200 KB</small>
                            <div class="mt-2">
                                <button class="btn btn-outline-primary btn-sm me-2">
                                    <i class="fas fa-download"></i>
                                </button>
                                <button class="btn btn-primary btn-sm">
                                    تنزيل
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="download-card text-center">
                            <i class="fas fa-file-pdf fa-2x text-danger mb-2"></i>
                            <h6>عقد اتفاق مبدئي</h6>
                            <small class="text-muted">200 KB</small>
                            <div class="mt-2">
                                <button class="btn btn-outline-primary btn-sm me-2">
                                    <i class="fas fa-download"></i>
                                </button>
                                <button class="btn btn-primary btn-sm">
                                    تنزيل
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="download-card text-center">
                            <i class="fas fa-file-pdf fa-2x text-danger mb-2"></i>
                            <h6>عقد اتفاق مبدئي</h6>
                            <small class="text-muted">200 KB</small>
                            <div class="mt-2">
                                <button class="btn btn-outline-primary btn-sm me-2">
                                    <i class="fas fa-download"></i>
                                </button>
                                <button class="btn btn-primary btn-sm">
                                    تنزيل
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 5: Statistics -->
        <div id="statistics" class="step-content">
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="content-card">
                        <h3 class="text-primary mb-4">مراحل المشروع</h3>
                        
                        <!-- Progress Circle -->
                        <div class="text-center mb-4">
                            <div class="progress-circle">
                                <canvas id="progressChart" width="200" height="200"></canvas>
                            </div>
                            <h4 class="text-primary">50%</h4>
                            <p class="text-muted">نسبة الإنجاز الإجمالية للمشروع الحالي</p>
                        </div>

                        <!-- Progress Chart -->
                        <div class="chart-container">
                            <h5 class="mb-3">تقدم المراحل</h5>
                            <canvas id="stagesChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="content-card">
                        <h5 class="text-primary mb-3">اسم المشروع</h5>
                        <p class="text-muted mb-4">اسم المشروع وحدة عديد</p>
                        
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="small">الأساسيات</span>
                                <span class="badge bg-success">مكتملة</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="small">الهيكل</span>
                                <span class="badge bg-warning">يتم مراكمة</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="small">التشطيبات</span>
                                <span class="badge bg-secondary">جاري</span>
                            </div>
                        </div>

                        <div class="text-center">
                            <small class="text-muted d-block mb-2">
                                <span class="text-primary">● الأساسيات</span>
                                <span class="text-warning ms-3">● الهيكل</span>
                                <span class="text-secondary ms-3">● التشطيبات</span>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Tab Navigation
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('[data-step]');
            const contents = document.querySelectorAll('.step-content');
            
            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active class from all tabs and contents
                    tabs.forEach(t => t.classList.remove('active'));
                    contents.forEach(c => c.classList.remove('active'));
                    
                    // Add active class to clicked tab
                    this.classList.add('active');
                    
                    // Show corresponding content
                    const step = this.getAttribute('data-step');
                    document.getElementById(step).classList.add('active');
                });
            });

            // Initialize Charts
            initializeCharts();
        });

        function initializeCharts() {
            // Progress Circle Chart
            const progressCtx = document.getElementById('progressChart').getContext('2d');
            new Chart(progressCtx, {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [50, 50],
                        backgroundColor: ['#007bff', '#e9ecef'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            // Stages Progress Chart
            const stagesCtx = document.getElementById('stagesChart').getContext('2d');
            new Chart(stagesCtx, {
                type: 'line',
                data: {
                    labels: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو'],
                    datasets: [{
                        label: 'الأساسيات',
                        data: [15, 25, 35, 45, 55, 90],
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0, 123, 255, 0.1)',
                        tension: 0.4
                    }, {
                        label: 'الهيكل',
                        data: [10, 20, 30, 40, 50, 50],
                        borderColor: '#ffc107',
                        backgroundColor: 'rgba(255, 193, 7, 0.1)',
                        tension: 0.4
                    }, {
                        label: 'التشطيبات',
                        data: [5, 10, 15, 20, 25, 15],
                        borderColor: '#6c757d',
                        backgroundColor: 'rgba(108, 117, 125, 0.1)',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                callback: function(value) {
                                    return value + '%';
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }
    </script>
</body>
</html>