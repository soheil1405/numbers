<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendCodeEamil extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */


     protected $code ;


    public function __construct( $code)
    {

        $this->code =  $code  ;

    }
    public function build()
    {

        

        $code = $this->code;
        
        return $this->view('mail.send-code-eamil' , compact('code' ));
    }


}
