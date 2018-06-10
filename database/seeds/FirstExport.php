<?php

use Illuminate\Database\Seeder;
use App\Product as Product;
use App\Category as Category;
use App\Offer as Offer;

class FirstExport extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        DB::table('products')->truncate();
        $file_url = "https://markethot.ru/export/bestsp";
        $data = json_decode(file_get_contents($file_url), true);

        foreach($data['products'] as $product){
            $offers = array_column($product['offers'], 'id');
            $categories = array_column($product['categories'], 'id');

            foreach($product['categories'] as $category_data){
                    if(empty(Category::find($category_data['id']))){
                        Category::create($category_data);
                    }

            }
    
            foreach($product['offers'] as $offer){
                if( empty(Offer::find($offer['id']))){
                    Offer::create($offer);
                }
            }

            unset($product['categories']);
            unset($product['offers']);
            $pr = Product::create($product);
            $pr->categories()->attach($categories);
            $pr->offers()->attach($offers);
        }

    }
}
