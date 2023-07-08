<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeLandController extends Controller
{



    public function home(){




        $user = Auth::user();
        
        
        if (!is_null($user)) {
       
       
            if($user->email_verified_at){
          
                
                                
                
                return view('welcome');

            }else{
                return redirect()->route('verifyEmailPage');
                
            }
       
       
        }else{
            return view('welcome');
        }
        
    }

}
