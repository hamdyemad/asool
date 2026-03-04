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
            <ul class="sidebar-menu" id="categories-sidebar">
                <li><a href="#" class="category-link active" data-category-id="">الكل</a></li>
                <!-- Categories will be loaded here via API -->
            </ul>
            
            <!-- Categories Pagination -->
            <div class="sidebar-pagination" id="categories-pagination" style="margin-top: 15px; text-align: center;">
                <!-- Pagination will be loaded here -->
            </div>
        </div>

        <!-- Main Content -->
        <div class="products-main">
            <div class="product-filters" id="subcategories-filter">
                <button class="filter-btn active" data-subcategory-id="">الكل</button>
                <!-- SubCategories will be loaded here via API -->
            </div>

            <div class="products-grid" id="products-grid">
                <!-- Products will be loaded here via API -->
                <div class="col-12 text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">جاري التحميل...</span>
                    </div>
                </div>
            </div>

            <div class="products-pagination" id="products-pagination">
                <!-- Pagination will be loaded here via API -->
            </div>

            <div class="products-view-all text-center">
                <a href="#" class="view-all-btn" id="view-all-products">
                    <span class="view-all-icon"><i class="fas fa-arrow-up"></i></span>
                    عرض جميع المنتجات
                </a>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    const API_BASE_URL = '/api/public';
    let currentPage = 1;
    let currentCategoryId = '';
    let currentSubCategoryId = '';
    let currentCategoryPage = 1;
    
    // Load data on page load
    document.addEventListener('DOMContentLoaded', function() {
        loadCategories();
        loadProducts();
    });
    
    // Load categories with pagination
    async function loadCategories(page = 1) {
        try {
            const response = await fetch(`${API_BASE_URL}/categories?per_page=10&page=${page}`);
            const data = await response.json();
            
            if (data.success) {
                const sidebar = document.getElementById('categories-sidebar');
                
                // Keep "الكل" option
                sidebar.innerHTML = '<li><a href="#" class="category-link active" data-category-id="">الكل</a></li>';
                
                if (data.data.length > 0) {
                    data.data.forEach(category => {
                        const li = document.createElement('li');
                        li.innerHTML = `<a href="#" class="category-link" data-category-id="${category.id}">${category.name}</a>`;
                        sidebar.appendChild(li);
                    });
                    
                    // Render categories pagination
                    renderCategoriesPagination(data.pagination);
                    
                    // Add click event to category links
                    document.querySelectorAll('.category-link').forEach(link => {
                        link.addEventListener('click', function(e) {
                            e.preventDefault();
                            
                            // Update active state
                            document.querySelectorAll('.category-link').forEach(l => l.classList.remove('active'));
                            this.classList.add('active');
                            
                            // Load products by category
                            currentCategoryId = this.dataset.categoryId;
                            currentSubCategoryId = '';
                            currentPage = 1;
                            
                            // Load subcategories if category selected
                            if (currentCategoryId) {
                                loadSubCategories(currentCategoryId);
                            } else {
                                document.getElementById('subcategories-filter').innerHTML = '<button class="filter-btn active" data-subcategory-id="">الكل</button>';
                            }
                            
                            loadProducts();
                        });
                    });
                }
                
                currentCategoryPage = page;
            }
        } catch (error) {
            console.error('Error loading categories:', error);
        }
    }
    
    // Render categories pagination
    function renderCategoriesPagination(pagination) {
        const container = document.getElementById('categories-pagination');
        const { current_page, last_page } = pagination;
        
        if (last_page <= 1) {
            container.innerHTML = '';
            return;
        }
        
        let html = '<div style="display: flex; justify-content: center; gap: 5px; flex-wrap: wrap;">';
        
        // Previous button
        if (current_page > 1) {
            html += `<button onclick="loadCategories(${current_page - 1}); return false;"><i class="fas fa-chevron-right"></i></button>`;
        }
        
        // Page numbers (show max 3 pages)
        const startPage = Math.max(1, current_page - 1);
        const endPage = Math.min(last_page, current_page + 1);
        
        for (let i = startPage; i <= endPage; i++) {
            const activeClass = i === current_page ? 'active' : '';
            html += `<button class="${activeClass}" onclick="loadCategories(${i}); return false;">${i}</button>`;
        }
        
        // Next button
        if (current_page < last_page) {
            html += `<button onclick="loadCategories(${current_page + 1}); return false;"><i class="fas fa-chevron-left"></i></button>`;
        }
        
        html += '</div>';
        container.innerHTML = html;
    }
    
    // Load subcategories
    async function loadSubCategories(categoryId) {
        try {
            const response = await fetch(`${API_BASE_URL}/subcategories?category_id=${categoryId}&per_page=100`);
            const data = await response.json();
            
            const filterContainer = document.getElementById('subcategories-filter');
            filterContainer.innerHTML = '<button class="filter-btn active" data-subcategory-id="">الكل</button>';
            
            if (data.success && data.data.length > 0) {
                data.data.forEach(subCategory => {
                    const btn = document.createElement('button');
                    btn.className = 'filter-btn';
                    btn.dataset.subcategoryId = subCategory.id;
                    btn.textContent = subCategory.name;
                    filterContainer.appendChild(btn);
                });
                
                // Add click event to filter buttons
                document.querySelectorAll('.filter-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                        this.classList.add('active');
                        
                        currentSubCategoryId = this.dataset.subcategoryId;
                        currentPage = 1;
                        loadProducts();
                    });
                });
            }
        } catch (error) {
            console.error('Error loading subcategories:', error);
        }
    }
    
    // Load products
    async function loadProducts(page = 1) {
        try {
            const params = new URLSearchParams({
                per_page: 8,
                page: page
            });
            
            if (currentCategoryId) params.append('category_id', currentCategoryId);
            if (currentSubCategoryId) params.append('sub_category_id', currentSubCategoryId);
            
            const response = await fetch(`${API_BASE_URL}/products?${params}`);
            const data = await response.json();
            
            if (data.success) {
                renderProducts(data.data);
                renderPagination(data.pagination);
                currentPage = page;
            }
        } catch (error) {
            console.error('Error loading products:', error);
            document.getElementById('products-grid').innerHTML = '<div class="col-12 text-center py-5"><p>حدث خطأ في تحميل المنتجات</p></div>';
        }
    }
    
    // Render products
    function renderProducts(products) {
        const grid = document.getElementById('products-grid');
        
        if (products.length === 0) {
            grid.innerHTML = '<div class="col-12 text-center py-5"><p>لا توجد منتجات</p></div>';
            return;
        }
        
        grid.innerHTML = products.map(product => `
            <div class="product-card">
                <div class="product-image">
                    <img src="${product.main_image || '{{ asset('front/image 2.png') }}'}" alt="${product.name}">
                </div>
                <h4 class="product-title">${product.name}</h4>
                <div class="product-action">
                    <a href="/product-details?id=${product.id}" class="prod-more-btn">
                        اعرف المزيد
                        <span class="prod-more-icon"><i class="fas fa-arrow-up"></i></span>
                    </a>
                </div>
            </div>
        `).join('');
    }
    
    // Render pagination
    function renderPagination(pagination) {
        const container = document.getElementById('products-pagination');
        const { current_page, last_page } = pagination;
        
        if (last_page <= 1) {
            container.innerHTML = '';
            return;
        }
        
        let html = '<ul>';
        
        // Previous buttons
        if (current_page > 1) {
            html += `<li><a href="#" onclick="loadProducts(${current_page - 1}); return false;"><i class="fas fa-angle-right"></i></a></li>`;
            html += `<li><a href="#" onclick="loadProducts(1); return false;"><i class="fas fa-angle-double-right"></i></a></li>`;
        }
        
        // Page numbers (show max 5 pages)
        const startPage = Math.max(1, current_page - 2);
        const endPage = Math.min(last_page, current_page + 2);
        
        for (let i = endPage; i >= startPage; i--) {
            html += `<li><a href="#" class="${i === current_page ? 'active' : ''}" onclick="loadProducts(${i}); return false;">${i}</a></li>`;
        }
        
        // Next buttons
        if (current_page < last_page) {
            html += `<li><a href="#" onclick="loadProducts(${last_page}); return false;"><i class="fas fa-angle-double-left"></i></a></li>`;
            html += `<li><a href="#" onclick="loadProducts(${current_page + 1}); return false;"><i class="fas fa-angle-left"></i></a></li>`;
        }
        
        html += '</ul>';
        container.innerHTML = html;
    }
</script>
@endpush

