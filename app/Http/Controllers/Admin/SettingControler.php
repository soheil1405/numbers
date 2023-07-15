<?php

namespace App\Http\Controllers\Admin;

use App\Models\payment;
use App\Models\QuestionPay;
use App\Models\setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Route;

class SettingControler extends Controller
{



    public function index()
    {

        $setting = setting::first();

        $payments = payment::OrderByDesc('id')->get();

        $todays = payment::whereDate('created_at', Carbon::today())->where('status', 1)->get();

        $all = payment::where('status', 1)->get();

        $allpays = 0;
        $allBuys = 0;
        $allpaysCount = 0;

        $todasyPay = 0;
        $todaysBuys = 0;
        $todaysCount = 0;

        foreach ($all as $pays) {
            $allpaysCount++;
            $allpays += $pays->totalAmount;
            $allBuys += $pays->PaymentCount;
        }


        foreach ($todays as $pays) {

            $todasyPay += $pays->totalAmount;
            $todaysBuys += $pays->PaymentCount;
            $todaysCount++;
        }





        return view(
            'admin.setting.index',
            compact('setting', 'payments', 'allpaysCount', 'todaysCount', 'todasyPay', 'todaysBuys', 'allpays', 'allBuys')
        );
    }






    public function edit(Request $request)
    {

        $setting = setting::first();

        $setting->update([

            'searchEnginOncePay' => $request->searchEnginOncePay ,
            'searchEnginMoreThanOne' => $request->searchEnginMoreThanOne ,

        ]);


        session()->flash('edited', 'مبلغ موتور جستجو با موقیت تغییر کرد');
        return redirect()->back();

    }





    public function searchPdfSettingPage()
    {

        $setting = setting::first();




        if (is_null($setting)) {
            $this->createFirstOneDefualtSetting();
        }

        $setting = setting::first();

        $routeName = Route::currentRouteName();

        $sCount = str_split($routeName, 16)[1];


        return view('admin.setting.searchEngins', compact('sCount', 'setting'));





    }

    public function s2()
    {

    }
    public function s3()
    {

    }
    public function s4()
    {

    }



    private function createFirstOneDefualtSetting()
    {




        setting::create([
            'searchEngin1Pay' => 50000,
            'searchEngin2Pay' => 50000,
            'searchEngin3Pay' => 50000,
            'searchEngin4Pay' => 50000,

        ]);

    }




    public function EditPdfs(Request $request)
    {

        
        dd($request->all());
        foreach ($request->except('_token') as $Reqkey => $ReqValue) {
            if (array_key_exists($Reqkey, config('main.searchEngin1'))) {
                foreach ($ReqValue as $reqItemKey => $reqItemValue) {

                    

                    dd($Reqkey);

                    Storage::disk('public')->path($Reqkey . "/" . $key . '/' . $keyy . "/" . $reqItemKey . ".docx");
    
                    // $path = url(public_path(env('SEARCH_ENGIN_ONE_' . $Reqkey) . $reqItemKey . ".pdf"));
                
                    // if (file_exists($path)) {
                    //     unlink($path);
                    // }
                    $reqItemValue->move(public_path(env('SEARCH_ENGIN_ONE_' . $Reqkey), $reqItemKey . ".pdf"));
                }
            }
        }


        session()->flash('edited', ' pdf مورد نظر با موقیت تغییر کرد');

        return redirect()->route('adminn.setting.s1');



    }



}
