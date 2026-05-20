<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $content = view('sitemap')->render();

        // Remove any leading whitespace/BOM before XML declaration
        $content = ltrim($content);

        return response($content, 200)
            ->header('Content-Type', 'application/xml; charset=UTF-8')
            ->header('X-Robots-Tag', 'noindex');
    }
}
