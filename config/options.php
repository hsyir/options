<?php
return [
    'optionsModel' => \Hsy\Options\Models\Option::class,
    'siteOptions' =>
        [
            'site-data' => [
                'title' => 'اطلاعات اصلی',
                'fields' => [
                    [
                        'key' => 'site-title',
                        'title' => 'عنوان سایت',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'site-short-description',
                        'title' => 'توضیح مختصر سایت',
                        'type' => 'text',
                        'description' => 'توضیح چند کلمه ای در مورد سایت',
                    ],
                    [
                        'key' => 'site-description',
                        'title' => 'توضیح در مورد سایت',
                        'type' => 'multiLine',
                        'description' => 'توضیح در مورد سایت(در حد 40 کلمه)',
                    ],
                ]
            ],
            'contacts-info' => [
                'title' => 'اطلاعات تماس',
                'fields' => [
                    [
                        'key' => 'site-email',
                        'title' => 'آدرس ایمیل ارتباطی',
                        'type' => 'text',
                        'description' => 'آدرس ایمیل قابل نمایش در سایت برای ارتباط بازدید کنندگان',
                    ],
                    [
                        'key' => 'site-tell',
                        'title' => 'شماره تلفن ارتباطی',
                        'type' => 'text',
                        'description' => 'شماره تلفن برای ارتباط با سایت',
                    ],
                    [
                        'key' => 'site-instagram',
                        'title' => 'آدرس اینستاگرام',
                        'type' => 'text',
                        'description' => 'آدرس صفحه اینستاگرام',
                    ],
                ]
            ]
        ]
];