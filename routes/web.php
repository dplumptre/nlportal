<?php

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
Route::get('access-denied', 'HomeController@accessDenied')->name('home.access.denied');
Route::get('home', 'HomeController@index')->name('home');
Route::get('apply', 'HomeController@apply')->name('home.apply');
Route::post('apply', 'HomeController@postApply')->name('home.post.apply');
Route::get('status/{users}', 'HomeController@status')->name('home.status');

Route::get('leave_delete/{users}', 'HomeController@leaveDelete')->name('home.leave.delete');


Route::get('supervisor_approval', 'HomeController@supervisor_approval')->middleware('supervisor');
Route::get('supervisor/{users}/edit', 'HomeController@supervisor_edit')->middleware('supervisor');
Route::patch('supervisor/{users}', 'HomeController@supervisor_update')->middleware('supervisor');






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