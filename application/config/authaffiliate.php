<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
    'hash_method' => 'ripemd160',
    'salt_pattern' => array(2, 5, 6, 9, 13, 18, 25, 28, 33, 39),
    'lifetime' => 1209600,
    'session_key' => 'auth_affiliate'
);