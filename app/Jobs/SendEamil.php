<?php

namespace App\Jobs;

use App\Mail\SendCodeEamil;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendEamil implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $email;

    protected $code;

    
    public function __construct($email , $code)
    {
        $this->email = $email;
        
        $this->code = $code;

    }

    
    public function handle()
    {



        
        // dd($this->email);

        // dd($this->code);
        $eeemail = new SendCodeEamil($this->code);
        
        dd($eeemail);
        Mail::to($this->email)->send($eeemail);
    }
}
