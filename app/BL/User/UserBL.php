<?php 

namespace App\BL\User;


use App\AO\User\UserAO;
use Illuminate\Support\Facades\Validator;

class UserBL{
   public static $response = array();

    private static function dataUsers($request){
        $dataUsers = array(
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> bcrypt($request->password),
            'username'=> $request->username,
            'status'=>$request->status,
        );
        return $dataUsers;
    }
    
    public static function getUsers(){
        try {
            $users = UserAO::getUsers();
            self::$response = array(
                'status'=> 200, 
                'message' => 'Users logs successfully fetched.', 
                'data' => $users
            );
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
            self::$response = array('response'=>'Failed to obtain the users.');
        }
        return self::$response;
    }
    public static function getSingleUsers($id){
        try {
            $users = UserAO::getSingleUsers($id->id);
            self::$response = array(
                'status'=> 200, 
                'message' => 'Users logs successfully fetched.', 
                'data' => $users
            );
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
            self::$response = array('response'=>'Failed to obtain the users.');
        }
        return self::$response;
    }

    
    public static function createUsers($request){
        try {
            $users = self::dataUsers($request);
            if ($users) {
                UserAO::createUsers($users);
            }
            self::$response = array(
                'status'=> 200,
                'message'=>'The user was successfully created.',
                'users' => $users,
             );
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
            self::$response = array(
                'response' => 'User creation failed.'
            );
        }
        return self::$response;
    }


    
    public static function editUsers($request){
        try {
            $users = self::dataUsers($request);
            if ($users) {
                UserAO::editUsers($users,$request->id);
            }
            self::$response = array(
                'status'=>200,
                'message'=>'The user was successfully edited.',
                'users' => $users,
            );
        } catch (\Throwable $th) {
           var_dump($th->getMessage());
           self::$response = array(
               'response'=>'Failed to edit the user.'
           );
        }
        return self::$response;
    }
    public static function deleteUsers($request){
        try {
            $dataUsers = array(
                'status'=> 0,  
            );
            $users = self::dataUsers($request);
            if ($users) {
                UserAO::deleteUsers($dataUsers, $request->id);
            }
            self::$response = array(
                'status'=>200,
                'message'=>'The user was successfully removed.',
                'users' => $users,
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