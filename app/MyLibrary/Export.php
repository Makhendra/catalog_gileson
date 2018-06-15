<?php namespace App\MyLibrary; 

use Illuminate\Support\Facades\Log;
use App\Product as Product;
use App\Category as Category;
use App\Offer as Offer;

class Export {

    static private $url_export = "https://markethot.ru/export/bestsp";

    public static function run() {
        Log::info('Начало экспорта');
        $data = json_decode(file_get_contents(self::$url_export), true);

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
            unset($product['images']);
            
            $pr = Product::with(['categories', 'offers'])->find($product['id']);
            if(empty($pr)){
                $pr = Product::create($product);
                $message = 'Был добавлен продукт '.$product['id'].' - '.$product['title'];
                Log::info($message);
            } else {
                $pr->update($product);
                $message = 'Был обновлен продукт '.$product['id'].' - '.$product['title'];
                Log::info($message);
            };

            $pr->categories()->attach($categories);
            $pr->offers()->attach($offers);
        }
        Log::info('Конец экспорта');
    }
    
}
