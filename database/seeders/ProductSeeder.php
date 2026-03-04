<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Product;
use App\Category;
use App\SubCategory;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $productPrefixes = [
            'Ultra', 'Super', 'Mega', 'Pro', 'Max',
            'Plus', 'Premium', 'Deluxe', 'Elite', 'Advanced',
            'Smart', 'Digital', 'Wireless', 'Portable', 'Compact',
            'Heavy-Duty', 'Professional', 'Industrial', 'Commercial', 'Residential',
            'Eco-Friendly', 'Sustainable', 'Organic', 'Natural', 'Pure',
            'High-Performance', 'Energy-Efficient', 'Multi-Purpose', 'All-in-One', 'Versatile'
        ];

        $productTypes = [
            'Device', 'Tool', 'Equipment', 'Gadget', 'Accessory',
            'System', 'Kit', 'Set', 'Bundle', 'Package',
            'Unit', 'Module', 'Component', 'Part', 'Piece',
            'Machine', 'Appliance', 'Instrument', 'Apparatus', 'Mechanism',
            'Product', 'Item', 'Article', 'Good', 'Merchandise',
            'Solution', 'Service', 'Platform', 'Application', 'Software'
        ];

        $productSuffixes = [
            '2024', 'Pro', 'Plus', 'Max', 'Ultra',
            'X', 'XL', 'XXL', 'Mini', 'Micro',
            'V2', 'V3', 'Gen 2', 'Gen 3', 'Edition',
            'Series', 'Model', 'Version', 'Type', 'Style',
            'Advanced', 'Premium', 'Standard', 'Basic', 'Lite'
        ];

        $descriptions = [
            'High-quality product designed for maximum performance and durability',
            'Innovative solution that combines functionality with elegant design',
            'Professional-grade equipment trusted by experts worldwide',
            'Perfect blend of quality, reliability, and affordability',
            'State-of-the-art technology for modern lifestyle needs',
            'Engineered for excellence with attention to every detail',
            'Versatile and practical for everyday use and special occasions',
            'Premium materials and craftsmanship ensure long-lasting quality',
            'User-friendly design with advanced features and capabilities',
            'Eco-conscious product that doesn\'t compromise on performance',
            'Cutting-edge innovation meets timeless design principles',
            'Exceptional value with outstanding performance characteristics',
            'Carefully crafted to exceed industry standards and expectations',
            'Reliable and efficient solution for demanding applications',
            'Superior quality backed by extensive research and development'
        ];

        $categories = Category::all();
        $subCategories = SubCategory::all();
        
        if ($categories->isEmpty()) {
            echo "Error: No categories found. Please run CategorySeeder first.\n";
            return;
        }

        echo "Creating 400 products...\n";

        for ($i = 1; $i <= 400; $i++) {
            $category = $categories->random();
            
            // 70% chance to have a subcategory
            $subCategory = null;
            if (rand(1, 100) <= 70 && $subCategories->isNotEmpty()) {
                // Try to get a subcategory from the same category
                $categorySubCategories = $subCategories->where('category_id', $category->id);
                if ($categorySubCategories->isNotEmpty()) {
                    $subCategory = $categorySubCategories->random();
                } else {
                    $subCategory = $subCategories->random();
                }
            }

            $prefix = $productPrefixes[array_rand($productPrefixes)];
            $type = $productTypes[array_rand($productTypes)];
            $suffix = $productSuffixes[array_rand($productSuffixes)];
            $name = $prefix . ' ' . $type . ' ' . $suffix . ' #' . $i;
            
            Product::create([
                'category_id' => $category->id,
                'sub_category_id' => $subCategory ? $subCategory->id : null,
                'name' => $name,
                'description' => $descriptions[array_rand($descriptions)],
                'main_image' => null, // No images for seeded data
                'created_at' => now()->subDays(rand(0, 365)),
                'updated_at' => now()->subDays(rand(0, 30)),
            ]);

            if ($i % 50 == 0) {
                echo "Created {$i} products...\n";
            }
        }

        echo "✓ Successfully created 400 products!\n";
    }
}
