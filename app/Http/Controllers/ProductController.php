<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Services\CategoryService;
use App\Services\SubCategoryService;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;
    protected $subCategoryService;

    public function __construct(
        ProductService $productService,
        CategoryService $categoryService,
        SubCategoryService $subCategoryService
    ) {
        $this->middleware('auth');
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->subCategoryService = $subCategoryService;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['search', 'category_id', 'sub_category_id', 'date_from', 'date_to']);
        $perPage = $request->get('per_page', 15);
        $products = $this->productService->getAllProducts($filters, $perPage);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductRequest $request)
    {
        $this->productService->createProduct($request->validated());
        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = $this->productService->getProductById($id);
        return view('products.edit', compact('product'));
    }

    public function update(ProductRequest $request, $id)
    {
        $this->productService->updateProduct($id, $request->validated());
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        $this->productService->deleteProduct($id);
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }

    public function deleteImage($productId, $imageId)
    {
        $product = $this->productService->getProductById($productId);
        $image = $product->images()->findOrFail($imageId);
        \Storage::disk('public')->delete($image->image_path);
        $image->delete();
        return back()->with('success', 'Image deleted successfully');
    }
}
