<?php 

namespace App\BL\Product;



use App\AO\Product\ProductAO;


class ProductBL{

    private static $response = array();


    private static function dataProduct($request){

        $dataProduct = array(
            'name'=> $request->name,
            'price'=> $request->price,
            'stock'=> $request->stock,
            'reference'=> $request->reference,
            'description'=> $request->description,
            'status'=>$request->status,  
            'category'=>$request->category,
            'imageOne'=>$request->image,
            'imageTwo'=>$request->image,
            'imageThree'=>$request->image,
        );
        return $dataProduct;
    }

    public static function getProducts(){
        try {
            $products = ProductAO::getProducts();
            self::$response = array(
                'status'=> 200, 
                'message' => 'Product logs successfully fetched.', 
                'data' => $products
            );
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
            self::$response = array(
                'response'=>'Failed to obtain the products.'
            );
        }
        return self::$response;
    }

    public static function getSingleProducts($id){
        try {
            
            $products = ProductAO::getSingleProducts($id->id);
            self::$response = array(
                'status'=> 200, 
                'message' => 'Product logs successfully fetched.', 
                'data' => $products
            );
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
            self::$response = array(
                'response'=>'Failed to obtain the products.'
            );
        }
        return self::$response;
    }


    public static function createProducts($request){
        try {         
            $products = self::dataProduct($request);
            if($image = $request->file('image')){
                $routeSaveImg = 'image/';
                $imageProduct = date('YmdHis').".".$image->getClientOriginalExtension();
                $image->move($routeSaveImg, $imageProduct);
                $products['image'] = "$imageProduct";
            }

            if ($products) {
                ProductAO::createProducts($products);
            }
            self::$response = array(
                'status'=> 200, 
                'message' => 'The product was successfully created.',
                'product' =>  $products
            );
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
            self::$response = array(
                'response'=>'Product creation failed.',
            );
        }
        return self::$response;

    

    }

    public static function editProducts($request){
        try {
            $products = self::dataProduct($request);
            if ($products) {
                ProductAO::editProducts($products, $request->id);
            }
            self::$response = array(
                'status'=> 200, 
                'message' => 'The product was successfully edited.',
                'product' =>  $products
            );
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
            self::$response = array(
                'response'=>'Failed to edit the product.'
            );
        }
        return self::$response;

    }
    public static function deleteProducts($request){
        try {
            $dataProduct = array(
                'status'=> 0,  
            );
            ProductAO::deleteProducts($dataProduct ,$request->id);
            self::$response = array(
                'status'=> 200, 
                'message' => 'The product was successfully removed.',
                'product' => $request
            );
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
            self::$response = array(
                'response'=>'Product removal failed.'
            );
        }
        return self::$response;
    }

    
}