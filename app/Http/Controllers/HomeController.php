<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Leave;
use App\Department;
use App\Role;
use App\Mail\firstmail;
use App\Mail\MailToAdminAfterSupervisorApproves;
use App\Mail\MailToStaffAfterSupervisorApproves;
use App\Mail\RejectedMail;
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


		   	$supervisor_email = $request->unit_head_email;
			$applicant_name = $request->user()->name;


	

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


		#Geting EMAIL  OF ADMIN
		$admin_emails = User::whereHas('roles', function($q) {
			$q->where('slug','admin' );
		})
		->get('email'); 
        #STAFF 
		$staff = User::where('id',$request->user_id)->first();



		#return $request->approval_status;
		

			if($request->approval_status == "Approved"){
				#SENDING MAIL TO HR COS SUPERVISOR HAS APPROVED
				foreach($admin_emails as $ae){
			     	Mail::to($ae->email)->send(new MailToAdminAfterSupervisorApproves($staff));
			    }
				#SENDING TO USER THAT SUPERVISOR HAS APPROVED
				Mail::to($staff->email)->send(new MailToStaffAfterSupervisorApproves($staff));

			}elseif($request->approval_status ==  "Rejected"){

				Mail::to($staff->email)->send(new RejectedMail($staff));
				
			}else{

				return back();
			}




		return redirect('supervisor_approval');

	}





}
