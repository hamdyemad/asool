# API Integration Guide for Landing Page

## Overview
This guide explains how to integrate the catalog API into your landing page to display categories, subcategories, and products.

## What Was Created

### 1. API Controller
**File:** `app/Http/Controllers/Api/CatalogApiController.php`

A dedicated controller that handles all public API requests for:
- Categories (list & single)
- SubCategories (list & single)
- Products (list & single)

### 2. API Routes
**File:** `routes/web.php`

Public API endpoints (no authentication required):
```
GET /api/public/categories
GET /api/public/categories/{id}
GET /api/public/subcategories
GET /api/public/subcategories/{id}
GET /api/public/products
GET /api/public/products/{id}
```

### 3. JavaScript Helper Library
**File:** `public/js/landing-catalog.js`

Reusable JavaScript functions for:
- Fetching data from API
- Rendering categories, products
- Handling pagination
- Filtering and searching

### 4. Example HTML Page
**File:** `public/landing-example.html`

A complete working example showing:
- Category grid display
- Product grid display
- Search functionality
- Category/SubCategory filters
- Pagination
- Responsive design

### 5. Documentation
**File:** `PUBLIC_API_DOCUMENTATION.md`

Complete API documentation with:
- All endpoints
- Request/response examples
- Query parameters
- Error handling
- Usage examples in JavaScript, jQuery, Axios

## Quick Start

### Option 1: Use the Example Page
1. Open your browser and go to:
   ```
   http://127.0.0.1:8000/landing-example.html
   ```

2. You'll see a working catalog with:
   - Categories displayed in a grid
   - Products with images
   - Search and filter functionality
   - Pagination

### Option 2: Integrate into Your Existing Landing Page

#### Step 1: Include the JavaScript Library
```html
<script src="/js/landing-catalog.js"></script>
```

#### Step 2: Add HTML Containers
```html
<!-- Categories -->
<div id="categories-container"></div>

<!-- Products -->
<div id="products-container"></div>

<!-- Pagination -->
<div id="pagination-container"></div>
```

#### Step 3: Load and Display Data
```javascript
// Load categories
const categoriesData = await fetchCategories({ per_page: 10 });
renderCategories(categoriesData.data, 'categories-container');

// Load products
const productsData = await fetchProducts({ per_page: 12 });
renderProducts(productsData.data, 'products-container');
renderPagination(productsData.pagination, 'pagination-container', loadProductsPage);
```

### Option 3: Use Direct API Calls

#### Fetch Products with Vanilla JavaScript
```javascript
fetch('/api/public/products?per_page=12')
  .then(response => response.json())
  .then(data => {
    console.log(data.data); // Array of products
    // Display products in your custom way
  });
```

#### Fetch Products by Category
```javascript
fetch('/api/public/products?category_id=1&per_page=12')
  .then(response => response.json())
  .then(data => {
    // Display filtered products
  });
```

#### Search Products
```javascript
fetch('/api/public/products?search=cream&per_page=12')
  .then(response => response.json())
  .then(data => {
    // Display search results
  });
```

## API Response Structure

All API responses follow this format:

```json
{
  "success": true,
  "data": [...],
  "pagination": {
    "current_page": 1,
    "last_page": 5,
    "per_page": 12,
    "total": 60,
    "from": 1,
    "to": 12
  }
}
```

## Common Use Cases

### 1. Display All Products
```javascript
const response = await fetch('/api/public/products?per_page=12');
const data = await response.json();

data.data.forEach(product => {
  console.log(product.name);
  console.log(product.main_image);
  console.log(product.category.name);
});
```

### 2. Filter Products by Category
```javascript
const categoryId = 1;
const response = await fetch(`/api/public/products?category_id=${categoryId}`);
const data = await response.json();
// Display filtered products
```

### 3. Search Products
```javascript
const searchTerm = 'cream';
const response = await fetch(`/api/public/products?search=${searchTerm}`);
const data = await response.json();
// Display search results
```

### 4. Load More Products (Pagination)
```javascript
const page = 2;
const response = await fetch(`/api/public/products?page=${page}&per_page=12`);
const data = await response.json();
// Display next page of products
```

### 5. Get Single Product Details
```javascript
const productId = 1;
const response = await fetch(`/api/public/products/${productId}`);
const data = await response.json();

console.log(data.data.name);
console.log(data.data.description);
console.log(data.data.images); // Array of image URLs
```

## Styling Tips

The example page includes basic CSS. You can customize it to match your landing page design:

```css
/* Product Card */
.product-card {
  background: white;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.product-card img {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

/* Category Badge */
.category-badge {
  background: #2196F3;
  color: white;
  padding: 5px 10px;
  border-radius: 4px;
  font-size: 12px;
}
```

## Performance Tips

1. **Use Pagination**: Don't load all products at once
   ```javascript
   fetchProducts({ per_page: 12 }) // Load 12 at a time
   ```

2. **Cache Categories**: Categories don't change often
   ```javascript
   const categories = await fetchCategories({ per_page: 100 });
   localStorage.setItem('categories', JSON.stringify(categories));
   ```

3. **Lazy Load Images**: Use lazy loading for product images
   ```html
   <img src="..." loading="lazy">
   ```

4. **Debounce Search**: Add delay to search input
   ```javascript
   let searchTimeout;
   searchInput.addEventListener('input', (e) => {
     clearTimeout(searchTimeout);
     searchTimeout = setTimeout(() => {
       searchProducts(e.target.value);
     }, 500);
   });
   ```

## Testing the API

### Using Browser Console
```javascript
// Test in browser console
fetch('/api/public/products')
  .then(r => r.json())
  .then(d => console.log(d));
```

### Using cURL
```bash
# Get all products
curl http://127.0.0.1:8000/api/public/products

# Get products by category
curl "http://127.0.0.1:8000/api/public/products?category_id=1"

# Search products
curl "http://127.0.0.1:8000/api/public/products?search=cream"
```

### Using Postman
1. Create a new GET request
2. URL: `http://127.0.0.1:8000/api/public/products`
3. Add query parameters as needed
4. Send request

## Troubleshooting

### Issue: CORS Error
**Solution:** Make sure CORS is configured in `config/cors.php`

### Issue: Images Not Loading
**Solution:** Check that images are stored in `storage/app/public` and the symbolic link is created:
```bash
php artisan storage:link
```

### Issue: Empty Response
**Solution:** Make sure you have data in the database. Run seeders:
```bash
php artisan db:seed --class=CatalogSeeder
```

### Issue: 404 Not Found
**Solution:** Clear route cache:
```bash
php artisan route:clear
php artisan route:cache
```

## Next Steps

1. Customize the example page design to match your landing page
2. Add product detail modal/page
3. Implement shopping cart functionality
4. Add product comparison feature
5. Implement wishlist functionality

## Support

For more details, check:
- `PUBLIC_API_DOCUMENTATION.md` - Complete API reference
- `public/landing-example.html` - Working example
- `public/js/landing-catalog.js` - Helper functions
