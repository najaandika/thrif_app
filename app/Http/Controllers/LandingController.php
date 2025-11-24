<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class LandingController extends Controller
{
    public function __invoke()
    {
        $limit = 6;

        $baseQuery = Product::query()
            ->where('is_available', true)
            ->where('stock', '>', 0)
            ->latest('updated_at');

        $featuredProducts = (clone $baseQuery)
            ->take($limit)
            ->get();

        $hasMoreProducts = $baseQuery->count() > $limit;

        // Fetch categories with product count
        // Since products.category is a string field, we need to count manually
        $categories = Category::all()->map(function ($category) {
            $category->products_count = Product::where('is_available', true)
                ->where('stock', '>', 0)
                ->where('category', 'LIKE', '%' . $category->name . '%')
                ->count();
            return $category;
        })->filter(function ($category) {
            return $category->products_count > 0;
        })->sortBy('name')->values();

        return view('welcome', [
            'featuredProducts' => $featuredProducts,
            'hasMoreProducts' => $hasMoreProducts,
            'categories' => $categories,
        ]);
    }
}
