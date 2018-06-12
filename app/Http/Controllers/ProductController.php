<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Offer;
use App\Category;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{

    public function index($category = null)
    {
        if(empty($category)){
            $offers_id = Offer::all()->sortByDesc('sales')->take(20)->pluck('id');
            $products = Product::whereHas('offers', function($q) use ($offers_id) {
                $q->whereIn('product_offer.offer_id', $offers_id);
            })->take(20)->get();
        } else {
            $category_search = Category::where('alias', $category);
            $category_id = $category_search->pluck('id');
            $parent = Category::find($category_search->pluck('parent'));
            $parent = $parent->isEmpty() ? $category : $parent->pluck('alias')->first();
            $category = ['parent' => $parent, 'active' => $category];
            $products = Product::whereHas('categories', function($q) use ($category_id) {
                $q->where('product_category.category_id', '=', $category_id);
            })->take(20)->get();
        ;}

        $categories = Category::all();
        $categories_parents = $categories->where('parent', '')->toArray();
        $categories_childrens = $categories->where('parent', '!=','');
        
        foreach($categories_parents as &$parent){
            $parent['childrens'] = $categories_childrens->where('parent', $parent['id'])->toArray();
        };

        return view('catalog', ['products' => $products, 'categories' => $categories_parents, 'active_category' => $category]);
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $products = Product::where('title', 'like', '%'.$search.'%')->orWhere('description', 'like', '%'.$search.'%')->get();
        $code = 200;
        return response()->json($products, $code);
    }

    
}
