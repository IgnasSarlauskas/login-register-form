<?php

require 'validators.php';

/**
 * Generates HTML attributes
 * @param array $attr
 * @return string
 */
function html_attr($attr) {
    $html_attr_array = [];
    foreach ($attr as $attribute_key => $attribute_value) {
        $html_attr_array[] = strtr('@key="@value"', [
            '@key' => $attribute_key,
            '@value' => $attribute_value
        ]);
    }

    return implode(' ', $html_attr_array);
}

/**
 * Generates safe input array using FILTER_SANITIZE_SPECIAL_CHARS and FILTER_SANITIZE_NUMBER_INT
 * @param array $form array
 * @return array
 */
function get_filtered_input($form) {
    $filter_parameters = [];
    foreach ($form['fields'] as $id => $value) {
        if (isset($value['filter'])) {
            $filter_parameters[$id] = $value['filter'];
        } else {
            $filter_parameters[$id] = FILTER_SANITIZE_SPECIAL_CHARS;
        }
    }
    return filter_input_array(INPUT_POST, $filter_parameters);
}

/**
 * function that validates form by checking if input field is empty then error occures above the empty input field 
 * @param $form
 * @return null 
 */
function validate_form($filtered_input, &$form) {
    $success = true;
    // All the iput info stays in the field after submitting
    foreach ($form['fields']   as $field_id => &$field) {
        $field_input = $filtered_input[$field_id];
        // makes input field to stay filled after refershing page
        $field['value'] = $field_input;
        // if validate array has functions then calling function to check if the field is empty
        foreach (($field['validate'] ?? []) as $validator) {
            $is_valid = $validator($filtered_input[$field_id], $field); // same as => validate_not_empty($field_input, $field);
            // $is_valid will be false, if validator returns false
            if (!$is_valid) {
                $success = false;
                break;
            }
        }
    }
    if (!$success) {
        foreach (($form['validate'] ?? []) as $validator) {
            $valid = $validator($filtered_input, $form);
            if (!$valid) {
                $success = false;
                break;
            }
        }
    }

    if ($success) {
        if (isset($form['callbacks']['success'])) {
            $form['callbacks']['success']($filtered_input, $form);
        }
    } else {
        if (isset($form['callbacks']['fail'])) {
            $form['callbacks']['fail']($filtered_input, $form);
        }
    }
    return $success;
}
