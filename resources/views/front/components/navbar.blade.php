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
                <a href="#" onclick="return false;"><i class="fas fa-download"></i> تحميل الكتالوج <i class="fas fa-chevron-down ms-1" style="font-size: 0.8em; margin-right: 8px;"></i></a>
                <ul class="nav-download-dropdown">
                    <li><a href="{{ asset('/front/كتالوج أصول عربي (1).pdf') }}" target="_blank">بالعربية</a></li>
                    <li><a href="{{ asset('/front/كتالوج أصول انجليزي 01.pdf') }}" target="_blank">بالإنجليزية</a></li>
                </ul>
            </div>
            <ul class="nav-menu">
                <li><a href="{{ route('home') }}#contact">تواصل معنا</a></li>
                <li><a href="{{ route('home') }}#partners">شركاء النجاح</a></li>
                <li><a href="{{ route('home') }}#products">منتجاتنا</a></li>
                <li><a href="{{ route('home') }}#services">خدماتنا</a></li>
                <li><a href="{{ route('home') }}#about-details">من نحن</a></li>
                <li class="{{ Request::routeIs('home') ? 'active' : '' }}"><a href="{{ route('home') }}">الرئيسية</a></li>
            </ul>
        </div>

        <!-- SOOL Logo (Right side in RTL = appears on right visually) -->
        <div class="main-logo">
            <img src="{{ asset('front/1e322c96b6a50c814a9fb5592f6b39e2ae162035.png') }}" alt="SOOL">
        </div>
    </div>
</nav>

<script>
    // Navbar scroll effect
    window.addEventListener('scroll', function () {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Mobile Navbar Toggle
    const mobileToggleBtn = document.getElementById('mobileToggleBtn');
    const navCapsule = document.getElementById('navCapsule');
    if (mobileToggleBtn && navCapsule) {
        mobileToggleBtn.addEventListener('click', function () {
            navCapsule.classList.toggle('show');
        });
    }
</script>
