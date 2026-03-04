<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->middleware('auth');
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['search', 'date_from', 'date_to']);
        $perPage = $request->get('per_page', 15);
        $categories = $this->categoryService->getAllCategories($filters, $perPage);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $this->categoryService->createCategory($request->validated());
        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    public function show($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        return view('categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $this->categoryService->updateCategory($id, $request->validated());
        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        $this->categoryService->deleteCategory($id);
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }

    public function searchForSelect2(Request $request)
    {
        // If requesting single item by ID
        if ($request->has('id')) {
            $category = $this->categoryService->getCategoryById($request->get('id'));
            return response()->json([
                'id' => $category->id,
                'text' => $category->name
            ]);
        }
        
        // Otherwise, search with pagination
        $search = $request->get('q', '');
        $page = $request->get('page', 1);
        $perPage = 20;
        
        $filters = ['search' => $search];
        $categories = $this->categoryService->getAllCategories($filters, $perPage);
        
        $results = $categories->map(function($category) {
            return [
                'id' => $category->id,
                'text' => $category->name
            ];
        });
        
        return response()->json([
            'results' => $results,
            'pagination' => [
                'more' => $categories->hasMorePages()
            ]
        ]);
    }
}

