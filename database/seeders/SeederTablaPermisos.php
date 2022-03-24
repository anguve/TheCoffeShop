<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            
            'getRolls', 
            'getSingleRolls',
            'createRolls', 
            'editRolls',  
            'deleteRolls',

            'getProducts' , 
            'getSingleProducts' , 
            'createProducts' , 
            'editProducts' , 
            'deleteProducts',
           
            'getToSells' , 
            'getSingleToSells' , 
            'createToSells' , 

            'getUsers' , 
            'getSingleUsers' , 
            'createAdminUsers',
            'createUsers' , 
            'editUsers' , 
            'deleteUsers',
              
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}