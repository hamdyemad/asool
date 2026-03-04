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

<script>
    // ==========================================
    // Hero Carousel / Slider
    // ==========================================
    (function () {
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
            slides.forEach(s => s.classList.remove('active'));
            dots.forEach(d => d.classList.remove('active'));
            thumbs.forEach(t => t.classList.remove('active'));

            currentSlide = index;
            slides[currentSlide].classList.add('active');
            dots[currentSlide].classList.add('active');
            thumbs[currentSlide].classList.add('active');

            heroContent.style.opacity = 0;
            heroContent.style.transition = 'opacity 0.4s ease-in-out';

            setTimeout(() => {
                const activeThumb = thumbs[currentSlide];
                badgeText.innerHTML = activeThumb.getAttribute('data-badge');
                titleText.innerHTML = activeThumb.getAttribute('data-title');
                descText.innerHTML = activeThumb.getAttribute('data-desc');
                heroContent.style.opacity = 1;
            }, 400);
        }

        function nextSlide() {
            let next = (currentSlide + 1) % slides.length;
            goToSlide(next);
        }

        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => {
                goToSlide(i);
                resetAutoSlide();
            });
        });

        thumbs.forEach((thumb, i) => {
            thumb.addEventListener('click', () => {
                goToSlide(i);
                resetAutoSlide();
            });
        });

        function startAutoSlide() {
            autoSlideInterval = setInterval(nextSlide, 5000);
        }

        function resetAutoSlide() {
            clearInterval(autoSlideInterval);
            startAutoSlide();
        }

        // Swipe / Touch support
        let touchStartX = 0;
        let touchEndX = 0;
        const heroHeader = document.querySelector('.hero');

        heroHeader.addEventListener('touchstart', e => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        heroHeader.addEventListener('touchend', e => {
            touchEndX = e.changedTouches[0].screenX;
            const SWIPE_THRESHOLD = 50;
            if (touchEndX < touchStartX - SWIPE_THRESHOLD) {
                goToSlide((currentSlide + 1) % slides.length);
                resetAutoSlide();
            }
            if (touchEndX > touchStartX + SWIPE_THRESHOLD) {
                goToSlide((currentSlide - 1 + slides.length) % slides.length);
                resetAutoSlide();
            }
        }, { passive: true });

        startAutoSlide();
    })();
</script>
