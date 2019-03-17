<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class ArrangeRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     
        $role_staff = Role::where('slug','staff')->first();
        $role_supervisor = Role::where('slug','supervisor')->first();
        $role_admin = Role::where('slug','admin')->first();
   


        $users = User::all();

        foreach($users as $user){


            if($user->role == 'admin'){
                $user->roles()->attach($role_admin);
            }elseif($user->role == 'supervisor'){
                $user->roles()->attach($role_supervisor);
            }else{
                $user->roles()->attach($role_staff);  
            }








        }


           



    }
}
