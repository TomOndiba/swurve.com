<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
    'hash_method' => 'ripemd160',
    'salt_pattern' => array(3, 6, 7, 10, 14, 19, 24, 29, 32, 38),
    'lifetime' => 1209600,
    'session_key' => 'auth_user'
);