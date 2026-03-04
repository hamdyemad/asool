# Blade Components Documentation

## Overview
Created reusable Blade components for forms, filters, tables, and pagination to maintain consistency and reduce code duplication across the application.

## Available Components

### 1. Form Components

#### form-input
**Location**: `resources/views/common-components/form-input.blade.php`

**Usage**:
```blade
@component('common-components.form-input', [
    'name' => 'email',
    'label' => 'Email Address',
    'type' => 'email',
    'required' => true,
    'placeholder' => 'Enter your email',
    'help' => 'We will never share your email',
    'value' => old('email', $user->email ?? '')
])
@endcomponent
```

**Parameters**:
- `name` (required) - Input name attribute
- `label` (required) - Label text
- `type` (optional) - Input type (default: 'text')
- `required` (optional) - Show required asterisk (default: false)
- `placeholder` (optional) - Placeholder text
- `help` (optional) - Help text below input
- `value` (optional) - Input value
- `id` (optional) - Custom ID (defaults to name)

#### form-textarea
**Location**: `resources/views/common-components/form-textarea.blade.php`

**Usage**:
```blade
@component('common-components.form-textarea', [
    'name' => 'description',
    'label' => 'Description',
    'rows' => 5,
    'required' => false,
    'value' => old('description', $category->description ?? '')
])
@endcomponent
```

**Parameters**:
- `name` (required) - Textarea name
- `label` (required) - Label text
- `rows` (optional) - Number of rows (default: 4)
- `required` (optional) - Show required asterisk
- `placeholder` (optional) - Placeholder text
- `help` (optional) - Help text
- `value` (optional) - Textarea value

#### form-select
**Location**: `resources/views/common-components/form-select.blade.php`

**Usage**:
```blade
@component('common-components.form-select', [
    'name' => 'category_id',
    'label' => 'Category',
    'required' => true
])
    <option value="">Select Category</option>
    @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
    @endforeach
@endcomponent
```

**Parameters**:
- `name` (required) - Select name
- `label` (required) - Label text
- `required` (optional) - Show required asterisk
- `help` (optional) - Help text
- `slot` (required) - Options HTML

#### form-file
**Location**: `resources/views/common-components/form-file.blade.php`

**Usage**:
```blade
@component('common-components.form-file', [
    'name' => 'main_image',
    'label' => 'Main Image',
    'accept' => 'image/*',
    'multiple' => false,
    'preview' => asset('storage/' . $product->main_image),
    'help' => 'Max size: 2MB'
])
@endcomponent
```

**Parameters**:
- `name` (required) - File input name
- `label` (required) - Label text
- `accept` (optional) - File types (default: 'image/*')
- `multiple` (optional) - Allow multiple files
- `required` (optional) - Show required asterisk
- `preview` (optional) - Show image preview
- `help` (optional) - Help text

#### form-buttons
**Location**: `resources/views/common-components/form-buttons.blade.php`

**Usage**:
```blade
@component('common-components.form-buttons', [
    'submitText' => 'Save Product',
    'cancelText' => 'Cancel',
    'cancelUrl' => route('products.index')
])
@endcomponent
```

**Parameters**:
- `submitText` (optional) - Submit button text (default: 'Save')
- `cancelText` (optional) - Cancel button text (default: 'Cancel')
- `cancelUrl` (required) - Cancel button URL

### 2. Filter Components

#### filter-form
**Location**: `resources/views/common-components/filter-form.blade.php`

**Usage**:
```blade
@component('common-components.filter-form', ['action' => route('products.index')])
    @component('common-components.filter-input', [
        'name' => 'search',
        'label' => 'Search',
        'placeholder' => 'Search products...'
    ])
    @endcomponent
    
    @component('common-components.filter-select', [
        'name' => 'category_id',
        'label' => 'Category'
    ])
        <option value="">All Categories</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    @endcomponent
@endcomponent
```

**Parameters**:
- `action` (required) - Form action URL
- `slot` (required) - Filter inputs

**Features**:
- Automatically adds Filter and Reset buttons
- Uses GET method
- Responsive grid layout

#### filter-input
**Location**: `resources/views/common-components/filter-input.blade.php`

**Usage**:
```blade
@component('common-components.filter-input', [
    'name' => 'search',
    'label' => 'Search',
    'type' => 'text',
    'placeholder' => 'Search...',
    'col' => '4'
])
@endcomponent
```

**Parameters**:
- `name` (required) - Input name
- `label` (required) - Label text
- `type` (optional) - Input type (default: 'text')
- `placeholder` (optional) - Placeholder text
- `col` (optional) - Column width (default: '3')

