<?php

class ConfigManager {

	public $ambiente;
	
	public $versione;
	
	public 
		$Host_locale, 
		$Database_locale, 
		$User_locale, 
		$Password_locale, 
		$table_prefix_locale,
		$elementNamespace_locale,
		$gecredNamespace_locale;
		
	public 
		$Host, 
		$Database, 
		$User, 
		$Password, 
		$table_prefix,
		$elementNamespace,
		$gecredNamespace;
	
	public function __construct() {
	
		$this->ambiente				= "locale"; //"online";
		$this->versione				= "v_1_0_0_20130814";
		
		//Parametri di accesso: localhost
		$this->Host_locale     		= "localhost";
		$this->Database_locale 			= "gecred";
		$this->User_locale     		= "root";
		$this->Password_locale 		= "";
		$this->table_prefix_locale 		= "rusc";
		$this->elementNamespace_locale 	= "http://localhost/services/rusc/server";
		$this->gecredNamespace_locale 	= "http://localhost/services/gecred/server";
		
		//Parametri di accesso: sergiobelli.net
		$this->Host     				= "sql.sergiobelli.net";
		$this->Database 				= "sergiobe35619";
		$this->User     				= "sergiobe35619";
		$this->Password 				= "serg73625";
		$this->table_prefix 			= "rusc";
		$this->elementNamespace		 	= "http://www.sergiobelli.net/services/rusc/server";
		$this->gecredNamespace		 	= "http://www.sergiobelli.net/services/gecred/server";
	
	}
		
	function getHost () {
		if ($this->ambiente == "online") {
			return $this->Host;
		} else {
			return $this->Host_locale;
		}
	}

	function getDatabase () {
		if ($this->ambiente == "online") {
			return $this->Database;
		} else {
			return $this->Database_locale;
		}
	}
	
	function getUser () {
		if ($this->ambiente == "online") {
			return $this->User;
		} else {
			return $this->User_locale;
		}
	}
	
	function getPassword () {
		if ($this->ambiente == "online") {
			return $this->Password;
		} else {
			return $this->Password_locale;
		}
	}
	
	function getTablePrefix () {
		if ($this->ambiente == "online") {
			return $this->table_prefix;
		} else {
			return $this->table_prefix_locale;
		}
	}
	
	function getVersione () {
		return $this->versione;
	}
	
	function getAmbiente () {
		return $this->ambiente;
	}
	
	function getElementNamespace () {
		if ($this->ambiente == "online") {
			return $this->elementNamespace;
		} else {
			return $this->elementNamespace_locale;
		}
	}
	
	function getGecredNamespace () {
		if ($this->ambiente == "online") {
			return $this->gecredNamespace;
		} else {
			return $this->gecredNamespace_locale;
		}
	}
}