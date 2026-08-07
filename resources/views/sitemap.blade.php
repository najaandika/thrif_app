@php echo '<' . '?xml version="1.0" encoding="UTF-8"?' . '>'; @endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->toW3cString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ url('/landing/products') }}</loc>
        <lastmod>{{ now()->toW3cString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
    @foreach($categories as $category)
    <url>
        <loc>{{ url('/landing/products?category=' . urlencode($category->name)) }}</loc>
        <lastmod>{{ now()->toW3cString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach
    @foreach($products as $product)
    <url>
        <loc>{{ url('/landing/products/' . $product->id) }}</loc>
        <lastmod>{{ $product->updated_at->toW3cString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
        @if($product->image)
        <image:image>
            <image:loc>{{ media_url($product->image) }}</image:loc>
            <image:title>{{ htmlspecialchars($product->name, ENT_XML1) }}</image:title>
            @if($product->description)
            <image:caption>{{ htmlspecialchars(\Illuminate\Support\Str::limit(strip_tags($product->description), 200), ENT_XML1) }}</image:caption>
            @endif
        </image:image>
        @endif
        @foreach($product->images as $img)
        <image:image>
            <image:loc>{{ media_url($img->image_path) }}</image:loc>
            <image:title>{{ htmlspecialchars($product->name, ENT_XML1) }}</image:title>
        </image:image>
        @endforeach
    </url>
    @endforeach
</urlset>