#### filter-select
**Location**: `resources/views/common-components/filter-select.blade.php`

**Usage**:
```blade
@component('common-components.filter-select', [
    'name' => 'status',
    'label' => 'Status',
    'col' => '3'
])
    <option value="">All Status</option>
    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
@endcomponent
```

**Parameters**:
- `name` (required) - Select name
- `label` (required) - Label text
- `col` (optional) - Column width (default: '3')
- `slot` (required) - Options HTML

### 3. Action Components

#### action-buttons
**Location**: `resources/views/common-components/action-buttons.blade.php`

**Usage**:
```blade
@component('common-components.action-buttons', [
    'showUrl' => route('products.show', $product->id),
    'editUrl' => route('products.edit', $product->id),
    'deleteUrl' => route('products.destroy', $product->id),
    'confirmMessage' => 'Delete this product?'
])
@endcomponent
```

**Parameters**:
- `showUrl` (optional) - View button URL
- `editUrl` (optional) - Edit button URL
- `deleteUrl` (optional) - Delete button URL
- `confirmMessage` (optional) - Delete confirmation message (default: 'Are you sure?')
- `slot` (optional) - Additional custom buttons

**Features**:
- Automatically includes CSRF token for delete
- Uses DELETE method for delete action
- Includes confirmation dialog
- Consistent icon styling

### 4. Pagination Component

#### pagination
**Location**: `resources/views/common-components/pagination.blade.php`

**Usage**:
```blade
@component('common-components.pagination', ['paginator' => $products])
@endcomponent
```

**Parameters**:
- `paginator` (required) - Laravel paginator instance

**Features**:
- Shows "Showing X to Y of Z entries"
- Previous/Next buttons with icons
- Page numbers with ellipsis for many pages
- Preserves all query parameters
- Responsive layout
- Bootstrap styled with rounded pagination
- Disabled state for first/last pages

## Complete Examples

### Category Create Form
```blade
<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    
    @component('common-components.form-input', [
        'name' => 'name',
        'label' => 'Name',
        'required' => true
    ])
    @endcomponent

    @component('common-components.form-textarea', [
        'name' => 'description',
        'label' => 'Description'
    ])
    @endcomponent

    @component('common-components.form-buttons', [
        'submitText' => 'Save Category',
        'cancelUrl' => route('categories.index')
    ])
    @endcomponent
</form>
```

### Product Create Form
```blade
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    @component('common-components.form-select', [
        'name' => 'category_id',
        'label' => 'Category',
        'required' => true
    ])
        <option value="">Select Category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    @endcomponent

    @component('common-components.form-input', [
        'name' => 'name',
        'label' => 'Product Name',
        'required' => true
    ])
    @endcomponent

    @component('common-components.form-textarea', [
        'name' => 'description',
        'label' => 'Description'
    ])
    @endcomponent

    @component('common-components.form-file', [
        'name' => 'main_image',
        'label' => 'Main Image',
        'help' => 'Max size: 2MB'
    ])
    @endcomponent

    @component('common-components.form-buttons', [
        'submitText' => 'Save Product',
        'cancelUrl' => route('products.index')
    ])
    @endcomponent
</form>
```

### Index Page with Filters
```blade
@component('common-components.filter-form', ['action' => route('products.index')])
    @component('common-components.filter-input', [
        'name' => 'search',
        'label' => 'Search',
        'placeholder' => 'Search products...',
        'col' => '3'
    ])
    @endcomponent

    @component('common-components.filter-select', [
        'name' => 'category_id',
        'label' => 'Category',
        'col' => '2'
    ])
        <option value="">All Categories</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    @endcomponent

    @component('common-components.filter-input', [
        'name' => 'date_from',
        'label' => 'Created From',
        'type' => 'date',
        'col' => '2'
    ])
    @endcomponent

    @component('common-components.filter-input', [
        'name' => 'date_to',
        'label' => 'Created To',
        'type' => 'date',
        'col' => '2'
    ])
    @endcomponent
@endcomponent

<table class="table">
    <!-- table content -->
</table>

@component('common-components.pagination', ['paginator' => $products])
@endcomponent
```

## Benefits

### 1. Consistency
- All forms look the same
- All filters work the same way
- All action buttons have same styling
- All pagination looks identical

### 2. Maintainability
- Change once, update everywhere
- Easy to add new features
- Centralized styling
- Reduced code duplication

### 3. Validation
- Automatic error display
- Consistent error styling
- Old input preservation
- Required field indicators

