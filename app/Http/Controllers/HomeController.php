<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function index()
   {
      $products = Product::latest()->get();
      $categories = Category::all();
      return view('home', compact('products', 'categories'));
   }

   public function search(Request $request)
   {
      $query = $request->input('query');
      $products = Product::where('name', 'LIKE', "%$query%")->get();
      return view('search', compact('products', 'query'));
   }
}
