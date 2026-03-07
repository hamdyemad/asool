<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LexaAdmin extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($folderName, $fileName)
    {
        // Render perticular view file by foldername and filename
        if (view()->exists($folderName . "." . $fileName)) {
            
            if ($folderName === 'dashboard' && $fileName === 'index') {
                $categoriesCount = \App\Category::count();
                $subCategoriesCount = \App\SubCategory::count();
                $productsCount = \App\Product::count();
                
                $monthsData = [];
                for ($i = 5; $i >= 0; $i--) {
                    $date = \Carbon\Carbon::now()->subMonths($i);
                    $start = $date->copy()->startOfMonth();
                    $end = $date->copy()->endOfMonth();

                    $monthsData[] = [
                        'y' => $date->format('Y-m'),
                        'a' => \App\Product::whereBetween('created_at', [$start, $end])->count(),
                        'b' => \App\Category::whereBetween('created_at', [$start, $end])->count(),
                        'c' => \App\SubCategory::whereBetween('created_at', [$start, $end])->count()
                    ];
                }

                return view($folderName . "." . $fileName, compact('categoriesCount', 'subCategoriesCount', 'productsCount', 'monthsData'));
            }

            return view($folderName . "." . $fileName);
        }
        return abort(404);
    }

    public function root()
    {
        $categoriesCount = \App\Category::count();
        $subCategoriesCount = \App\SubCategory::count();
        $productsCount = \App\Product::count();
        
        $monthsData = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = \Carbon\Carbon::now()->subMonths($i);
            $start = $date->copy()->startOfMonth();
            $end = $date->copy()->endOfMonth();

            $monthsData[] = [
                'y' => $date->format('Y-m'),
                'a' => \App\Product::whereBetween('created_at', [$start, $end])->count(),
                'b' => \App\Category::whereBetween('created_at', [$start, $end])->count(),
                'c' => \App\SubCategory::whereBetween('created_at', [$start, $end])->count()
            ];
        }

        return view('dashboard.index', compact('categoriesCount', 'subCategoriesCount', 'productsCount', 'monthsData'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function live()
    {
        return "";
    }
}
