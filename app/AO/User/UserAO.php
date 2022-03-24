<?php 

namespace App\AO\User;

use App\Models\User;

use Illuminate\Support\Facades\DB;
class UserAO{
 

    public static function getUsers(){
        return User::all()->where('status', 1);
    }

    public static function getSingleUsers($id){
        return User::findOrFail($id);
    }
    public static function createUsers($dataUsers){

      $users = User::create($dataUsers);
      $users->assignRole('Client');
      return $users ;
      
    }
    public static function editUsers($dataUsers, $id){
        $users = User::findOrFail($id);
        DB::table('model_has_role')->where('model_id')->delete();
        $users->assignRole($dataUsers->roll);
        return $users->update($dataUsers);
    }
    public static function deleteUsers($dataUsers, $id){
        $users = User::findOrFail($id);
        return $users->update($dataUsers);
    }
}