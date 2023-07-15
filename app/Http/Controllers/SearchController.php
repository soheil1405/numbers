<?php

namespace App\Http\Controllers;

use App\Models\names;
use App\Models\orders;
use App\Models\setting;
use App\Models\user_searches;
use \Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// // use mPDF;

class SearchController extends Controller
{

    public function submit(Request $request)
    {
        if ($request->secondName) {
            $request->validate([
                'secondName' => 'required|regex:/^[a-zA-Z]+$/u',
                'name' => 'required|regex:/^[a-zA-Z]+$/u',
            ]);
            $result = $this->searchEngin4($request);
            $files = $this->getFileNamesFromResult($result['output'], 's4', $request->sex);
            $searchType = 's4';

        } elseif ($request->date2) {
            $request->validate([
                'date1' => 'required',
                'date2' => 'required',
            ]);
            $result = $this->searchEngin3($request);

            $files = $this->getFileNamesFromResult($result['output'], 's3', $request->sex);
            $searchType = 's3';
        } elseif ($request->name && $request->family) {
            $request->validate([
                'name' => 'required|regex:/^[a-zA-Z]+$/u',
                'family' => 'required|regex:/^[a-zA-Z]+$/u',
            ]);
            $result = $this->searchEngin2($request);

            $files = $this->getFileNamesFromResult($result['output'], 's2', $request->sex);

            $searchType = 's2';
        } else {

            $result = $this->searchEngin1($request);

            $files = $this->getFileNamesFromResult($result['output'], 's1', $request->sex);

            $searchType = 's1';
        }

        $inputed = $this->arrayInputName($result['input']);

        $data = $this->getTextFromDocxFile($files);


        $headers = $data['headers'];

        $Arraydata = [
            'data' => $data['files'],
            'headers' => $headers,
            'inputed' => $inputed,
            'sex' => $request->sex
        ];

        $user = Auth::user();




        $totalAmount = setting::first()->searchEnginOncePay;




        $order = orders::create([
            'user_id' => $user->id,
            'jsonData' => json_encode($Arraydata),
            'totalAmount' => $totalAmount,
            'status' => 0,
            'resultCount' => 1,
            'componyOrUserName' => $user->firstname . "-" . $user->lastname,
            'ComponyOrUser' => 'u',
            'searchType' => $searchType,
        ]);




        return redirect()->route('user.search.show', ['id' => $order->id]);

        // $pdf = Pdf::loadView('export.pdf', compact('newData'));
        // Pdf::setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);

        // return $pdf->download('disney.pdf');
        // return view('export.pdf' , compact('newData' , 'data'));
//         $html = '<!doctype html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';

        //         $html .= '</head><body>';
//         $html .= "<style>

        // @font-face {
//     font-family: IRANSansWeb_UltraLight;
//     font-style: normal;
//     font-weight: 200;
//     src: url('../fonts/eot/IRANSansWeb_UltraLight.eot');
//     src: url('../fonts/eot/IRANSansWeb_UltraLight.eot?#iefix')
//             format('embedded-opentype'),
//          url('../fonts/woff2/IRANSansWeb_UltraLight.woff2')
//             format('woff2'),

        //             url('../fonts/woff/IRANSansWeb_UltraLight.woff') format('woff'),

        //             url('../fonts/ttf/IRANSansWeb_UltraLight.ttf') format('truetype');
// }

        //         body{ font-family: 'IRANSansWeb_UltraLight'; font-weight: normal; line-height:1.6em; font-size:17pt; }
//         h1,h2{ font-family: 'IRANSansWeb_UltraLight'; font-weight: bold; line-height:1.2em; }
//         </style>";

        //         $html .= 'test <br>
//         <span style="font-family:\'Open Sans\'"> ' . $newData . ' </span> <br>          ';
//         $html .= '</body></html>';

        //         // instantiate and use the dompdf class
//         $dompdf = new Dompdf();
//         $dompdf->loadHtml($html, 'UTF-8');

        //         // (Optional) Setup the paper size and orientation
//         $dompdf->setPaper('A4');

        //         $dompdf->set_option('defaultMediaType', 'all');
//         $dompdf->set_option('isFontSubsettingEnabled', true);

        //         // Render the HTML as PDF
//         $dompdf->render();

        //         return $dompdf->stream();

    }

