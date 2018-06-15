<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Offer;
use App\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function index($category = '')
    { 
        $products = DB::table('products')
        ->select('products.*', DB::raw('SUM(offers.sales) as total_sales'), 'categories.alias')
        ->join('product_offer', 'products.id', '=', 'product_offer.product_id')
        ->join('offers', 'product_offer.offer_id', '=', 'offers.id')
        ->join('product_category', 'product_category.product_id', '=', 'products.id')
        ->join('categories', 'product_category.category_id', '=', 'categories.id')
        ->orderBy('total_sales', 'desc')
        ->where('alias', 'like', '%'.$category.'%')
        ->groupBy('products.id')
        ->limit(20)
        ->get();

        $categories = Category::with('childrens')->where('parent', null)->get();
        $parent = Category::with('categoryParent')->where('alias',  $category)->first();

        \DB::listen(function ($sql) { 
            var_dump($sql->sql);
        });

        return view('catalog', ['products' => $products, 'categories' => $categories, 'active_category' => $parent]);
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $products = Product::where('title', 'like', '%'.$search.'%')->orWhere('description', 'like', '%'.$search.'%')->get();
        $code = 200;
        return response()->json($products, $code);
    }

    
}
