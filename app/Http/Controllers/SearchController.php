<?php

namespace App\Http\Controllers;

use App\Models\names;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Morilog\Jalali\Jalalian;

use Dompdf\Dompdf;

// use Barryvdh\DomPDF\Facade\Pdf;
// use mPDF;
use niklasravnsborg\LaravelPdf\PdfWrapper;


class SearchController extends Controller
{






    public function submit(Request $request)
    {
        if ($request->secondName) {
            $request->validate([
                'secondName' => 'required|regex:/^[a-zA-Z]+$/u',
                'name' => 'required|regex:/^[a-zA-Z]+$/u'
            ]);
            $result = $this->searchEngin4($request);
            $files = $this->getFileNamesFromResult($result['output'], 's4');


        } elseif ($request->date2) {
            $request->validate([
                'date1' => 'required',
                'date2' => 'required'
            ]);
            $result = $this->searchEngin3($request);



            $files = $this->getFileNamesFromResult($result['output'], 's3');
        } elseif ($request->name && $request->family) {
            $request->validate([
                'name' => 'required|regex:/^[a-zA-Z]+$/u',
                'family' => 'required|regex:/^[a-zA-Z]+$/u'
            ]);
            $result = $this->searchEngin2($request);

            $files = $this->getFileNamesFromResult($result['output'], 's2');
        } else {

            $result = $this->searchEngin1($request);



            $files = $this->getFileNamesFromResult($result['output'], 's1');
        }

        $inputed = $this->arrayInputName($result['input']);

        $data = $this->getTextFromDocxFile($files['files']);

        $newData = implode($data);


        $headers = $files['headers'];

        
        return view('export.pdf', compact('newData', 'data', 'inputed' , 'headers'));

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







    public function searchEngin1($request, $date = null)
    {
        if ($date) {
            $date1 = $date;
            $inputShamsiDate = $date;
        } else {
            $date1 = $request->date;

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
            2 => $daySum

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



    protected function searchEngin2($request)
    {


        $name = $request->name;
        $family = $request->family;

        $SoulSum = $this->getNumberFromPersonalNameAndFamily($name, $family, 'soulNumberFromChars');

        $PersonalSum = $this->getNumberFromPersonalNameAndFamily($name, $family, 'personalNumberFromChars');


        $personalEnergy = $this->getSumOfAll([$SoulSum['sum'], $PersonalSum['sum']]);



        $input = [
            'name' => $name,
            "family" => $family
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
            "output" => $output
        ];


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
                'arr' => [$SazOKar]
            ]
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
            'secondFamily' => $secondFamily
        ];


        $output = [

            "StressSum" =>
            [
                'sum' => $StressSum,
                'spc' => null,
                'arr' => [$StressSum]
            ]

        ];

        $data = [
            'input' => $inputs,
            'output' => $output
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




    function getFileNamesFromResult($result, $sCount)
    {

        $files = [];


        $headers = [];

        foreach ($result as $key => $value) {

            array_push($headers, config('main.persianNames')[$key]);

            $v = (string) (int) $value['sum'];

            $fielename = $sCount . "/" . $key . "/" . $v . ".docx";

            $path = Storage::disk('public')->path($fielename);

            // $path = public_path(env('SEARCH_ENGIN_'.config('main.numberToEnglish')[$sCount]."_".$key).$v);

            if (file_exists($path)) {
                array_push($files, $path);
            }

        }


        $outPut = [
            'headers' => $headers,
            'files' => $files
        ];

        return $outPut;
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

}