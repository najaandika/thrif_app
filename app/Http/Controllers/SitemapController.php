<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'available')
            ->orderBy('updated_at', 'desc')
            ->get();

        $content = view('sitemap', compact('products'))->render();

        return response($content, 200)
            ->header('Content-Type', 'application/xml');
    }
}
