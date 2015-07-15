<?php defined('SYSPATH') or die('No direct script access.');

return array(
    'picture' => array(
        'upload::valid'    => 'Problem with file selected, please try again.',
        'upload::not_empty'    => 'Please select a file to upload.',
        'upload::type'    => 'Only png, jpg, and gif files may be uploaded.',
        'upload::size'       => 'File size too big, max size is 10MB.',
    ),
    'confirm' => array(
        'not_empty'    => 'You must agree to the statement above to upload a photo.',
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