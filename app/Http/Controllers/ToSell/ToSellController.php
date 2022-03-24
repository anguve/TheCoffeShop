<?php

namespace App\Http\Controllers\ToSell;

use App\BL\ToSell\ToSellBL;
use App\Http\Controllers\Controller;
use App\Http\Requests\ToSell\ToSellValidateRequest;
use App\Models\ToSell\ToSell;
use Illuminate\Http\Request;

class ToSellController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:getToSells', ['only'=>['getToSells']]);
        $this->middleware('permission:getSingleToSells', ['only'=>['getSingleToSells']]);
        $this->middleware('permission:createToSells', ['only'=>['createToSells']]);
    
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getToSells()
    {
        $toSells = ToSellBL::getToSells();
        return $toSells;
    }
    public function getSingleToSells(Request $id)
    {
        $toSells = ToSellBL::getSingleToSells($id);
        return $toSells;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createToSells(ToSellValidateRequest $request)
    {
        $toSells = ToSellBL::createToSells($request);
        return response()->json($toSells);
    }

 

 

 



}