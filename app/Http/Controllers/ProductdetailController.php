<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductdetailController extends Controller
{
    public function detail($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        return view('product-detail', compact('product'));
    }
}
