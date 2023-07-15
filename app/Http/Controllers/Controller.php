<?php

namespace App\Http\Controllers;

use App\Models\payment;
use App\Models\QuestionPay;
use App\Models\setting;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\Orders;
use FPDF;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    protected function payment(Request $request)
    {


        $userLastOrder = Orders::where('user_id', Auth::user()->id)->whereNull('marchant_id')->where('status', 0)->latest()->first();

        if (is_null($userLastOrder)) {
            session()->flash('CustomError', "خطا");
            return redirect()->back();
        }


        $pay = $userLastOrder->totalAmount;

        $data = array(
            'MerchantID' => "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx",
            'Amount' => (int) $pay,
            'CallbackURL' => route('user.payment.verify'),
            'Description' => 'خرید تست',

        );

        $jsonData = json_encode($data);
        $ch = curl_init('https://sandbox.zarinpal.com/pg/rest/WebGate/PaymentRequest.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($jsonData),
            )
        );

        $result = curl_exec($ch);
        $err = curl_error($ch);
        $result = json_decode($result, true);

        curl_close($ch);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {

            $userLastOrder->update([
                'status' => $result['Status'],
                'marchant_id' => json_encode($result)
            ]);

            if ($result["Status"] == 100) {

                return redirect("https://sandbox.zarinpal.com/pg/StartPay/" . $result["Authority"]);

                // $array = ['Authority'=>$result["Authority"]];
                // header('Content-Type: application/json');
                // header('Location: https://sandbox.zarinpal.com/pg/StartPay/' . $result["Authority"]);

            } else {

                echo 'ERR: ' . $result["Status"];

                session()->flash('CustomError', "خطا");

            }
        }

    }

    public function verifyy(Request $request)
    {

        $MerchantID = "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx";

        $Authority = $request->Authority;
        $orders = Orders::where('user_id', Auth::user()->id)->whereNotNull('marchant_id')->where('status', 100)->latest()->first();

        if (is_null($orders)) {
            session()->flash('CustomError', "خطا");
            return redirect()->back();
        }


        $data = array('MerchantID' => $MerchantID, 'Authority' => $Authority, 'Amount' => $orders->totalAmount);
        $jsonData = json_encode($data);
        $ch = curl_init('https://sandbox.zarinpal.com/pg/rest/WebGate/PaymentVerification.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($jsonData),
            )
        );

        $result = curl_exec($ch);

        $err = curl_error($ch);
        curl_close($ch);

        $result = json_decode($result, true);


        $payment = new payment();

        $payment->user_id = Auth::user()->id;
        $payment->order_id = $orders->id;

        $payment->ref_id = $result['RefID'];
        $payment->callback_url = route('user.history');
        $payment->totalAmount = $orders->totalAmount;
        $payment->status = $result['Status'];



        $payment->save();



        $orders->update([

            'status' => $result['Status']
        ]);


        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            if ($result['Status'] == 100) {
                $user = User::findOrFail($payment->user_id);
                if ($orders->searchType == "increaseCredit") {
                 
                    $setting = setting::first();

                    $firstpay = $setting->searchEnginOncePay;

                    $count = ($orders->totalAmount)/$firstpay;
                 
                    $user->update([
                        's1CreditCount' => ($user->s1CreditCount + $count),
                        's2CreditCount' => ($user->s2CreditCount + $count),
                        's3CreditCount' => ($user->s3CreditCount + $count),
                        's4CreditCount' => ($user->s4CreditCount + $count),
                    ]);
                }

                session()->flash('CustomSuccess', 'پرداخت شما با موفقیت انجام شد و حساب کاربری شما شارز  شد');

                return redirect()->route('user.history');

            } else {





                session()->flash('error', 'عملیات پرداخت با شکست مواجه شد');

                return redirect()->route('user.orders.index');

            }
        }
    }


    function shamsiToMiladi($date)
    {
        return \Morilog\Jalali\CalendarUtils::createCarbonFromFormat('Y-m-d', $date)->format('Y-m-d');
    }


    protected function ExportDateAsShamsi($date)
    {


        $newdate = str_replace('/', '-', $date);


        $jDate = $this->shamsiToMiladi($newdate);


        return explode('-', $jDate);






    }

    protected function getYear($data)
    {
        return $data[0];
    }

    protected function getMonth($data)
    {
        return $data[1];
    }

    protected function getDay($data)
    {


        return $data[2];
    }


    protected function getSum($data)
    {



        $sum = 0;


        $spcSumNumbers = [];

        if ($data != 11 && $data != 22 && $data != 33) {


            for ($i = 0; $i < strlen($data); $i++) {
                $sum += $data[$i];
            }

            if ($sum == 11 || $sum == 22 || $sum == 33) {
                array_push($spcSumNumbers, $sum);
            }


        } else {


            array_push($spcSumNumbers, $data);

            $sum = (int) $data;
        }


        if ($sum > 9 && $sum != 11 && $sum != 22) {
            return $this->getSum((string) $sum);
        }


        $result = [
            "sum" => $sum,
            "spcSumNumbers" => $spcSumNumbers,
            "data" => $data
        ];


        return $result;


    }




    protected function getSumOfAll($arr, $spcArr = null)
    {




        $sum = 0;



        foreach ($arr as $number) {
            $sum += $number;
        }


        if ($sum > 9) {


            if ($spcArr) {

                if (in_array($sum, $spcArr)) {
                    $output = [
                        "sum" => $this->getManualSum((string) $sum),
                        "spc" => $sum,
                        "arr" => $arr
                    ];

                    return $output;

                } else {

                    $stringVal = (string) $sum;

                    $arrVal = [];

                    for ($i = 0; $i < strlen($stringVal); $i++) {
                        array_push($arrVal, (int) $stringVal[$i]);
                    }

                    return $this->getSumOfAll($arrVal);

                }
            } else {
                $stringVal = (string) $sum;

                $arrVal = [];

                for ($i = 0; $i < strlen($stringVal); $i++) {
                    array_push($arrVal, (int) $stringVal[$i]);
                }

                return $this->getSumOfAll($arrVal);

            }

        }






        $output = [
            "sum" => $sum,
            'spc' => null,
            "arr" => $arr
        ];


        return $output;
    }




    //bedehi mali ----- page 3 of pdf
    public function DebtStatusFromDayOfBirthday($day)
    {

        if ($day == 13 || $day == 14 || $day == 16 || $day == 19) {

            $output =
                [
                    'sum' => $this->getSum($day)['sum'],
                    "spc" => $day,
                    "arr" => [$day],
                ];

            return $output;

        } else {

            $output =
                [
                    'sum' => $this->getSum($day)['sum'],
                    "spc" => $day,
                    "arr" => [$day],
                ];

            return $output;
        }
    }



    public function getNumberFromPersonalNameAndFamily($name, $family = null, $type)
    {

        $nameAnalize = $this->getNumber($name, $type);


        if ($family) {

            $familyAnalize = $this->getNumber($family, $type);

            $data = array_merge($nameAnalize, $familyAnalize);



        } else {

            $data = $nameAnalize;

        }

        $finalSum = $this->getSumOfAll($data);

        return $finalSum;

    }


    function getNumber($string, $type)
    {

        $datas = [];



        for ($i = 0; $i < strlen($string); $i++) {
            if (array_key_exists($string[$i], config('main.' . $type))) {
                if ($type == "soulNumberFromChars") {
                    if ($string[$i] == "y" || $string[$i] == "Y") {

                        if ($i + 1 < strlen($string)) {
                            if (array_key_exists($string[$i + 1], config('main.soulNumberFromChars'))) {
                                array_push($datas, config('main.' . $type)[$string[$i]]);
                            }
                        }
                    } else {
                        array_push($datas, config('main.' . $type)[$string[$i]]);
                    }
                } else {
                    array_push($datas, config('main.' . $type)[$string[$i]]);
                }
            }
        }


        $output = $datas;

        return $output;


    }





    //it just return 1-9
    function getManualSum($StringNumber)
    {

        $sum = 0;

        for ($i = 0; $i < strlen($StringNumber); $i++) {
            $sum += $StringNumber[$i];
        }


        if ($sum > 9) {
            return $this->getManualSum((string) $sum);
        }

        return $sum;


    }




    public function getTodayDateTimeAsArray()
    {

        return Carbon::today()->toArray();





    }




    protected function getTextFromDocxFile($filenameArr)
    {



        $headers = [];

        $dataaa = [];

        $data = [];
        foreach ($filenameArr as $fasl => $f) {
            array_push($headers , $fasl);

            foreach ($f as $header => $filename) {



                $striped_content = '';
                $content = '';

                if (!$filename || !file_exists($filename)) {


                    return false;


                }

                $zip = zip_open($filename);



                if (!$zip || is_numeric($zip)) {

                    return false;

                }
                while ($zip_entry = zip_read($zip)) {
                    if (zip_entry_open($zip, $zip_entry) == FALSE)
                        continue;
                    if (zip_entry_name($zip_entry) != "word/document.xml")
                        continue;
                    $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
                    zip_entry_close($zip_entry);
                } // end while  



                zip_close($zip);
                $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
                $content = str_replace('</w:r></w:p>', "\r\n", $content);
                $striped_content = strip_tags($content);


                if (array_key_exists($fasl, $dataaa)) {

                    // dd($dataaa[$fasl]);
                    $dataaa[$fasl] = array_merge($dataaa[$fasl] ,  [$striped_content]);

                }else{

                    $dataaa[$fasl] =[ $striped_content];
                }



                // return $striped_content;

                $filename = "sample.docx"; // or /var/www/html/file.docx  
                // $content = read_file_docx($filename);

                if ($content !== false) {

                    // array_push($data , $content);

                    // echo nl2br($content);
                }
            }


        }


        
        $output = [
            'headers' => $headers,
            'files' => $dataaa
        ];

        

        return $output;



    }



    public function increaseCredit(Request $request)
    {



        $setting = setting::first();

        $firstpay = $setting->searchEnginOncePay;

        $pay = ($request->pay) * $firstpay;

        $user = Auth::user();
        $order = orders::create([
            'user_id' => $user->id,

            'totalAmount' => $pay,
            'status' => 0,
            'componyOrUserName' => $user->firstname . " - " . $user->lastname,
            'ComponyOrUser' => 'u',
            'searchType' => 'increaseCredit',
        ]);

        return redirect()->route('user.orders.show', ['order' => $order]);

    }


    public function payFromCredit(Request $request)
    {


        $order = Orders::findOrFail($request->id);

        $user = Auth::user();


        if ($order->searchType == "increaseCredit" || $order->ComponyOrUser != "u" || $order->payment || $order->user_id != $user->id) {
            session()->flash('CustomError', "خطا");
            return redirect()->back();
        }


        if ($user[$order->searchType . 'CreditCount'] == 0) {
            session()->flash('CustomError', "موجودی کافی نیست");
            return redirect()->back();
        }

        $order->update([
            'status' => 100 ,
            'marchant_id'=>'payFromCredit' 
        ]);


        $user[$order->searchType . 'CreditCount'] = ($user[$order->searchType . 'CreditCount']) - 1;

        $user->save();



        return redirect()->route('user.search.show', ['id' => $order->id]);





    }



    public function f17($arr)
    {

        $date = implode('-', $arr);
        $numbers = [
            '1' => 0,
            '2' => 0,
            '3' => 0,
            '4' => 0,
            '5' => 0,
            '6' => 0,
            '7' => 0,
            '8' => 0,
            '9' => 0,
        ];
        for ($j = 1; $j <= 9; $j++) {
            for ($i = 1; $i < strlen($date) + 1; $i++) {
                if ($date[$i - 1] == $j) {
                    $numbers[$j] = $numbers[$j] + 1;
                }
            }
        }


        foreach ($numbers as $key => $value) {

            if ($value == 0) {
                $numbers[$key] = "-1";
            } elseif ($value > 1) {
                $numbers[$key] = "+1";
            } else {
                $numbers[$key] = "1";

            }

        }

        $output = ['data' => $date, 'sum' => $numbers];

        return $output;
    }
}