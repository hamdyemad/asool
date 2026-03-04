# Select2 with AJAX Pagination Implementation

## Overview
Implemented Select2 with AJAX pagination for Categories and SubCategories dropdowns across all product and subcategory forms and filters. This eliminates the need to load all records at once and provides search functionality with infinite scroll.

## Features
- AJAX-based data loading with pagination (20 items per page)
- Search functionality with 250ms delay
- Infinite scroll pagination
- Dynamic SubCategory loading based on selected Category
- Preserves selected values on validation errors
- Works in create, edit, and filter forms

## API Endpoints

### Categories Search
- **URL**: `/api/categories/search`
- **Method**: GET
- **Parameters**:
  - `q`: Search term (optional)
  - `page`: Page number (default: 1)
- **Response**:
```json
{
  "results": [
    {"id": 1, "text": "Category Name"}
  ],
  "pagination": {
    "more": true
  }
}
```

### SubCategories Search
- **URL**: `/api/subcategories/search`
- **Method**: GET
- **Parameters**:
  - `q`: Search term (optional)
  - `page`: Page number (default: 1)
  - `category_id`: Filter by category (optional)
- **Response**: Same as categories

## Files Modified

### Controllers
- `app/Http/Controllers/CategoryController.php` - Added `searchForSelect2()` method
- `app/Http/Controllers/SubCategoryController.php` - Added `searchForSelect2()` method, removed loading all categories
- `app/Http/Controllers/ProductController.php` - Removed loading all categories/subcategories

### Routes
- `routes/web.php` - Added API endpoints for Select2

### JavaScript
- `public/js/select2-ajax.js` - Reusable Select2 initialization functions

### Views - Products
- `resources/views/products/index.blade.php` - Updated filters to use Select2
- `resources/views/products/create.blade.php` - Updated form to use Select2
- `resources/views/products/edit.blade.php` - Updated form to use Select2

### Views - SubCategories
- `resources/views/subcategories/index.blade.php` - Updated filters to use Select2
- `resources/views/subcategories/create.blade.php` - Updated form to use Select2
- `resources/views/subcategories/edit.blade.php` - Updated form to use Select2

## Usage

### In Blade Views

#### Include CSS (in @section('headerCss'))
```blade
<link href="{{ URL::asset('/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
```

#### Include JS (in @section('footerScript'))
```blade
<script src="{{ URL::asset('/libs/select2/select2.min.js')}}"></script>
<script src="{{ URL::asset('/js/select2-ajax.js')}}"></script>
```

#### Initialize Category Select2
```javascript
initCategorySelect2('#category_id', {
    placeholder: 'Select Category',
    allowClear: false
});
```

#### Initialize SubCategory Select2
```javascript
initSubCategorySelect2('#sub_category_id', '#category_id', {
    placeholder: 'Select SubCategory (Optional)',
    allowClear: true
});
```

#### Set Initial Values (for edit forms)
```javascript
setSelect2Value('#category_id', {{ $product->category_id }}, '{{ $product->category->name }}');
setSelect2Value('#sub_category_id', {{ $product->sub_category_id }}, '{{ $product->subCategory->name }}');
```

## JavaScript Functions

### initCategorySelect2(selector, options)
Initializes Select2 for category dropdown with AJAX pagination.

**Parameters:**
- `selector`: jQuery selector for the select element
- `options`: Optional configuration object
  - `placeholder`: Placeholder text (default: 'Select Category')
  - `allowClear`: Allow clearing selection (default: true)

### initSubCategorySelect2(selector, categorySelector, options)
Initializes Select2 for subcategory dropdown with AJAX pagination and category dependency.

**Parameters:**
- `selector`: jQuery selector for the subcategory select element
- `categorySelector`: jQuery selector for the category select element
- `options`: Optional configuration object
  - `placeholder`: Placeholder text (default: 'Select SubCategory')
  - `allowClear`: Allow clearing selection (default: true)

### setSelect2Value(selector, id, text)
Sets initial value for Select2 dropdown (useful for edit forms).

**Parameters:**
- `selector`: jQuery selector for the select element
- `id`: Value ID
- `text`: Display text

## Benefits
1. **Performance**: Only loads 20 items at a time instead of all records
2. **Search**: Users can search through categories/subcategories
3. **Scalability**: Works efficiently even with thousands of records
4. **User Experience**: Smooth infinite scroll pagination
5. **Maintainability**: Centralized JavaScript functions for reuse

## Notes
- Select2 library is already included in the dashboard template
- SubCategory dropdown is automatically disabled until a category is selected
- Search has a 250ms delay to prevent excessive API calls
- Pagination loads 20 items per page by default
- All filter parameters are preserved when using Select2 in filter forms
