<?php
$data = [
    // 'bindedAttributes' => ['title', 'address', 'phone', 'email'],

    'title' => 'Omri',
    'name' => 'Site Name',
    'address' => '22 saadya gaon st.',

    'appearance' => [
        'font' => '',
        'bg_color' => '',
    ],

    'testimonials' => [
        [
            'name' => 'Name #1',
            'image' => '',
            'review' => 'Review #1',
        ],

        [
            'name' => 'Name #2',
            'image' => '',
            'review' => 'Review #2',
        ],

        [
            'name' => 'Name #3',
            'image' => '',
            'review' => 'Review #3',
        ],
    ]
];

echo json_encode($data);
die;
?>