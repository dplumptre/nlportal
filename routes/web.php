<?php

use App\User;

use App\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    // $user = User::create([
    //     'name' => 'Plumptre',
    //     'email'=> 'dplumptre1@gmail.com',
    //     'password'=> bcrypt('oh12345'),
    //     'loan_roles_id'=>1,
    //     'department_id'=>4,
    // ]);

    // $user =User::where('email','dplumptre1@gmail.com')->first();

    // // $role_admin = Role::where('slug','admin')->first();
    // $role_staff = Role::where('slug','staff')->first();
    // $role_supervisor = Role::where('slug','supervisor')->first();
    // $user->roles()->attach($role_supervisor);
    // $user->roles()->attach($role_staff);
    // $user->roles()->attach($role_admin);

//     $items = \DB::table('password_resets')->where('token', 'not like', '$%')->orderBy('created_at', 'desc')->get();
// foreach ($items as $item) { \DB::table('password_resets')->where('email', $item->email)->update(['token' => bcrypt($item->token)]); }
//
   return view('welcome');
});

Auth::routes();


/*
|--------------------------------------------------------------------------
| USERS : HomeController
|--------------------------------------------------------------------------
|
| Here is the control for ordinary users
|
|
*/
Route::get('/profile/{user}', 'HomeController@view_profile');
Route::get('access-denied', 'HomeController@accessDenied')->name('home.access.denied');
Route::get('home', 'HomeController@index')->name('home');
Route::get('apply', 'HomeController@apply')->name('home.apply');
Route::post('apply', 'HomeController@postApply')->name('home.post.apply');
Route::get('status/{users}', 'HomeController@status')->name('home.status');
Route::get('leave_delete/{users}', 'HomeController@leaveDelete')->name('home.leave.delete');
Route::get('supervisor_approval', 'HomeController@supervisor_approval')->middleware('supervisor');
Route::get('supervisor/{users}/edit', 'HomeController@supervisor_edit')->middleware('supervisor');
Route::patch('supervisor/{users}', 'HomeController@supervisor_update')->middleware('supervisor');
Route::get('leave_return/edit/{id}', 'HomeController@leaveReturn');
Route::patch('leave_return/{users}', 'HomeController@leave_return_update');


/*
|--------------------------------------------------------------------------
| ADMIN : HomeController
|--------------------------------------------------------------------------
|
| Here is the control for ordinary users
|
|
*/


Route::get('admin/leave-applications', 'AdminController@show_all_leave_request');


//ADMIN Approval
Route::get('admin/{users}/admin-edit', 'AdminController@admin_edit');
Route::patch('admin/{users}/admin-edit', 'AdminController@admin_approval');



Route::get('admin/view-users', 'AdminController@view_users')->name('admin.view.user');
Route::get('admin/add-user', 'AdminController@add_user')->name('admin.add.user');
Route::post('admin/add-user', 'AdminController@post_user')->name('admin.post.user');
Route::get('admin/view-user/{user}/edit', 'AdminController@edit_user')->name('admin.edit.user');
Route::put('admin/update-user/{user}', 'AdminController@update_user')->name('admin.update.user');
Route::get('admin/delete-user/{user}', 'AdminController@delete_user')->name('admin.delete.user');
Route::get('admin/{user}/history', 'AdminController@leave_history');


//RESET COLUMN

Route::get('admin/reset', 'AdminController@reset');
Route::post('admin/reset_leave', 'AdminController@reset_column')->name('admin.post.reset.leave');
