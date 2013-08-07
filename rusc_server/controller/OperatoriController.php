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
					rusc_operatori.id as id_operatore,
					rusc_operatori.id_user as id_user,
					rusc_operatori.descrizione as descrizione_operatore				
				from 
					rusc_operatori
				order by rusc_operatori.descrizione";

			$result = $conn->prepare($cmd);
			$result->execute();
			$return_arr = array();
			$row_array = array();

			while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
				$row_array['idOperatore'] = utf8_encode($row['id_operatore']);
				$row_array['idUser'] = utf8_encode($row['id_user']);
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