### 4. Productivity
- Faster development
- Less code to write
- Copy-paste friendly
- Self-documenting

## Customization

### Modify Component Styling
Edit the component file directly:
```bash
resources/views/common-components/form-input.blade.php
```

All pages using this component will automatically update.

### Add New Component
Create new file in `resources/views/common-components/`:
```blade
<!-- resources/views/common-components/my-component.blade.php -->
<div class="my-component">
    {{ $slot }}
</div>
```

Use it:
```blade
@component('common-components.my-component')
    Content here
@endcomponent
```

## Migration Guide

### Before (Without Components)
```blade
<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Name <span class="text-danger">*</span></label>
    <div class="col-sm-10">
        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name') }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
```

### After (With Components)
```blade
@component('common-components.form-input', [
    'name' => 'name',
    'label' => 'Name',
    'required' => true
])
@endcomponent
```

**Result**: 11 lines → 5 lines (54% reduction)

## Summary

Created 10 reusable Blade components:
1. `form-input` - Text/email/date inputs
2. `form-textarea` - Textarea fields
3. `form-select` - Select dropdowns
4. `form-file` - File uploads
5. `form-buttons` - Submit/Cancel buttons
6. `filter-form` - Filter form wrapper
7. `filter-input` - Filter inputs
8. `filter-select` - Filter dropdowns
9. `action-buttons` - View/Edit/Delete buttons
10. `pagination` - Styled pagination with info

All components are:
- Fully responsive
- Bootstrap styled
- Validation ready
- Error handling included
- Accessible
- Reusable


## Dynamic Data Table Component

### data-table
**Location**: `resources/views/common-components/data-table.blade.php`

**Purpose**: Create dynamic, reusable tables with configurable columns and data types.

**Usage**:
```blade
@component('common-components.data-table', [
    'headers' => ['#', 'Name', 'Email', 'Status', 'Created', 'Actions'],
    'data' => $users,
    'columns' => [
        'id',
        'name',
        'email',
        ['type' => 'badge', 'field' => 'status', 'class' => 'success'],
        ['type' => 'date', 'field' => 'created_at', 'format' => 'Y-m-d'],
        function($user) {
            return view('common-components.action-buttons', [
                'showUrl' => route('users.show', $user->id),
                'editUrl' => route('users.edit', $user->id),
                'deleteUrl' => route('users.destroy', $user->id)
            ])->render();
        }
    ],
    'emptyMessage' => 'No users found'
])
@endcomponent
```

**Parameters**:
- `headers` (required) - Array of table header labels
- `data` (required) - Collection or array of data
- `columns` (required) - Array defining how to display each column
- `emptyMessage` (optional) - Message when no data (default: 'No records found')

### Column Types

#### 1. Simple Field
Display a field directly:
```php
'name'  // Displays $row->name
'email' // Displays $row->email
```

#### 2. Nested Field
Access nested relationships:
```php
'category.name'        // Displays $row->category->name
'user.profile.avatar'  // Displays $row->user->profile->avatar
```

#### 3. Badge Type
Display field as a colored badge:
```php
['type' => 'badge', 'field' => 'status', 'class' => 'success']
['type' => 'badge', 'field' => 'category.name', 'class' => 'primary']
```

**Badge Classes**: primary, secondary, success, danger, warning, info, light, dark

#### 4. Image Type
Display image with fallback:
```php
['type' => 'image', 'field' => 'avatar', 'fallback' => 'name']
['type' => 'image', 'field' => 'main_image', 'fallback' => 'title', 'alt' => 'Product Image']
```

**Features**:
- Shows image if exists
- Shows initials in colored circle if no image
- Responsive avatar-sm size

#### 5. Date Type
Format date fields:
```php
['type' => 'date', 'field' => 'created_at', 'format' => 'Y-m-d']
['type' => 'date', 'field' => 'updated_at', 'format' => 'd/m/Y H:i']
```

#### 6. Limit Type
Truncate long text:
```php
['type' => 'limit', 'field' => 'description', 'limit' => 50]
['type' => 'limit', 'field' => 'content', 'limit' => 100]
```

#### 7. Custom Callback
Full control with closure:
```php
function($row) {
    if($row->status === 'active') {
        return '<span class="badge badge-success">Active</span>';
    }
    return '<span class="badge badge-danger">Inactive</span>';
}
```

```php
function($product) {
    return view('common-components.action-buttons', [
        'showUrl' => route('products.show', $product->id),
        'editUrl' => route('products.edit', $product->id),
        'deleteUrl' => route('products.destroy', $product->id)
    ])->render();
}
```

### Complete Examples

