<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
		User::create([
            'name' => 'Sistemas y Desarrollo',
            'email' => 'sdmppaa@minaguas.gob.ve',
            'ROLE' => 'Admin',
            'password' => bcrypt('123456789')
        ])->assignRole('Administrador');
        User::create([
            'name' => 'Katherin Martinez',
            'email' => 'kmartinez@minaguas.gob.ve',
            'ROLE' => 'User',
            'password' => bcrypt('123456789')
        ])->assignRole('User');
        User::create([
            'name' => 'Karina Florez',
            'email' => 'kflorez@minaguas.gob.ve',
            'ROLE' => 'Admin',
            'password' => bcrypt('123456789')
        ])->assignRole('Supervisor');
      
	
    }
}
