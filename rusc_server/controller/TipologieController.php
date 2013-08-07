<?php

require_once("ConfigManager.php");

class TipologieController {

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
					rusc_tipologia.id as id_tipologia,
					rusc_tipologia.codice as codice_tipologia,
					rusc_tipologia.descrizione as descrizione_tipologia 
				from 
					rusc_tipologia
				order by rusc_tipologia.codice";

			$result = $conn->prepare($cmd);
			$result->execute();
			$return_arr = array();
			$row_array = array();

			while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
				$row_array['idTipologia'] = utf8_encode($row['id_tipologia']);
				$row_array['codiceTipologia'] = utf8_encode($row['codice_tipologia']);
				$row_array['descrizioneTipologia'] = utf8_encode($row['descrizione_tipologia']);
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