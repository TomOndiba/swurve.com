<?php defined('SYSPATH') or die('No direct script access.');

return array(
    'username' => array(
        'alpha_dash'    => 'Only alphabetical, numeric, underscore and dash characters allowed.',
        'min_length'    => ':field must be between 3 and 25 characters',
        'max_length'    => ':field must be between 3 and 25 characters',
        'invalid'       => 'Invalid login',
        'not_unique'    => 'Username taken'
    ),
    'password_confirm' => array(
        'matches'    => ':field does not match',
    ),
    'email' => array(
        'email'    => 'Please enter a valid email.',
        'not_unique'    => 'Email address already in use'
    ),
    'birthdate' => array(
        'not_valid'    => 'Please enter a valid birthdate.',
        'not_of_age'    => 'You must be 18+ to join this site.',
        'not_of_age_edit'    => 'You must be 18+ to use this site.',
    ),
    'seeking' => array(
        'none_selected'    => 'Please select at least one.',
    ),
    'seeking[]' => array(
        'none_selected'    => 'Please select at least one.',
    ),
    'password' => array(
        'not_empty'    => 'Please select a :field.',
    ),
    'gender' => array(
        'not_empty'    => 'Please select a :field.',
    ),
    'orientation' => array(
        'not_empty'    => 'Please select a :field.',
    ),
    'country_id' => array(
        'not_empty'    => 'Please select a :field.',
    ),
    'city_id' => array(
        'not_empty'    => 'Please select a :field.',
    ),
    'interested_in' => array(
        'not_empty'    => 'Please select a :field.',
    ),
    'body_type' => array(
        'not_empty'    => 'Please select a :field.',
    ),
    'hair_color' => array(
        'not_empty'    => 'Please select a :field.',
    ),
    'eye_color' => array(
        'not_empty'    => 'Please select a :field.',
    ),
    'ethnicity' => array(
        'not_empty'    => 'Please select a :field.',
    ),
    'relationship_status' => array(
        'not_empty'    => 'Please select a :field.',
    ),
    'smoke' => array(
        'not_empty'    => 'Please select a :field.',
    ),
    'drink' => array(
        'not_empty'    => 'Please select a :field.',
    ),
    'first_date_sex' => array(
        'not_empty'    => 'Please select a :field.',
    ),
    'payment_method_account' => array(
        'not_empty'    => 'Please enter a :field.',
    ),
    'tou' => array(
        'not_empty'    => 'You must agree to the TOU to register.',
    ),
);
/*
return array(
    'not_empty'    => ':field must not be empty',
    'matches'      => ':field must be the same as :param1',
    'regex'        => ':field does not match the required format',
    'exact_length' => ':field must be exactly :param1 characters long',
    'min_length'   => ':field must be at least :param1 characters long',
    'max_length'   => ':field must be less than :param1 characters long',
    'in_array'     => ':field must be one of the available options',
    'digit'        => ':field must be a digit',
);
*/