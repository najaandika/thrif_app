<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q', '');
        $products = Product::query()
            ->where('name', 'like', '%' . $query . '%')
            ->orWhere('category', 'like', '%' . $query . '%')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('landing.sections.product-search-results', [
            'products' => $products,
            'query' => $query,
        ]);
    }
}
