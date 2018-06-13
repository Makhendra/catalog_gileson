<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Offer;
use App\Product;
use App\Category;

class ExportCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Экспорт данных с сайта https://markethot.ru/';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   
        $url_export = 'https://markethot.ru/export/bestsp';
        $message = 'Начало экспорта';
        Log::info($message);

        $data = json_decode(file_get_contents($url_export), true);

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
            $pr = Product::find($product['id']);
            if(empty(Product::find($product['id']))){
                $pr = Product::create($product);
                $message = 'Был добавлен продукт '.$product['id'].' - '.$product['title'];
                Log::info($message);
            } else {
                $pr->categories()->attach($categories);
                $pr->offers()->attach($offers);
            }
            
        }
        $message = 'Конец экспорта';
        Log::info($message);
    }
}
