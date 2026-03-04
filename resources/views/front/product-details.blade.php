@extends('front.layout')

@section('title', 'تفاصيل المنتج')

@section('content')

<!-- Product Details Section -->
<section class="product-details-section" style="padding: 120px 0 80px; background: var(--light-bg, #f8fcf8);">
    <div class="container">
        <!-- Loading State -->
        <div id="loading-state" class="text-center py-5">
            <div class="spinner-border" role="status" style="width: 3rem; height: 3rem; color: var(--primary-color, #91c744); border-width: 4px;">
                <span class="visually-hidden">جاري التحميل...</span>
            </div>
            <p class="mt-3" style="color: var(--text-color, #333);">جاري تحميل تفاصيل المنتج...</p>
        </div>

        <!-- Product Content -->
        <div id="product-content" style="display: none;">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb" style="background: transparent; padding: 0;">
                    <li class="breadcrumb-item"><a href="/" style="color: var(--primary-color, #91c744); text-decoration: none; font-weight: 600;">الرئيسية</a></li>
                    <li class="breadcrumb-item"><a href="/#products" style="color: var(--primary-color, #91c744); text-decoration: none; font-weight: 600;">المنتجات</a></li>
                    <li class="breadcrumb-item active" aria-current="page" id="breadcrumb-product" style="color: var(--text-color, #333);">...</li>
                </ol>
            </nav>

            <div class="row">
                <!-- Product Images -->
                <div class="col-lg-6 mb-4">
                    <div class="product-images-container">
                        <!-- Main Image -->
                        <div class="main-image-container" style="background: var(--white, #ffffff); border-radius: 20px; padding: 30px; box-shadow: 0 4px 20px rgba(3, 79, 49, 0.1); margin-bottom: 20px; border: 2px solid var(--third-color, #f0f8e8);">
                            <img id="main-product-image" src="" alt="" style="width: 100%; height: 450px; object-fit: contain; border-radius: 12px;">
                        </div>

                        <!-- Thumbnail Images -->
                        <div id="thumbnail-images" class="d-flex gap-3 flex-wrap" style="justify-content: center;">
                            <!-- Thumbnails will be loaded here -->
                        </div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-lg-6">
                    <div class="product-info" style="background: var(--white, #ffffff); border-radius: 20px; padding: 40px; box-shadow: 0 4px 20px rgba(3, 79, 49, 0.1); border: 2px solid var(--third-color, #f0f8e8);">
                        <!-- Product Title -->
                        <h1 id="product-title" style="font-size: 36px; font-weight: bold; color: var(--secondary-color, #034f31); margin-bottom: 25px; line-height: 1.4;">...</h1>

                        <!-- Category & SubCategory Badges -->
                        <div class="product-badges mb-4">
                            <span id="category-badge" class="badge" style="background: var(--primary-color, #91c744); color: var(--white, #ffffff); padding: 10px 20px; border-radius: 25px; font-size: 15px; margin-left: 10px; font-weight: 600;">
                                <i class="fas fa-folder"></i> <span id="category-name">...</span>
                            </span>
                            <span id="subcategory-badge" class="badge" style="background: var(--accent-color, #d9ef6f); color: var(--secondary-color, #034f31); padding: 10px 20px; border-radius: 25px; font-size: 15px; display: none; font-weight: 600;">
                                <i class="fas fa-tag"></i> <span id="subcategory-name">...</span>
                            </span>
                        </div>

                        <!-- Product Description -->
                        <div class="product-description mb-4" style="padding: 25px; background: var(--third-color, #f0f8e8); border-radius: 15px; border-right: 5px solid var(--primary-color, #91c744);">
                            <h5 style="color: var(--secondary-color, #034f31); margin-bottom: 15px; font-weight: bold; font-size: 18px;">
                                <i class="fas fa-info-circle"></i> وصف المنتج
                            </h5>
                            <p id="product-description" style="color: var(--text-color, #333); line-height: 1.9; font-size: 16px; margin: 0;">...</p>
                        </div>

                        <!-- Product Meta Info -->
                        <div class="product-meta mb-4">
                            <div class="row g-3">
                                <div class="col-6">
                                    <div style="padding: 20px; background: var(--third-color, #f0f8e8); border-radius: 15px; text-align: center; border: 2px solid var(--primary-color, #91c744);">
                                        <i class="fas fa-calendar-alt" style="color: var(--primary-color, #91c744); font-size: 28px; margin-bottom: 10px;"></i>
                                        <p style="margin: 0; color: var(--text-color, #333); font-size: 13px; opacity: 0.8;">تاريخ الإضافة</p>
                                        <p id="product-date" style="margin: 0; color: var(--secondary-color, #034f31); font-weight: bold; font-size: 15px;">...</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div style="padding: 20px; background: var(--third-color, #f0f8e8); border-radius: 15px; text-align: center; border: 2px solid var(--primary-color, #91c744);">
                                        <i class="fas fa-images" style="color: var(--primary-color, #91c744); font-size: 28px; margin-bottom: 10px;"></i>
                                        <p style="margin: 0; color: var(--text-color, #333); font-size: 13px; opacity: 0.8;">عدد الصور</p>
                                        <p id="images-count" style="margin: 0; color: var(--secondary-color, #034f31); font-weight: bold; font-size: 15px;">...</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="product-actions d-flex gap-3">
                            <a href="/#products" class="btn" style="flex: 1; padding: 15px; border-radius: 12px; font-weight: bold; background: var(--white, #ffffff); color: var(--secondary-color, #034f31); border: 2px solid var(--secondary-color, #034f31); transition: var(--transition, all 0.3s ease); text-decoration: none; text-align: center;" onmouseover="this.style.background='var(--secondary-color, #034f31)'; this.style.color='var(--white, #ffffff)';" onmouseout="this.style.background='var(--white, #ffffff)'; this.style.color='var(--secondary-color, #034f31)';">
                                <i class="fas fa-arrow-right"></i> العودة للمنتجات
                            </a>
                            <button onclick="shareProduct()" class="btn" style="padding: 15px 25px; border-radius: 12px; background: var(--primary-color, #91c744); color: var(--white, #ffffff); border: none; font-weight: bold; transition: var(--transition, all 0.3s ease); cursor: pointer;" onmouseover="this.style.background='var(--primary-dark, #7aab3a)';" onmouseout="this.style.background='var(--primary-color, #91c744)';">
                                <i class="fas fa-share-alt"></i> مشاركة
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Products Section -->
            <div class="related-products mt-5">
                <div class="section-title text-center mb-4">
                    <h3 style="color: var(--secondary-color, #034f31); font-weight: bold; font-size: 32px; margin-bottom: 10px;">منتجات ذات صلة</h3>
                    <div style="width: 80px; height: 4px; background: var(--primary-color, #91c744); margin: 0 auto; border-radius: 2px;"></div>
                </div>
                <div id="related-products-grid" class="row g-4">
                    <!-- Related products will be loaded here -->
                </div>
            </div>
        </div>

        <!-- Error State -->
        <div id="error-state" class="text-center py-5" style="display: none;">
            <div style="background: var(--white, #ffffff); border-radius: 20px; padding: 60px 40px; box-shadow: 0 4px 20px rgba(3, 79, 49, 0.1); max-width: 600px; margin: 0 auto;">
                <i class="fas fa-exclamation-triangle" style="font-size: 72px; color: var(--accent-color, #d9ef6f); margin-bottom: 25px;"></i>
                <h3 style="color: var(--secondary-color, #034f31); font-weight: bold; margin-bottom: 15px;">عذراً، لم نتمكن من العثور على المنتج</h3>
                <p style="color: var(--text-color, #333); margin-bottom: 30px;">المنتج المطلوب غير موجود أو تم حذفه</p>
                <a href="/#products" class="btn" style="padding: 15px 40px; border-radius: 12px; background: var(--primary-color, #91c744); color: var(--white, #ffffff); text-decoration: none; font-weight: bold; display: inline-block; transition: var(--transition, all 0.3s ease);" onmouseover="this.style.background='var(--primary-dark, #7aab3a)';" onmouseout="this.style.background='var(--primary-color, #91c744)';">
                    <i class="fas fa-arrow-right"></i> العودة للمنتجات
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // Force navbar to be visible on product details page
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.querySelector('.navbar');
        if (navbar) {
            navbar.classList.add('scrolled');
        }
    });

    const API_BASE_URL = '/api/public';
    let currentProduct = null;

    // Get product ID from URL
    function getProductIdFromUrl() {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get('id');
    }

    // Load product details
    async function loadProductDetails() {
        const productId = getProductIdFromUrl();
        
        if (!productId) {
            showError();
            return;
        }

        try {
            const response = await fetch(`${API_BASE_URL}/products/${productId}`);
            const data = await response.json();

            if (data.success) {
                currentProduct = data.data;
                displayProduct(data.data);
                loadRelatedProducts(data.data.category.id, productId);
            } else {
                showError();
            }
        } catch (error) {
            console.error('Error loading product:', error);
            showError();
        }
    }

    // Display product details
    function displayProduct(product) {
        // Hide loading, show content
        document.getElementById('loading-state').style.display = 'none';
        document.getElementById('product-content').style.display = 'block';

        // Update page title
        document.title = product.name + ' - أصول الزراعة';

        // Breadcrumb
        document.getElementById('breadcrumb-product').textContent = product.name;

        // Main image
        const mainImage = product.main_image || '{{ asset('front/image 2.png') }}';
        document.getElementById('main-product-image').src = mainImage;
        document.getElementById('main-product-image').alt = product.name;

        // Title
        document.getElementById('product-title').textContent = product.name;

        // Category
        document.getElementById('category-name').textContent = product.category.name;

        // SubCategory
        if (product.subcategory) {
            document.getElementById('subcategory-badge').style.display = 'inline-block';
            document.getElementById('subcategory-name').textContent = product.subcategory.name;
        }

        // Description
        const description = product.description || 'لا يوجد وصف متاح لهذا المنتج';
        document.getElementById('product-description').textContent = description;

        // Date
        const date = new Date(product.created_at);
        document.getElementById('product-date').textContent = date.toLocaleDateString('ar-EG');

        // Images count
        const totalImages = 1 + product.images.length;
        document.getElementById('images-count').textContent = totalImages;

        // Thumbnails
        displayThumbnails(product);
    }

    // Display thumbnail images
    function displayThumbnails(product) {
        const container = document.getElementById('thumbnail-images');
        container.innerHTML = '';

        // Add main image thumbnail
        const mainThumb = createThumbnail(product.main_image || '{{ asset('front/image 2.png') }}', product.name);
        container.appendChild(mainThumb);

        // Add other images thumbnails
        product.images.forEach((image, index) => {
            const thumb = createThumbnail(image.url, `${product.name} - صورة ${index + 2}`);
            container.appendChild(thumb);
        });
    }

    // Create thumbnail element
    function createThumbnail(imageUrl, altText) {
        const div = document.createElement('div');
        div.style.cssText = 'width: 90px; height: 90px; border: 3px solid var(--third-color, #f0f8e8); border-radius: 12px; overflow: hidden; cursor: pointer; transition: all 0.3s ease; background: var(--white, #ffffff);';
        div.onmouseover = function() { 
            this.style.borderColor = 'var(--primary-color, #91c744)'; 
            this.style.transform = 'scale(1.05)';
            this.style.boxShadow = '0 4px 12px rgba(145, 199, 68, 0.3)';
        };
        div.onmouseout = function() { 
            this.style.borderColor = 'var(--third-color, #f0f8e8)'; 
            this.style.transform = 'scale(1)';
            this.style.boxShadow = 'none';
        };
        div.onclick = function() {
            document.getElementById('main-product-image').src = imageUrl;
            // Update active state
            document.querySelectorAll('#thumbnail-images > div').forEach(t => {
                t.style.borderColor = 'var(--third-color, #f0f8e8)';
                t.style.borderWidth = '3px';
            });
            this.style.borderColor = 'var(--primary-color, #91c744)';
            this.style.borderWidth = '3px';
        };

        const img = document.createElement('img');
        img.src = imageUrl;
        img.alt = altText;
        img.style.cssText = 'width: 100%; height: 100%; object-fit: cover;';

        div.appendChild(img);
        return div;
    }

    // Load related products
    async function loadRelatedProducts(categoryId, excludeProductId) {
        try {
            const response = await fetch(`${API_BASE_URL}/products?category_id=${categoryId}&per_page=4`);
            const data = await response.json();

            if (data.success) {
                const relatedProducts = data.data.filter(p => p.id != excludeProductId).slice(0, 4);
                displayRelatedProducts(relatedProducts);
            }
        } catch (error) {
            console.error('Error loading related products:', error);
        }
    }

    // Display related products
    function displayRelatedProducts(products) {
        const container = document.getElementById('related-products-grid');
        
        if (products.length === 0) {
            container.innerHTML = '<div class="col-12 text-center"><p style="color: var(--text-color, #333);">لا توجد منتجات ذات صلة</p></div>';
            return;
        }

        container.innerHTML = products.map(product => `
            <div class="col-md-3 mb-4">
                <div class="product-card" style="background: var(--white, #ffffff); border-radius: 16px; overflow: hidden; box-shadow: 0 4px 15px rgba(3, 79, 49, 0.1); transition: all 0.3s ease; border: 2px solid var(--third-color, #f0f8e8); height: 100%;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 8px 25px rgba(3, 79, 49, 0.15)'; this.style.borderColor='var(--primary-color, #91c744)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(3, 79, 49, 0.1)'; this.style.borderColor='var(--third-color, #f0f8e8)';">
                    <div class="product-image" style="height: 220px; overflow: hidden; background: var(--third-color, #f0f8e8);">
                        <img src="${product.main_image || '{{ asset('front/image 2.png') }}'}" alt="${product.name}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.1)';" onmouseout="this.style.transform='scale(1)';">
                    </div>
                    <div style="padding: 20px;">
                        <h5 style="font-size: 17px; margin-bottom: 15px; color: var(--secondary-color, #034f31); font-weight: bold; min-height: 50px; line-height: 1.4;">${product.name}</h5>
                        <a href="/product-details?id=${product.id}" class="btn" style="width: 100%; border-radius: 10px; padding: 12px; background: var(--primary-color, #91c744); color: var(--white, #ffffff); text-decoration: none; font-weight: bold; display: inline-block; text-align: center; transition: all 0.3s ease; border: none;" onmouseover="this.style.background='var(--primary-dark, #7aab3a)'; this.style.transform='scale(1.02)';" onmouseout="this.style.background='var(--primary-color, #91c744)'; this.style.transform='scale(1)';">
                            <i class="fas fa-eye"></i> عرض التفاصيل
                        </a>
                    </div>
                </div>
            </div>
        `).join('');
    }

    // Show error state
    function showError() {
        document.getElementById('loading-state').style.display = 'none';
        document.getElementById('error-state').style.display = 'block';
    }

    // Share product
    function shareProduct() {
        if (navigator.share && currentProduct) {
            navigator.share({
                title: currentProduct.name,
                text: currentProduct.description || 'تحقق من هذا المنتج',
                url: window.location.href
            }).catch(err => console.log('Error sharing:', err));
        } else {
            // Fallback: Copy link to clipboard
            navigator.clipboard.writeText(window.location.href).then(() => {
                alert('تم نسخ رابط المنتج!');
            });
        }
    }

    // Load product on page load
    document.addEventListener('DOMContentLoaded', loadProductDetails);
</script>
@endpush

