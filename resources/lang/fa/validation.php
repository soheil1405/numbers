<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'مقدار :attribute باید قابل تایید باشد',
    'active_url'           => 'مقدار :attribute باید یک آدرس معتبر باشد',
    'after'                => 'مقدار :attribute باید پس از :date باشد',
    'after_or_equal'       => 'مقدار :attribute باید برابر یا بیشتر از :date باشد',
    'alpha'                => 'مقدار :attribute تنها باید حروف باشد',
    'alpha_dash'           => 'مقدار :attribute باید تنها حروف،اعداد و dash باشد',
    'alpha_num'            => 'مقدار :attribute باید تنها اعداد و حروف باشد',
    'array'                => 'مقدار :attribute باید آرایه باشد',
    'before'               => 'مقدار :attribute باید قبل از :date باشد',
    'before_or_equal'      => 'مقدار :attribute باید کمتر یا برابر :date باشد',
    'between'              => [
        'numeric' => 'مقدار :attribute باید بین :min و :max باشد',
        'file'    => 'مقدار :attribute باید بین :min kb و :max kb باشد',
        'string'  => 'مقدار :attribute باید از حرف :min بیشتر و  از حرف :max کمتر باشد',
        'array'   => 'مقدار :attribute باید بین :min و :max باشد',
    ],
    'boolean'              => 'مقدار :attribute تنها دوحالت true/false می تواند باشد',
    'confirmed'            => ':attribute همخوانی ندارد',
    'date'                 => ':attribute تاریخ معتبر نیست',
    'date_format'          => ':attribute الگوی :format ندارد',
    'different'            => 'مقدار :attribute و :other متفاوت باید باشد',
    'digits'               => 'مقدار :attribute باید ارقام :digits باشد',
    'digits_between'       => 'ارقام :attribute باید بین :min و :max باشد',
    'dimensions'           => ':attribute اندازه غیرمعتبر دارد',
    'distinct'             => ':attribute تکراری می باشد',
    'email'                => ':attribute نامعتبر است',
    'exists'               => ':attribute انتخاب شده نامعتبر است',
    'file'                 => ':attribute فایل باید باشد',
    'filled'               => ':attribute باید مقدار داشته باشد',
    'image'                => ':attribute باید تصویر باشد',
    'in'                   => ':attribute انتخاب شده نامعتبر است',
    'in_array'             => 'مقدار :attribute در :other موجود نیست',
    'integer'              => ':attribute باید عدد باشد',
    'ip'                   => ':attribute باید آدرس ip معتبر باشد',
    'ipv4'                 => ':attribute باید آدرس IPv4 معتبر باشد',
    'ipv6'                 => ':attribute باید آدرس IPv6 معتبر باشد',
    'json'                 => ':attribute باید متن JSON معتبر باشد',
    'max'                  => [
        'numeric' => ':attribute نباید بیشتر از :max باشد',
        'file'    => ':attribute نباید بیشتر از :max kb باشد',
        'string'  => ':attribute نباید بیشتر از :max حرف باشد',
        'array'   => 'در :attribute نباید بیشتر از :max مقدار باشد',
    ],
    'mimes'                => ':attribute باید نوع :type داشته باشد',
    'mimetypes'            => ':attribute باید نوع :type داشته باشد',
    'min'                  => [
        'numeric' => 'مقدار :attribute باید حداقل :min باشد',
        'file'    => ':attribute باید حداقل :min kb باشد',
        'string'  => ':attribute باید حداقل :min حرف باشد',
        'array'   => ':attribute باید حداقل :min مقدار داشته باشد',
    ],
    'not_in'               => 'مقدار انتخاب شده برای :attribute نامعتبر است',
    'not_regex'            => 'الگوی :attribute نامعتبر است',
    'numeric'              => ':attribute باید عدد باشد',
    'present'              => ':attribute باید مقدار داشته باشد',
    'regex'                => 'الگوی :attribute نامعتبر است',
    'required'             => ':attribute مورد نیاز است',
    'required_if'          => ':attribute وقتی که :other مقدار :value دارد ضروری است',
    'required_unless'      => ':attribute وقتی که :other :value نیست مورد نیاز است',
    'required_with'        => ':attribute وقتی که :other مقدار دارد مورد نیاز است',
    'required_with_all'    => ':attribute وقتی که :other مقدار دارد مورد نیاز است',
    'required_without'     => ':attribute وقتی که :other مقدار ندارد مورد نیاز است',
    'required_without_all' => ':attribute وقتی که هیچ کدام از :other مقدار ندارند مورد نیاز است',
    'same'                 => ':attribute و :other باید همخوانی داشته باشد',
    'size'                 => [
        'numeric' => 'اندازه :attribute باید :size باشد',
        'file'    => 'اندازه :attribute باید :size kb باشد',
        'string'  => 'اندازه :attribute باید :size حرف باشد',
        'array'   => 'اندازه :attribute باید :size مقدار باشد',
    ],
    'string'               => ':attribute باید متنی باشد',
    'timezone'             => ':attribute باید موقعیت زمانی معتبر باشد',
    'unique'               => ':attribute تکراری است',
    'uploaded'             => ':attribute در آپلود موفق نشد',
    'url'                  => ':attribute نامعتبر است',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        "order" => "ترتیب",
        'help' => 'کمک',
        'input_name' => 'نام ورودی',
        'user' => 'کاربر',
        'name' => 'نام',
        'email' => 'ایمیل',
        'password' => 'رمز',
        'component' => 'کامپوننت',
        'regex' => 'قانون اعتبار سنجی',
        'password_confirmation' => 'تکرار رمز',
        'title' => 'عنوان',
        'image' => 'تصویر شاخص',
        'parent' => 'والد',
        'value' => 'مقدار',
        'is_visible' => 'نمایش داده شود؟',
        'is_required' => 'واجب است؟',
        'is_active' => 'فعال؟',
        'is_admin' => 'مدیر کل؟',
        'phone' => 'موبایل',
        'auto_submit' => 'ثبت خودکار',
        'multiple' => 'چندتایی',
        'range' => 'بازه',
        'type' => 'نوع',
        'group' => 'گروه',

    ],

];
