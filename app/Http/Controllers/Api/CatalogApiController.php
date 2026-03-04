<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\SubCategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class CatalogApiController extends Controller
{
    protected $categoryService;
    protected $subCategoryService;
    protected $productService;

    public function __construct(
        CategoryService $categoryService,
        SubCategoryService $subCategoryService,
        ProductService $productService
    ) {
        $this->categoryService = $categoryService;
        $this->subCategoryService = $subCategoryService;
        $this->productService = $productService;
    }

    /**
     * Get all categories
     */
    public function categories(Request $request)
    {
        $perPage = $request->get('per_page', 20);
        $filters = $request->only(['search']);
        
        $categories = $this->categoryService->getAllCategories($filters, $perPage);
        
        return response()->json([
            'success' => true,
            'data' => $categories->items(),
            'pagination' => [
                'current_page' => $categories->currentPage(),
                'last_page' => $categories->lastPage(),
                'per_page' => $categories->perPage(),
                'total' => $categories->total(),
                'from' => $categories->firstItem(),
                'to' => $categories->lastItem(),
            ]
        ]);
    }

    /**
     * Get single category
     */
    public function category($id)
    {
        try {
            $category = $this->categoryService->getCategoryById($id);
            
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $category->id,
                    'name' => $category->name,
                    'description' => $category->description,
                    'created_at' => $category->created_at->format('Y-m-d H:i:s'),
                    'subcategories_count' => $category->subCategories->count(),
                    'products_count' => $category->products->count(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }
    }

    /**
     * Get all subcategories
     */
    public function subcategories(Request $request)
    {
        $perPage = $request->get('per_page', 20);
        $filters = $request->only(['search', 'category_id']);
        
        $subCategories = $this->subCategoryService->getAllSubCategories($filters, $perPage);
        
        $data = $subCategories->map(function($subCategory) {
            return [
                'id' => $subCategory->id,
                'name' => $subCategory->name,
                'description' => $subCategory->description,
                'category' => [
                    'id' => $subCategory->category->id,
                    'name' => $subCategory->category->name,
                ],
                'created_at' => $subCategory->created_at->format('Y-m-d H:i:s'),
            ];
        });
        
        return response()->json([
            'success' => true,
            'data' => $data,
            'pagination' => [
                'current_page' => $subCategories->currentPage(),
                'last_page' => $subCategories->lastPage(),
                'per_page' => $subCategories->perPage(),
                'total' => $subCategories->total(),
                'from' => $subCategories->firstItem(),
                'to' => $subCategories->lastItem(),
            ]
        ]);
    }

    /**
     * Get single subcategory
     */
    public function subcategory($id)
    {
        try {
            $subCategory = $this->subCategoryService->getSubCategoryById($id);
            
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $subCategory->id,
                    'name' => $subCategory->name,
                    'description' => $subCategory->description,
                    'category' => [
                        'id' => $subCategory->category->id,
                        'name' => $subCategory->category->name,
                    ],
                    'created_at' => $subCategory->created_at->format('Y-m-d H:i:s'),
                    'products_count' => $subCategory->products->count(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'SubCategory not found'
            ], 404);
        }
    }

    /**
     * Get all products
     */
    public function products(Request $request)
    {
        $perPage = $request->get('per_page', 20);
        $filters = $request->only(['search', 'category_id', 'sub_category_id']);
        
        $products = $this->productService->getAllProducts($filters, $perPage);
        
        $data = $products->map(function($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'main_image' => $product->main_image ? asset('storage/' . $product->main_image) : null,
                'images' => $product->images->map(function($image) {
                    return asset('storage/' . $image->image_path);
                }),
                'category' => [
                    'id' => $product->category->id,
                    'name' => $product->category->name,
                ],
                'subcategory' => $product->subCategory ? [
                    'id' => $product->subCategory->id,
                    'name' => $product->subCategory->name,
                ] : null,
                'created_at' => $product->created_at->format('Y-m-d H:i:s'),
            ];
        });
        
        return response()->json([
            'success' => true,
            'data' => $data,
            'pagination' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
                'from' => $products->firstItem(),
                'to' => $products->lastItem(),
            ]
        ]);
    }

    /**
     * Get single product
     */
    public function product($id)
    {
        try {
            $product = $this->productService->getProductById($id);
            
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'main_image' => $product->main_image ? asset('storage/' . $product->main_image) : null,
                    'images' => $product->images->map(function($image) {
                        return [
                            'id' => $image->id,
                            'url' => asset('storage/' . $image->image_path),
                        ];
                    }),
                    'category' => [
                        'id' => $product->category->id,
                        'name' => $product->category->name,
                    ],
                    'subcategory' => $product->subCategory ? [
                        'id' => $product->subCategory->id,
                        'name' => $product->subCategory->name,
                    ] : null,
                    'created_at' => $product->created_at->format('Y-m-d H:i:s'),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }
    }
}
