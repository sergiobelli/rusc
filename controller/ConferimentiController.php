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
					conferimenti_monnezza.id as id_conferimento,
					tipologia_monnezza.descrizione as descrizione_conferimento, 
					conferimenti_monnezza.data as data_conferimento,
					operatori.descrizione as descrizione_operatore
				from 
					conferimenti_monnezza, 
					tipologia_monnezza,
					operatori
				where 
					conferimenti_monnezza.tipologia = tipologia_monnezza.id
					and conferimenti_monnezza.operatore = operatori.id
					and operatori.id = ".$idOperatore;

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