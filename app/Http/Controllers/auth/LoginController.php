<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\OtpNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\auth\authverifyCode;
use Carbon\Carbon;

class LoginController extends Controller
{

    public function gotoLoginPage()
    {

        $user = Auth::user();

        if (!is_null($user)) {
            return redirect()->route('home');
        } else {
            return view('auth.login');
        }
    }

    public function Login(Request $request)
    {





        $request->validate([

            'number' => 'required|digits:11|exists:users,mobile',
        ]);

        $user = User::where('mobile', $request->number)->first();


        if (is_null($user)) {

            return response()->json('شماره وارد شده معتبر نیست', 403);
        }

        $ten_minutes_ago = Carbon::now()->subMinutes(10)->toDateTimeString();
        $lastCode = authverifyCode::where('user_id', $user->id)->first();

        if (!is_null($lastCode)) {

            // if ($lastCode->updated_at < $ten_minutes_ago) {
            //     session()->flash('customError', 'کد فراموشی رمز دقایقی پیش برای شما ارسال شده است ،لطفا دقایقی دیگر تلاش کنید.');
            //     return redirect()->back();
            // } else {
            $code = $lastCode->update([
                'user_id' => $user->id,
                'code' => rand(10000, 99999),
            ]);

            session()->flash('customError', 'کد  ورود برای  شما ارسال شد');

            $user->notify(new OtpNotification());

            // }

        } else {


            $code = authverifyCode::create([
                'user_id' => $user->id,
                'code' => rand(10000, 99999),
            ]);


            
            
            $user->notify(new OtpNotification());

            session()->flash('customError', 'کد ورود  برای  شما ارسال شد');

        }

        
        session()->put('number' , $user->mobile);
            
        return redirect()->route('auth.EnterLoginCodePage');

    }



    public function EnterLoginCodePage(){


        $number = session()->get('number');
            
        
        $user = User::where('mobile' , $number)->first();

        if($user){
            

            return  view('auth.forgotPassword' , compact('user')) ;
        }else{
            return redirect()->home();
        }
       
       
    }



    public function EnterLoginCode(Request $request){
        
        $request->validate([

            'authEmailcode' => 'required|digits:5',
        ]);
        
        $user = User::where('mobile', $request->mobile)->first();

        if (is_null($user)) {
        
            session()->flash('userNotFound', 'مشکل در داده های ورودس');
            return redirect()->back();

        }

        $lastCode = authverifyCode::where('user_id', $user->id)->where('code', $request->authEmailcode)->first();

        if (is_null($lastCode)) {

            session()->flash('wrongCode', 'کد وارد شده اشتباه است');
            return redirect()->back();

        }

        $lastCode->delete();

        Auth::login($user);
        
        return redirect()->route('user.panel');

    }


    public function logout()
    {
        $user = Auth::user();


        Auth::logout($user);

        return redirect()->route('home');
    }
}