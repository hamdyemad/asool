# Refactored Architecture - Proper Service-Repository Pattern

## Overview
Refactored the filtering logic to follow proper separation of concerns using the Service-Repository pattern with Model Scopes.

## Architecture Layers

### 1. Models (Data Structure + Scopes)
**Location**: `app/`
- `Category.php`
- `SubCategory.php`
- `Product.php`

**Responsibilities**:
- Define database structure and relationships
- Implement `scopeFilter()` method for filtering logic
- Keep filtering logic close to the data model

**Example**:
```php
public function scopeFilter($query, $filters)
{
    if (isset($filters['search']) && $filters['search']) {
        $query->where(function($q) use ($filters) {
            $q->where('name', 'like', "%{$filters['search']}%")
              ->orWhere('description', 'like', "%{$filters['search']}%");
        });
    }
    
    if (isset($filters['date_from']) && $filters['date_from']) {
        $query->whereDate('created_at', '>=', $filters['date_from']);
    }
    
    return $query;
}
```

### 2. Repositories (Data Access Layer)
**Location**: `app/Repositories/`
- `CategoryRepository.php`
- `SubCategoryRepository.php`
- `ProductRepository.php`

**Responsibilities**:
- Handle all database queries
- Use model scopes for filtering
- Return Eloquent collections or models
- NO business logic

**Example**:
```php
public function all($filters = [])
{
    return Category::filter($filters)->latest()->get();
}
```

### 3. Services (Business Logic Layer)
**Location**: `app/Services/`
- `CategoryService.php`
- `SubCategoryService.php`
- `ProductService.php`

**Responsibilities**:
- Implement business logic
- Call repository methods
- Handle file uploads (for products)
- Transform data if needed
- NO direct database queries

**Example**:
```php
public function getAllCategories($filters = [])
{
    return $this->categoryRepository->all($filters);
}
```

### 4. Controllers (Request Handling)
**Location**: `app/Http/Controllers/`
- `CategoryController.php`
- `SubCategoryController.php`
- `ProductController.php`

**Responsibilities**:
- Handle HTTP requests
- Extract filters from request
- Call service methods
- Return views with data
- NO direct model access
- NO business logic

**Example**:
```php
public function index(Request $request)
{
    $filters = $request->only(['search', 'date_from', 'date_to']);
    $categories = $this->categoryService->getAllCategories($filters);
    return view('categories.index', compact('categories'));
}
```

## Data Flow

```
Request → Controller → Service → Repository → Model (with Scope) → Database
                ↓
            Response
```

### Example Flow for Filtered List:
1. **User** submits filter form
2. **Controller** extracts filters from request
3. **Controller** calls service with filters
4. **Service** calls repository with filters
5. **Repository** uses model scope with filters
6. **Model Scope** builds query with filters
7. **Database** returns filtered results
8. **Controller** returns view with data

## Benefits of This Architecture

### 1. Separation of Concerns
- Each layer has a single responsibility
- Easy to understand and maintain
- Changes in one layer don't affect others

### 2. Testability
- Easy to mock repositories in service tests
- Easy to mock services in controller tests
- Scope filters can be tested independently

### 3. Reusability
- Scopes can be used anywhere in the application
- Services can be used by multiple controllers
- Repositories can be used by multiple services

### 4. Maintainability
- Filtering logic is in one place (model scope)
- Easy to add new filters
- Easy to modify existing filters

### 5. Consistency
- All filtering follows the same pattern
- All data access goes through repositories
- All business logic goes through services

## Filter Implementation

### Adding a New Filter

1. **Update Model Scope**:
```php
// app/Category.php
public function scopeFilter($query, $filters)
{
    // ... existing filters ...
    
    if (isset($filters['status']) && $filters['status']) {
        $query->where('status', $filters['status']);
    }
    
    return $query;
}
```

2. **Update Controller** (extract new filter):
```php
// app/Http/Controllers/CategoryController.php
public function index(Request $request)
{
    $filters = $request->only(['search', 'date_from', 'date_to', 'status']);
    $categories = $this->categoryService->getAllCategories($filters);
    return view('categories.index', compact('categories'));
}
```

3. **Update View** (add filter input):
```blade
<select name="status" class="form-control">
    <option value="">All Status</option>
    <option value="active">Active</option>
    <option value="inactive">Inactive</option>
</select>
```

That's it! No changes needed in Service or Repository layers.

## Key Differences from Previous Implementation

### Before (Wrong):
```php
// Controller directly accessing Model
public function index(Request $request)
{
    $query = Category::query();
    
    if ($request->filled('search')) {
        $query->where('name', 'like', "%{$request->search}%");
    }
    
    $categories = $query->get();
    return view('categories.index', compact('categories'));
}
```

**Problems**:
- Controller has database logic
- Violates single responsibility
- Hard to test
- Not reusable
- Breaks service-repository pattern

### After (Correct):
```php
// Controller delegates to Service
public function index(Request $request)
{
    $filters = $request->only(['search', 'date_from', 'date_to']);
    $categories = $this->categoryService->getAllCategories($filters);
    return view('categories.index', compact('categories'));
}

// Service delegates to Repository
public function getAllCategories($filters = [])
{
    return $this->categoryRepository->all($filters);
}

// Repository uses Model Scope
public function all($filters = [])
{
    return Category::filter($filters)->latest()->get();
}

// Model has filtering logic
public function scopeFilter($query, $filters)
{
    // filtering logic here
}
```

**Benefits**:
- Clean separation of concerns
- Easy to test each layer
- Reusable across application
- Follows SOLID principles
- Maintainable and scalable

## Summary

The refactored architecture properly implements the Service-Repository pattern with:
- **Models**: Define structure and scopes
- **Repositories**: Handle data access
- **Services**: Implement business logic
- **Controllers**: Handle HTTP requests

All filtering logic is now in model scopes, making it reusable, testable, and maintainable.
