<?php
require_once('lib/nusoap.php');

// Create the client instance
$client = new nusoap_client('http://localhost/services/rusc/server.php?wsdl', true); // false: no WSDL

// Call the SOAP method
$result = $client->call('elencoConferimenti',array('param' => '1'));
print_r($result) ;

?>