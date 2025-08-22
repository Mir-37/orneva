<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['brand', 'category'])->where('is_active', true);

        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        if ($request->brand) {
            $query->where('brand_id', $request->brand);
        }

        $products = $query->paginate(12); // 12 per page
        $categories = Category::where('is_active', true)->get();
        $brands = Brand::where('is_active', true)->get();

        return view('shop', compact('products', 'categories', 'brands'));
    }

    public function show($slug)
    {
        $product = Product::with(['brand', 'category'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Fetch related products from same category
        $related = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('sproduct', compact('product', 'related'));
    }
}
