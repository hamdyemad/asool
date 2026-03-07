@extends('front.layout')

@section('title', 'منتجات وحلول الري الذكي - أصول الزراعة (SOOL)')
@section('meta_description', 'تصفح أحدث منتجات وحلول الري ومحطات مراقبة الطقس من أصول الزراعة. أنظمة تحكم عن بعد، حساسات LoRa، وحلول للفلل والمزارع الذكية.')
@section('meta_keywords', 'منتجات الري الذكي, تحكم في الري عن بعد, حساسات LoRa, محطة طقس زراعية, ري الفلل, الري الحضري, أصول الزراعة, منتجات SOOL')
@section('canonical_url', url('/solutions'))
@section('og_title', 'استكشف منتجات وحلول أصول الزراعة')
@section('og_description', 'مجموعة واسعة من الأجهزة التكنولوجية المصممة للري والزراعات الحديثة.')


@section('extra_css')
<style>
    /* ============================================
       PAGE RESET
    ============================================ */
    html, body {
        overflow-x: hidden;
        background: #000;
    }

    /* ============================================
       SOLUTIONS PAGE - FULL SCREEN SLIDER
    ============================================ */
    .solutions-wrapper {
        position: relative;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        overflow: hidden;
        z-index: 0;
    }

    .solutions-track {
        display: flex;
        flex-direction: column;
        height: 100%;
        transition: transform 0.8s cubic-bezier(0.77, 0, 0.175, 1);
        will-change: transform;
    }

    .solution-slide {
        position: relative;
        width: 100%;
        height: 100vh;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    .slide-bg {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        z-index: 0;
        transform: scale(1.05); /* initial slight zoom for effect */
        transition: transform 2s ease-out;
    }
    
    .solution-slide.active .slide-bg {
        transform: scale(1);
    }

    /* Dark gradient for text readability */
    .slide-bg::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at center, rgba(0,0,0,0) 0%, rgba(0,0,0,0.6) 100%);
    }

    /* ---- Inner Layout (RTL: Right Title, Left Features) ---- */
    .slide-inner {
        position: relative;
        z-index: 2;
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 60px;
        display: flex;
        justify-content: space-between; /* Space between left/right panels */
        align-items: center;
        margin-top: 60px; /* Space for navbar */
    }

    /* Shared Glass Panel Styles */
    .glass-panel {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 30px;
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.6s ease 0.4s, transform 0.6s ease 0.4s;
    }
    
    .solution-slide.active .glass-panel {
        opacity: 1;
        transform: translateY(0);
    }

    /* Left Panel: Features */
    .slide-features-panel {
        width: 400px;
    }

    .slide-features {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .slide-features li {
        font-family: 'Cairo', sans-serif;
        font-size: 15px;
        color: #fff;
        display: flex;
        align-items: center;
        gap: 12px;
        text-shadow: 0 1px 4px rgba(0,0,0,0.5);
    }

    .slide-features li::before {
        content: '\f058'; /* FontAwesome check-circle */
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        color: #fff;
        font-size: 16px;
    }

    /* Right Panel: Title & CTA */
    .slide-title-panel {
        text-align: right;
        padding: 40px;
        border-radius: 20px;
    }

    .slide-title-panel h2 {
        font-family: 'Cairo', sans-serif;
        font-size: 3.5rem;
        font-weight: 800;
        color: #fff;
        margin-bottom: 8px;
        text-shadow: 0 4px 15px rgba(0,0,0,0.5);
    }

    .slide-title-panel .slide-sub {
        font-family: 'Cairo', sans-serif;
        font-size: 18px;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 30px;
    }

    .slide-cta-btn {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background: #68a927;
        color: #fff;
        font-family: 'Cairo', sans-serif;
        font-size: 16px;
        font-weight: 700;
        padding: 12px 28px;
        border-radius: 50px;
        border: 2px solid #8fc945;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .slide-cta-btn:hover {
        background: #558e1c;
        transform: scale(1.05);
        color: #fff;
    }
    
    .btn-icon-circle {
        background: #fff;
        color: #68a927;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }

    /* ---- Scroll Down Hint (Bottom Center) ---- */
    .scroll-hint-wrapper {
        position: absolute;
        bottom: 40px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        opacity: 0;
        transition: opacity 0.5s ease 0.8s;
    }
    
    .solution-slide.active .scroll-hint-wrapper {
        opacity: 1;
    }

    .scroll-hint-btn {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255,255,255,0.4);
        padding: 8px 24px;
        border-radius: 50px;
        color: white;
        font-family: 'Cairo', sans-serif;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        animation: scrollBounce 2s infinite;
    }

    @keyframes scrollBounce {
        0%, 100% { transform: translateY(0); }
        50%       { transform: translateY(10px); }
    }

    /* ============================================
       POPUP MODAL (FIGMA STYLE)
    ============================================ */
    .popup-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.7);
        backdrop-filter: blur(10px);
        z-index: 2000;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        padding-bottom: 20px; /* Space from bottom */
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.35s ease, visibility 0.35s ease;
    }

    .popup-overlay.open {
        opacity: 1;
        visibility: visible;
    }

    .popup-box {
        background: #e9ecf1;
        border-radius: 24px;
        width: min(1300px, 95vw);
        height: 85vh; /* Takes most of the screen below navbar */
        display: block; /* Removed flex since content is absolute */
        box-shadow: 0 24px 80px rgba(0,0,0,0.4);
        transform: scale(0.95) translateY(20px);
        transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
        overflow: hidden;
    }

    .popup-overlay.open .popup-box {
        transform: scale(1) translateY(0);
    }

    /* Red Close Button (Top Left) */
    .popup-close {
        position: absolute;
        top: 30px;
        left: 30px;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #e53935; /* Red */
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        color: #fff;
        z-index: 20;
        transition: transform 0.2s;
    }

    .popup-close:hover {
        transform: scale(1.15);
    }

    .popup-img-model {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover; /* Takes the full width & height */
        object-position: center;
        z-index: 1;
    }

    /* Absolute Overlay for Text */
    .popup-text-overlay {
        position: absolute;
        top: 50px;
        right: 50px;
        display: flex;
        flex-direction: column;
        text-align: right;
        z-index: 10;
        max-width: 450px;
    }

    /* Popup Tags and text */
    .usage-tag {
        background: #eef8df;
        color: #68a927;
        padding: 6px 16px;
        border-radius: 5px;
        font-family: 'Cairo', sans-serif;
        font-size: 13px;
        font-weight: 700;
        width: max-content;
        margin-bottom: 20px;
    }

    .popup-title {
        font-family: 'Cairo', sans-serif;
        font-size: 24px;
        font-weight: 800;
        color: #222;
        margin-bottom: 20px;
        line-height: 1.4;
    }

    /* Mini tags row */
    .popup-tags-row {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        justify-content: flex-end;
        margin-top: 10px; /* space between title and tags */
    }

    .mini-tag {
        background: #d8e5c4; /* Slightly darker light-green for visibility */
        color: #4a8a11;
        padding: 6px 24px;
        border-radius: 50px;
        font-family: 'Cairo', sans-serif;
        font-size: 14px;
        font-weight: 700;
    }

    /* Override Navbar just for this page so it floats */
    .navbar {
        position: fixed !important;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
        background: rgba(0,0,0,0.3) !important; /* more transparent */
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    /* Hide global footer just for this page so it floats */
    /* REMOVED footer display rule so it shows correctly at bottom */

    /* ============================================
       RESPONSIVE DESIGN (MOBILE & TABLET)
    ============================================ */
    @media (max-width: 992px) {
        .slide-inner {
            flex-direction: column;
            justify-content: center;
            gap: 20px;
            padding: 0 20px;
            margin-top: 80px; /* clear navbar */
        }
        
        .slide-title-panel {
            text-align: center;
            padding: 15px;
            background: rgba(0,0,0,0.5); /* extra readability */
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 15px;
        }
        
        .slide-title-panel h2 {
            font-size: 2.2rem;
        }
        
        .slide-title-panel .slide-sub {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .slide-features-panel {
            width: 100%;
            max-width: 100%;
            padding: 20px;
        }
        
        .slide-features li {
            font-size: 14px;
        }

        /* Popup Box */
        .popup-box {
            width: 95vw;
            height: 75vh;
        }

        .popup-text-overlay {
            top: auto;
            bottom: 20px; /* Put text at bottom since 3d model usually takes center/top */
            right: 20px;
            left: 20px;
            max-width: calc(100% - 40px);
            background: rgba(255, 255, 255, 0.85);
            padding: 20px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            align-items: center; /* center content */
            text-align: center;
        }

        .popup-tags-row {
            justify-content: center;
        }

        .popup-title {
            font-size: 18px;
        }

        .popup-close {
            top: 20px;
            left: 20px;
        }
    }

    @media (max-width: 576px) {
        .slide-inner {
            margin-top: 70px;
            gap: 15px;
        }
        
        .slide-title-panel h2 {
            font-size: 1.8rem;
        }

        .slide-cta-btn {
            font-size: 14px;
            padding: 10px 20px;
        }

        .slide-features li {
            font-size: 13px;
        }

        .glass-panel {
            padding: 15px;
        }

        .scroll-hint-wrapper {
            bottom: 15px;
        }
        
        .scroll-hint-btn {
            font-size: 12px;
            padding: 6px 16px;
        }

        .popup-text-overlay {
            padding: 15px;
        }

        .popup-title {
            font-size: 16px;
        }

        .mini-tag, .usage-tag {
            font-size: 12px;
            padding: 4px 12px;
        }
    }

    /* ============================================
       SOLUTIONS PAGE - STATIC PRODUCTS SHOWCASE
    ============================================ */
    .solutions-products-showcase {
        padding: 80px 10%;
        background: #fff;
    }

    .solutions-products-showcase .section-title {
        margin-bottom: 50px;
    }

    .solutions-products-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 25px;
    }

    .solutions-products-grid .product-card {
        background: #fff;
        border: 1px solid #f0f0f0;
        border-radius: 16px;
        padding: 25px 20px;
        text-align: center;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
    }

    .solutions-products-grid .product-card:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
        transform: translateY(-5px);
    }

    .solutions-products-grid .product-image {
        height: 200px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
    }

    .solutions-products-grid .product-image img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .solutions-products-grid .product-title {
        font-size: 1.1rem;
        font-weight: 900;
        color: #1a1a2e;
        margin-bottom: 8px;
    }

    .solutions-products-grid .product-subtitle {
        font-size: 0.85rem;
        color: #888;
        font-weight: 600;
        line-height: 1.5;
        margin-bottom: 20px;
        min-height: 40px;
    }

    .solutions-products-grid .product-action {
        display: flex;
        justify-content: center;
    }

    .solutions-products-grid .prod-more-btn {
        display: inline-flex;
        align-items: center;
        border: 1px solid #a4d360;
        border-radius: 30px;
        padding: 4px 15px 4px 5px;
        color: #8fc945;
        font-weight: 800;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s ease;
        gap: 10px;
    }

    .solutions-products-grid .prod-more-btn:hover {
        background: #f0f8e0;
    }

    .solutions-products-grid .prod-more-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: #8fc945;
        color: #fff;
        font-size: 12px;
    }

    @media (max-width: 992px) {
        .solutions-products-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .solutions-products-grid {
            grid-template-columns: 1fr;
        }
        .solutions-products-showcase {
            padding: 50px 5%;
        }
    }
