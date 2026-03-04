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
