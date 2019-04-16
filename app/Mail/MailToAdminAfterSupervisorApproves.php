<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Department;

class MailToAdminAfterSupervisorApproves extends Mailable
{
    use Queueable, SerializesModels;

    public $applicant_name;
    public $unit;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($staff)
    {
        $this->applicant_name = $staff->name;
        $this->unit = $this->getunit($staff->department_id);
        
    }




    public function getunit($val)
    {
       $d = Department::where('id',$val)->first();
       return $d->name;
    }



    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('TFOLC LEAVE PORTAL')
                    ->view('mail.admin_reminder_to_approve');
    }
}
