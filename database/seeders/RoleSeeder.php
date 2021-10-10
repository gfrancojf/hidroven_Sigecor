<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // nombre de los roles ROOT ADMIN Y USER
        $root = Role::create(['name'=> 'Administrador']);
        $sup = Role::create(['name'=> 'Supervisor']);
        $user = Role::create(['name'=> 'User']);
                    
        

//USERS LIST
             Permission::create(['name'=> 'users.index'])->syncRoles($root);
                Permission::create(['name'=> 'users.edit'])->syncRoles($root);
                Permission::create(['name'=> 'users.update'])->syncRoles($root);

                //Entes INTERNos
            Permission::create(['name'=> 'interno'])->syncRoles($root,$sup );
                Permission::create(['name'=> 'interno.create'])->syncRoles($root);
                Permission::create(['name'=> 'interno.edit'])->syncRoles($root,$sup );
                Permission::create(['name'=> 'interno.destroy'])->syncRoles($root);


                //ENTES EXTERNOS
            Permission::create(['name'=> 'externo'])->syncRoles($root,$sup );
                Permission::create(['name'=> 'externo.create'])->syncRoles($root);
                Permission::create(['name'=> 'externo.edit'])->syncRoles($root,$sup );
                Permission::create(['name'=> 'externo.destroy'])->syncRoles($root);

            // seguimientos
            Permission::create(['name'=> 'delete_seg'])->syncRoles($root);
            Permission::create(['name'=> 'editSeg'])->syncRoles($root,$sup );

    }
}
