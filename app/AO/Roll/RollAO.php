<?php 

namespace App\AO\Roll;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
class RollAO {

    
    public function getRolls()
    {
        return  Role::all();
    }

    public function getSingleRolls($id)
    {
        return  Role::findOrFail($id);
    }

  
    public function createRolls($dataRolls)
    {  
        $rolls = Role::create(['name'=> $dataRolls['name']]);
        $rolls->syncPermissions($dataRolls['permission']);
        return  $rolls;
    }

  
    public function editRolls($dataRolls, $id)
    {
        $rolls = Role::findOrFail($id);
        $rolls->update(['name'=> $dataRolls['name']]);
        $rolls->syncPermissions($dataRolls['permission']);
        return $rolls; 
    }

   
    public function deleteRolls($id)
    {
       return DB::table('roles')->where('id', $id)->delete();
    }
}