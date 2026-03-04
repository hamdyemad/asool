<?php

namespace App\Http\Controllers;

use App\Services\SubCategoryService;
use App\Services\CategoryService;
use App\Http\Requests\SubCategoryRequest;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    protected $subCategoryService;
    protected $categoryService;

    public function __construct(SubCategoryService $subCategoryService, CategoryService $categoryService)
    {
        $this->middleware('auth');
        $this->subCategoryService = $subCategoryService;
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['search', 'category_id', 'date_from', 'date_to']);
        $perPage = $request->get('per_page', 15);
        $subCategories = $this->subCategoryService->getAllSubCategories($filters, $perPage);
        return view('subcategories.index', compact('subCategories'));
    }

    public function create()
    {
        return view('subcategories.create');
    }

    public function store(SubCategoryRequest $request)
    {
        $this->subCategoryService->createSubCategory($request->validated());
        return redirect()->route('subcategories.index')->with('success', 'SubCategory created successfully');
    }

    public function show($id)
    {
        $subCategory = $this->subCategoryService->getSubCategoryById($id);
        return view('subcategories.show', compact('subCategory'));
    }

    public function edit($id)
    {
        $subCategory = $this->subCategoryService->getSubCategoryById($id);
        return view('subcategories.edit', compact('subCategory'));
    }

    public function update(SubCategoryRequest $request, $id)
    {
        $this->subCategoryService->updateSubCategory($id, $request->validated());
        return redirect()->route('subcategories.index')->with('success', 'SubCategory updated successfully');
    }

    public function destroy($id)
    {
        $this->subCategoryService->deleteSubCategory($id);
        return redirect()->route('subcategories.index')->with('success', 'SubCategory deleted successfully');
    }

    public function getByCategory($categoryId)
    {
        $subCategories = $this->subCategoryService->getAllSubCategories(['category_id' => $categoryId]);
        return response()->json($subCategories);
    }

    public function searchForSelect2(Request $request)
    {
        // If requesting single item by ID
        if ($request->has('id')) {
            $subCategory = $this->subCategoryService->getSubCategoryById($request->get('id'));
            return response()->json([
                'id' => $subCategory->id,
                'text' => $subCategory->name
            ]);
        }
        
        // Otherwise, search with pagination
        $search = $request->get('q', '');
        $categoryId = $request->get('category_id', null);
        $page = $request->get('page', 1);
        $perPage = 20;
        
        $filters = ['search' => $search];
        if ($categoryId) {
            $filters['category_id'] = $categoryId;
        }
        
        $subCategories = $this->subCategoryService->getAllSubCategories($filters, $perPage);
        
        $results = $subCategories->map(function($subCategory) {
            return [
                'id' => $subCategory->id,
                'text' => $subCategory->name
            ];
        });
        
        return response()->json([
            'results' => $results,
            'pagination' => [
                'more' => $subCategories->hasMorePages()
            ]
        ]);
    }
}
