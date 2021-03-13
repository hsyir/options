<?php
return [
    'optionsModel' => \Hsy\Options\Models\Option::class,
    'groups' =>
        [
            'group-one' => [
                'title' => 'title of group one',
                'fields' => [
                    [
                        'key' => 'field-one',
                        'title' => 'field title one',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field-two',
                        'title' => 'field-title-two',
                        'type' => 'text',
                        'description' => 'Some descriptions',
                    ],
                ]
            ],
            'group-two' => [
                'title' => 'title of group one',
                'fields' => [
                    [
                        'key' => 'field-one',
                        'title' => 'field title one',
                        'type' => 'text',
                    ],
                ]
            ],
        ]
];
