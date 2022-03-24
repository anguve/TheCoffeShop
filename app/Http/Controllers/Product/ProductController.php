<?php

namespace App\Http\Controllers\Product;
use App\Http\Controllers\Controller;

use App\BL\Product\ProductBL;
use App\Http\Requests\Product\ProductValidateRequest;
use Illuminate\Http\Request;
class ProductController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:getProducts', ['only'=>['getProducts']]);
        $this->middleware('permission:getSingleProducts', ['only'=>['getSingleProducts']]);
        $this->middleware('permission:createProducts', ['only'=>['createProducts']]);
        $this->middleware('permission:editProducts', ['only'=>['editProducts']]);
        $this->middleware('permission:deleteProducts', ['only'=>['deleteProducts']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProducts()
    {  
        $products = ProductBL::getProducts();
        return $products;            
    }

    public function getSingleProducts(Request $id)
    {  
        $products = ProductBL::getSingleProducts($id);
        return $products;            
    }

 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createProducts(ProductValidateRequest $request)
    {
        $products = ProductBL::createProducts($request);
        return  response()->json($products);
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProducts(Request $request)
    {
        $products = ProductBL::editProducts($request);
        return response()->json($products);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteProducts(ProductValidateRequest $request)
    {
        $products = ProductBL::deleteProducts($request);
        return  response()->json($products);
    }
}