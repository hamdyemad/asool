<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="author" content="أصول الزراعة - SOOL Agriculture">
    <title>@yield('title', 'أصول الزراعة - حلول ري وزراعة ذكية')</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('meta_description', 'أصول الزراعة - شركة رائدة في حلول الري الذكي والزراعة المستدامة في المملكة العربية السعودية. نقدم أنظمة ري متطورة، استشارات زراعية، ومنتجات تقنية عالية الجودة.')">
    <meta name="keywords" content="@yield('meta_keywords', 'أصول الزراعة, ري ذكي, زراعة مستدامة, أنظمة ري, استشارات زراعية, منتجات زراعية, السعودية, SOOL, حلول ري, تقنيات زراعية')">

    <!-- Canonical URL -->
    @if(trim($__env->yieldContent('canonical_url')))
        <link rel="canonical" href="@yield('canonical_url')">
    @endif

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:locale" content="ar_SA">
    <meta property="og:site_name" content="أصول الزراعة - SOOL">
    <meta property="og:title" content="@yield('og_title', 'أصول الزراعة - حلول ري وزراعة ذكية')">
    <meta property="og:description" content="@yield('og_description', 'شركة رائدة في حلول الري الذكي والزراعة المستدامة في المملكة العربية السعودية.')">
    <meta property="og:image" content="@yield('og_image', asset('front/logo.png'))">
    @if(trim($__env->yieldContent('canonical_url')))
        <meta property="og:url" content="@yield('canonical_url')">
    @endif

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', 'أصول الزراعة - حلول ري وزراعة ذكية')">
    <meta name="twitter:description" content="@yield('og_description', 'شركة رائدة في حلول الري الذكي والزراعة المستدامة في المملكة العربية السعودية.')">
    <meta name="twitter:image" content="@yield('og_image', asset('front/logo.png'))">

    <!-- JSON-LD Structured Data -->
    @yield('structured_data')

    <!-- Google Fonts: Cairo -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('front/logo.png') }}" type="image/x-icon">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-api.css') }}">

    @yield('extra_css')
</head>
<body>

    @include('front.components.navbar')

    @yield('content')

    @include('front.components.footer')

    @yield('extra_js')
    
    @stack('scripts')

    <!-- AOS Animation library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
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
                document.querySelectorAll(selector).forEach((el) => {
                    if (!el.hasAttribute('data-aos')) {
                        el.setAttribute('data-aos', 'fade-up');
                    }
                });
            });

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
