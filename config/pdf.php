<?php

return [
    'mode' => 'utf-8',
    'format' => 'A4',
    'author' => 'soheil-amini',
    'subject' => '',
    'keywords' => '',
    'creator' => 'soheil-amini',
    'display_mode' => 'fullpage',
    'tempDir' => base_path('../temp/'),
    'font_path' => base_path('public/main/fonts/ttf/'),
    'font_data' => [
        'IRANSansWeb_UltraLight' => [
            'R' => 'IRANSansWeb_Light.ttf',
            'B' => 'IRANSansWeb_Medium.ttf',
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
    ]
];