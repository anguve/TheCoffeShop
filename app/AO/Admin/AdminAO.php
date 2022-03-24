<?php 

namespace App\AO\Admin;

use App\Models\User;

class AdminAO{
 

    public static function getUser(){
        return User::all()->where('status', 1);
    }
    public static function createUser($dataAdmin, $roll)
    {
      $users = User::create($dataAdmin);
      $users->assignRole($roll);
      return $users ;
      
    }
    public static function editUser($dataAdmin, $id){
        $users = User::findOrFail($id);
        $users->assignRole($dataAdmin['roll']);
        return $users->update($dataAdmin);
       
    }
    public static function deleteUser($dataAdmin, $id){
        $users = User::findOrFail($id);
        return $users->update($dataAdmin);
    }
}