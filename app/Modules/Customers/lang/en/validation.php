<?php

return [
    'first_name' => [
        'required' => 'First name is required',
        'string' => 'First name must be string',
    ],
    'last_name' => [
        'required' => 'Last name is required',
        'string' => 'Last name must be string',
    ],
    'email' => [
        'required' => 'Email is required',
        'email' => 'Email must be valid email',
        'unique' => 'Email must be unique',
    ]
];
