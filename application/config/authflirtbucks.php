<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
    'hash_method' => 'ripemd160',
    'salt_pattern' => array(1, 4, 5, 8, 15, 20, 27, 29, 31, 37),
    'lifetime' => 1209600,
    'session_key' => 'auth_flirtbucks'
);