<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>أصول الزراعة - حلول ري وزراعة ذكية</title>
    
    <!-- Google Fonts: Cairo -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            
            <button class="mobile-toggle-btn" id="mobileToggleBtn" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Vision 2030 Logo (Left side in RTL = appears on left visually) -->
            <div class="vision-logo">
                <img src="{{ asset('front/0c86d460576b502caedf188318127fd7e3f865e8.png') }}" alt="Vision 2030">
            </div>

            <!-- Floating Navbar Capsule (Center) -->
            <div class="nav-capsule" id="navCapsule">
                <div class="nav-download">
                    <a href="#"><i class="fas fa-download"></i> تحميل الكتالوج</a>
                </div>
                <ul class="nav-menu">
                    <li><a href="#contact">تواصل معنا</a></li>
                    <li><a href="#partners">شركاء النجاح</a></li>
                    <li><a href="#products">منتجاتنا <i class="fas fa-chevron-down"></i></a></li>
                    <li><a href="#services">خدماتنا <i class="fas fa-chevron-down"></i></a></li>
                    <li><a href="#about">من نحن <i class="fas fa-chevron-down"></i></a></li>
                    <li class="active"><a href="#hero">الرئيسية</a></li>
                </ul>
            </div>

            <!-- SOOL Logo (Right side in RTL = appears on right visually) -->
            <div class="main-logo">
                <img src="{{ asset('front/1e322c96b6a50c814a9fb5592f6b39e2ae162035.png') }}" alt="SOOL">
            </div>
        </div>
    </nav>

    <!-- Hero Section with Carousel -->
    <header class="hero" id="hero">
        <!-- Carousel Slides -->
        <div class="hero-carousel">
            <div class="hero-slide active" style="background-image: url('{{ asset('front/142aca30b5a930c7b79a280b89dba7769397a052.png') }}');"></div>
            <div class="hero-slide" style="background-image: url('{{ asset('front/54ef89689e971d2970cf8121d2d4f800663a5599.jpg') }}');"></div>
            <div class="hero-slide" style="background-image: url('{{ asset('front/d577a493b828026c11f4d6ef16c920c996469006.jpg') }}');"></div>
        </div>

        <!-- Dark overlay gradient -->
        <div class="hero-overlay"></div>

        <div class="hero-content">
            <!-- Badge -->
            <div class="hero-badge">
                <span id="hero-badge-text">الشريك الموثوق لحلول الري وزراعة</span>
                <img src="{{ asset('front/Button.png') }}" alt="icon" class="hero-badge-icon">
            </div>
            
            <h1 id="hero-title">حلول ري وزراعة ذكية <br> لمستقبل مستدام</h1>
            <p id="hero-desc">في شركة أصول الزراعة للتجارة، نلتزم بتوفير أحدث التقنيات الزراعية وأنظمة الري المبتكرة. نحن نسعى جاهدين لتعزيز الإنتاجية الزراعية وتحسين كفاءة استخدام المياه من خلال حلول مستدامة وموثوقة.</p>
            
            <div class="hero-btns">
                <a href="#" class="btn-green"><img src="{{ asset('front/basil_arrow-up-solid.png') }}" alt="arrow" class="btn-green-icon"> استكشف خدماتنا</a>
                <a href="#products" class="btn-white">منتجاتنا</a>
            </div>
        </div>

        <!-- Hero Thumbnails (Bottom Left visually in RTL) -->
        <div class="hero-thumbs">
            <div class="thumb-item active" data-slide="0"
                 data-badge="الشريك الموثوق لحلول الري وزراعة"
                 data-title="حلول ري وزراعة ذكية <br> لمستقبل مستدام"
                 data-desc="في شركة أصول الزراعة للتجارة، نلتزم بتوفير أحدث التقنيات الزراعية وأنظمة الري المبتكرة. نحن نسعى جاهدين لتعزيز الإنتاجية الزراعية وتحسين كفاءة استخدام المياه من خلال حلول مستدامة وموثوقة.">
                <img src="{{ asset('front/d577a493b828026c11f4d6ef16c920c996469006.jpg') }}" alt="Irrigation">
            </div>
            <div class="thumb-item" data-slide="1"
                 data-badge="الري الذكي و المستدام"
                 data-title="تقنيات زراعية متقدمة لتعزيز الإنتاج"
                 data-desc="نوفر معدات وأنظمة زراعية حديثة تساعد المزارعين والشركات الزراعية على تحقيق أعلى كفاءة تشغيلية وجودة محصولية.">
                <img src="{{ asset('front/54ef89689e971d2970cf8121d2d4f800663a5599.jpg') }}" alt="Irrigation">
            </div>
            <div class="thumb-item" data-slide="2"
                 data-badge="الخيار الأمثل للري"
                 data-title="إدارة مياه ذكية لدعم الزراعة المستدامة"
                 data-desc="حلول متكاملة لإدارة الموارد المائية وتحسين توزيع المياه بما يحقق الاستدامة البيئية ويخفض التكاليف التشغيلية.">
                <img src="{{ asset('front/Slide 16_9 - 1.png') }}" alt="Irrigation">
            </div>
        </div>

        <!-- Hero Progress Dots (Bottom Right visually in RTL) -->
        <div class="hero-progress">
            <div class="progress-dot active" data-slide="0"></div>
            <div class="progress-dot" data-slide="1"></div>
            <div class="progress-dot" data-slide="2"></div>
        </div>
    </header>

    <!-- Strategic Partnership Section (شراكة استراتيجية) -->
    <section class="partnership-section" id="about">
        <div class="partnership-container">
            <div class="partnership-product">
                <img src="{{ asset('front/section2/Frame 1707480293.png') }}" alt="SOLEM LR-NR Tap Timer" class="w-100 solem-card-img">
            </div>
            <div class="partnership-content">
                <div class="partnership-badge">
                    <img src="{{ asset('front/section2/icon5.png') }}" alt="SOLEM LR-NR Tap Timer">
                    شراكة استراتيجية
                </div>
                <h2>شراكة استراتيجية مع رواد حلول الري الذكية</h2>
                <ul class="partnership-list">
                    <li>تفخر شركة أصول الزراعة للتجارة بعقد شراكة استراتيجية مع شركة عالمية رائدة في حلول الري الذكية والتقنيات الزراعية المتصلة، لتقديم أحدث الابتكارات في إدارة المياه والزراعة الدقيقة.</li>
                    <li>نهدف من خلال هذا التعاون إلى توفير حلول متطورة تدعم المشاريع الزراعية وتساعد العملاء على تحقيق أعلى كفاءة في استخدام الموارد المائية.</li>
                </ul>
                <a href="#" class="partnership-btn">اعرف اكثر <span class="partnership-btn-icon"><i class="fas fa-arrow-left"></i></span></a>
            </div>

        </div>

        <!-- 4 Feature Cards -->
        <div class="feature-cards-row">
            <div class="feature-card">
                <div class="feature-card-icon">
                    <img src="{{ asset('front/section2/Icon.png') }}" alt="">
                </div>
                <h4>حلول ري متصلة</h4>
                <p>أنظمة ري ذكية يمكن التحكم بها عن بعد عبر التطبيقات والمنصات الرقمية</p>
            </div>
            <div class="feature-card">
                <div class="feature-card-icon">
                    <img src="{{ asset('front/section2/Icon (1).png') }}" alt="">
                </div>
                <h4>تقنيات زراعة دقيقة</h4>
                <p>حلول تعتمد على البيانات لتحسين إنتاجية المحاصيل وتقليل استهلاك المياه</p>
            </div>
            <div class="feature-card">
                <div class="feature-card-icon">
                    <img src="{{ asset('front/section2/Icon (2).png') }}" alt="">
                </div>
                <h4>منصة رقمية متقدمة</h4>
                <p>لوحات تحكم احترافية لإدارة المشاريع الزراعية بسهولة وكفاءة</p>
            </div>
            <div class="feature-card">
                <div class="feature-card-icon">
                    <img src="{{ asset('front/section2/Icon (3).png') }}" alt="">
                </div>
                <h4>حلول مرنة قابلة للتوسع</h4>
                <p>حلول ري متكاملة تتكيف مع احتياجات المزرعة سواء كانت صغيرة أو متنوعة زراعياً ضخمة</p>
            </div>
        </div>

        <!-- Why Partnership Section -->
        <div class="why-partnership">
            <div class="why-partnership-content">
                <h3>لماذا هذه الشراكة مهمة؟</h3>
                <ul class="why-list">
                    <li><img src="{{ asset('front/section2/righticon.png') }}" class="why-list-icon" alt="Check"> منصة رقمية متقدمة</li>
                    <li><img src="{{ asset('front/section2/righticon.png') }}" class="why-list-icon" alt="Check"> سهولة التحكم والإدارة عبر التطبيقات</li>
                    <li><img src="{{ asset('front/section2/righticon.png') }}" class="why-list-icon" alt="Check"> حلول متكاملة عبر الإنترنت (IoT)</li>
                    <li><img src="{{ asset('front/section2/righticon.png') }}" class="why-list-icon" alt="Check"> أداء موثوق طويل المدى</li>
                    <li><img src="{{ asset('front/section2/righticon.png') }}" class="why-list-icon" alt="Check"> دعم الاستدامة البيئية وتقليل استهلاك المياه</li>
                </ul>
            </div>
            <div class="why-partnership-image">
                <img src="{{ asset('front/section2/Frame 1707480165.png') }}" alt="Irrigation Field">
            </div>
        </div>
    </section>

    <!-- Partners Agents Section (وكلاء اخرون) -->
    <section class="agents-section">
        <div class="agents-title">
            <h2>وكلاء اخرون</h2>
        </div>
        <div class="agents-grid">
            <div class="agent-card">
                <div class="agent-logo">
                    <img src="{{ asset('front/section2/image 11.png') }}" alt="IRRIGPLAST">
                </div>
                <p>تقوم شركة Irrigplast بأنظمة الري، الوليات المتحددة، بالتصوير لمفهوم "الأداء العالي" الذي العمل من خلال تطوير منتجات خاصة على رأسها ومواد أنابيب احترافية جميع منتجات مجموعة استخدامات الأنابيب المائية من مادة الصلبة مصنعة خصيصاً ومحتارة لمقاومة التآكل. يتم تأكيد جودة جميع المنتجات المعملية من خلال نتائج الإختبارات المعملية.</p>
            </div>
            <div class="agent-card">
                <div class="agent-logo">
                    <img src="{{ asset('front/section2/image 10.png') }}" alt="GreenPlains">
                </div>
                <p>تقوم شركة Irriplast لأنظمة الري، الولايات المتحدة، بالترويج لمفهوم "الأداء العالي" للري الفعال من خلال تطوير منتجات تحافظ على الطاقة وتوفر توازنًا استثنائيًا. جميع منتجات مصنوعة باستخدام راتنجات بلاستيكية هندسية مصممة خصيصًا ومختارة لمقاومة التآكل. يتم تأكيد جودة جميع المنتجات من خلال نتائج الاختبارات المعملية.</p>
            </div>
        </div>
    </section>

    <!-- About Us Section with Stats -->
    <section class="about-us-section" id="about-details">
        <div class="about-us-container">
            <div class="about-us-image">
                <img src="{{ asset('front/aboutus/aboutus.png') }}" alt="About Us">
            </div>
            <div class="about-us-content">
                <div class="about-us-badge">
                    <img src="{{ asset('front/aboutus/Icon (1).png') }}" alt="" class="badge-leaf-dark"> من نحن
                </div>
                <h2>شركة أصول الزراعة لتجارة <br>انظمة الرى</h2>
                <ul class="about-us-list">
                    <li>هي شركة متخصصة في تقديم الحلول الزراعية المتكاملة وأنظمة الري الحديثة تعمل على دعم القطاع الزراعي عبر تقنيات مبتكرة تساعد في تحسين الإنتاجية وتحقيق الاستخدام الأمثل للموارد الطبيعية.</li>
                    <li>نلتزم بتقديم حلول مستدامة تعتمد على أحدث التقنيات العالمية مع دعم فني واستشاري متكامل لعملائنا.</li>
                </ul>

                <!-- Stats Counters -->
                <div class="stats-row">
                    <div class="stat-box stat-green">
                        <span class="stat-number">500+</span>
                        <span class="stat-label">مشروع منجز</span>
                    </div>
                    <div class="stat-box stat-light">
                        <span class="stat-number">98%</span>
                        <span class="stat-label">رضا العملاء</span>
                    </div>
                    <div class="stat-box stat-light">
                        <span class="stat-number">+15</span>
                        <span class="stat-label">عام من الخبرة</span>
                    </div>
                    <div class="stat-box stat-light">
                        <span class="stat-number">99%</span>
                        <span class="stat-label">معدل النجاح</span>
                    </div>
                </div>
            </div>
            
        </div>
    </section>

    <!-- Services Grid -->
    <section class="services-section" id="services">
        <div class="section-title">
            <span class="badge"><img src="{{ asset('front/services/drop.png') }}" alt="" class="badge-leaf"> خدماتنا</span>
            <h2>خدمات وحلول اصول</h2>
            <p>نقدم مجموعة متكاملة من الخدمات الزراعية المتخصصة لدعم مشاريعكم</p>
        </div>
        
        <div class="services-grid">
            <!-- Row 1: Large card right + Small card left -->
            <div class="service-card grid-item-1">
                <img src="{{ asset('front/7ba173e3b00f462d703ff1a996b51040e07b4a70.png') }}" alt="Irrigation Design" class="service-bg">
                <div class="service-glass-overlay">
                    <div class="service-glass-top">
                        <div class="service-icon-circle">
                            <img src="{{ asset('front/services/Icon.png') }}" alt="">
                        </div>
                        <span class="service-tag">أنظمة الري الذكية</span>
                    </div>
                    <h3>تصميم وتنفيذ أنظمة الري الحديثة</h3>
                    <p>نصمم وننفذ أنظمة ري متطورة تضمن توزيع المياه بكفاءة عالية وتقليل الهدر وزيادة إنتاجية المحاصيل.</p>
                    <a href="#" class="service-link">اعرف المزيد 
                        <div class="icon">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Row 2: Two equal cards -->
            <div class="service-card grid-item-3">
                <img src="{{ asset('front/48de4df38dced46f505c81dab469130d09f6840b.jpg') }}" alt="Equipment Supply" class="service-bg">
                <div class="service-glass-overlay">
                    <div class="service-glass-top">
                        <div class="service-icon-circle">
                            <img src="{{ asset('front/services/Icon (1).png') }}" alt="">
                        </div>
                        <span class="service-tag">المعدات الزراعية</span>
                    </div>
                    <h3>توريد المعدات والأنظمة الزراعية</h3>
                    <p>نوفر أحدث المعدات والأنظمة الزراعية عالية الجودة لدعم المشاريع الزراعية وتحسين الأداء التشغيلي.</p>
                    <a href="#" class="service-link">اعرف المزيد 
                        <div class="icon">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                    </a>
                </div>
            </div>
            <div class="service-card grid-item-2">
                <img src="{{ asset('front/bab03d9bbf0bb04d1d61d5d24aa45a6d4ac57e57.png') }}" alt="Agriculture Consultation" class="service-bg">
                <div class="service-glass-overlay">
                    <div class="service-glass-top">
                        <div class="service-icon-circle">
                            <img src="{{ asset('front/services/Icon (2).png') }}" alt="">
                        </div>
                        <span class="service-tag">الاستشارات والدعم الفني</span>
                    </div>
                    <h3>الاستشارات الفنية والدعم التقني</h3>
                    <p>يقدم فريقنا المتخصص استشارات فنية متكاملة لمساعدة المزارعين والمشاريع على تحقيق أفضل النتائج والإنتاجية.</p>
                    <a href="#" class="service-link">اعرف المزيد 
                        <div class="icon">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                    </a>
                </div>
            </div>
            


            <div class="service-card grid-item-5">
                <img src="{{ asset('front/f8f4b21f7723543788eb0d086cd69e84a6ff5d53.jpg') }}" alt="Water Management" class="service-bg">
                <div class="service-glass-overlay">
                    <div class="service-glass-top">
                        <div class="service-icon-circle">
                            <img src="{{ asset('front/services/Icon (4).png') }}" alt="">
                        </div>
                        <span class="service-tag">إدارة المياه</span>
                    </div>
                    <h3>حلول إدارة المياه وتحسين كفاءة الري</h3>
                    <p> نقدم حلولًا ذكية لإدارة الموارد المائية وتحسين كفاءة استخدام المياه بما يدعم الاستدامة البيئية ويخفض التكاليف.</p>
                    <a href="#" class="service-link">اعرف المزيد 
                        <div class="icon">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                    </a>
                </div>
            </div>

            <div class="service-card grid-item-4">
                <img src="{{ asset('front/c212f062a0ab00b2cf8292af75b7bd426ba32e03.png') }}" alt="Maintenance" class="service-bg">
                <div class="service-glass-overlay">
                    <div class="service-glass-top">
                        <div class="service-icon-circle">
                            <img src="{{ asset('front/services/Icon (3).png') }}" alt="">
                        </div>
                        <span class="service-tag">التشغيل والصيانة</span>
                    </div>
                    <h3>التشغيل والصيانة لأنظمة الري</h3>
                    <p>نوفر خدمات تشغيل وصيانة احترافية لضمان استمرارية عمل أنظمة الري بأعلى كفاءة وأقل أعطال.</p>
                    <a href="#" class="service-link">اعرف المزيد 
                        <div class="icon">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Sustainable Technology Section (تقنيات مستدامة) -->
    <section class="sustainable-tech" id="sustainable">
        <div class="sust-container">
            
            <!-- Left Side Pills -->
            <div class="sust-col sust-left">
                <!-- Card 4 -->
                <div class="sust-pill">
                    <div class="sust-pill-text">
                        <h4>حلول زراعية متكاملة من التصميم<br>إلى التنفيذ</h4>
                        <p>نوفر خدمة شاملة من التخطيط والاستشارات<br>وصولاً للتنفيذ الكامل</p>
                    </div>
                    <div class="sust-pill-icon bg-light-green">
                        <img src="{{ asset('front/services/next_service/Icon (1).png') }}" alt="Checkmark">
                    </div>
                </div>
                <!-- Card 5 -->
                <div class="sust-pill">
                    <div class="sust-pill-text">
                        <h4>فريق فني واستشاري متخصص</h4>
                        <p>فريقنا من الخبراء والمهندسين الزراعيين ذوي الكفاءة<br>العالية</p>
                    </div>
                    <div class="sust-pill-icon bg-lime-green">
                        <img src="{{ asset('front/services/next_service/Icon (2).png') }}" alt="Users">
                    </div>
                </div>
                <!-- Card 6 -->
                <div class="sust-pill">
                    <div class="sust-pill-text">
                        <h4>التزام بالاستدامة البيئية<br>وكفاءة الموارد</h4>
                        <p>حلول صديقة للبيئة تحافظ على الموارد الطبيعية للأجيال<br>القادمة</p>
                    </div>
                    <div class="sust-pill-icon bg-leaf-green">
                        <i class="fas fa-leaf"></i>
                    </div>
                </div>
            </div>

            <!-- Center Logo Circle -->
            <div class="sust-center">
                <div class="sust-center-circle">
                    <img src="{{ asset('front/services/next_service/اصول 1.png') }}" class="sust-logo-img" alt="SOOL">
                    <h3>تقنيات مستدامة<br>لمستقبل أخضر</h3>
                    <p>نستثمر في أحدث التقنيات لضمان أفضل النتائج</p>
                </div>
            </div>

            <!-- Right Side Pills -->
            <div class="sust-col sust-right">
                <!-- Card 1 -->
                <div class="sust-pill">
                    <div class="sust-pill-icon bg-dark-green">
                        <img src="{{ asset('front/services/next_service/Icon (5).png') }}" alt="Globe">
                    </div>
                    <div class="sust-pill-text">
                        <h4>تقنيات حديثة وفق المعايير<br>العالمية</h4>
                        <p>نستخدم أحدث التقنيات والمعدات المعتمدة عالمياً</p>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="sust-pill">
                    <div class="sust-pill-icon bg-mid-green">
                        <img src="{{ asset('front/services/next_service/Icon (4).png') }}" alt="Headphones">
                    </div>
                    <div class="sust-pill-text">
                        <h4>دعم مستمر وخدمة ما بعد البيع</h4>
                        <p>نلتزم بتقديم الدعم الفني والصيانة المستمرة لضمان<br>استمرارية العمل</p>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="sust-pill">
                    <div class="sust-pill-icon bg-olive-green">
                        <img src="{{ asset('front/services/next_service/Icon (3).png') }}" alt="Target">
                    </div>
                    <div class="sust-pill-text">
                        <h4>حلول مخصصة لكل مشروع</h4>
                        <p>كل مشروع زراعي فريد من نوعه، لذلك نصمم حلولاً<br>تناسب احتياجاتك الخاصة وميزانيتك وأهدافك التشغيلية.</p>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- Market Segments -->
    <section class="markets-section" id="markets">
        <div class="section-title text-center">
            <span class="badge"><img src="{{ asset('front/section2/leaf.png') }}" alt="" class="badge-leaf"> قطاعاتنا</span>
            <h2>الأسواق التي نخدمها</h2>
            <p class="section-desc">نقدم حلولنا المتخصصة لمجموعة واسعة من القطاعات الزراعية والتجارية</p>
        </div>
        <div class="market-grid">
            <div class="market-card bg-mc-1">
                <div class="market-icon"><img src="{{ asset('front/ketatna/Icon (1).png') }}" alt="الحدائق والمناطق الطبيعية"></div>
                <h4>الحدائق والمناطق الطبيعية</h4>
            </div>
            <div class="market-card bg-mc-2">
                <div class="market-icon"><img src="{{ asset('front/ketatna/Icon.png') }}" alt="المزارع التجارية"></div>
                <h4>المزارع التجارية</h4>
            </div>
            <div class="market-card bg-mc-3">
                <div class="market-icon"><img src="{{ asset('front/ketatna/Icon (3).png') }}" alt="المشاريع الزراعية الكبرى"></div>
                <h4>المشاريع الزراعية الكبرى</h4>
            </div>
            <div class="market-card bg-mc-4">
                <div class="market-icon"><img src="{{ asset('front/ketatna/Icon (4).png') }}" alt="شركات الاستثمار الزراعي"></div>
                <h4>شركات الاستثمار الزراعي</h4>
            </div>
            <div class="market-card bg-mc-5">
                <div class="market-icon"><img src="{{ asset('front/ketatna/Icon (5).png') }}" alt="المؤسسات الحكومية والخاصة"></div>
                <h4>المؤسسات الحكومية والخاصة</h4>
            </div>
            <div class="market-card bg-mc-6">
                <div class="market-icon"><img src="{{ asset('front/ketatna/Icon (2).png') }}" alt="مشاريع إدارة المياه"></div>
                <h4>مشاريع إدارة المياه</h4>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="products-section" id="products">
        <div class="section-title text-center">
            <h2>استكشف مجموعتنا المتنوعة من المنتجات</h2>
            <p class="section-desc">نحن نقدم منتجات ذات جودة عالية</p>
        </div>

        <div class="products-container">
            <!-- Sidebar -->
            <div class="products-sidebar">
                <div class="sidebar-badge">
                    منتجاتنا 
                    <img src="{{ asset('front/ketatna/Icon (5).png') }}" class="badge-leaf" alt=""> 
                </div>
                <h3>الأقسام الرئيسية</h3>
                <ul class="sidebar-menu">
                    <li><a href="#" class="active">الري</a></li>
                    <li><a href="#">التنقيط والرشاشات</a></li>
                    <li><a href="#">المحابس</a></li>
                    <li><a href="#">قطع الحديد</a></li>
                    <li><a href="#">الليّات</a></li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="products-main">
                <div class="product-filters">
                    <button class="filter-btn">الكل</button>
                    <button class="filter-btn">رشاش مدفعي</button>
                    <button class="filter-btn">فلتر زراعي</button>
                    <button class="filter-btn active">التنقيط والرشاشات</button>
                </div>
                
                <div class="products-grid">
                    @for($i=1; $i<=8; $i++)
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{ asset('front/image 2.png') }}" alt="Product">
                        </div>
                        <h4 class="product-title">قسام سن خارجي</h4>
                        <div class="product-action">
                            <a href="#" class="prod-more-btn">
                                اعرف المزيد
                                <span class="prod-more-icon"><i class="fas fa-arrow-up"></i></span>
                            </a>
                        </div>
                    </div>
                    @endfor
                </div>

                <div class="products-pagination">
                    <ul>
                        <li><a href="#"><i class="fas fa-angle-right"></i></a></li>
                        <li><a href="#"><i class="fas fa-angle-double-right"></i></a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#" class="active">1</a></li>
                        <li><a href="#"><i class="fas fa-angle-double-left"></i></a></li>
                        <li><a href="#"><i class="fas fa-angle-left"></i></a></li>
                    </ul>
                </div>

                <div class="products-view-all text-center">
                    <a href="#" class="view-all-btn">
                        <span class="view-all-icon"><i class="fas fa-arrow-up"></i></span>
                        عرض جميع المنتجات
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="partners-section" id="partners">
        <div class="partners-header">
            <span class="badge partners-badge">
                <i class="fas fa-chart-line"></i>
                شركاء النجاح
            </span>
            <p class="partners-subtitle">نفخر بثقة العديد من الجهات</p>
        </div>

        <!-- Carousel Wrapper -->
        <div class="partners-carousel-outer">
            <button class="partners-nav-btn partners-prev" id="partnersPrev">
                <i class="fas fa-chevron-right"></i>
            </button>

            <div class="partners-viewport" id="partnersViewport">
                <div class="partners-track" id="partnersTrack">
                    <!-- Partner Cards -->
                    @php $partnerLogos = [
                        '1e322c96b6a50c814a9fb5592f6b39e2ae162035.png',
                        'section2/image 10.png',
                        'section2/image 11.png',
                        '1e322c96b6a50c814a9fb5592f6b39e2ae162035.png',
                        'section2/image 10.png',
                        'section2/image 11.png',
                        '1e322c96b6a50c814a9fb5592f6b39e2ae162035.png',
                        'section2/image 10.png',
                    ]; @endphp

                    @foreach($partnerLogos as $logo)
                    <div class="partner-card">
                        <img src="{{ asset('front/' . $logo) }}" alt="شريك نجاح">
                    </div>
                    @endforeach
                </div>
            </div>

            <button class="partners-nav-btn partners-next" id="partnersNext">
                <i class="fas fa-chevron-left"></i>
            </button>
        </div>
    </section>



    <!-- Contact Section -->
    <section class="contact-section" id="contact">
        <div class="contact-header">
            <span class="badge">
                <img src="{{ asset('front/ketatna/Icon (5).png') }}" class="badge-leaf" alt=""> 
                أصول 
            </span>
            <h2>تواصل معنا</h2>
            <p>يسعدنا استقبال استفساراتكم وطلباتكم على مدار الساعة، فريقنا جاهز لدعمك وتقديم أفضل الحلول والخدمات في أسرع وقت ممكن.</p>
        </div>

        <div class="contact-container">
            <!-- Image (RTL so it appears on the Right) -->
            <div class="contact-image-col">
                <img src="{{ asset('front/54ef89689e971d2970cf8121d2d4f800663a5599.jpg') }}" alt="مزرعة أصول">
            </div>

            <!-- Form (Appears on the Left) -->
            <div class="contact-form-col">
                <form>
                    <div class="form-group custom-input">
                        <input type="text" placeholder="الاسم">
                        <span class="input-icon"><i class="fas fa-user" style="color: #0c6a3a;"></i></span>
                    </div>
                    <div class="form-group custom-input">
                        <input type="tel" placeholder="الهاتف">
                        <span class="input-icon"><i class="fas fa-phone-alt" style="color: #0c6a3a;"></i></span>
                    </div>
                    <div class="form-group custom-input">
                        <input type="email" placeholder="البريد الالكتروني">
                        <span class="input-icon"><i class="fas fa-envelope" style="color: #0c6a3a;"></i></span>
                    </div>
                    <div class="form-group custom-input">
                        <textarea rows="5" placeholder="محتوى الرسالة"></textarea>
                    </div>
                    <button type="submit" class="submit-btn" style="background:#8fc945; color: white;">
                        <span class="submit-icon" style="transform: scaleX(-1); display:inline-block;"><i class="far fa-paper-plane"></i></span> 
                        ارسال
                    </button>
                </form>
            </div>
        </div>
        <div class="grass-bottom"></div>
    </section>

    <!-- Footer -->
    <footer class="footer-area">
        <div class="footer-container">
            
            <!-- Column 1: Expertise & Services -->
            <div class="footer-col">
                <h4 class="footer-title">خبراتنا و خدماتنا</h4>
                <ul class="footer-links-list">
                    <li><a href="#">تصميم وتنفيذ أنظمة الري الحديثة</a></li>
                    <li><a href="#">توريد المعدات والأنظمة الزراعية</a></li>
                    <li><a href="#">الاستشارات الفنية والدعم التقني</a></li>
                    <li><a href="#">حلول إدارة المياه وتحسين كفاءة الري</a></li>
                    <li><a href="#">التشغيل والصيانة لأنظمة الري</a></li>
                </ul>
            </div>

            <!-- Column 2: Important Links -->
            <div class="footer-col footer-col-center">
                <h4 class="footer-title">روابط مهمة</h4>
                <ul class="footer-links-list center-aligned">
                    <li><a href="#">الرئيسية</a></li>
                    <li><a href="#">من نحن</a></li>
                    <li><a href="#">خدماتنا</a></li>
                    <li><a href="#">منتجاتنا</a></li>
                    <li><a href="#">شركاء النجاح</a></li>
                    <li><a href="#">تواصل معنا</a></li>
                </ul>
            </div>

            <!-- Column 3: Logo & Socials -->
            <div class="footer-col footer-logo-col">
                <img src="{{ asset('front/logo.png') }}" alt="SOOL Agriculture" class="footer-logo">
                <h4 class="footer-social-title">وسائل التواصل الاجتماعي</h4>
                <div class="footer-social-icons">
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                </div>
            </div>

        </div>

        <!-- Footer Bottom Contact Info Bar -->
        <div class="footer-contact-bar">
            <!-- Contact Box: Phone -->
            <div class="contact-box">
                <img src="{{ asset('front/footer/1.png') }}">
                <div class="contact-box-text">
                    <span>الهاتف</span>
                    <p dir="ltr">310-437-2766</p>
                </div>
            </div>
            <!-- Contact Box: Email -->
            <div class="contact-box">
                <img src="{{ asset('front/footer/2.png') }}">
                <div class="contact-box-text">
                    <span>البريد الالكتروني</span>
                    <p>unreal@outlook.com</p>
                </div>
            </div>

            <!-- Contact Box: Address -->
            <div class="contact-box">
                <img src="{{ asset('front/footer/3.png') }}">
                <div class="contact-box-text">
                    <span>العنوان</span>
                    <p>706 Campfire Ave. Meriden, CT 06450</p>
                </div>
            </div>
            

            <!-- Contact Box: Fax -->
            <div class="contact-box">
                <img src="{{ asset('front/footer/4.png') }}">
                <div class="contact-box-text">
                    <span>الفاكس</span>
                    <p dir="ltr">+1-000-0000</p>
                </div>
            </div>
            


            

        </div>

        <!-- Copyright -->
        <div class="footer-copyright">
            <p>&copy; 2026 اصول. جميع الحقوق محفوظة.</p>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // ==========================================
        // Hero Carousel / Slider
        // ==========================================
        (function() {
            const slides = document.querySelectorAll('.hero-slide');
            const dots = document.querySelectorAll('.hero-progress .progress-dot');
            const thumbs = document.querySelectorAll('.hero-thumbs .thumb-item');
            
            const badgeText = document.getElementById('hero-badge-text');
            const titleText = document.getElementById('hero-title');
            const descText = document.getElementById('hero-desc');
            const heroContent = document.querySelector('.hero-content');
            
            let currentSlide = 0;
            let autoSlideInterval;

            function goToSlide(index) {
                // Remove active from all
                slides.forEach(s => s.classList.remove('active'));
                dots.forEach(d => d.classList.remove('active'));
                thumbs.forEach(t => t.classList.remove('active'));

                // Set current
                currentSlide = index;
                slides[currentSlide].classList.add('active');
                dots[currentSlide].classList.add('active');
                thumbs[currentSlide].classList.add('active');
                
                // Update Text with smooth fade out/in
                heroContent.style.opacity = 0;
                heroContent.style.transition = 'opacity 0.4s ease-in-out';
                
                setTimeout(() => {
                    const activeThumb = thumbs[currentSlide];
                    badgeText.innerHTML = activeThumb.getAttribute('data-badge');
                    titleText.innerHTML = activeThumb.getAttribute('data-title');
                    descText.innerHTML = activeThumb.getAttribute('data-desc');
                    
                    heroContent.style.opacity = 1;
                }, 400); // Wait for fade out
            }

            function nextSlide() {
                let next = (currentSlide + 1) % slides.length;
                goToSlide(next);
            }

            // Click on dots
            dots.forEach((dot, i) => {
                dot.addEventListener('click', () => {
                    goToSlide(i);
                    resetAutoSlide();
                });
            });

            // Click on thumbs
            thumbs.forEach((thumb, i) => {
                thumb.addEventListener('click', () => {
                    goToSlide(i);
                    resetAutoSlide();
                });
            });

            // Auto slide every 5 seconds
            function startAutoSlide() {
                autoSlideInterval = setInterval(nextSlide, 5000);
            }

            function resetAutoSlide() {
                clearInterval(autoSlideInterval);
                startAutoSlide();
            }

            // Swipe / Touch support for Mobile Dragging
            let touchStartX = 0;
            let touchEndX = 0;
            const heroHeader = document.querySelector('.hero');
            
            heroHeader.addEventListener('touchstart', e => {
                touchStartX = e.changedTouches[0].screenX;
            }, {passive: true});
            
            heroHeader.addEventListener('touchend', e => {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            }, {passive: true});

            function handleSwipe() {
                const SWIPE_THRESHOLD = 50; 
                // RTL Direction
                if (touchEndX < touchStartX - SWIPE_THRESHOLD) {
                    // Swiped Left - Next
                    let next = (currentSlide + 1) % slides.length;
                    goToSlide(next);
                    resetAutoSlide();
                }
                if (touchEndX > touchStartX + SWIPE_THRESHOLD) {
                    // Swiped Right - Prev
                    let prev = (currentSlide - 1 + slides.length) % slides.length;
                    goToSlide(prev);
                    resetAutoSlide();
                }
            }

            startAutoSlide();
        })();

        // Mobile Navbar Toggle
        const mobileToggleBtn = document.getElementById('mobileToggleBtn');
        const navCapsule = document.getElementById('navCapsule');
        if (mobileToggleBtn && navCapsule) {
            mobileToggleBtn.addEventListener('click', function() {
                navCapsule.classList.toggle('show');
            });
        }

        // ==========================================
        // Partners Carousel
        // ==========================================
        (function() {
            const track = document.getElementById('partnersTrack');
            const viewport = document.getElementById('partnersViewport');
            const prevBtn = document.getElementById('partnersPrev');
            const nextBtn = document.getElementById('partnersNext');
            if (!track || !viewport) return;

            let currentIndex = 0;
            let autoInterval;

            function getVisibleCards() {
                const vw = viewport.offsetWidth;
                if (vw < 480) return 1;
                if (vw < 768) return 2;
                if (vw < 1024) return 3;
                return 5;
            }

            function getCardWidth() {
                const cards = track.querySelectorAll('.partner-card');
                if (!cards.length) return 0;
                const gap = 24;
                return cards[0].offsetWidth + gap;
            }

            function getTotalCards() {
                return track.querySelectorAll('.partner-card').length;
            }

            function goTo(index) {
                const total = getTotalCards();
                const visible = getVisibleCards();
                const maxIndex = total - visible;
                currentIndex = Math.max(0, Math.min(index, maxIndex));
                const offset = currentIndex * getCardWidth();
                // RTL: slide opposite direction
                track.style.transform = `translateX(${offset}px)`;
            }

            prevBtn && prevBtn.addEventListener('click', () => { goTo(currentIndex - 1); resetAuto(); });
            nextBtn && nextBtn.addEventListener('click', () => { goTo(currentIndex + 1); resetAuto(); });

            // Touch swipe
            let touchStartX = 0;
            viewport.addEventListener('touchstart', e => { touchStartX = e.changedTouches[0].screenX; }, {passive:true});
            viewport.addEventListener('touchend', e => {
                const diff = e.changedTouches[0].screenX - touchStartX;
                if (Math.abs(diff) > 50) {
                    diff > 0 ? goTo(currentIndex - 1) : goTo(currentIndex + 1);
                    resetAuto();
                }
            }, {passive:true});

            function startAuto() {
                autoInterval = setInterval(() => {
                    const maxIndex = getTotalCards() - getVisibleCards();
                    if (currentIndex >= maxIndex) {
                        goTo(0);
                    } else {
                        goTo(currentIndex + 1);
                    }
                }, 3000);
            }

            function resetAuto() {
                clearInterval(autoInterval);
                startAuto();
            }

            viewport.addEventListener('mouseenter', () => clearInterval(autoInterval));
            viewport.addEventListener('mouseleave', startAuto);

            startAuto();
            window.addEventListener('resize', () => goTo(currentIndex));
        })();
    </script>
    
    <!-- AOS Animation library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Automatically add animation attributes
            const sectionsToAnimate = [
                '.partnership-content',
                '.partnership-product',
                '.feature-card', 
                '.why-partnership-content', 
                '.why-partnership-image',
                '.agent-card', 
                '.about-us-image', 
                '.about-us-content',
                '.section-title', 
                '.service-card', 
                '.sust-pill', 
                '.sust-center-circle', 
                '.market-card', 
                '.products-sidebar', 
                '.product-card', 
                '.contact-container',
                '.footer-col'
            ];
            
            sectionsToAnimate.forEach(selector => {
                document.querySelectorAll(selector).forEach((el, index) => {
                    if(!el.hasAttribute('data-aos')) {
                        el.setAttribute('data-aos', 'fade-up');
                    }
                });
            });
            
            // Initialize AOS
            AOS.init({
                duration: 900,
                once: true,
                offset: 50,
                easing: 'ease-out-cubic'
            });
        });
    </script>
</body>
</html>
