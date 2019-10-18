<?php

require 'functions/form/core.php';
require 'functions/file.php';

$form = [
    'attr' => [
        'action' => 'index.php',
    ],
    'fields' => [
        'full_name' => [
            'type' => 'text',
            'extra' => [
                'attr' => [
                    'placeholder' => 'Full Name',
                    'class' => 'full-name',
                ]
            ],
            'validate' => [
                'validate_not_empty',
            ]
        ],
        'email' => [
            'type' => 'text',
            'extra' => [
                'attr' => [
                    'placeholder' => 'Email',
                    'class'=> 'email',
                ],
            ],
            'validate' => [
                'validate_not_empty',
                'validate_email',
//                'validate_email_unique',
            ]
        ],
        'password' => [
            'type' => 'password',
            'extra' => [
                'attr' => [
                    'placeholder' => 'Password',
                    'class' => 'password',
                ]
            ],
            'validate' => [
                'validate_not_empty',
                'validate_password',
            ]
        ],
        'password_repeat' => [
            'type' => 'password',
            'extra' => [
                'attr' => [
                    'placeholder' => 'Repeat password',
                    'class' => 'password',
                ],
            ],
            'validate' => [
                'validate_not_empty',
            ]
        ]
    ],
    'buttons' => [
        'create' => [
            'type' => 'submit',
            'value' => 'Register',
            'class' => 'submit-button',
        ],
    ],
    'callbacks' => [
        'success' => 'form_success',
        'fail' => 'form_fail'
    ]
];

$filtered_input = get_filtered_input($form);


function form_success($filtered_input, $form) {
    print 'Successfully registered!';
    update_user($filtered_input);
}

function update_user($filtered_input) {    
    $array_users = file_to_array('./data/users.json');
    $filtered_input['full_name'];
    $filtered_input['email']; 
    $filtered_input['password'];
    $array_users[] = $filtered_input;
    array_to_file($array_users, './data/users.json');
}

if (!empty($filtered_input)) {
    validate_form($filtered_input, $form);
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registration</title>
        <link rel="stylesheet" href="includes/form-styles.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php require 'templates/form.tpl.php'; ?>
    </body>
</html>



