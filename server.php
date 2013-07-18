<?php
require_once('lib/nusoap.php');

$server = new nusoap_server; // Create server instance

$server->configureWSDL('ruscws','http://localhost/services/rusc/server');

$server->register( 'elencoConferimenti',
	array("param"=>"xsd:string"), // inputs
	array("result"=>"xsd:string"), // outputs
	'http://localhost/services/rusc/server' // element namespace
);

$server->register( 'elencoOperatori',
	array("param"=>"xsd:string"), // inputs
	array("result"=>"xsd:string"), // outputs
	'http://localhost/services/rusc/server' // element namespace
);

$server->register( 'elencoTipologie',
	array("param"=>"xsd:string"), // inputs
	array("result"=>"xsd:string"), // outputs
	'http://localhost/services/rusc/server' // element namespace
);

$server->register( 'nuovoConferimento',
	array("data"=>"xsd: dateTime", "idTipologia"=>"xsd:string", "idOperatore"=>"xsd:string"), // inputs
	array("result"=>"xsd:string"), // outputs
	'http://localhost/services/rusc/server' // element namespace
);

$server->register( 'login',
	array("username"=>"xsd:string", "password"=>"xsd:string"), // inputs
	array("result"=>"xsd:string"), // outputs
	'http://localhost/services/rusc/server' // element namespace
);

function login($username, $password) {
	
	
	require_once("controller/LoginController.php");
	$LoginController = new LoginController();
	
	return $LoginController->login($username, $password);
	
}

function elencoTipologie($parameters) {
	
	require_once("controller/TipologieController.php");
	$TipologieController = new TipologieController();
	
	return $TipologieController->elenco();
	
}

function elencoOperatori($parameters) {
	
	require_once("controller/OperatoriController.php");
	$OperatoriController = new OperatoriController();
	
	return $OperatoriController->elenco($parameters[0]);

}

function elencoConferimenti($parameters) {
	
	require_once("controller/ConferimentiController.php");
	$ConferimentiController = new ConferimentiController();
	
	return $ConferimentiController->elenco($parameters[0]);

}

function nuovoConferimento($data, $idTipologia, $idOperatore) {
		
	$dbhost = "localhost";
	$dbuser = "root";
	$dbname = "rusc";
	$dbpass = "";
	
	$conn = null;
	try {
		
		$return_arr = array();
		$row_array = array();
		
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		
		$conn->beginTransaction();
		
		$sql = "
			insert into conferimenti (data, tipologia, operatore) 
			values (:data, :tipologia, :operatore)";
		
		$statement = $conn->prepare($sql);
		
		$statement->execute(
			array(
				':data'=>$data,
				':tipologia'=>$idTipologia,
				':operatore'=>$idOperatore
			)
		);
		
		$conn->commit();
		
		$conn = NULL;
				
	} catch(PDOException $e) {
		return json_encode($e->getMessage());
	}

}

// Use the request to (try to) invoke the service
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);

?>
