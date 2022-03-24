<?php 

namespace App\BL\Roll;
use App\AO\Roll\RollAO;

Class RollBL{
    private static $response = array();
    private static function dataRoll($request){

        $dataRoll = array(
            'name'=> $request->name,
            'permission'=> $request->permission,
        );
        return $dataRoll;
    }
    public function getRolls()
    {
        try {
            $rolls  = RollAO::getRolls();
            self::$response = array(
                'status'=> 200, 
                'message' => 'Roll logs successfully fetched.', 
                'data' => $rolls 
            );
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
            self::$response = array(
                'response'=>'Failed to obtain the roll.'
            );
        }
        return self::$response;
    }
 
    public function getSingleRolls($id)
    {
        try {
            $rolls  = RollAO::getSingleRolls($id->id);
            $rolls->permissions;
            self::$response = array(
                'status'=> 200, 
                'message' => 'Roll logs successfully fetched.', 
                'data' => $rolls 
            );
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
            self::$response = array(
                'response'=>'Failed to obtain the roll.'
            );
        }
        return self::$response;
    }
    public function createRolls($request)
    {
        try {
            $rolls  = self::dataRoll($request);
            RollAO::createRolls($rolls);
            self::$response = array(
                'status'=> 200, 
                'message' => 'The roll was successfully created.'
            );
        
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
            self::$response = array(
                'response'=>'Failed to created the roll.',
            );
        }
        return self::$response;
    }


    public function editRolls($request)
    {
        try {
            $rolls = self::dataRoll($request);
            RollAO::editRolls($rolls, $request->id);
            self::$response = array(
                'status'=> 200, 
                'message' => 'The roll was successfully edited.'
            );
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
            self::$response = array(
                'response'=>'Failed to edit the roll.'
            );
        }
        return self::$response;
    }

   
    public function deleteRolls($request)
    {
        try {
            RollAO::deleteRolls($request->id);
            self::$response = array(
                'status'=> 200, 
                'message' => 'The Roll was successfully removed.'
            );
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
            self::$response = array(
                'response'=>'Roll removal failed.'
            );
        }
        return self::$response;
    }
}