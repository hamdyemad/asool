<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Electronics', 'Fashion', 'Home & Garden', 'Sports & Outdoors', 'Books',
            'Toys & Games', 'Health & Beauty', 'Automotive', 'Food & Beverages', 'Pet Supplies',
            'Office Supplies', 'Baby Products', 'Jewelry', 'Music', 'Movies & TV',
            'Video Games', 'Tools & Hardware', 'Arts & Crafts', 'Industrial', 'Grocery',
            'Furniture', 'Appliances', 'Lighting', 'Kitchen', 'Bedding',
            'Bath', 'Outdoor Living', 'Fitness Equipment', 'Camping', 'Cycling',
            'Fishing', 'Hunting', 'Golf', 'Tennis', 'Basketball',
            'Football', 'Baseball', 'Soccer', 'Swimming', 'Yoga',
            'Running', 'Hiking', 'Climbing', 'Skiing', 'Snowboarding',
            'Skateboarding', 'Surfing', 'Diving', 'Boating', 'Kayaking'
        ];

        $descriptions = [
            'High quality products for everyday use',
            'Premium selection of top-rated items',
            'Best deals on popular products',
            'Exclusive collection of unique items',
            'Wide variety of choices available',
            'Trusted brands and reliable quality',
            'Latest trends and innovations',
            'Affordable prices without compromise',
            'Professional grade equipment',
            'Eco-friendly and sustainable options'
        ];

        echo "Creating 400 categories...\n";

        for ($i = 1; $i <= 400; $i++) {
            $baseName = $categories[array_rand($categories)];
            $name = $baseName . ' ' . $i;
            
            Category::create([
                'name' => $name,
                'description' => $descriptions[array_rand($descriptions)] . ' in ' . $baseName . ' category.',
                'created_at' => now()->subDays(rand(0, 365)),
                'updated_at' => now()->subDays(rand(0, 30)),
            ]);

            if ($i % 50 == 0) {
                echo "Created {$i} categories...\n";
            }
        }

        echo "✓ Successfully created 400 categories!\n";
    }
}
