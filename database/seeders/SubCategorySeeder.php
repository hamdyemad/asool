<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\SubCategory;
use App\Category;

class SubCategorySeeder extends Seeder
{
    public function run()
    {
        $subCategoryPrefixes = [
            'Premium', 'Standard', 'Basic', 'Deluxe', 'Professional',
            'Advanced', 'Beginner', 'Expert', 'Pro', 'Elite',
            'Classic', 'Modern', 'Vintage', 'Contemporary', 'Traditional',
            'Luxury', 'Budget', 'Mid-Range', 'High-End', 'Entry-Level',
            'Compact', 'Full-Size', 'Mini', 'Mega', 'Ultra',
            'Smart', 'Digital', 'Analog', 'Wireless', 'Wired',
            'Portable', 'Stationary', 'Mobile', 'Fixed', 'Adjustable',
            'Automatic', 'Manual', 'Semi-Automatic', 'Electric', 'Battery-Powered',
            'Solar', 'Rechargeable', 'Disposable', 'Reusable', 'Eco-Friendly',
            'Heavy-Duty', 'Light-Weight', 'Industrial', 'Commercial', 'Residential'
        ];

        $subCategorySuffixes = [
            'Collection', 'Series', 'Line', 'Range', 'Edition',
            'Set', 'Kit', 'Bundle', 'Package', 'Combo',
            'Selection', 'Assortment', 'Variety', 'Mix', 'Group',
            'Category', 'Type', 'Style', 'Model', 'Version',
            'Grade', 'Class', 'Level', 'Tier', 'Rank'
        ];

        $descriptions = [
            'Carefully curated selection of quality items',
            'Best-selling products in this category',
            'Top-rated by customers worldwide',
            'Innovative designs and features',
            'Durable and long-lasting products',
            'Perfect for both beginners and experts',
            'Exceptional value for money',
            'Latest technology and trends',
            'Trusted by professionals',
            'Ideal for everyday use'
        ];

        $categories = Category::all();
        
        if ($categories->isEmpty()) {
            echo "Error: No categories found. Please run CategorySeeder first.\n";
            return;
        }

        echo "Creating 400 subcategories...\n";

        for ($i = 1; $i <= 400; $i++) {
            $category = $categories->random();
            $prefix = $subCategoryPrefixes[array_rand($subCategoryPrefixes)];
            $suffix = $subCategorySuffixes[array_rand($subCategorySuffixes)];
            $name = $prefix . ' ' . $suffix . ' ' . $i;
            
            SubCategory::create([
                'category_id' => $category->id,
                'name' => $name,
                'description' => $descriptions[array_rand($descriptions)] . ' for ' . $category->name . '.',
                'created_at' => now()->subDays(rand(0, 365)),
                'updated_at' => now()->subDays(rand(0, 30)),
            ]);

            if ($i % 50 == 0) {
                echo "Created {$i} subcategories...\n";
            }
        }

        echo "✓ Successfully created 400 subcategories!\n";
    }
}
