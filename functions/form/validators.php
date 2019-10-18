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

function validate_team($field_input, &$field) {
    $teams_array = file_to_array('data/teams.json');
    if (!empty($teams_array)) {
        foreach ($teams_array as $team) {
            if ($field_input === $team['team_name']) {
                $field['error'] = 'Toks komandos pavadinimas jau yra!';
                return false;
            }
        }
    }
    return true;
}

function validate_player($field_input, &$field) {
    $teams_array = file_to_array('data/teams.json');
    if (!empty($teams_array)) {
        foreach ($teams_array as $team) {
            foreach ($team['players'] as $player) {
                if ($field_input === $player['nickname']) {
                    $field['error'] = 'Toks zaidejas jau yra!';
                    return false;
                }
            }
        }
    }
    return true;
}

function validate_kick($field_input, &$field) {
    $teams = file_to_array('data/teams.json');
        foreach ($teams as &$team) {
            foreach ($team['players'] as &$player) {
                if ($player['nickname'] === $_SESSION['nickname']) {
                    return true;
                } else {
                    return false;
                }
            }
        }
}
