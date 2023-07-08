<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\auth\authverifyCode;
use App\Models\cities;
use App\Models\classLevels;
use App\Models\Fileds_of_studys;
use App\Models\User;
use App\Models\user_roles;
use App\Notifications\OtpNotification;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function gotoRegisterPage()
    {



        $user = Auth::user();

        if (!is_null($user)) {

            return redirect()->route('home');

        } else {
            $cities = config('main.cities');
            // $class_levels = classLevels::all();
            $fields_of_study = config('main.Fileds_of_studys');

            return view('auth.register', compact('cities', 'fields_of_study'));
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required|digits:11',
        ]);



        $user = Auth::user();



        if (!is_null($user)) {

            return redirect()->route('home');

        } else {


            $sameNumber = User::where('mobile', $request->mobile)->first();


            if ($sameNumber) {
                session()->flash('customError', 'این شماره تلفن قبلا در سیستم ثبت نام کرده است ...');
                return redirect()->back();

            } else {

                $user = User::create([
                    'firstname' => $request->first_name,
                    'lastname' => $request->last_name,
                    'mobile' => $request->mobile,
                ]);

                user_roles::create([
                    'user_id' => $user->id,
                    'role_id' => '1',
                ]);

                $code = authverifyCode::create([
                    'user_id' => $user->id,
                    'code' => rand(10000, 99999),

                ]);


                if ($user) {
                    Auth::login($user);
                    return redirect()->route('verifyMobile');
                } else {
                    Session::flash('customError', 'عملیات با شکست مواجه شد ...');

                    return redirect()->back();
                }



            }
        }
    }
}