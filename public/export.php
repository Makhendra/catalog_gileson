<?php
$file_url = "https://markethot.ru/export/bestsp";
$data = json_decode(file_get_contents($file_url), true);
// var_dump($data);

// foreach($data['products'] as $product){
//     $categories = $product['categories'];
//     $offers = $product['offers'];
//     var_dump($offers);
// }

$categories = [];
$offers = [];

foreach($data['products'] as $product){
    array_push($categories,  $product['categories']);
    array_push($offers, $product['offers']);
}

$categories = array_unique($categories);
$offers = array_unique($offers);
var_dump($categories);
var_dump($offers);
