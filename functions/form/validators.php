<?php

/**
 * if input field is empty, error occures above the empty input field 
 * @param $field_input, &$field
 * @return null | boolean
 */
function validate_not_empty($field_input, &$field) {
    if ($field_input === '') {
        $field['error'] = 'Paliktas tuscias laukelis';
        return false;
    } else {
        return true;
    }
}

function validate_is_number($field_input, &$field) {
    if (!is_numeric($field_input) && !empty($field_input)) {
        $field['error'] = 'Iveskite validu skaiciu';
        return false;
    } else {
        return true;
    }
}

function validate_is_positive($field_input, &$field) {
    if ($field_input <= 0) {
        $field['error'] = 'Iveskite teigiama skaiciu';
        return false;
    } else {
        return true;
    }
}

function validate_max_100($field_input, &$field) {
    if ($field_input >= 100) {
        $field['error'] = 'Ivestas per didelis skaicius';
        return false;
    } else {
        return true;
    }
}

function validate_email($field_input, &$field) {

    function valid_email($field_input) {
        return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $field_input)) ? FALSE : TRUE;
    }

    if (!valid_email($field_input)) {
        $field['error'] = 'Ivestas neteisingas el.pato adresas';
        return false;
    } else {
        return true;
    }
}

function validate_password($field_input, &$field) {
    if (strlen($field_input) < 8) {
        return false;
    } else {
        return true;
    }
}

function validate_fields_match($filtered_input, &$form, $params) {
    $reference_value = $filtered_input[$params[0]];
    foreach ($params as $param) {
        if ($filtered_input[$param] !== $reference_value) {
            $form['fields'][$param]['error'] = 'Password didnt match!';
            return false;
        }
    }
    return true;
}

function validate_login($filtered_input, &$form) {
    $array_users = file_to_array('./data/users.json');
    if (!empty($array_users)) {
        foreach ($array_users as $user) {
            if ($user['email'] !== $filtered_input['email'] || $user['password'] !== $filtered_input['password']) {
                $form['fields']['password']['error'] = 'Kazkas cia ne to!';
                return false;
            }
        }
    }
    return true;
}

function validate_email_unique($field_input, &$field) {
    $array_users = file_to_array('./data/users.json');
    if (!empty($array_users)) {
        foreach ($array_users as $user) {
            if ($user['email'] === $field_input) {
                $field['error'] = 'Toks email jau egzistuoja';
                return false;
            }
        }
    }
    return true;
}
