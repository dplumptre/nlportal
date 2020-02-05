<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Reliever extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $input;

    public function __construct($input)
    {
        // $this->applicant_name = $input['applicant_name'];
        // $this->reliever_name = $input['reliever_name'];
        $this->input = $input;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        //echo $this->input;
        return $this->subject('TFOLC LEAVE PORTAL')->view('mail.reliever');
    }
}
