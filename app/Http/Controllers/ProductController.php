<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Offer;
use App\Category;

class ProductController extends Controller
{
    public function index(){
        $products = Product::with('offers')->take(20)->get();

        $categories = Category::all();
        $categories_parents = $categories->where('parent', '')->toArray();
        $categories_childrens = $categories->where('parent', '!=','');
        
        foreach($categories_parents as &$parent){
            $parent['childrens'] = $categories_childrens->where('parent', $parent['id']);
        };

        return view('catalog', ['products' => $products, 'categories' => $categories_parents]);
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $products = Product::where('title', 'like', '%'.$search.'%')->orWhere('description', 'like', '%'.$search.'%')->get();
        $code = 200;
        return response()->json($products, $code);
    }
}
