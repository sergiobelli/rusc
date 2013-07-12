<?php
require_once('../lib/nusoap.php');

// Create the client instance
$client = new nusoap_client('http://localhost/services/nusoap/monnezza/server.php?wsdl', true); // false: no WSDL

// Call the SOAP method
$result = $client->call('login',array('username' => 'test', 'password' => 'testxx'));
print_r($result) ;

?>