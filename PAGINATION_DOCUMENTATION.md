# Pagination Documentation

## Overview
Added pagination to all index pages (Categories, SubCategories, Products) to handle large datasets efficiently.

## Implementation

### Default Settings
- **Default per page**: 15 records
- **Customizable**: Can be changed via query parameter `per_page`
- **Maintains filters**: Pagination links preserve all filter parameters

### Architecture Layers

#### 1. Repositories
Updated to use `paginate()` instead of `get()`:

```php
public function all($filters = [], $perPage = 15)
{
    return Category::filter($filters)->latest()->paginate($perPage);
}
```

#### 2. Services
Pass through the `$perPage` parameter:

```php
public function getAllCategories($filters = [], $perPage = 15)
{
    return $this->categoryRepository->all($filters, $perPage);
}
```

#### 3. Controllers
Extract `per_page` from request and pass to service:

```php
public function index(Request $request)
{
    $filters = $request->only(['search', 'date_from', 'date_to']);
    $perPage = $request->get('per_page', 15);
    $categories = $this->categoryService->getAllCategories($filters, $perPage);
    return view('categories.index', compact('categories'));
}
```

**Note**: For filter dropdowns (categories/subcategories), we fetch all records:
```php
$categories = $this->categoryService->getAllCategories([], 1000);
```

#### 4. Views
Added pagination UI with info and links:

```blade
<!-- Pagination -->
<div class="row mt-3">
    <div class="col-sm-12 col-md-5">
        <div class="dataTables_info">
            Showing {{ $categories->firstItem() ?? 0 }} to {{ $categories->lastItem() ?? 0 }} of {{ $categories->total() }} entries
        </div>
    </div>
    <div class="col-sm-12 col-md-7">
        <div class="dataTables_paginate float-right">
            {{ $categories->appends(request()->query())->links() }}
        </div>
    </div>
</div>
```

## Features

### 1. Pagination Info
Shows current page range and total records:
```
Showing 1 to 15 of 400 entries
Showing 16 to 30 of 400 entries
```

### 2. Pagination Links
- First page
- Previous page
- Page numbers (with ellipsis for many pages)
- Next page
- Last page

### 3. Filter Preservation
All filter parameters are preserved when navigating pages:
```
/categories?search=electronics&date_from=2025-01-01&page=2
```

The `appends(request()->query())` ensures all query parameters are maintained.

### 4. Bootstrap Styling
Uses Laravel's default Bootstrap pagination styling that matches your dashboard theme.

## Usage

### Default Pagination (15 per page)
```
/categories
/subcategories
/products
```

### Custom Per Page
```
/categories?per_page=25
/products?per_page=50
/subcategories?per_page=100
```

### With Filters
```
/categories?search=electronics&per_page=20&page=2
/products?category_id=1&date_from=2025-01-01&per_page=30&page=3
```

## Pagination Methods Available

### In Views
```blade
{{ $categories->links() }}              // Pagination links
{{ $categories->total() }}              // Total records
{{ $categories->count() }}              // Records on current page
{{ $categories->firstItem() }}          // First item number
{{ $categories->lastItem() }}           // Last item number
{{ $categories->currentPage() }}        // Current page number
{{ $categories->lastPage() }}           // Last page number
{{ $categories->hasPages() }}           // Has multiple pages?
{{ $categories->hasMorePages() }}       // Has next page?
{{ $categories->onFirstPage() }}        // On first page?
```

### In Controllers
```php
$categories->total()           // Total records
$categories->perPage()         // Records per page
$categories->currentPage()     // Current page
$categories->lastPage()        // Last page
$categories->hasMorePages()    // Has more pages?
```

## Customization

### Change Default Per Page
Update the default value in repositories:

```php
public function all($filters = [], $perPage = 25) // Changed from 15 to 25
{
    return Category::filter($filters)->latest()->paginate($perPage);
}
```

### Change Pagination View
Laravel uses Bootstrap by default. To customize, publish pagination views:

```bash
php artisan vendor:publish --tag=laravel-pagination
```

Then edit files in `resources/views/vendor/pagination/`

### Add Per Page Selector
Add a dropdown in the view to let users choose per page:

```blade
<select name="per_page" onchange="this.form.submit()">
    <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
</select>
```

## Performance Benefits

### Before (Without Pagination)
```php
// Loads ALL 400 records into memory
$categories = Category::all();
```

**Problems**:
- High memory usage
- Slow page load
- Poor user experience with large tables
- Database overhead

### After (With Pagination)
```php
// Loads only 15 records per page
$categories = Category::paginate(15);
```

**Benefits**:
- Low memory usage (only 15 records)
- Fast page load
- Better user experience
- Efficient database queries
- Scalable to thousands of records

## Database Queries

### Without Pagination
```sql
SELECT * FROM categories ORDER BY created_at DESC
-- Returns 400 rows
```

### With Pagination
```sql
SELECT * FROM categories ORDER BY created_at DESC LIMIT 15 OFFSET 0
-- Returns only 15 rows

SELECT COUNT(*) FROM categories
-- For total count
```

## Testing Pagination

### Test Cases

1. **First Page**
   - URL: `/categories`
   - Should show records 1-15
   - "Previous" button disabled

2. **Middle Page**
   - URL: `/categories?page=5`
   - Should show records 61-75
   - Both "Previous" and "Next" enabled

3. **Last Page**
   - URL: `/categories?page=27` (for 400 records)
   - Should show records 391-400
   - "Next" button disabled

4. **With Filters**
   - URL: `/categories?search=electronics&page=2`
   - Should maintain search filter
   - Should show page 2 of filtered results

5. **Invalid Page**
   - URL: `/categories?page=999`
   - Laravel automatically redirects to last valid page

## Troubleshooting

### Pagination Links Not Showing
**Cause**: Not enough records to paginate
**Solution**: Ensure you have more than 15 records

### Filters Lost on Page Change
**Cause**: Not using `appends(request()->query())`
**Solution**: Use `{{ $categories->appends(request()->query())->links() }}`

### Wrong Page Count
**Cause**: Using `get()` instead of `paginate()`
**Solution**: Ensure repositories use `paginate($perPage)`

### Slow Pagination
**Cause**: Missing database indexes
**Solution**: Add indexes on frequently filtered columns:
```php
$table->index('created_at');
$table->index('category_id');
```

## Best Practices

1. **Always use pagination** for lists that can grow large
2. **Preserve filters** using `appends(request()->query())`
3. **Show pagination info** (Showing X to Y of Z entries)
4. **Use appropriate per page values** (15-50 for most cases)
5. **Add database indexes** on filtered/sorted columns
6. **Handle empty states** gracefully
7. **Test with large datasets** to ensure performance

## Summary

Pagination is now implemented across all index pages:
- **Categories**: 15 per page (400 total)
- **SubCategories**: 15 per page (400 total)
- **Products**: 15 per page (400 total)

All filters are preserved during pagination, and the UI shows clear information about the current page and total records.
