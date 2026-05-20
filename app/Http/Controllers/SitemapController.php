<?php

namespace App\Http\Controllers;

use App\Models\Product;

class SitemapController extends Controller
{
    public function index()
    {
        $products = Product::where('is_available', true)
            ->orderBy('updated_at', 'desc')
            ->get();

        $content = view('sitemap', compact('products'))->render();

        // Remove any leading whitespace/BOM before XML declaration
        $content = ltrim($content);

        return response($content, 200)
            ->header('Content-Type', 'application/xml; charset=UTF-8')
            ->header('X-Robots-Tag', 'noindex');
    }
}
