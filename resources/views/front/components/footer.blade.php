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
                <a href="https://www.tiktok.com/@osoolagri"><i class="fab fa-tiktok"></i></a>
                <a href="https://www.instagram.com/osoolagri/"><i class="fab fa-instagram"></i></a>
            </div>
        </div>

    </div>

    <!-- Footer Bottom Contact Info Bar -->
    <div class="footer-contact-bar">
        <div class="contact-box">
            <img src="{{ asset('front/footer/1.png') }}">
            <div class="contact-box-text">
                <span>الهاتف</span>
                <p dir="ltr">+966 598613005</p>
            </div>
        </div>
        <div class="contact-box">
            <img src="{{ asset('front/footer/2.png') }}">
            <div class="contact-box-text">
                <span>البريد الالكتروني</span>
                <p>info@osool1.com</p>
            </div>
        </div>
        <div class="contact-box">
            <img src="{{ asset('front/footer/3.png') }}">
            <div class="contact-box-text">
                <span>العنوان</span>
                <p>7888 شارع الصباح، حي الصباح، وحدة 2936، بريدة 52339، المملكة العربية السعوديه</p>
            </div>
        </div>
    </div>

    <!-- VAT & Registration Info Section -->
    <div class="footer-registration-info" style="background-color: var(--secondary-color); color: var(--white); padding: 40px; border-radius: 16px; max-width: 1300px; width: 90%; margin: 40px auto; display: flex; flex-direction: column; align-items: center; gap: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
        
        <!-- Logo -->
        <div style="display: flex; justify-content: center; align-items: center;">
            <img src="{{ asset('front/logo.png') }}" style="height: 70px; filter: brightness(0) invert(1);" alt="SOOL Agriculture">
        </div>

        <!-- Info Row -->
        <div style="display: flex; flex-wrap: wrap; justify-content: space-around; align-items: center; gap: 20px; width: 100%; border-top: 1px solid rgba(255,255,255,0.1); border-bottom: 1px solid rgba(255,255,255,0.1); padding: 25px 0;">
            
            <!-- Saudi Logo -->
            <div style="display: flex; align-items: center; justify-content: center;">
                <img src="{{ asset('images/saudi.jpg') }}" alt="Saudi" style="height: 80px; object-fit: contain; border-radius: 8px;">
            </div>

            <!-- Tax Number -->
            <div style="text-align: center;">
                <div style="font-size: 1.2rem; margin-bottom: 8px; color: #e5e5e5;">رقم ضريبي</div>
                <div style="font-size: 1.5rem; font-weight: bold; letter-spacing: 1px;">3021305787</div>
            </div>

            <!-- CR Number -->
            <div style="text-align: center;">
                <div style="font-size: 1.2rem; margin-bottom: 8px; color: #e5e5e5;">سجل تجاري</div>
                <div style="font-size: 1.5rem; font-weight: bold; letter-spacing: 1px;">1131299893</div>
            </div>

            <!-- VAT Logo -->
            <div style="display: flex; align-items: center; justify-content: center;">
                <img src="{{ asset('images/vat.jpg') }}" alt="VAT" style="height: 80px; object-fit: contain; border-radius: 8px;">
            </div>
            
        </div>

        <!-- Description -->
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <p style="font-size: 1.2rem; line-height: 1.8; margin: 0; color: #fff; font-weight: 500;">شركة رائدة في مجالات المقاولات والزراعة ومكافحة الآفات بخبرة تمتد لأكثر من 40 عاماً</p>
        </div>
    </div>

    <!-- Copyright -->
    <div class="footer-copyright">
        <p>&copy; 2026 اصول. جميع الحقوق محفوظة.</p>
    </div>
</footer>
