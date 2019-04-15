<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Leave;
use App\Department;
use App\Role;
use App\Mail\firstmail;
use Illuminate\Support\Facades\Mail;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    { 
        // $role_staff = Role::where('slug','staff')->first();
        // $role_supervisor = Role::where('slug','supervisor')->first();
        // $role_admin = Role::where('slug','admin')->first();
		// $user = User::find(122);
		// $user->roles()->attach($role_supervisor);
        return view('home');
    }




	public function accessDenied()
    { 
        return view('access-denied');
    }


    public function apply()
    {

        $leave = Leave::where('user_id', '=', auth()->user()->department_id)
        				->where('allowance', '>', 0)
        				->where('approval_status', '=', "Approved")
        				->where('admin_approval_status', '=', "Approved")
        				->where('days_hr_approved', '>', 0)->get();
    
        $allowance = $leave->count();
		$relievers = User::where('department_id', '=', auth()->user()->department_id)->get();

        return view('apply',compact('relievers','allowance'));
    }





    public function postApply(Request $request, Leave $leave, User $user)
	{


		return $supervisor_email ."    ".$applicat_email;

		$this->validate($request, [
            'reason' => 'required|string|max:255',
            'working_days_no' => 'required|integer',
            //'reliever_name' => 'required|string',
            'leave_address' => 'required|string',
            'leave_starts' => 'required|date:dd-mm-yyyy|after:yesterday',
            'leave_ends' => 'required|date:dd-mm-yyyy|after:leave_starts',
            'resumption_date' => 'required|date:dd-mm-yyyy|after:leave_ends',
            //'date_unithead_approved' => 'required',
            //'signature' => 'required',
			]);


		
		$d = Department::find($request->user()->department_id);

		$leave = new Leave;
		$leave->leave_starts = $request->leave_starts;
		$leave->leave_ends = $request->leave_ends;
		$leave->working_days_no = $request->working_days_no;
		$leave->resumption_date = $request->resumption_date;
		$leave->reason = $request->reason;
		$leave->reliever_name = $request->reliever_name;
		$leave->leave_address = $request->leave_address;
		$leave->allowance = $request->allowance;
		$leave->approval_status = $request->approval_status;
		$leave->mobile = $request->mobile;
		$leave->leave_type = $request->leave_type;
		$leave->unit_head_name = $request->unit_head_name;
				
		$leave->user_id = $request->user()->id;
		$leave->name = $request->user()->name;
		$leave->department = $d->name ;
		$leave->department_id = $request->user()->department_id;
		$leave->grade = $request->user()->grade;
        $leave->save();
        
        $request->Session()->flash('message.content', 'Your leave application was successful!');
		$request->session()->flash('message.level', 'success');

		// if ($leave->save()) {
		


		// 		#SEND EMAIL
		// 		$supervisor = $request->unit_head_name;
		// 		$supervisor_email = $request->unit_head_email;
		// 		$applicant_name = $request->user()->name;
		// 		$applicat_email = $request->user()->email;


		// 		if($supervisor_email == "" || empty($supervisor_email)){


		// 			$d = Department::where('slug','admin')->first();
		// 			$hremails = User::where('role', '=', 'admin')
		// 			->where('department_id', '=', $d->id)->first();


		// 			$supervisor_email = $hremails->email;
		// 		}


		// 		Mail::send('mail.firstmail', array('supervisor'=> $supervisor,'applicant_name'=> $applicant_name), function($message) use ($supervisor_email) 
		// 		{
		// 			$message->to($supervisor_email,'TFOLC LEAVE APP')->subject('Leave Request has been sent to you');
		// 		});  			
			
		// }
		Mail::to($supervisor_email)->send(new firstmail($applicant_name));
		return redirect('status/'.$request->user()->id);
	}




    public function status(User $users){         
    return view('status', compact('users'));
    }




	public function leaveDelete(Leave $users){
		$users->delete($users);
		Session()->flash('message.content', 'Leave application was successfully deleted!');
		session()->flash('message.level', 'success');
		return redirect()->back();
	}



	public function supervisor_approval(Request $request){

		$uhDept = auth()->user()->department_id;
		$requests = Leave::where('department_id', '=', "$uhDept")->orderBy('id', 'desc')->get();

	    return view('supervisor_approval', compact('requests'));
	}




    public function supervisor_edit(Leave $users)
	{
	
		return view('supervisor-edit', compact('users'));
	}






	public function supervisor_update(Request $request, Leave $users)
	{

		$this->validate($request, [
           'date_unithead_approved' => 'required',
           'signature' => 'required',
			]);

			$users->update($request->all());

		return redirect('supervisor_approval');

	}





}
