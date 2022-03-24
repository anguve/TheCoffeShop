<?php 

namespace App\BL\ToSell;

use App\AO\Product\ProductAO;
use App\AO\ToSell\ToSellAO;
use App\Console\Commands\CronStockTask\CronStockTask;
use App\Mail\EmailStockMailable;
use Illuminate\Support\Facades\Mail;

Class ToSellBL{
    private static $response = array();
    private static function dataToSell($request){

        $dataToSell = array(
            'product_id'=>$request->product_id,
            'user_id'=>$request->user_id,
            'quantity'=>$request->quantity,
            
           
        );
        return $dataToSell;
    }
    public function getToSells()
    {
        try {
            $toSells  = ToSellAO::getToSells();
            self::$response = array(
                'status'=> 200, 
                'message' => 'ToSell logs successfully fetched.', 
                'data' => $toSells 
            );
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
            self::$response = array(
                'response'=>'Failed to obtain the ToSell.'
            );
        }
        return self::$response;
    }
 
    public function getSingleToSells($id)
    {
        try {
            $toSells  = ToSellAO::getSingleToSells($id->id);
            self::$response = array(
                'status'=> 200, 
                'message' => 'to sell logs successfully fetched.', 
                'data' => $toSells 
            );
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
            self::$response = array(
                'response'=>'Failed to obtain the to sell.'
            );
        }
        return self::$response;
    }
    public function createToSells($request)
    {
        try {
            
            $product = ProductAO::getSingleProducts($request->product_id);
            if ($product == null) {
                self::$response = array(
                    'status'=> 200, 
                    'message' => 'No stock products available.'
                );
            }elseif ($product->stock > 0) {
                $product->stock = $product->stock - $request->quantity;
                if ($product->stock < 0) {
                    self::$response = array(
                        'status'=> 200, 
                        'message' => 'The sale cannot be made since the products are running out.'
                    );
                } else {
                    $toSells  = self::dataToSell($request);
                    ToSellAO::createToSells($toSells);
                    $product->update($request->all());
                }
            }
            if($product->stock == 0){
                Mail::to('andres.gutierrez.v@grupokonecta.com')->send(new  EmailStockMailable($product));
                self::$response = array(
                    'status'=> 200, 
                    'message' => 'The Stock is 0.'
                );
            }
            self::$response = array(
                'status'=> 200, 
                'message' => 'The to sell was successfully created.'
            );
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
            self::$response = array(
                'response'=>'Failed to created the to sell.',
            );
        }
        return self::$response;
    }



}