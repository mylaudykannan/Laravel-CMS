<?php
return [
    'section' => [
        'default' => [
            'content' => [
                'title' => 'Content',
                /* 'blade' => 'breadcrump', */
                // 'static' => true,
                'fields' => [
                    'content' => ['validation' => 'required', 'type' => 'editor']//,'allowed' => 'page'
                ]
            ],
            'image' => [
                'title' => 'Content image',
                // 'blade' => 'breadcrump',
                'static' => true, 'label' => 'Image Field',
                'fields' => [
                    'imagename' => ['validation' => 'required', 'type' => 'image', 'label' => 'Image Field']
                ]
            ],
            'input' => [
                'title' => 'Content input',
                // 'blade' => 'breadcrump',
                'static' => true, 'label' => 'Input Field',
                'fields' => [
                    'inputname' => ['validation' => 'required', 'type' => 'input', 'label' => 'Input Field']
                ]
            ],
        ],
    ]
];
?>