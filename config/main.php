<?php

return [
    'sms_send' => strtolower(env('APP_ENV')) == 'production' ? true : env('SEND_OTP_SMS', false),
    'otp_min' => env('OTP_MIN', 1111),
    'otp_max' => env('OTP_MAX', 9999),
    'ippanel_api_key' => env('IPPANEL_API_KEY'),
    'ippanel_otp_pattern_key' => env('IPPANEL_OTP_PATTERN_KEY'),
    'dev_detial' => [
        'email' => 'msoheilamini@gmail.com',
        'mobile' => '09390141405'
    ],
    "citits_Label" => "استان",
    "cities" => [

        1 => "آذربایجان شرقی",

        2 => "آذربایجان غربی",
        3 => "اردبیل",
        4 => "اصفهان",
        5 => "البرز",
        6 => "ایلام",
        7 => "بوشهر",
        8 => "تهران",
        9 => "چهارمحال و بختیاری",
        10 => "خراسان جنوبی",
        11 => "خراسان رضوی",
        12 => "خراسان شمالی",
        13 => "خوزستان",
        14 => "زنجان",
        15 => "سمنان",
        16 => "سیستان و بلوچستان",
        17 => "فارس",
        18 => "قزوین",
        19 => "قم",
        20 => "کردستان",
        21 => "کرمان",
        22 => "کرمانشاه",
        23 => "کهگیلویه و بویراحمد",
        24 => "گلستان",
        25 => "گیلان",
        26 => "لرستان",
        27 => "مازندران",
        28 => "مرکزی",
        29 => "هرمزگان",
        30 => "همدان",
        31 => "یزد",

    ],
    "parent_Fileds_of_studys" => "رشته پرنت",
    "Fileds_of_studys_Lablel" => "رشته تحصیلی",
    "Fileds_of_studys" => [
        1 => "تجربی",
        2 => "انسانی",
        3 => "ریاضی فیزیک",
        4 => "فنی حرفه ای",
        "هنر"
    ],
    "speciallity_Label" => "وضعیت سهمیه",
    "speciallity" => [
        0 => "ندارم",
        1 => "دارم"
    ],

    "speciallityAmout_Label" => "میزان سهمیه",
    "speciallityAmout" => [
        5 => "5%",
        25 => "25%"
    ],

    "users" => " لیست کاربران ",
    "fieldsOfStudies" => " لیست رشته های تحصیلی",
    "show" => "مشاهده",
    "CreateFieldsOfStudies" => "ایجاد رشته",
    "Fileds_of_studys_name" => "نام رشته",
    "back" => "بازگشت",
    "save" => "ذخیره",
    "rate" => "رتبه",
    "rates" => [
        1 => "1",
        2 => "2",
        3 => "3",
        4 => "4"
    ],

    'name'=>'نام' ,
    'family'=>'نام خانوادگی',
    'secondName'=> 'نام دوم' ,
    'secondFamily'=>'نام خانوادگی دوم',
    "shamsi"=>'تاریخ شمسی',
    'miladi'=>'تاریخ میلادی',
    "shamsi2"=>'تاریخ شمسی دوم',
    'miladi2'=>'تاریخ میلادی دوم',
    
    
    
    'names' => 'لیست اسم ها',
    'persian_name_label' => 'اسم فارسی',
    'english_name_label' => 'اسم انگلیسی',
    "EditName" => 'ویرایش اسم',
    "nameType" => [
        "name" => "نام",
        "family" => "نام خانوادگی",
    ],

    "personalNumberFromChars" => [

        'B' => 2,
        'b' => 2,
        'C' => 3,
        'c' => 3,
        'D' => 4,
        'd' => 4,
        'F' => 6,
        'f' => 6,
        'G' => 7,
        'g' => 7,
        'H' => 8,
        'h' => 8,
        'J' => 1,
        'j' => 1,
        'K' => 2,
        'k' => 2,
        'L' => 3,
        'l' => 3,
        'M' => 4,
        'm' => 4,
        'N' => 5,
        'n' => 5,
        'P' => 7,
        'p' => 7,
        'Q' => 8,
        'q' => 8,
        'R' => 9,
        'r' => 9,
        'S' => 1,
        's' => 1,
        'T' => 2,
        't' => 2,
        'V' => 4,
        'v' => 4,
        'W' => 5,
        'w' => 5,
        'X' => 6,
        'x' => 6,
        'Y' => 7,
        'y' => 7,
        'Z' => 8,
        'z' => 8,

    ]
    ,

    "soulNumberFromChars" => [
        'A' => 1,
        'a' => 1,
        'E' => 5,
        'e' => 5,
        'I' => 9,
        'i' => 9,
        'O' => 6,
        'o' => 6,
        'U' => 3,
        'u' => 3,
        'Y' => 7,
        'y' => 7,

    ],


    'searchEngin1' => [
        "birthday" => [
            '1' => '1.pdf',
            '2' => '2.pdf',
            '3' => '3.pdf',
            '4' => '4.pdf',
            '5' => '5.pdf',
            '6' => '6.pdf',
            '7' => '7.pdf',
            '8' => '8.pdf',
            '9' => '9.pdf',
            '10' => '10.pdf',
            '11' => '11.pdf',
            '12' => '12.pdf',
            '13' => '13.pdf',
            '14' => '14.pdf',
            '15' => '15.pdf',
            '16' => '16.pdf',
            '17' => '17.pdf',
            '18' => '18.pdf',
            '19' => '19.pdf',
            '20' => '20.pdf',
            '21' => '21.pdf',
            '22' => '22.pdf',
            '23' => '23.pdf',
            '24' => '24.pdf',
            '25' => '25.pdf',
            '26' => '26.pdf',
            '27' => '27.pdf',
            '28' => '28.pdf',
            '29' => '29.pdf',
            '30' => '30.pdf',
            '31' => '31.pdf',
        ],

        'monthShamsi' => [
            '1' => '1.pdf',
            '2' => '2.pdf',
            '3' => '3.pdf',
            '4' => '4.pdf',
            '5' => '5.pdf',
            '6' => '6.pdf',
            '7' => '7.pdf',
            '8' => '8.pdf',
            '9' => '9.pdf',
            '10' => '10.pdf',
            '11' => '11.pdf',
            '12' => '12.pdf'

        ],
        'YearShamsi' => [
            '1' => '1.pdf',
            '2' => '2.pdf',
            '3' => '3.pdf',
            '4' => '4.pdf',
            '5' => '5.pdf',
            '6' => '6.pdf',
            '7' => '7.pdf',
            '8' => '8.pdf',
            '9' => '9.pdf',
            '10' => '10.pdf',
            '11' => '11.pdf',
            '12' => '12.pdf'
        ],
        "lifeWay" => [
            '1' => '1.pdf',
            '2' => '2.pdf',
            '3' => '3.pdf',
            '4' => '4.pdf',
            '5' => '5.pdf',
            '6' => '6.pdf',
            '7' => '7.pdf',
            '8' => '8.pdf',
            '9' => '9.pdf',
            '11' => '11.pdf',
            '22' => '22.pdf',
            '33' => '33.pdf',
        ],

        "ProbablyHealthProblems" => [
            '1' => '1.pdf',
            '2' => '2.pdf',
            '3' => '3.pdf',
            '4' => '4.pdf',
            '5' => '5.pdf',
            '6' => '6.pdf',
            '7' => '7.pdf',
            '8' => '8.pdf',
            '9' => '9.pdf',

        ],
        'yourNumber' => [
            '1' => '1.pdf',
            '2' => '2.pdf',
            '3' => '3.pdf',
            '4' => '4.pdf',
            '5' => '5.pdf',
            '6' => '6.pdf',
            '7' => '7.pdf',
            '8' => '8.pdf',
            '9' => '9.pdf',

        ],
        'yourPopularPeoples' => [
            '1' => '1.pdf',
            '2' => '2.pdf',
            '3' => '3.pdf',
            '4' => '4.pdf',
            '5' => '5.pdf',
            '6' => '6.pdf',
            '7' => '7.pdf',
            '8' => '8.pdf',
            '9' => '9.pdf',

        ],
        'positiveAndNegativeFromYourBithday' => [
            '1' => '1.pdf',
            '2' => '2.pdf',
            '3' => '3.pdf',
            '4' => '4.pdf',
            '5' => '5.pdf',
            '6' => '6.pdf',
            '7' => '7.pdf',
            '8' => '8.pdf',
            '9' => '9.pdf',

        ],
        "otherJobsForYou" => [
            '1' => '1.pdf',
            '2' => '2.pdf',
            '3' => '3.pdf',
            '4' => '4.pdf',
            '5' => '5.pdf',
            '6' => '6.pdf',
            '7' => '7.pdf',
            '8' => '8.pdf',
            '9' => '9.pdf',

        ],
        "attitudeStatusFromDayAndMonth" => [
            '1' => '1.pdf',
            '2' => '2.pdf',
            '3' => '3.pdf',
            '4' => '4.pdf',
            '5' => '5.pdf',
            '6' => '6.pdf',
            '7' => '7.pdf',
            '8' => '8.pdf',
            '9' => '9.pdf',
        ],
        'RotationYear' => [
            '1' => '1.pdf',
            '2' => '2.pdf',
            '3' => '3.pdf',
            '4' => '4.pdf',
            '5' => '5.pdf',
            '6' => '6.pdf',
            '7' => '7.pdf',
            '8' => '8.pdf',
            '9' => '9.pdf',
        ],
        'RotationMonth' =>
        [
            '1' => '1.pdf',
            '2' => '2.pdf',
            '3' => '3.pdf',
            '4' => '4.pdf',
            '5' => '5.pdf',
            '6' => '6.pdf',
            '7' => '7.pdf',
            '8' => '8.pdf',
            '9' => '9.pdf',
        ],
        'RotationDay' => [
            '1' => '1.pdf',
            '2' => '2.pdf',
            '3' => '3.pdf',
            '4' => '4.pdf',
            '5' => '5.pdf',
            '6' => '6.pdf',
            '7' => '7.pdf',
            '8' => '8.pdf',
            '9' => '9.pdf',
        ],
        "DayNumberFromBirthday" => [
            '1' => '1.pdf',
            '2' => '2.pdf',
            '3' => '3.pdf',
            '4' => '4.pdf',
            '5' => '5.pdf',
            '6' => '6.pdf',
            '7' => '7.pdf',
            '8' => '8.pdf',
            '9' => '9.pdf',
            '11' => '11.pdf',
            '22' => '22.pdf',
            '29' => '11.pdf'
        ],

        "DebtStatusFromDayOfBirthday" => [
            '4' => '4.pdf',
            '5' => '5.pdf',
            '7' => '7.pdf',
            '1' => '1.pdf' , 
        ],

    ],


    'searchEngin2' => [

        "personalEnergy" => [
            0 => '0.pdf',
            2 => '2.pdf',
            3 => '3.pdf',
            4 => '4.pdf',
            5 => '5.pdf',
            6 => '6.pdf',
            7 => '7.pdf',
            8 => '8.pdf',
         
        ],
        "soulNumnber" => [
            0 => '0.pdf',

            1 => '1.pdf',
            2 => '2.pdf',
            3 => '3.pdf',
            4 => '4.pdf',
            5 => '5.pdf',
            6 => '6.pdf',
            7 => '7.pdf',
            8 => '8.pdf',
            
        ],
        "personalNumber" => [
            0 => '0.pdf',
            2 => '2.pdf',
            3 => '3.pdf',
            4 => '4.pdf',
            5 => '5.pdf',
            6 => '6.pdf',
            7 => '7.pdf',
            8 => '8.pdf',
        ],

    ],

    'searchEngin3' => [
        'SazOKar' => [
            '0' => '0.pdf',
            '1' => '1.pdf',
            '2' => '2.pdf',
            '3' => '3.pdf',
            '4' => '4.pdf',
            '5' => '5.pdf',
            '6' => '6.pdf',
            '7' => '7.pdf',
            '8' => '8.pdf',

        ]
    ],

    'searchEngin4' => [
        "StressSum" => [
            '0' => '0.pdf',
            '1' => '1.pdf',
            '2' => '2.pdf',
            '3' => '3.pdf',
            '4' => '4.pdf',
            '5' => '5.pdf',
            '6' => '6.pdf',
            '7' => '7.pdf',
            '8' => '8.pdf',

        ]
    ],


    "persianNames" => [
        'birthday' => 'فصل1-روز تولد_',
        "monthShamsi" => 'فصل2-ماه شمسی(راهنمای انتخاب شغل)',
        "YearShamsi" => 'فصل3-سال شمسی (زودیاک چینی و علاقمندی ها) ',
        "lifeWay" => 'فصل4-مسیر سرنوشت',
        "ProbablyHealthProblems" => 'فصل 5 -مشکلات احتمالی سلامتی',
        "yourNumber" => 'فصل6-مفهوم و نشانه عددی',
        "yourPopularPerson" => 'فصل7-افراد مشهور هم ارتعاش',
        "positiveAndNegativeFromYourDate" => 'فصل8-تاثیرات مثبت و منفی ارتعاش عدد های تاریخ تولد',
        "yourBestJobs" => 'فصل9-دیگر شغل ها و حرفه های متاسب',
        "attitudeStatusFromDayAndMonth" => 'فصل13-نگرش',
        "RotationYear" => 'فصل14-چرخش سال(تجربیات و چالش های 9 ساله)',
        "RotationMonth" => 'فصل15-چرخش ماه(وظایف و درس های ماه شخصی)',
        "RotationDay" => 'فصل16-چرخش روز(راهنمای انتخاب تاریخ خاص)',
        "DayNumberFromBirthday" => 'روز تولد',
        "DebtStatusFromDayOfBirthday" => 'بدهی کارمایی',
        "personalEnergy"=>"فصل10-پتانسیل و استعداد طبیغی",
        "soulNumnber" => 'فصل11-عدد روحی(رویا ها ،ارزو ها و خواسته های درونی)',
        "personalNumber" => 'فصل12- شخصیت حقیقی',
        "SazOKar" => 'فصل18-سازگاری دو نفره',
        "StressSum" => 'فصل19-سازگاری کاری ،اجتماعی و روابط دوستانه(عدد استرس)',


    ],

    "numberToEnglish" => [

        "1" => "ONE",
        "2" => "TWO",
        "3" => "THREE",
        "4" => "FOUR",
    ]


];