    public function searchEngin1($request, $date = null, $sex = null)
    {
        if ($date) {

            $date1 = $date;
            $inputShamsiDate = $date;
            $sex = $sex;

        } else {

            $date1 = $request->date;
            $sex = $request->sex;
            $inputShamsiDate = $request->date;

        }

        $manthShamsi = (int) substr($date1, 5, 2);
        $YearShamsi = ((((int) substr($date1, 0, 4)) - 1279) % 12) + 1;

        $date1 = $this->ExportDateAsShamsi($date1);

        $year = $this->getYear($date1);

        $month = $this->getMonth($date1);

        $day = $this->getDay($date1);

        $yearSum = $this->getSum($year)['sum'];
        $monthSum = $this->getSum($month)['sum'];
        $daySum = $this->getSum($day)['sum'];

        $allSums = [
            0 => $yearSum,
            1 => $monthSum,
            2 => $daySum,

        ];

        $stringMiladi = implode("-", $date1);
        $time = $this->getTodayDateTimeAsArray();

        $thisYear = $time['year'];
        $thisMonth = $time['month'];
        $thisDay = $time['day'];

        //adad shoghli ----- page 1 of pdf
        $adad_shoghli = $this->getSumOfAll($allSums, [11, 22, 33]);
        $DayNumberFromBirthday = $this->getSumOfAll([$this->getDay($date1)], [11, 22, 29]);
        $DebtStatusFromDayOfBirthday = $this->DebtStatusFromDayOfBirthday($this->getDay($date1));
        $dataForAttitude = [
            0 => $monthSum,
            1 => $daySum,
        ];
        $attitudeStatusFromDayAndMonth = $this->getSumOfAll($dataForAttitude);
        $RotationYear = $this->getSumOfAll([$thisYear, $attitudeStatusFromDayAndMonth['sum']], [11, 22]);
        $RotationMonth = $this->getSumOfAll([$RotationYear['sum'], $thisMonth]);
        $RotationDay = $this->getSumOfAll([$RotationMonth['sum'], $thisDay]);

        $f17 = $this->f17($date1);

        $ipute = [
            'shamsi' => $date1,
            'miladi' => $stringMiladi,
        ];

        $output = [
            //f-1 shoma che kasi hastid
            'birthday' => ['sum' => $day, 'spc' => null, 'arr' => [$day]],

            //f-2 rahnamaye entekhab shoghl
            'monthShamsi' => ['sum' => $manthShamsi, 'spc' => null, 'arr' => [$manthShamsi]],

            //f-3 zoodyak chini
            'YearShamsi' => ['sum' => $YearShamsi, 'spc' => null, 'arr' => [$YearShamsi]],

            //f-4 masir zendegi
            "lifeWay" => $adad_shoghli,

            //f-5 moshkelat ehtemali salamat
            "ProbablyHealthProblems" => $adad_shoghli,

            //f-6 neshaneh va namad adadi
            "yourNumber" => $adad_shoghli,

            //f-7 afrad mashHoor
            "yourPopularPerson" => $adad_shoghli,

            //f-8 nomarat mosbat va manfi az  tarikh tavalod shoma
            "positiveAndNegativeFromYourDate" => $adad_shoghli,

            //f-9 behtarin herfe baraye shoma
            "yourBestJobs" => $adad_shoghli,

            //f-13 negaresh
            "attitudeStatusFromDayAndMonth" => $attitudeStatusFromDayAndMonth,

            //f-14  tajrobiat va chalesh haye 9 sale
            'RotationYear' => $RotationYear,
            //f-15  vazayef va darsh haye mahe shakhsi
            'RotationMonth' => $RotationMonth,
            //f-16 rahnamaye entekhabe tarikhe khas
            'RotationDay' => $RotationDay,

            //f-17
            "f17" => $f17,

            //f-20 bedehi karmaei
            "DebtStatusFromDayOfBirthday" => $DebtStatusFromDayOfBirthday,

        ];

        $input = [
            'miladi' => $stringMiladi,
            'shamsi' => $inputShamsiDate,
        ];

        $data = ['output' => $output, "input" => $input];


        return $data;
    }

    protected function searchEngin2($request, $name = null, $family = null)
    {

        if (is_null($name)) {

            $name = $request->name;
        }

        if (is_null($family)) {

            $family = $request->family;

        }

        $SoulSum = $this->getNumberFromPersonalNameAndFamily($name, $family, 'soulNumberFromChars');

        $PersonalSum = $this->getNumberFromPersonalNameAndFamily($name, $family, 'personalNumberFromChars');

        $personalEnergy = $this->getSumOfAll([$SoulSum['sum'], $PersonalSum['sum']]);

        $input = [
            'name' => $name,
            "family" => $family,
        ];

        $output = [
            //f-10 potansiel va estedad shakhsi
            'personalEnergy' => $personalEnergy,

            //f-11 roya ha va arezoo ha
            "soulNumnber" => $SoulSum,

            //f-12 shkhsiat haghighi
            "personalNumber" => $PersonalSum,

        ];

        $data = [
            'input' => $input,
            "output" => $output,
        ];

        // dd($data);
        return $data;

    }

