<?php

session_start();

require 'functions/form/core.php';
require 'functions/file.php';

$form = [
    'attr' => [
        'action' => 'login.php',
    ],
    'fields' => [
        'email' => [
            'type' => 'text',
            'extra' => [
                'attr' => [
                    'placeholder' => 'Email',
                    'class' => 'email',
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
            ]
        ],
    ],
    'buttons' => [
        'create' => [
            'type' => 'submit',
            'value' => 'Login',
            'class' => 'submit-button',
        ],
    ],
    'validators' => [
        'validate_login',
    ],
    'callbacks' => [
        'success' => 'form_success',
        'fail' => 'form_fail'
    ],
];

$filtered_input = get_filtered_input($form);

function form_fail($filtered_input, $form) {
    var_dump('Retard Alert!');
}

function form_success($filtered_input, $form) {
    $_SESSION['email'] = $filtered_input['email'];
    var_dump('success');
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
        <link rel="stylesheet" href="includes/navigation-styles.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php include './particles/navigation.php'; ?>
        <?php require 'templates/form.tpl.php'; ?>
    </body>
</html>
