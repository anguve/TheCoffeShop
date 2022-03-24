<?php 

namespace App\AO\Product;


use App\Models\Product\Product;


class ProductAO {

    public static function getProducts(){
        return  Product::all()->where('status', 1);
    }
    public static function getSingleProducts($id){
        return  Product::findOrFail($id);
    }

    public static function createProducts($dataProducts){
       return Product::create($dataProducts);
    }


    public static function editProducts($dataProducts, $id){
  
        $products = Product::findOrFail($id);
        return  $products->update($dataProducts);
    }

    public static function deleteProducts($dataProducts, $id){
        $products = Product::findOrFail($id);
        return  $products->update($dataProducts);
    }

    
}