    protected function searchEngin3($request)
    {

        $for1 = $this->searchEngin1($request, $request->date1);
        $for2 = $this->searchEngin1($request, $request->date2);

        $attitude1 = $for1['output']['attitudeStatusFromDayAndMonth'];

        $attitude2 = $for2['output']['attitudeStatusFromDayAndMonth'];

        $sum1 = $attitude1['sum'];

        $sum2 = $attitude2['sum'];

        if ($sum2 >= $sum1) {
            $SazOKar = $sum2 - $sum1;
        } else {
            $SazOKar = $sum1 - $sum2;
        }

        $inputes = [
            'shamsi' => $for1['input']['shamsi'],
            'miladi' => $for1['input']['miladi'],

            'shamsi2' => $for2['input']['shamsi'],
            'miladi2' => $for2['input']['miladi'],
        ];

        $outPut = [

            //f-19 sazegari ejtemaei
            'SazOKar' => [
                'sum' => $SazOKar,
                'spc' => null,
                'arr' => [$SazOKar],
            ],
        ];

        $date = ['input' => $inputes, 'output' => $outPut];

        return $date;
    }

    protected function searchEngin4($request)
    {

        $name = $request->name;

        $secondName = $request->secondName;

        $family = $request->family;

        $secondFamily = $request->secondFamily;
        $SoulSumName = $this->getNumberFromPersonalNameAndFamily($name, $family, 'soulNumberFromChars');

        $SoulSumSecondName = $this->getNumberFromPersonalNameAndFamily($secondName, $secondFamily, 'soulNumberFromChars');

        $first = $SoulSumName['sum'];
        $second = $SoulSumSecondName['sum'];
        if ($second >= $first) {
            $StressSum = $second - $first;
        } else {
            $StressSum = $first - $second;
        }

        $inputs = [
            'name' => $name,
            'secondName' => $secondName,
            'family' => $family,
            'secondFamily' => $secondFamily,
        ];

        $output = [

            "StressSum" =>
            [
                'sum' => $StressSum,
                'spc' => null,
                'arr' => [$StressSum],
            ],

        ];

        $data = [
            'input' => $inputs,
            'output' => $output,
        ];

        return $data;

    }

    public function s1()
    {
        return view('user.search.s1');
    }

    public function s2()
    {
        return view('user.search.s2');
    }
    public function s3()
    {
        return view('user.search.s3');
    }

    public function s4()
    {
        return view('user.search.s4');
    }

    public function searchName(Request $request)
    {

        $names = names::where('english_name', "LIKE", "%" . $request->name . "%")->where('type', $request->type)->get();

        return response()->json($names);

    }

    public function getFileNamesFromResult($result, $sCount, $sex)
    {


        foreach ($result as $key => $value) {


            // $newfileDir = [];

            if ($key == "f17" && $sCount == "s1") {

                $f17files = [];

                foreach ($value['sum'] as $keyy => $valuee) {
                    if ($valuee === "+1") {

                        $path1 = Storage::disk('public')->path($sCount . "/" . $key . '/' . $keyy . "/" . $valuee . ".docx");
                        $path2 = Storage::disk('public')->path($sCount . "/" . $key . '/' . $keyy . '/' . "1.docx");
                        if (file_exists($path1)) {
                            array_push($f17files, $path1);
                        }
                        if (file_exists($path2)) {
                            array_push($f17files, $path2);
                        }
                    } else {

                        $path = Storage::disk('public')->path($sCount . "/" . $key . '/' . $keyy . "/" . $valuee . ".docx");
                        if (file_exists($path)) {
                            array_push($f17files, $path);
                        }
                    }
                }
                $items[$key] = $f17files;
            } else {

                $v = (string) (int) $value['sum'];


                if ($key == "lifeWay") {
                    $v = $v . $sex;
                }

                $fielename = $sCount . "/" . $key . "/" . $v . ".docx";
                $path = Storage::disk('public')->path($fielename);


                if (file_exists($path)) {
                    $items[$key] = [$path];
                }

                if ($value['spc']) {

                    $v = (string) (int) $value['spc'];


                    if ($key == "lifeWay") {
                        $v = $v . $sex;
                    }

                    $fielename = $sCount . "/" . $key . "/" . $v . ".docx";
                    $path2 = Storage::disk('public')->path($fielename);

                    if (file_exists($path2)) {
                        $items[$key] = [$path, $path2];
                    }
                }







            }

            // $path = public_path(env('SEARCH_ENGIN_'.config('main.numberToEnglish')[$sCount]."_".$key).$v);



        }

        // dd($filekey);





        return $items;
    }