</style>
@endsection

@section('content')

<!-- ============================================
     SOLUTIONS PAGE: Full-Screen Vertical Carousel
============================================ -->
<div class="solutions-wrapper" id="solutionsWrapper">
    <div class="solutions-track" id="solutionsTrack">

        @php
        // Updated with actual image paths from public/front/second_page
        $slides = [
            [
                'bg'       => 'front/second_page/first/6482b3baf7e3071bc66fb1ce461c3cc36a8c09b5.jpg',
                'model'    => 'front/second_page/first/c9211abaf2ec6e9f2478ccffe17a5a60d89c8e21.png',
                'title'    => 'الرى المنزلي',
                'sub'      => 'متصل محلياً، متصل عن بعد',
                'features' => [
                    'التحكم عن بُعد والمدى القصير',
                    'متوافق مع التركيبات الحالية',
                    'مراقبة استهلاك المياه',
                    'أتمتة الري بناءً على بيانات المناخ',
                    'تطبيق ومنصة مجانية'
                ],
                'popup_desc' => 'نظام ري بسيط ومتصل لأصحاب المنازل والمهنيين',
            ],
            [
                'bg'       => 'front/second_page/second/1ca0eebb7d71aeffc5d652195fad8eb175704999.jpg',
                'model'    => 'front/second_page/second/b10248dda44e7eaa0c34ea7e4a78d4c79f419fb9.png',
                'title'    => 'الحديقة المتصلة',
                'sub'      => 'تحكم في حديقتك بسهولة',
                'features' => [
                    'التحكم عن بُعد في الري وحوض السباحة والإضاءة',
                    'برمجة الري السهلة والأتمتة',
                    'تحليل مياه الحوض في الوقت الحقيقي',
                    'خلق أجواء فريدة',
                    'مراقبة استهلاك المياه',
                    'تطبيقات ومنصات فريدة ومجانية'
                ],
                'popup_desc' => 'تطبيق واحد واجهة لحقيقتك بالكامل',
            ],
            [
                'bg'       => 'front/second_page/third/81ddf94452bb419744717eb66f4db4a3923094cf.jpg',
                'model'    => 'front/second_page/third/93e52eca492505dd178faaa30bd0bd8c04a3b918.png',
                'title'    => 'الري الحضري',
                'sub'      => 'تشكيل مدن اليوم والغد.',
                'features' => [
                    'تركيبات قابلة للتوسع:
                    من المشاريع الصغيرة إلى الكبيرة',
                    'إدارة مركزية:
                    أدوات قوية للتحكم عن بُعد',
                    'ري دقيق:
                    تحسين استهلاك المياه',
                    'التزام مستدام:
                    المساهمة في أهداف مدينتك البيئية',
                    'واجهة بديهية وفعالة'
                ],
                'popup_desc' => 'إدارة شاملة للمزارع الكبيرة بكفاءة عالية',
            ],
            [
                'bg'       => 'front/second_page/four/03a91728e37ecf9584db3f5f0e5fdb51a2eb5da6.jpg',
                'model'    => 'front/second_page/four/9ad7929ff70aef2b899769d959fd36f591b0bb41.png',
                'title'    => 'الزراعة المتصلة',
                'sub'      => 'زراعة السوق، زراعة الأشجار، زراعة العنب، المحاصيل في البيوت الزجاجية.',
                'features' => [
                    'تحسين موارد المياه',
                    'مراقبة جذور الأشجار الخاصة بك',
                    'المزامنة التلقائية للمضخة أو صمام التحكم الرئيسي',
                    'الملء التلقائي لخزانات المياه',
                    'تطبيق ومنصة مجانية'
                ],
                'popup_desc' => 'تكنولوجيا إنترنت الأشياء (IoT) المتقدمة للري الضخم',
            ]
        ];
        @endphp

        @foreach($slides as $index => $slide)
        <div class="solution-slide {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}">

            {{-- Background Image --}}
            <div class="slide-bg" style="background-image: url('{{ asset($slide['bg']) }}');"></div>

            {{-- Inner Content --}}
            <div class="slide-inner">

                <div class="slide-title-panel">
                    <h2>{{ $slide['title'] }}</h2>
                    <p class="slide-sub">{{ $slide['sub'] }}</p>

                    <button class="slide-cta-btn" onclick="openPopup({{ $index }})">
                        استكشف حالات الاستخدام
                        <div class="btn-icon-circle"><i class="fas fa-search-plus"></i></div>
                    </button>
                </div>
                <div class="glass-panel slide-features-panel">
                    <ul class="slide-features">
                        @foreach($slide['features'] as $feat)
                            <li>{{ $feat }}</li>
                        @endforeach
                    </ul>
                </div>


            </div>

            {{-- Scroll hint --}}
            @if($index < count($slides) - 1)
            <div class="scroll-hint-wrapper" onclick="goToSlide({{ $index + 1 }})">
                <div class="scroll-hint-btn">
                    مر للأسفل <i class="fas fa-arrow-down"></i>
                </div>
            </div>
            @endif

        </div>
        @endforeach

    </div>
