<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\BusinessDetail;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with('category')
            ->where('flag', 'featured')
            ->where('is_active', true)
            ->take(8)->get();

        $newArrivals = Product::with('category')
            ->latest()
            ->where('is_active', true)
            ->take(8)->get();


        return view('home', compact('featuredProducts', 'newArrivals'));
    }
}