#### Categories Table
```blade
@component('common-components.data-table', [
    'headers' => ['#', 'Name', 'Description', 'Created At', 'Actions'],
    'data' => $categories,
    'columns' => [
        'id',
        'name',
        ['type' => 'limit', 'field' => 'description', 'limit' => 50],
        ['type' => 'date', 'field' => 'created_at', 'format' => 'Y-m-d'],
        function($category) {
            return view('common-components.action-buttons', [
                'showUrl' => route('categories.show', $category->id),
                'editUrl' => route('categories.edit', $category->id),
                'deleteUrl' => route('categories.destroy', $category->id)
            ])->render();
        }
    ],
    'emptyMessage' => 'No categories found'
])
@endcomponent
```

#### Products Table with Images
```blade
@component('common-components.data-table', [
    'headers' => ['#', 'Image', 'Name', 'Category', 'Price', 'Stock', 'Actions'],
    'data' => $products,
    'columns' => [
        'id',
        ['type' => 'image', 'field' => 'main_image', 'fallback' => 'name'],
        'name',
        ['type' => 'badge', 'field' => 'category.name', 'class' => 'primary'],
        function($product) {
            return '$' . number_format($product->price, 2);
        },
        function($product) {
            $class = $product->stock > 10 ? 'success' : 'danger';
            return '<span class="badge badge-' . $class . '">' . $product->stock . '</span>';
        },
        function($product) {
            return view('common-components.action-buttons', [
                'showUrl' => route('products.show', $product->id),
                'editUrl' => route('products.edit', $product->id),
                'deleteUrl' => route('products.destroy', $product->id)
            ])->render();
        }
    ]
])
@endcomponent
```

#### SubCategories Table
```blade
@component('common-components.data-table', [
    'headers' => ['#', 'Category', 'Name', 'Description', 'Created At', 'Actions'],
    'data' => $subCategories,
    'columns' => [
        'id',
        ['type' => 'badge', 'field' => 'category.name', 'class' => 'primary'],
        'name',
        ['type' => 'limit', 'field' => 'description', 'limit' => 50],
        ['type' => 'date', 'field' => 'created_at', 'format' => 'Y-m-d'],
        function($subCategory) {
            return view('common-components.action-buttons', [
                'showUrl' => route('subcategories.show', $subCategory->id),
                'editUrl' => route('subcategories.edit', $subCategory->id),
                'deleteUrl' => route('subcategories.destroy', $subCategory->id)
            ])->render();
        }
    ]
])
@endcomponent
```

### Benefits

1. **Dynamic Headers**: Change headers without touching HTML
2. **Flexible Columns**: Mix different column types easily
3. **Reusable**: Same component for all tables
4. **Type-Safe**: Predefined types for common patterns
5. **Extensible**: Add custom logic with callbacks
6. **Consistent**: All tables look the same
7. **Maintainable**: Update once, affects all tables

### Migration from Static Tables

**Before**:
```blade
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>
                    <a href="{{ route('items.edit', $item->id) }}">Edit</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
```

**After**:
```blade
@component('common-components.data-table', [
    'headers' => ['#', 'Name', 'Actions'],
    'data' => $items,
    'columns' => [
        'id',
        'name',
        function($item) {
            return '<a href="' . route('items.edit', $item->id) . '">Edit</a>';
        }
    ]
])
@endcomponent
```

### Advanced Usage

#### Conditional Rendering
```php
function($user) {
    if($user->is_admin) {
        return '<span class="badge badge-danger">Admin</span>';
    } elseif($user->is_moderator) {
        return '<span class="badge badge-warning">Moderator</span>';
    }
    return '<span class="badge badge-secondary">User</span>';
}
```

#### Multiple Badges
```php
function($product) {
    $badges = [];
    if($product->is_featured) {
        $badges[] = '<span class="badge badge-warning">Featured</span>';
    }
    if($product->is_new) {
        $badges[] = '<span class="badge badge-success">New</span>';
    }
    return implode(' ', $badges);
}
```

#### Links
```php
function($category) {
    return '<a href="' . route('categories.show', $category->id) . '">' . $category->name . '</a>';
}
```

### Summary

The `data-table` component provides:
- **6 built-in column types**: simple, badge, image, date, limit, custom
- **Nested field support**: Access relationships easily
- **Empty state handling**: Customizable empty message
- **Responsive design**: Works on all screen sizes
- **Bootstrap styled**: Matches your dashboard theme
- **Flexible**: Mix and match column types
- **Powerful**: Custom callbacks for complex logic

All tables in the application now use this single, reusable component!
