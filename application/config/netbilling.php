<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
    'gateway_url'   => 'https://secure.netbilling.com:1402/gw/sas/direct3.1', // DEV URL: http://secure.netbilling.com:1401/gw/sas/direct3.1 Prod URL: https://secure.netbilling.com:1402/gw/sas/direct3.1
    'update_url'    => 'https://secure.netbilling.com/gw/native/mupdate1.1',
    'dri_url'       => 'https://secure.netbilling.com/gw/reports/transaction1.5',
    'account'       => array (
        'account_id'        => "111011436182",
        'site_tag'          => "SWURVE",
        'access_keyword'    => 'guCuxbUvJ5kIl80EFLBk',
        'dri_authorization' => 'SWURVE_GAGF34'
    )
);