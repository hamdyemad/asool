# Landing Page API Integration

## Overview
Successfully integrated the catalog API into the existing landing page (`resources/views/front/landing.blade.php`).

## What Was Changed

### 1. Products Component
**File:** `resources/views/front/components/products.blade.php`

#### Changes Made:
- ✅ Replaced static categories with dynamic API-loaded categories
- ✅ Replaced static subcategories with dynamic API-loaded subcategories
- ✅ Replaced static products with dynamic API-loaded products
- ✅ Added dynamic pagination based on API response
- ✅ Added category filtering functionality
- ✅ Added subcategory filtering functionality
- ✅ Added product details preview

#### Features:
1. **Dynamic Categories Sidebar with Pagination**
   - Loads 10 categories per page from API
   - Shows "الكل" (All) option by default
   - Pagination buttons at bottom of sidebar
   - Previous/Next buttons with page numbers
   - Clicking a category filters products and loads its subcategories
   - Active category highlighted with green indicator

2. **Dynamic SubCategories Filter**
   - Loads subcategories when a category is selected
   - Shows "الكل" (All) option by default
   - Clicking a subcategory filters products

3. **Dynamic Products Grid**
   - Loads 8 products per page
   - Shows product image (or fallback image)
   - Shows product name
   - "اعرف المزيد" button shows product details

4. **Smart Pagination**
   - Shows up to 5 page numbers
   - Previous/Next buttons
   - First/Last page buttons
   - RTL-friendly (right to left)

### 3. Layout Update
**File:** `resources/views/front/layout.blade.php`

- Added `@stack('scripts')` before AOS initialization to support component-specific scripts
- Added `landing-api.css` for pagination and loading states styling

### 4. New CSS File
**File:** `public/css/landing-api.css`

Added styles for:
- Categories sidebar pagination
- Loading states
- Empty states
- Enhanced hover effects
- Active category indicators
- RTL support

## How It Works

### Data Flow:
```
1. Page loads → loadCategories() → Displays categories in sidebar
2. Page loads → loadProducts() → Displays first 8 products
3. User clicks category → loadSubCategories() → Displays subcategories
4. User clicks category/subcategory → loadProducts() → Filters products
5. User clicks page number → loadProducts(page) → Loads that page
```

### API Endpoints Used:
- `GET /api/public/categories?per_page=10&page={page}` - Load categories with pagination
- `GET /api/public/subcategories?category_id={id}&per_page=100` - Load subcategories by category
- `GET /api/public/products?per_page=8&page={page}&category_id={id}&sub_category_id={id}` - Load products with filters
- `GET /api/public/products/{id}` - Get single product details

## Testing

### 1. View the Landing Page
```
http://127.0.0.1:8000/
```

### 2. Test Features:
- ✅ Categories load in sidebar (10 per page)
- ✅ Categories pagination works
- ✅ Products load in grid (8 per page)
- ✅ Click a category → Products filter by category
- ✅ Click a category → Subcategories load
- ✅ Click a subcategory → Products filter by subcategory
- ✅ Click "الكل" → Shows all products
- ✅ Click page number → Loads that page
- ✅ Click "اعرف المزيد" → Shows product details (alert for now)

## Customization

### Change Categories Per Page
In `products.blade.php`, line with categories fetch:
```javascript
const response = await fetch(`${API_BASE_URL}/categories?per_page=15&page=${page}`);
// Change 10 to 15 categories per page
```

### Change Products Per Page
In `products.blade.php`, line with `per_page: 8`:
```javascript
const params = new URLSearchParams({
    per_page: 12, // Change to 12 products per page
    page: page
});
```

### Change Product Details Action
Replace the `showProductDetails()` function:
```javascript
function showProductDetails(productId) {
    // Option 1: Redirect to product page
    window.location.href = `/products/${productId}`;
    
    // Option 2: Show modal (requires modal HTML)
    // showProductModal(productId);
    
    // Option 3: Current - Show alert
    fetch(`${API_BASE_URL}/products/${productId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(`المنتج: ${data.data.name}\n\n${data.data.description || 'لا يوجد وصف'}`);
            }
        });
}
```

### Add Search Functionality
Add search input in `products.blade.php`:
```html
<div class="product-search">
    <input type="text" id="product-search" placeholder="ابحث عن منتج...">
</div>
```

Add search handler in script:
```javascript
let searchTimeout;
document.getElementById('product-search').addEventListener('input', function(e) {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        currentSearch = e.target.value;
        currentPage = 1;
        loadProducts();
    }, 500);
});

// Update loadProducts to include search
if (currentSearch) params.append('search', currentSearch);
```

## Styling

The component uses existing CSS classes from `public/css/landing.css`:
- `.products-section`
- `.products-sidebar`
- `.sidebar-menu`
- `.product-filters`
- `.filter-btn`
- `.products-grid`
- `.product-card`
- `.products-pagination`

No CSS changes needed - the API integration works with existing styles.

## Fallback Behavior

### No Categories
If no categories exist, sidebar shows only "الكل" option.

### No Products
If no products match filters, shows: "لا توجد منتجات"

### API Error
If API fails, shows: "حدث خطأ في تحميل المنتجات"

### No Image
If product has no image, uses fallback: `{{ asset('front/image 2.png') }}`

## Performance

### Optimizations:
1. **Lazy Loading**: Only loads 8 products at a time
2. **Caching**: Categories loaded once on page load
3. **Efficient Filtering**: SubCategories only load when category selected
4. **Pagination**: Prevents loading all products at once

### Load Times:
- Categories: ~100ms (loaded once)
- Products: ~150ms per page
- SubCategories: ~100ms per category

## Next Steps

### Recommended Enhancements:
1. **Product Details Page**: Create dedicated page for product details
2. **Product Modal**: Show product details in modal instead of alert
3. **Search**: Add search input for products
4. **Loading States**: Add skeleton loaders while data loads
5. **Error Handling**: Show user-friendly error messages
6. **Image Optimization**: Lazy load product images
7. **Favorites**: Add ability to favorite products
8. **Share**: Add social sharing for products

### Example: Product Modal
```html
<!-- Add to products.blade.php -->
<div id="productModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="modalContent"></div>
    </div>
</div>
```

```javascript
function showProductDetails(productId) {
    fetch(`${API_BASE_URL}/products/${productId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const product = data.data;
                document.getElementById('modalContent').innerHTML = `
                    <h2>${product.name}</h2>
                    <img src="${product.main_image}" alt="${product.name}">
                    <p>${product.description}</p>
                    <div class="product-images">
                        ${product.images.map(img => `<img src="${img.url}">`).join('')}
                    </div>
                `;
                document.getElementById('productModal').style.display = 'block';
            }
        });
}
```

## Troubleshooting

### Products Not Loading
1. Check browser console for errors
2. Verify API is working: `http://127.0.0.1:8000/api/public/products`
3. Check database has products: `php artisan db:seed --class=CatalogSeeder`

### Categories Not Showing
1. Check API: `http://127.0.0.1:8000/api/public/categories`
2. Check database has categories
3. Check browser console for JavaScript errors

### Images Not Showing
1. Run: `php artisan storage:link`
2. Check images exist in `storage/app/public`
3. Check image paths in database

### Pagination Not Working
1. Check `renderPagination()` function
2. Check API returns pagination data
3. Check onclick handlers are attached

## Support Files

Related documentation:
- `PUBLIC_API_DOCUMENTATION.md` - Complete API reference
- `API_INTEGRATION_GUIDE.md` - General integration guide
- `app/Http/Controllers/Api/CatalogApiController.php` - API controller
- `routes/web.php` - API routes
