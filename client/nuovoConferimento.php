<?php
require_once('../lib/nusoap.php');

// Create the client instance
$client = new nusoap_client('http://localhost/services/nusoap/monnezza/server.php?wsdl', true); // false: no WSDL

// Call the SOAP method
$result = $client->call(
		'nuovoConferimento',
		array(
			'data' 		=> date("Y-m-d H:i:s")	, 
			'idTipologia' => '1'					, 
			'idOperatore' => '2'					)
	);
print_r($result) ;

?>