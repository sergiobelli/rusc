<?php

require_once("ConfigManager.php");

class LoginController {
	
    function login ($username, $password) {		
		
		$ConfigManager = new ConfigManager();
		$dbhost = $ConfigManager->getHost ();
		$dbuser = $ConfigManager->getUser ();
		$dbname = $ConfigManager->getDatabase ();
		$dbpass = $ConfigManager->getPassword ();
		
		$conn = null;
		try {
			
			$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
				
			$cmd = "
				SELECT 	
					id as id_operatore,
					username as username_operatore,
					password as password_operatore,
					descrizione as descrizione_operatore
				FROM 	operatori 
				WHERE 	username = :username
						AND password = :password";
			
			$result = $conn->prepare($cmd);
			$result->bindValue(":username", $username);
			$result->bindValue(":password", $password);
			$result->execute();
			
			$return_arr = array();
			$row_array = array();	
			
			while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
				$row_array['idOperatore'] = utf8_encode($row['id_operatore']);
				$row_array['usernameOperatore'] = utf8_encode($row['username_operatore']);
				$row_array['descrizioneOperatore'] = utf8_encode($row['descrizione_operatore']);
				array_push($return_arr,$row_array);
			}
			
			$conn = NULL;
			
			return json_encode($return_arr);
			
		} catch(PDOException $e) {
			return json_encode($e->getMessage());
		}
		
    }
	
}
