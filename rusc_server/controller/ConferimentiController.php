<?php

require_once("ConfigManager.php");

class ConferimentiController {

    function elenco ($idOperatore) {
		
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
					rusc_conferimenti.id as id_conferimento,
					rusc_tipologia.descrizione as descrizione_conferimento, 
					rusc_conferimenti.data as data_conferimento,
					rusc_operatori.descrizione as descrizione_operatore
				from 
					rusc_conferimenti, 
					rusc_tipologia,
					rusc_operatori
				where 
					rusc_conferimenti.tipologia = rusc_tipologia.id
					and rusc_conferimenti.operatore = rusc_operatori.id
					and rusc_operatori.id = ".$idOperatore;

			$result = $conn->prepare($cmd);
			$result->execute();
			$return_arr = array();
			$row_array = array();

			while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
				$row_array['idConferimento'] = utf8_encode($row['id_conferimento']);
				$row_array['descrizioneConferimento'] = utf8_encode($row['descrizione_conferimento']);
				$row_array['dataConferimento'] = utf8_encode($row['data_conferimento']);
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