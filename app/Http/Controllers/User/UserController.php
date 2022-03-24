<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;


use App\BL\User\UserBL;
use App\Http\Requests\User\UserValidateRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function __construct()
    {   
        $this->middleware('permission:getUsers', ['only'=>['getUsers']]);
        $this->middleware('permission:getSingleUsers', ['only'=>['getSingleUsers']]);
        $this->middleware('permission:editUsers', ['only'=>['editUsers']]);
        $this->middleware('permission:deleteUsers', ['only'=>['deleteUsers']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsers()
    {
        $users = UserBL::getUsers();
        return $users;
    }

    public function getSingleUsers(Request $id)
    {
        $users = UserBL::getSingleUsers($id);
        return $users;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUsers(UserValidateRequest $request)
    {
        $users = UserBl::createUsers($request);
        return response()->json($users);
    }

    
  

  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editUsers(UserValidateRequest $request)
    {
        $users = UserBL::editUsers($request);
        return response()->json($users);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteUsers(UserValidateRequest $request)
    {
        $users = UserBL::deleteUsers($request);
        return  response()->json($users);
    }
}