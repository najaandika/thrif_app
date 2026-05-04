<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class LandingController extends Controller
{
    public function __invoke()
    {
        $data = \Illuminate\Support\Facades\Cache::remember('landing_page_data', 300, function () {
            $limit = 8;

            $baseQuery = Product::query()
                ->where('is_available', true)
                ->latest('updated_at');

            $featuredProducts = (clone $baseQuery)
                ->take($limit)
                ->get();

            $hasMoreProducts = $baseQuery->count() > $limit;

            // Fetch categories with product count
            $categories = Category::all()->map(function ($category) {
                $category->products_count = Product::where('is_available', true)
                    ->where('category', 'LIKE', '%' . $category->name . '%')
                    ->count();
                return $category;
            })->filter(function ($category) {
                return $category->products_count > 0;
            })->sortBy('name')->values();

            return [
                'featuredProducts' => $featuredProducts,
                'hasMoreProducts' => $hasMoreProducts,
                'categories' => $categories,
            ];
        });

        return view('welcome', $data);
    }
}
