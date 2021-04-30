<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  20210427 : vide la table et l'enrichit avec php artisan db:seed
        Role::truncate(); 
        User::truncate(); 

        //  Création des rôles et liaison avec les utilisateurs 
        
        $role1 = Role::create(['profil' => "super-admin"]); 
        $role2 = Role::create(['profil' => "admin"]); 
        $role3 = Role::create(['profil' => "client"]); 

        $user1 = User::create([
            'name' => "SUPER ADMIN",
            'email' => "super-admin@admin.com",
            'password' => Hash::make('admin123'), 
            'role_id' => $role1->id, 
        ]); 

        $user2 = User::create([
            'name' => "ADMIN",
            'email' => "admin@admin.com",
            'password' => Hash::make('admin123'), 
            'role_id' => $role2->id, 
        ]); 

        $user3 = User::create([
            'name' => "CLIENT",
            'email' => "client@admin.com",
            'password' => Hash::make('admin123'), 
            'role_id' => $role3->id, 
        ]); 
    }
}
