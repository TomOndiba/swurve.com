<?php defined('SYSPATH') or die('No direct script access.');
/**
 * SwiftMailer transports
 *
 * @see http://swiftmailer.org/docs/transport-types
 *
 * Valid transports are: smtp, native, sendmail
 *
 * To use secure connections with SMTP, set "port" to 465 instead of 25.
 * To enable TLS, set "encryption" to "tls".
 * To enable SSL, set "encryption" to "ssl".
 *
 * Transport options:
 * @param   null  	native: no options
 * @param   string  sendmail: 
 * @param   array   smtp: hostname, username, password, port, encryption (optional)
 *
 */

return array
(
	'transport'	=> 'smtp',
	'options'	=> array
	(
        'hostname'    => 'smtp1217.socketlabs-od.com',
        'username'    => 'user1217',
        'password'    => '1R5w6apIbcm0',
		//'hostname'	=> 'solarisdev.com',
		//'username'	=> 'root',
		//'password'	=> 'SolarisDevQYKUw8',
		'port'		=> '25',
	),
);

