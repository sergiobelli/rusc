<?php
require_once('../lib/nusoap.php');

// Create the client instance
$client = new nusoap_client('http://localhost/services/nusoap/monnezza/server.php?wsdl', true); // false: no WSDL

// Call the SOAP method
$result = $client->call('elencoTipologie',array('param' => '1'));
print_r($result) ;

?>