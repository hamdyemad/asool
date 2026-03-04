<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    /**
     * Run the catalog database seeds.
     * This seeder creates 400 categories, 400 subcategories, and 400 products.
     *
     * @return void
     */
    public function run()
    {
        echo "\n";
        echo "========================================\n";
        echo "  CATALOG SEEDER - Starting...\n";
        echo "========================================\n\n";

        $startTime = microtime(true);

        // Seed in order: Categories → SubCategories → Products
        $this->call([
            CategorySeeder::class,
            SubCategorySeeder::class,
            ProductSeeder::class,
        ]);

        $endTime = microtime(true);
        $executionTime = round($endTime - $startTime, 2);

        echo "\n========================================\n";
        echo "  CATALOG SEEDER - Completed!\n";
        echo "========================================\n";
        echo "  Total Records Created:\n";
        echo "  - Categories: 400\n";
        echo "  - SubCategories: 400\n";
        echo "  - Products: 400\n";
        echo "  - Total: 1,200 records\n";
        echo "  Execution Time: {$executionTime} seconds\n";
        echo "========================================\n\n";
    }
}
