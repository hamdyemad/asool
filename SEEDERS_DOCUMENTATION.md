# Database Seeders Documentation

## Overview
Created comprehensive seeders for the catalog system that generate 400 records each for Categories, SubCategories, and Products with realistic data.

## Available Seeders

### 1. CategorySeeder
**File**: `database/seeders/CategorySeeder.php`
**Records**: 400 categories

**Features**:
- 50 different category base names (Electronics, Fashion, Home & Garden, etc.)
- 10 different description templates
- Random creation dates (up to 365 days ago)
- Random update dates (up to 30 days ago)
- Unique names with numbering

**Sample Data**:
```
Name: Electronics 1
Description: High quality products for everyday use in Electronics category.
Created: 2025-03-15
```

### 2. SubCategorySeeder
**File**: `database/seeders/SubCategorySeeder.php`
**Records**: 400 subcategories

**Features**:
- 50 different prefix options (Premium, Standard, Professional, etc.)
- 25 different suffix options (Collection, Series, Line, etc.)
- Randomly assigned to existing categories
- 10 different description templates
- Random creation and update dates
- Unique names with numbering

**Sample Data**:
```
Name: Premium Collection 1
Category: Electronics 1
Description: Carefully curated selection of quality items for Electronics 1.
Created: 2025-06-20
```

### 3. ProductSeeder
**File**: `database/seeders/ProductSeeder.php`
**Records**: 400 products

**Features**:
- 30 different product prefixes (Ultra, Super, Pro, etc.)
- 30 different product types (Device, Tool, Equipment, etc.)
- 25 different product suffixes (2024, Pro, Max, etc.)
- Randomly assigned to existing categories
- 70% chance to have a subcategory
- Tries to match subcategory with product's category
- 15 different description templates
- Random creation and update dates
- No images (main_image is null)
- Unique names with numbering

**Sample Data**:
```
Name: Ultra Device Pro #1
Category: Electronics 1
SubCategory: Premium Collection 1
Description: High-quality product designed for maximum performance and durability
Created: 2025-08-10
```

### 4. CatalogSeeder (Master Seeder)
**File**: `database/seeders/CatalogSeeder.php`

**Features**:
- Runs all catalog seeders in correct order
- Shows progress for each seeder
- Displays summary statistics
- Shows execution time
- Pretty formatted output

## Usage

### Option 1: Seed All Catalog Data
```bash
php artisan db:seed --class=CatalogSeeder
```

This will create:
- 400 Categories
- 400 SubCategories
- 400 Products
- Total: 1,200 records

### Option 2: Seed Individual Tables
```bash
# Seed only categories
php artisan db:seed --class=CategorySeeder

# Seed only subcategories (requires categories)
php artisan db:seed --class=SubCategorySeeder

# Seed only products (requires categories and subcategories)
php artisan db:seed --class=ProductSeeder
```

### Option 3: Seed Everything (Including Admin User)
```bash
php artisan db:seed
```

This runs DatabaseSeeder which includes:
- AdminUserSeeder
- CategorySeeder
- SubCategorySeeder
- ProductSeeder

### Option 4: Fresh Migration with Seeding
```bash
# Drop all tables, migrate, and seed
php artisan migrate:fresh --seed
```

## Seeding Order

**IMPORTANT**: Seeders must run in this order due to foreign key constraints:

1. **CategorySeeder** (no dependencies)
2. **SubCategorySeeder** (requires Categories)
3. **ProductSeeder** (requires Categories and SubCategories)

## Data Characteristics

### Categories (400 records)
- Diverse category names across multiple industries
- Realistic descriptions
- Spread across 365 days of creation dates
- Updated within last 30 days

### SubCategories (400 records)
- Evenly distributed across all categories
- Professional naming conventions
- Linked to parent categories
- Varied creation dates

### Products (400 records)
- Creative and varied product names
- 70% have subcategories
- Subcategories match product categories when possible
- Professional descriptions
- No images (can be added manually or via separate seeder)

## Performance

### Expected Execution Time
- Categories: ~2-3 seconds
- SubCategories: ~3-4 seconds
- Products: ~4-5 seconds
- **Total: ~10-12 seconds**

### Progress Indicators
Each seeder shows progress every 50 records:
```
Creating 400 categories...
Created 50 categories...
Created 100 categories...
Created 150 categories...
...
✓ Successfully created 400 categories!
```

## Customization

### Change Number of Records
Edit the loop in each seeder:
```php
// Change from 400 to desired number
for ($i = 1; $i <= 400; $i++) {
    // ...
}
```

### Add More Variety
Add more options to the arrays:
```php
$categories = [
    'Electronics', 'Fashion', 'Your New Category',
    // Add more...
];
```

### Modify Descriptions
Edit the description arrays:
```php
$descriptions = [
    'Your custom description',
    // Add more...
];
```

### Add Images to Products
Modify ProductSeeder to include images:
```php
'main_image' => 'products/sample-' . $i . '.jpg',
```

## Troubleshooting

### Error: No categories found
**Solution**: Run CategorySeeder before SubCategorySeeder or ProductSeeder
```bash
php artisan db:seed --class=CategorySeeder
```

### Error: Foreign key constraint fails
**Solution**: Ensure tables are empty or run fresh migration
```bash
php artisan migrate:fresh
php artisan db:seed --class=CatalogSeeder
```

### Slow Performance
**Solution**: 
- Disable query logging during seeding
- Use database transactions
- Increase PHP memory limit

### Duplicate Key Errors
**Solution**: Truncate tables before reseeding
```bash
php artisan migrate:fresh
```

## Testing Filters

After seeding, you can test the filter functionality:

### Test Search Filter
- Search for "Ultra" - should find many products
- Search for "Premium" - should find many subcategories
- Search for "Electronics" - should find many categories

### Test Date Filters
- Date From: 2025-01-01
- Date To: 2025-12-31
- Should show records created in 2025

### Test Category Filter
- Select any category
- Should show related subcategories/products

## Database Statistics After Seeding

```
Categories: 400 records
├── SubCategories: 400 records (distributed across categories)
└── Products: 400 records
    ├── With SubCategory: ~280 records (70%)
    └── Without SubCategory: ~120 records (30%)

Total Records: 1,200
```

## Notes

- All timestamps are randomized for realistic data
- No actual image files are created (main_image is null)
- Descriptions are varied but professional
- Names are unique with numbering
- Data is suitable for testing pagination, filtering, and searching
- Perfect for performance testing with realistic data volume

## Next Steps

After seeding:
1. Test the filter functionality on index pages
2. Test search with various keywords
3. Test date range filters
4. Verify pagination works correctly
5. Test view/edit/delete operations
6. Add images manually if needed
