<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class SitemapController extends Controller
{
    public function index()
    {
        $products = Product::where('is_available', true)
            ->with('images')
            ->orderBy('updated_at', 'desc')
            ->get();

        // Only include categories that have at least one available product
        $categories = Category::query()
            ->whereIn('name', Product::where('is_available', true)
                ->whereNotNull('category')
                ->distinct()
                ->pluck('category'))
            ->orderBy('name')
            ->get();

        $content = view('sitemap', compact('products', 'categories'))->render();

        // Remove any leading whitespace/BOM before XML declaration
        $content = ltrim($content);

        return response($content, 200)
            ->header('Content-Type', 'application/xml; charset=UTF-8')
            ->header('X-Robots-Tag', 'noindex');
    }
}
