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
                @php $partnerLogos = [
                    'logo.png',
                    'logo.png',
                    'logo.png',
                    'logo.png',
                    'logo.png',
                    'logo.png',
                    'logo.png',
                    'logo.png',
                    'logo.png',
                    'logo.png',
                    'logo.png',
                    'logo.png',
                    'logo.png',
                    'logo.png',
                    'logo.png',
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

<script>
    // ==========================================
    // Partners Carousel
    // ==========================================
    document.addEventListener('DOMContentLoaded', function () {
        const track = document.getElementById('partnersTrack');
        const viewport = document.getElementById('partnersViewport');
        const prevBtn = document.getElementById('partnersPrev');
        const nextBtn = document.getElementById('partnersNext');
        if (!track || !viewport) return;

        let currentIndex = 0;
        let autoInterval;

        // Check text direction
        const isRTL = document.documentElement.dir === 'rtl';

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
            // In RTL, we translate positive X to show items overflowing to the left.
            // In LTR, we translate negative X to show items overflowing to the right.
            const translateX = isRTL ? offset : -offset;
            
            track.style.transform = `translateX(${translateX}px)`;
        }

        prevBtn && prevBtn.addEventListener('click', () => { goTo(currentIndex - 1); resetAuto(); });
        nextBtn && nextBtn.addEventListener('click', () => { goTo(currentIndex + 1); resetAuto(); });

        let touchStartX = 0;
        viewport.addEventListener('touchstart', e => { touchStartX = e.changedTouches[0].screenX; }, { passive: true });
        viewport.addEventListener('touchend', e => {
            const diff = e.changedTouches[0].screenX - touchStartX;
            if (Math.abs(diff) > 50) {
                // Adjust touch direction based on RTL/LTR
                if (isRTL) {
                    diff > 0 ? goTo(currentIndex - 1) : goTo(currentIndex + 1);
                } else {
                    diff > 0 ? goTo(currentIndex - 1) : goTo(currentIndex + 1);
                }
                resetAuto();
            }
        }, { passive: true });

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

        // Optional: Ensure first dimension calc is run
        setTimeout(() => goTo(0), 100);
        startAuto();
        window.addEventListener('resize', () => goTo(currentIndex));
    });
</script>
