<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Offer;

class ProductController extends Controller
{
    public function index(){
        $products = Product::with('offers')->take(20)->get();
        return view('catalog', ['products' => $products]);
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $products = Product::where('title', '%'.$search.'%')->orWhere('description','%'.$search.'%')->get();
        $code = 200;
        return response()->json($products, $code);
    }
}
