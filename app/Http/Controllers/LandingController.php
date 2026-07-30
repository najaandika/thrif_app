<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class LandingController extends Controller
{
    public function __invoke()
    {
        $resolver = fn () => $this->landingData();

        $data = app()->environment('local')
            ? $resolver()
            : Cache::remember('landing_page_data', 300, $resolver);

        return view('welcome', $data);
    }

    private function landingData(): array
    {
        $limit = 12;

        $baseQuery = Product::query()
            ->where('is_available', true)
            ->latest('updated_at');

        $featuredProducts = (clone $baseQuery)
            ->take($limit)
            ->get();

        $hasMoreProducts = (clone $baseQuery)->count() > $limit;

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
    }
}
