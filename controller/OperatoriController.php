<?php

require_once("ConfigManager.php");

class OperatoriController {

    function elenco () {
		
		$ConfigManager = new ConfigManager();
		$dbhost = $ConfigManager->getHost ();
		$dbuser = $ConfigManager->getUser ();
		$dbname = $ConfigManager->getDatabase ();
		$dbpass = $ConfigManager->getPassword ();
		
		$conn = null;
		try {
			
			$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
						
			$cmd = "
				select 
					operatori.id as id_operatore,
					operatori.descrizione as descrizione_operatore				
				from 
					operatori
				order by operatori.descrizione";

			$result = $conn->prepare($cmd);
			$result->execute();
			$return_arr = array();
			$row_array = array();

			while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
				$row_array['idOperatore'] = utf8_encode($row['id_operatore']);
				$row_array['descrizioneOperatore'] = utf8_encode($row['descrizione_operatore']);
				array_push($return_arr,$row_array);
			}
			
			$conn = NULL;
			
			return json_encode($return_arr);
			
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
		
	}
	
}
?>