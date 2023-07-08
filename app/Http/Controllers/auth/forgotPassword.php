<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendEamil;
use App\Models\auth\authverifyCode;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\OtpNotification;

class forgotPassword extends Controller
{

    public function sendForgotPassCode(Request $request)
    {

        // $request->validate([

        //     'number' => 'required|email',
        // ]);


        $number = session()->get('number');


        $user = User::where('number' , $number)->first();

        if(is_null($user)){
            session()->flash('customError', 'شماره وارد شده اشتباه است');

            return redirect()->route('auth.login');
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
                    'for' => 'mobile'
                ]);



                // SendEamil::dispatch($email , $lastCode->code);

                session()->flash('customError', 'کد فراموشی رمز برای  شما ارسال شد');
              
                $user->notify(new OtpNotification());

            // }

        } else {


            $code = authverifyCode::create([
                'user_id' => $user->id,
                'code' => rand(10000, 99999),
                'for' => 'mobile'
            ]);



            // $email = $user->email;

            // SendEamil::dispatch($email , $code->code);
            $user->notify(new OtpNotification());

            session()->flash('customError', 'کد فراموشی رمز به  شما ارسال شد');

        }
        return   redirect()->route('auth.EnterResetPassPage') ;

    }

    public function EnterResetPassCode(Request $request)
    {

        $request->validate([

            'authEmailcode' => 'required|digits:5',
        ]);

        $user = User::where('number', $request->number)->first();

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

        ;

        Auth::login($user);

        return redirect()->route('user.ResetPassPage');

    }


    public function EnterResetPassPage(){
        
        if(session()->get('number')){
            $number = session()->get('number');

            $user = User::where('number' , $number)->first();

            if(is_null($user)){

             
                session()->flash('customErr' , 'unknown errr');

                return redirect()->route('auth.LoginPage');
            }



            return  view('auth.forgotPassword' , compact('user')) ;
        }






    }

    public function ResetPassPage()
    {

        
        return view('auth.resetPassPage');
    }

    public function EnterNew(Request $request)
    {

        $request->validate([
            'newPass' => 'required|min:4 |same:newPassVerify',
        ]);

        $user = Auth::user();

        if (is_null($user)) {
            return redirect()->route('home');

        }

        $pass = Hash::make($request->newPass);

        $check = hash::check($request->newPass, $pass);

        if ($check) {

            $user->update([
                'password' => $pass,
            ]);

            session()->flash('passEdited', 'پسورد شما با موفقیت  تغییر کرد');

            if ($user->role->role_id != 2) {
                return redirect()->route('user.panel');
            } else {
                return redirect()->route('adminn.panel');
            }

        } else {

            session()->flash('customErr', 'خطایی پیش آمده می باشد');

            return redirect()->back();

        }

    }

}