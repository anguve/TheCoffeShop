<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BL\Admin\AdminBL;
use App\Http\Requests\Admin\AdminValidateRequest;

class AdminController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:getUsers', ['only'=>['getUsers']]);
        $this->middleware('permission:getSingleUsers', ['only'=>['getSingleUsers']]);
        $this->middleware('permission:createAdminUsers', ['only'=>['createAdminUsers']]);
        $this->middleware('permission:editUsers', ['only'=>['editUsers']]);
        $this->middleware('permission:deletetUsers', ['only'=>['deleteUsers']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUser()
    {
        $users = AdminBL::getUser();
        return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAdminUsers(AdminValidateRequest $request)   
    {
        $users = AdminBL::createUser($request);
        return response()->json($users);
        
    }

 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editUsers(AdminValidateRequest $request)
    {
        $users = AdminBL::editUser($request);
        return response()->json($users);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteUser(AdminValidateRequest $request)
    {
        $users = AdminBL::deleteUser($request);
        return  response()->json($users);
    }
}