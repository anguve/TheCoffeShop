<?php

namespace App\Http\Controllers\Roll;

use App\BL\Roll\RollBL;
use App\Http\Controllers\Controller;
use App\Http\Requests\Roll\RollValidateRequest;
use Illuminate\Http\Request;



class RollController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:getRolls', ['only'=>['getRolls']]);
        $this->middleware('permission:getSingleRolls', ['only'=>['getSingleRolls']]);
        $this->middleware('permission:createRolls', ['only'=>['createRolls']]);
        $this->middleware('permission:editRolls', ['only'=>['editRolls']]);
        $this->middleware('permission:deleteRolls', ['only'=>['deleteRolls']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRolls()
    {
        $rolls = RollBL::getRolls();
        return $rolls;
    }
    public function getSingleRolls(Request $id)
    {
        $rolls = RollBL::getSingleRolls($id);
        return $rolls;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createRolls(RollValidateRequest $request)
    {
        $rolls = RollBL::createRolls($request);
        return  response()->json($rolls);
     }

  


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editRolls(RollValidateRequest $request, $id)
    {
        $Rolls = RollBL::editRolls($request);
        return response()->json($Rolls);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteRolls(RollValidateRequest $request)
    {
        $rolls = RollBL::deleteRolls($request);
        return  response()->json($rolls);
    }
}