</div>

<!-- ============================================
     NORMAL PAGE CONTENT (Scrolls Natively)
============================================ -->
<div class="normal-content" id="normalContent" style="background: #fff; position: relative; z-index: 10;">

    <!-- Static Products Showcase (Figma Design) -->
    <section class="solutions-products-showcase" id="solutions-products">
        <div class="section-title text-center">
            <span class="badge"><img src="{{ asset('front/services/drop.png') }}" alt="" class="badge-leaf"> المنتجات</span>
            <h2>اكتشفوا منتجاتنا</h2>
        </div>

        <div class="solutions-products-grid">
            <!-- LR-MS-ECO (leftmost in RTL) -->
            <div class="product-card">
                <h4 class="product-title">LR-MS-ECO</h4>
                <p class="product-subtitle">LoRa Regarcheable Sensor Module</p>
                <div class="product-image">
                    <img src="{{ asset('front/second_page/a8a6dafc48e92ebcac2064652e46d0f81cd3d6b4.png') }}" alt="LR-MS-ECO">
                </div>
            </div>

            <!-- Irrigation Station -->
            <div class="product-card">
                <h4 class="product-title">Irrigation Station</h4>
                <p class="product-subtitle">All-in-one 4G Gateway and Weather Station</p>
                <div class="product-image">
                    <img src="{{ asset('front/second_page/0ef74d8784b461d82b8c635657604bb2ae2f3b1c.png') }}" alt="Irrigation Station">
                </div>
            </div>

            <!-- LR-IP-ECO -->
            <div class="product-card">
                <h4 class="product-title">LR-IP-ECO</h4>
                <p class="product-subtitle">LoRa Rechargeable Irrigation Controller ™</p>
                <div class="product-image">
                    <img src="{{ asset('front/second_page/745f60546c5f370624e3ba51148a05644c09e092.png') }}" alt="LR-IP-ECO">
                </div>
            </div>

            <!-- VILLA (rightmost in RTL) -->
            <div class="product-card">
                <h4 class="product-title">VILLA</h4>
                <p class="product-subtitle">Wi-Fi Outdoor AC-Powered Irrigation Controller</p>
                <div class="product-image">
                    <img src="{{ asset('front/second_page/50de94cb37aca8f3795e8acd6dc040906227b247.png') }}" alt="VILLA">
                </div>
            </div>
        </div>
    </section>

    @include('front.components.contact')
