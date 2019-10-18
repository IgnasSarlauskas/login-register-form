<?php

function array_to_file($array, $file_name) {
    $json_string = json_encode($array);
    $success = file_put_contents($file_name, $json_string);
    if (!$success !== false) {
        return true;
    }
    return false;
}

function file_to_array($file_name) {
    if (file_exists($file_name)) {
        $json_string = file_get_contents($file_name);
        if ($json_string !== false) {
            return json_decode($json_string, true);
        }
    }
    return false;
}

