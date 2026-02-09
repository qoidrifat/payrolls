<?php

return [
    'disk' => env('FILESYSTEM_DISK', 'public'),
    'visibility' => 'public', // or replace by filesystem disk visibility with fallback value
    'show_custom_fields' => true,
    'custom_fields' =>  [
        'github' => [
            'label' => 'Github Username',
            'type' => 'text',
            'placeholder' => '',
            'rules' => 'nullable|string|max:255',
            'required' => false,
        ],
        'instagram' => [
            'label' => 'Instagram Username',
            'type' => 'text',
            'placeholder' => '',
            'rules' => 'nullable|string|max:255',
            'required' => false,
        ],
        'linkedin' => [
            'label' => 'Linkedin Username',
            'type' => 'text',
            'placeholder' => '',
            'rules' => 'nullable|string|max:255',
            'required' => false,
        ]
    ]

];
