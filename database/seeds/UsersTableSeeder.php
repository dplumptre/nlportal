<?php

use Illuminate\Database\Seeder;

use App\User;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {




        $data = new User();
        $data->name = 'Plumptre';
        $data->email = 'dplumptre@yahoo.com';
        $data->password = Hash::make('password');
        $data->department_id = "1";

        $data->save();
    }
}
