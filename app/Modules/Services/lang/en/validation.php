<?php

return [
    'name' => [
        'required' => 'Name is required',
        'string' => 'Name must be string',
        'unique' => 'Name must be unique',
    ],
    'customer_id' => [
        'required' => 'Customer Id is required',
        'integer' => 'Customer Id must be string',
        'exists' => 'Customer Id must be exist in customers',
    ]
];
