# Public API Documentation

## Overview
Public REST API endpoints for accessing catalog data (Categories, SubCategories, Products) on the landing page. All endpoints are publicly accessible without authentication.

## Base URL
```
http://127.0.0.1:8000/api/public
```

## Response Format
All responses follow this structure:
```json
{
  "success": true,
  "data": [...],
  "pagination": {
    "current_page": 1,
    "last_page": 5,
    "per_page": 20,
    "total": 100,
    "from": 1,
    "to": 20
  }
}
```

---

## Categories

### Get All Categories
Get a paginated list of all categories.

**Endpoint:** `GET /api/public/categories`

**Query Parameters:**
- `per_page` (optional, default: 20) - Number of items per page
- `search` (optional) - Search by name or description

**Example Request:**
```
GET /api/public/categories?per_page=10&search=health
```

**Example Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Health & Beauty",
      "description": "High quality products for everyday use",
      "created_at": "2025-03-04 00:00:00"
    }
  ],
  "pagination": {
    "current_page": 1,
    "last_page": 5,
    "per_page": 10,
    "total": 50,
    "from": 1,
    "to": 10
  }
}
```

### Get Single Category
Get details of a specific category.

**Endpoint:** `GET /api/public/categories/{id}`

**Example Request:**
```
GET /api/public/categories/1
```

**Example Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "Health & Beauty",
    "description": "High quality products for everyday use",
    "created_at": "2025-03-04 00:00:00",
    "subcategories_count": 15,
    "products_count": 120
  }
}
```

---

## SubCategories

### Get All SubCategories
Get a paginated list of all subcategories.

**Endpoint:** `GET /api/public/subcategories`

**Query Parameters:**
- `per_page` (optional, default: 20) - Number of items per page
- `search` (optional) - Search by name or description
- `category_id` (optional) - Filter by category ID

**Example Request:**
```
GET /api/public/subcategories?category_id=1&per_page=10
```

**Example Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Skin Care",
      "description": "Premium skin care products",
      "category": {
        "id": 1,
        "name": "Health & Beauty"
      },
      "created_at": "2025-03-04 00:00:00"
    }
  ],
  "pagination": {
    "current_page": 1,
    "last_page": 2,
    "per_page": 10,
    "total": 15,
    "from": 1,
    "to": 10
  }
}
```

### Get Single SubCategory
Get details of a specific subcategory.

**Endpoint:** `GET /api/public/subcategories/{id}`

**Example Request:**
```
GET /api/public/subcategories/1
```

**Example Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "Skin Care",
    "description": "Premium skin care products",
    "category": {
      "id": 1,
      "name": "Health & Beauty"
    },
    "created_at": "2025-03-04 00:00:00",
    "products_count": 45
  }
}
```

---

## Products

### Get All Products
Get a paginated list of all products.

**Endpoint:** `GET /api/public/products`

**Query Parameters:**
- `per_page` (optional, default: 20) - Number of items per page
- `search` (optional) - Search by name or description
- `category_id` (optional) - Filter by category ID
- `sub_category_id` (optional) - Filter by subcategory ID

**Example Request:**
```
GET /api/public/products?category_id=1&per_page=12
```

**Example Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Face Cream",
      "description": "Moisturizing face cream for all skin types",
      "main_image": "http://127.0.0.1:8000/storage/products/main_image.jpg",
      "images": [
        "http://127.0.0.1:8000/storage/products/image1.jpg",
        "http://127.0.0.1:8000/storage/products/image2.jpg"
      ],
      "category": {
        "id": 1,
        "name": "Health & Beauty"
      },
      "subcategory": {
        "id": 1,
        "name": "Skin Care"
      },
      "created_at": "2025-03-04 00:00:00"
    }
  ],
  "pagination": {
    "current_page": 1,
    "last_page": 10,
    "per_page": 12,
    "total": 120,
    "from": 1,
    "to": 12
  }
}
```

### Get Single Product
Get details of a specific product.

**Endpoint:** `GET /api/public/products/{id}`

**Example Request:**
```
GET /api/public/products/1
```

**Example Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "Face Cream",
    "description": "Moisturizing face cream for all skin types. Contains natural ingredients and vitamins.",
    "main_image": "http://127.0.0.1:8000/storage/products/main_image.jpg",
    "images": [
      {
        "id": 1,
        "url": "http://127.0.0.1:8000/storage/products/image1.jpg"
      },
      {
        "id": 2,
        "url": "http://127.0.0.1:8000/storage/products/image2.jpg"
      }
    ],
    "category": {
      "id": 1,
      "name": "Health & Beauty"
    },
    "subcategory": {
      "id": 1,
      "name": "Skin Care"
    },
    "created_at": "2025-03-04 00:00:00"
  }
}
```

---

## Error Responses

### 404 Not Found
```json
{
  "success": false,
  "message": "Product not found"
}
```

### 500 Server Error
```json
{
  "success": false,
  "message": "Internal server error"
}
```

---

## Usage Examples

### JavaScript (Fetch API)
```javascript
// Get all products
fetch('http://127.0.0.1:8000/api/public/products?per_page=12')
  .then(response => response.json())
  .then(data => {
    console.log(data.data); // Array of products
    console.log(data.pagination); // Pagination info
  });

// Get single product
fetch('http://127.0.0.1:8000/api/public/products/1')
  .then(response => response.json())
  .then(data => {
    console.log(data.data); // Product details
  });
```

### jQuery (AJAX)
```javascript
// Get products by category
$.ajax({
  url: 'http://127.0.0.1:8000/api/public/products',
  method: 'GET',
  data: {
    category_id: 1,
    per_page: 12
  },
  success: function(response) {
    console.log(response.data); // Array of products
  }
});
```

### Axios
```javascript
// Get all categories
axios.get('http://127.0.0.1:8000/api/public/categories')
  .then(response => {
    console.log(response.data.data); // Array of categories
  });

// Get products with filters
axios.get('http://127.0.0.1:8000/api/public/products', {
  params: {
    category_id: 1,
    search: 'cream',
    per_page: 12
  }
})
  .then(response => {
    console.log(response.data.data); // Filtered products
  });
```

---

## CORS Configuration
If you need to access the API from a different domain, make sure CORS is properly configured in `config/cors.php`.

## Rate Limiting
Currently, there is no rate limiting on public API endpoints. Consider implementing rate limiting for production use.

## Notes
- All endpoints return data sorted by latest first (newest to oldest)
- Image URLs are absolute URLs including the domain
- Pagination is zero-indexed (first page is 1)
- All dates are in `Y-m-d H:i:s` format
- SubCategory can be null for products
