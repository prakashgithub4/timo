<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [ 
    'client_id' => 'Aee_zm6CyaLaqGjC76MPNgZvTz2GHW1t9XbMXtG_k2ZZyTvjKoLgTVj7EQ0ZAszKxRIgVMDEkZF9bStD',
	'secret' => 'EKkox2biAsny-dcPuF0N4OoZkyUPW7Ex9Tyg8pIaICz_e1SCq-20Z6eukzjLDjfjODPLeEzxXZwhM2J3',
    'settings' => array(
        'mode' => 'sandbox',
        'http.ConnectionTimeOut' => 1000,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'FINE'
    ),
];