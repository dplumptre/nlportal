<?php

use App\Role;
use App\Department;
use App\Grade;
use App\Employeetype;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;



class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {




        $data = new Department();
        $data->name = 'Human Resources';
        $data->slug = Str::slug('Human Resources', '-');
        $data->save();

        $data = new Department();
        $data->name = 'Nurses';
        $data->slug = Str::slug('Nurses', '-');
        $data->save();


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

        


        $data = new Employeetype();
        $data->employee_type = 'Full Time';
        $data->save();
        $data = new Employeetype();
        $data->employee_type = 'Part Time';
        $data->save();
        $data = new Employeetype();
        $data->employee_type = 'Freelance';
        $data->save();
        $data = new Employeetype();
        $data->employee_type = 'Contract';
        $data->save();


        $data = new Grade();
        $data->level = 'General Manager';
        $data->save();
        $data = new Grade();
        $data->level = 'Deputy General Manager';
        $data->save();
        $data = new Grade();
        $data->level = 'Principal Manager';
        $data->save();
        $data = new Grade();
        $data->level = 'Senior Manager';
        $data->save();
        $data = new Grade();
        $data->level = 'Manager';
        $data->save();
        $data = new Grade();
        $data->level = 'Deputy Manager';
        $data->save();
        $data = new Grade();
        $data->level = 'Assistant Manager';
        $data->save();
        $data = new Grade();
        $data->level = 'Officer 2';
        $data->save();
        $data = new Grade();
        $data->level = 'Officer 1';
        $data->save();
        $data = new Grade();
        $data->level = 'Management Trainee 2';
        $data->save();
        $data = new Grade();
        $data->level = 'Management Trainee 1';
        $data->save();
        $data = new Grade();
        $data->level = 'Clerical Officer 2';
        $data->save();
        $data = new Grade();
        $data->level = 'Clerical Officer 1';
        $data->save();

    }
}
