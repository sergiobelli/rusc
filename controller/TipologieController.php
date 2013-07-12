<?php

require_once("ConfigManager.php");

class TipologieController {

    function elenco () {
		
		$ConfigManager = new ConfigManager();
		$dbhost = $ConfigManager->getHost ();
		$dbuser = $ConfigManager->getUser ();
		$dbname = $ConfigManager->getDatabase ();
		$dbpass = $ConfigManager->getPassword ();

		/*$dbhost = "localhost";
		$dbuser = "root";
		$dbname = "monnezza";
		$dbpass = "";*/
		
		$conn = null;
		try {
			
			$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
			
			$cmd = "
				select 
					tipologia_monnezza.id as id_tipologia,
					tipologia_monnezza.codice as codice_tipologia,
					tipologia_monnezza.descrizione as descrizione_tipologia 
				from 
					tipologia_monnezza
				order by tipologia_monnezza.codice";

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