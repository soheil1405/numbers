<?php

namespace App\Broadcasting;

use App\Models\User;

use App\Notifications\OtpNotification;
use Illuminate\Notification\Notification;


class SmsChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\Models\User  $user
     * @return array|bool
     */
    public function join(User $user)
    {
        //
    }


    public function send($notifiable , OtpNotification $OtpNotification){


        // dd($notifiable , get_object_vars($OtpNotification));



        $data = $OtpNotification->toArray($notifiable);
                    

        $code = [
            'code'=>$data['code']
        ];

        
        
        $to = $data['number'] ;
        
        // $client = new \SoapClient("http://188.0.240.110/class/sms/wsdlservice/server.php?wsdl");

        $user = "09369567693";
        $pass = "Soheil$2748";
        $fromNum = "+983000505";
        $toNum = array($to);
        $pattern_code = "1vhxdrra0lu87pw";
        // echo $client->sendPatternSms($fromNum, $toNum, $user, $pass, $pattern_code, $code);




    }




}