</div>

<!-- ============================================
     POPUP MODAL (FIGMA MATCHING)
============================================ -->
<div class="popup-overlay" id="popupOverlay" onclick="closePopupOutside(event)">
    <div class="popup-box" id="popupBox">

        {{-- Main Background Image (Takes Full Width/Height) --}}
        <img class="popup-img-model" id="popupImg" src="" alt="3D Model">

        {{-- Top Left Close (Red circle) --}}
        <button class="popup-close" onclick="closePopup()">
            <i class="fas fa-times"></i>
        </button>

        {{-- Text Area Absolute Overlay (Top Right) --}}
        <div class="popup-text-overlay">
            <span class="usage-tag">حالات الاستخدام</span>
            <h3 class="popup-title" id="popupDesc">نظام ري بسيط ومتصل لأصحاب المنازل والمهنيين</h3>
            
            <div class="popup-tags-row" id="popupTagsContainer">
                <!-- Tags will go here handled by JS -->
            </div>
        </div>

    </div>
</div>

@endsection

@section('extra_js')
<script>
    // ============================================
    // DATA
    // ============================================
    const slidesData = @json($slides);

    // ============================================
    // SLIDER LOGIC
    // ============================================
    let currentSlide    = 0;
    let isAnimating     = false;
    const track         = document.getElementById('solutionsTrack');
    const allSlides     = document.querySelectorAll('.solution-slide');
    const totalSlides   = {{ count($slides) }};

    function goToSlide(index) {
        if (isAnimating || index < 0 || index >= totalSlides || index === currentSlide) return;
        isAnimating  = true;
        
        // Remove active class from old slide
        allSlides[currentSlide].classList.remove('active');
        
        currentSlide = index;
        track.style.transform = `translateY(-${index * 100}vh)`;

        // Add active class to new slide for animations
        setTimeout(() => {
            allSlides[currentSlide].classList.add('active');
        }, 300);

        setTimeout(() => { isAnimating = false; }, 850);
    }

    // --- Mouse Wheel ---
    let wheelCooldown = false;
    window.addEventListener('wheel', (e) => {
        const isAtTop = window.scrollY <= 5;
        const scrollingDown = e.deltaY > 0;
        const scrollingUp = e.deltaY < 0;

        if (isAtTop) {
            // Prevent default native scroll if we're still navigating slides
            if (scrollingDown && currentSlide < totalSlides - 1) {
                e.preventDefault();
                if (isAnimating || wheelCooldown) return;
                wheelCooldown = true;
                setTimeout(() => { wheelCooldown = false; }, 1000);
                goToSlide(currentSlide + 1);
            } else if (scrollingUp && currentSlide > 0) {
                e.preventDefault();
                if (isAnimating || wheelCooldown) return;
                wheelCooldown = true;
                setTimeout(() => { wheelCooldown = false; }, 1000);
                goToSlide(currentSlide - 1);
            }
        }
    }, { passive: false });

    // --- Touch Swipe ---
    let touchStartY = 0;
    window.addEventListener('touchstart', e => {
        touchStartY = e.changedTouches[0].clientY;
    }, { passive: false });

    window.addEventListener('touchmove', e => {
        const isAtTop = window.scrollY <= 5;
        const touchCurrentY = e.changedTouches[0].clientY;
        const diff = touchStartY - touchCurrentY;

        if (isAtTop) {
            if (diff > 0 && currentSlide < totalSlides - 1) {
                e.preventDefault(); // swipe up (scroll down) -> lock native scroll
            } else if (diff < 0 && currentSlide > 0) {
                e.preventDefault(); // swipe down (scroll up) -> lock native scroll
            }
        }
    }, { passive: false });

    window.addEventListener('touchend', e => {
        const isAtTop = window.scrollY <= 5;
        const diff = touchStartY - e.changedTouches[0].clientY;

        if (isAtTop && !isAnimating) {
            if (diff > 50 && currentSlide < totalSlides - 1) {
                goToSlide(currentSlide + 1);
            } else if (diff < -50 && currentSlide > 0) {
                goToSlide(currentSlide - 1);
            }
        }
    }, { passive: true });

    // --- Keyboard ---
    window.addEventListener('keydown', e => {
        if (e.key === 'ArrowDown' || e.key === 'PageDown') goToSlide(currentSlide + 1);
        if (e.key === 'ArrowUp'   || e.key === 'PageUp')   goToSlide(currentSlide - 1);
        if (e.key === 'Escape') closePopup();
    });

    // ============================================
    // POPUP LOGIC
    // ============================================
    const overlay  = document.getElementById('popupOverlay');
    const popupImg = document.getElementById('popupImg');

    function openPopup(index) {
        const s = slidesData[index];

        document.getElementById('popupDesc').textContent = s.popup_desc;
        
        // Render Tags
        const tagsContainer = document.getElementById('popupTagsContainer');
        if (tagsContainer) {
            tagsContainer.innerHTML = '';
            if (s.tags && s.tags.length > 0) {
                s.tags.forEach(tag => {
                    let span = document.createElement('span');
                    span.className = 'mini-tag';
                    span.textContent = tag;
                    tagsContainer.appendChild(span);
                });
            }
        }

        // Set Image
        popupImg.src = "{{ asset('') }}" + s.model;

        overlay.classList.add('open');
    }

    function closePopup() {
        overlay.classList.remove('open');
    }

    function closePopupOutside(e) {
        if (e.target === overlay) closePopup();
    }
</script>
@endsection
