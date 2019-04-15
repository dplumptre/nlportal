<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Leave;
use App\Department;
use App\Grade;
use App\Employeetype;
use App\Role;
use App\Loan_role;
use App\Loan;

class AdminController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }


    
	public function show_all_leave_request(Request $request){

		$users = $request->user();
		$requests = Leave::orderBy('id', 'desc')->get();
		return view('admin.leave-applications', compact('users', 'requests'));
	}





	public function admin_edit(Leave $users)
	{

		$app_email = User::find($users->user_id);
        $applicant_email = $app_email->email;
        
		return view('admin/admin-edit', compact('users','applicant_email'));
	}


	public function admin_approval(Request $request, Leave $users)
	{

		$applicant_name = $request->applicant_name;
		$applicant_email = $request->applicant_email;



		
		$this->validate($request, [
			'hr_signature' => 'required',
		]);

        $users->admin_name = $request->user()->admin_name;
        

        $users->update($request->all());

		// if ($users->update($request->all())) {
		// 	//$users->update();
			
		// 	if($request->admin_approval_status == "Approved"){

		// 		Mail::send('mail.approved_mail', array('applicant_name'=> $applicant_name), function($message) use ($applicant_email) 
		// 		{
		// 			$message->to($applicant_email,'TFOLC LEAVE APP')->subject('Your Leave has been approved!');
		// 		});  

		// 	}

			
		// 	if($request->admin_approval_status == "Rejected"){
				
		// 		Mail::send('mail.failmailtwo', array('applicant_name'=> $applicant_name), function($message) use ($applicant_email)
		// 		{
		// 			$message->to($applicant_email,'TFOLC LEAVE APP')->subject('Result of your Leave Application!');
		// 		});  

		// 	}
		// 		$request->Session()->flash('message.content', 'Leave status was successfully updated!');
		// 	  	$request->session()->flash('message.level', 'success');
        // }
        

        $request->Session()->flash('message.content', 'Leave status was successfully updated!');
        $request->session()->flash('message.level', 'success');



		return redirect('admin/leave-applications');

	}


	public function delete_user(User $user){
		$loan= Loan::where('user_id',$user->id)->first();



        if($loan){
			$loan->delete();
		}
		$user->delete();
		return back();
	}

	public function edit_user(User $user)
	{
		$departments = Department::all();
		$grades = Grade::all();
		$roles = Role::all();
		$employee_types = Employeetype::all();
		//$loan_roles = Loan_role::all();

		return view('admin/edit-user', compact('user', 'departments', 'grades', 'employee_types', 'loan_roles','roles'));
	}

	public function view_users(){
		$employees = User::orderBy('department', 'desc')->get();
		return view('admin.view-users', compact('employees'));
	}

	public function add_user(){
		$departments = Department::all();
		$grades = Grade::all();
		$employee_types = Employeetype::all();
		return view('admin.add-user', compact('departments', 'grades', 'employee_types'));

	}


	public function post_user(Request $request){

		$this->validate($request, [
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6|confirmed',
			'department' => 'required',
			'entitled' => 'required',
			'job_title' => 'required|string|max:100',
			'date_of_hire' => 'required|date:dd-mm-yyyy',
		]);


        $role_user = Role::where('slug',$request->role)->first();
   



		$user = new User;
		$user->name = $request->name;
		$user->email = $request->email;
		//$user->role = $request->role;
		$user->password = bcrypt($request->password);
		$user->marital_status = $request->marital_status;
		$user->gender = $request->gender;
		$user->department = $request->department;
		$user->grade = $request->grade;
		$user->employee_type = $request->employee_type;
		$user->date_of_hire = $request->date_of_hire;
		$user->job_title = $request->job_title;
		$user->entitled = $request->entitled;
		$user->loan_roles_id = $request->loan_roles_id;
		$user->department_id = $request->department;
		

		



		if($request->role == "supervisor"){
			$check = User::where('department_id', '=', $request->department)->count();
			if ($check > 0 ) {
				$request->Session()->flash('message.content','A supervisor already exist in this department!');
				$request->session()->flash('message.level', 'danger');

				return back();	
			}
		}




		$user->save();
		$user->roles()->attach($role_user);
		$request->session()->flash('message.content', 'New User creation was successfull!');
		$request->session()->flash('message.level', 'success');
		return  redirect('admin/view-users');


	}




	public function update_user(Request $request, User $user)
	{

		

  #return $user;



		$this->validate($request, [
			'name' => 'required|string|max:255',

		]);

		  $d = Department::find($request->department);

	      $check = User::with('roles')->where('department_id', '=', $request->department)->get();
			  
			  

	   

	      foreach($check as $user){
		  
			foreach($user->roles as $role){

				 #return $role->slug;
				 if ($role->slug == "supervisor"  && in_array($role->id,$request->checkbox)){
				  $request->Session()->flash('message.content', 'A supervisor already exist in this department!');
				  $request->session()->flash('message.level', 'danger');
				  return redirect('admin/view-users');	
				 }


			}
		}
  







       

	    
		// $user->name = $request->name;
		// $user->email = $request->email;
		// $user->updated_at = $request->updated_at;
		// $user->address = $request->address;
		// //$user->role = $request->role;
		// $user->gender = $request->gender;
		// $user->mobile = $request->mobile;
		// $user->dob = $request->dob;
		// $user->marital_status = $request->marital_status;
		// $user->department = $d->name;
		// $user->grade = $request->grade;
		// $user->employee_type = $request->employee_type;
		// $user->job_title = $request->job_title;
		// $user->date_of_hire = $request->date_of_hire;
		// $user->entitled = $request->entitled;
		// $user->balance = $request->balance;
		// $user->loan_roles_id = $request->loan_roles_id;
		// $user->department_id = $request->department;
		// $user->updated_at = date('Y-m-d H:i:s');
		// $user->save();
		// $user->roles()->sync($request->checkbox);



		$update = User::where('id', $user->id)
			->update([

			'name' => $request->name,
			'email' => $request->email,
			'address' => $request->address,
			'gender' => $request->gender,
			'mobile' => $request->mobile,
			'dob' => $request->dob,
			'marital_status' => $request->marital_status,
			'department' => $d->name,
			'grade' => $request->grade,
			'employee_type' => $request->employee_type,
			'job_title' => $request->job_title,
			'date_of_hire' => $request->date_of_hire,
			'entitled' => $request->entitled,
			'balance' => $request->balance,
			'loan_roles_id' => $request->loan_roles_id,
			'department_id' => $request->department,
			'updated_at' => date('Y-m-d H:i:s'),
			
			
			]);
			$user->roles()->sync($request->checkbox);
		
		// $user->update($request->all());
			$request->Session()->flash('message.content', 'Employee details was successfully updated!');
		  	$request->session()->flash('message.level', 'success');

		return redirect('admin/view-users');
		
	}

















}
