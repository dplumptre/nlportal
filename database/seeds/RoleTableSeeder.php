<?php

use App\Role;

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new Role();
        $data->role = 'Administrator';
        $data->slug = 'admin';
        $data->save();

        $data = new Role();
        $data->role = 'Supervisor';
        $data->slug = 'supervisor';
        $data->save();

        $data = new Role();
        $data->role = 'Staff';
        $data->slug = 'staff';
        $data->save();
    }
}