    public function arrayInputName($data, $persianName = null)
    {

        $string = "اطلاعات ورودی:";

        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $string .= config('main.' . $key) . " : " . $value;
            }

        } else {
            $string = $persianName . "  " . $data;
        }

        return $string;

    }

    public function searchByCompony(Request $request)
    {





        $result = [];

        $dates = $request->date;
        $sexes = $request->sex;


        $setting = setting::first();

        $user = Auth::user();

        if (is_null($setting)) {
            $totalAmount = count($dates) * (990000);
        } else {

            $totalAmount = count($dates) * ($setting->searchEnginMoreThanOne);
        }


        for ($i = 0; $i < count($dates); $i++) {
            $data = $this->searchEngin1($request, $dates[$i + 1], $sexes[$i + 1]);
            // dd($data);
            $files = $this->getFileNamesFromResult($data['output'], 's1', $sexes[$i + 1]);


            $inputed = $this->arrayInputName($data['input']);

            $dataFromFiles = $this->getTextFromDocxFile($files);

            $headers = $dataFromFiles['headers'];

            $Arraydata = [
                'data' => $dataFromFiles['files'],
                'headers' => $headers,
                'inputed' => $inputed,
                'sex' => $sexes[$i + 1] == "a" ? "آقا" : "خانم",
            ];

            array_push($result, $Arraydata);
        }
        $order = orders::create([
            'user_id' => $user->id,
            'jsonData' => json_encode($result),
            'totalAmount' => $totalAmount,
            'status' => 0,
            'resultCount' => count($dates),
            'componyOrUserName' => $user->componyName,
            'ComponyOrUser' => 'c',
            'searchType' => 's1',
        ]);



        return redirect()->route('user.orders.show', ['order' => $order]);
    }





    public function history()
    {
        $user = Auth::user();



        $personalHistory = $user->personalHistory;


        $orgHistory = $user->orgHistory;


        $history = $personalHistory->merge($orgHistory);





        return view('user.history.index', compact('history'));
    }



    public function show($orderId)
    {

        $order = orders::findOrFail($orderId);

        $user = Auth::user();

        if ($order->user_id != $user->id) {

            session()->flash('CustomError', "خطا");
            return back();
        }


        $dataaa = json_decode($order->jsonData, true);

        if (array_key_exists('inputed', $dataaa)) {


            $data = $dataaa['data'];
            $inputed = $dataaa['inputed'];
            $sex = $dataaa['sex'];
            $headers = $dataaa['headers'];

            return view('user.search.result.show', compact('data', 'order', 'inputed', 'sex', 'headers'));
        }

        if (count($dataaa) > 0) {
            $data = $dataaa;

            return view('user.search.result.componyList', compact('data', 'order'));
        }


    }

    public function showItem($id, $index)
    {

        $order = orders::findOrFail($id);

        $user = Auth::user();

        if ($order->user_id != $user->id) {

            session()->flash('CustomError', "خطا");
            return back();
        }


        $arrData = json_decode($order->jsonData, true);
        if (!array_key_exists($index, $arrData)) {
            return abort(404);
        }




        $inputed = $arrData[$index]['inputed'];

        $headers = $arrData[$index]['headers'];
        $data = $arrData[$index]['data'];


        return view('user.search.result.show', compact('data', 'inputed', 'headers'));


    }



    public function searchByCompony2(Request $request)
    {

        $names = $request->name;

        $families = $request->family;
        $sexes = $request->sex;

        

        $setting = setting::first();

        $user = Auth::user();

        if (is_null($setting)) {
            $totalAmount = count($names) * (990000);
        } else {

            $totalAmount = count($names) * ($setting->searchEnginMoreThanOne);
        }


        $data = [];

        for ($i = 1; $i <= count($names); $i++) {

            $result = $this->searchEngin2($request, $names[$i], $families[$i]);

            $inputed = $this->arrayInputName($result['input']);

            $files = $this->getFileNamesFromResult($result['output'], 's2', $sexes[$i]);
            $dataFromFiles = $this->getTextFromDocxFile($files);

            $headers = $dataFromFiles['headers'];

            $Arraydata = [
                'data' => $dataFromFiles['files'],
                'headers' => $headers,
                'inputed' => $inputed,
                'sex' => $sexes[$i] == "a" ? "آقا" : "خانم",
            ];

            array_push($data, $Arraydata);

        }

        $order = orders::create([
            'user_id' => $user->id,
            'jsonData' => json_encode($data),
            'totalAmount' => $totalAmount,
            'status' => 0,
            'resultCount' => count($names),
            'componyOrUserName' => $user->componyName,
            'ComponyOrUser' => 'c',
            'searchType' => 's2',
        ]);



        return redirect()->route('user.orders.show', ['order' => $order]);
    }


}