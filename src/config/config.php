<?php

return [
    'prefix'    => 'admin',
    'auth'      => [
        'table'                 => 'users',
        'login_field'           => 'email',
        'login_field_name'      => 'Email',
        'password_field'        => 'password',
        'password_field_name'   => 'Password'
    ],
    'config'    => [
        'table' => 'admin_configurations'
    ]
];