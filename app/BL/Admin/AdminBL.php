<?php 

namespace App\BL\Admin;


use App\AO\Admin\AdminAO;
use App\Http\Requests\Admin\AdminValidateRequest;
use Illuminate\Support\Facades\Validator;


class AdminBL{

   

    public static $response = array();



    private static function dataUser($request){
        $dataAdmin = array(
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> bcrypt($request->password),
            'username'=> $request->username,
            'roll'=> $request->roll,
            'status'=>$request->status,
        );
        return $dataAdmin;
    }
    
    public static function getUser(){
        try {
            $users = AdminAO::getUser();
            self::$response = array(
                'status'=> 200, 
                'message' => 'Admin logs successfully fetched.', 
                'data' => $users
            );
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
            self::$response = array('response'=>'Failed to obtain the users.');
        }
        return self::$response;
    }

    
    public static function createUser($request){
        try {
            $users = self::dataUser($request);
            if ($users) {
                AdminAO::createUser($users,$request->roll);
            }
            self::$response = array(
                'status'=> 200,
                'message'=>'The user was successfully created.',
                'user' => $users,
             );
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
            self::$response = array(
                'response' => 'User creation failed.'
            );
        }
        return self::$response;
    }


    
    public static function editUser($request){
        try {
            $users = self::dataUser($request);
            AdminAO::editUser($users,$request->id);
            self::$response = array(
                'status'=>200,
                'message'=>'The user was successfully edited.',
            );
        } catch (\Throwable $th) {
           var_dump($th->getMessage());
           self::$response = array(
               'response'=>'Failed to edit the user.'
           );
        }
        return self::$response;
    }
    public static function deleteUser($request){
        try {
            $dataAdmin = array(
                'status'=> 0,  
            );
            $users = self::dataUser($request);
            AdminAO::deleteUser($dataAdmin, $request->id);
            self::$response = array(
                'status'=>200,
                'message'=>'The user was successfully removed.'
            );
        } catch (\Throwable $th) {
           var_dump($th->getMessage());
            self::$response = array(
                'response'=>'User removal failed.'
            );
        }
        return self::$response;
    }
}