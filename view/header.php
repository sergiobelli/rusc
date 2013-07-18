<?php

// inizializzazione della sessione
session_start();

require_once("../controller/ConfigManager.php");

$ConfigManager = new ConfigManager();
$ambiente = $ConfigManager->getAmbiente();
$versione = $ConfigManager->getVersione();
$utenza   = $_SESSION['username'];
	
?>

	<title>.: Rusc - Gestionale per la pattumiera condominiale :.</title>

	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

	<link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
	<link type="text/css" href="../css/redmond/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" />

	<style>
		input.error {
			border-color: red;           
		}
		label.error {
			color: white;
			font-weight:bold;
		}
	</style>

	<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="../js/jquery-ui-1.8.20.custom.min.js"></script>
	<script type="text/javascript" src="../js/jquery-ui-i18n.js"></script>
    <script type="text/javascript" src="../js/jquery.form.js"></script>
    <script type="text/javascript" src="../js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="../js/jquery.validationEngine-it.js"></script>
	<script type="text/javascript">
            $(function(){
                var browser
                if ($.browser.msie) {
                    browser = "Internet Explorer";
                } else if ($.browser.mozilla) {
                    browser = "Mozilla";
                }else if ($.browser.webkit) {
                    browser = "SafariWE";
                }else if ($.browser.opera) {
                    browser = "Opera";
                } else {
                    browser = "sconosciuto"
                }
                var versione = $.browser.version

                $("#browser").append(browser + " versione: " + versione)
            })
        </script>
	
</head>

<body class="FacetPageBODY">

<div align="right" class="version">
	<table>
		<tr><td>versione</td><td>:</td><td><?php echo $versione; ?></td></tr>
		<tr><td>ambiente</td><td>:</td><td><?php echo $ambiente; ?></td></tr>
		<tr><td>utenza</td><td>:</td><td><?php echo $utenza; ?></td></tr>
		<tr><td>browser</td><td>:</td><td id="browser"></td></tr>
	</table>
</div>

<!--
<br/>
<div align="center"><b>Gestione Societ&agrave; - Atletica Valsesia</b></div>
<br/>

<div align="center">
	<a href="AtletaView.php">Atleti</a> 									| 
	<a href="ExAtletaView.php">Ex-Atleti</a> 								| 
	<a href="CertificatoMedicoView.php"> Certificati Medici </a>			| 
	<a href="GaraView.php"> Gare </a>										| 
	<a href="PresenzaView.php"> Presenze </a>								| 
	<a href="ClassificaView.php" target="new"> Classifica </a>		
	&nbsp;&nbsp;&nbsp;															
	<a href="AccessiView.php"> Accessi </a>									| 
	<a href="view/diagnostica.php" target="new"> Diagnostica </a>	
</div>
-->
<br /><br />