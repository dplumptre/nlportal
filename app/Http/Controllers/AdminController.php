<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Leave;
use App\Department;
use App\Role;


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

}
