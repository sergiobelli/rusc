<?php

require_once("../controller/LoginController.php");

require_once("../controller/ConfigManager.php");

$ConfigManager = new ConfigManager();
$ambiente = $ConfigManager->getAmbiente();
$versione = $ConfigManager->getVersione();
$utenza   = 'n.d.';

	// inizializzazione della sessione
	//session_start();
	// se la sessione di autenticazione
	// è già impostata non sarà necessario effettuare il login
	// e il browser verrà reindirizzato alla pagina di scrittura dei post
	if (isset($_SESSION['login'])) {
		// reindirizzamento alla homepage in caso di login mancato
		header("Location: login.php");
	}
	
	$LoginController = new LoginController();	
	
	if (isset($_POST['username']) && isset($_POST['password'])) {
		
		//header("Location: login.php");
		
		$auth = $LoginController->login($_POST['username'],$_POST['password']);
		$var = json_decode($auth, true);
		
		$contatore = 0;
		foreach ($var as $key => $value) { 
			$contatore++;
		}
		
		if ($contatore > 0) {
			foreach ($var as $key => $value) { 
				echo "<h2>$key</h2>";
				foreach ($value as $k => $v) {
					echo "$k | $v <br />"; 
				}
			}
			
			echo "xxxxxx".var_dump($var[0]['idOperatore']); 
			echo "xxxxxx".var_dump($var[0]['usernameOperatore']);
			echo "xxxxxx".var_dump($var[0]['descrizioneOperatore']);
			
			session_start();
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['auth'] = $auth;
			$_SESSION['count'] = count($auth);
			$message = null;
						
			//header("Location: loginDone.php");
			
		} else {
		
			$message = 'Inserire utenza/password validi!';
			header("Location: login.php");
			
		}
		
	} else {
?>

<html>

	<head>
		<title>.: Rusc - Gestionale per la pattumiera condominiale :.</title>

		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

		<link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
		<link type="text/css" href="../css/redmond/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" />
		
		<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="../js/jquery-ui-1.8.20.custom.min.js"></script>
		
		<script type="text/javascript" src="../js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="../js/jquery.validationEngine-it.js"></script>
	
		<style>
			input.error {
				border-color: red;           
			}
			label.error {
				color: white;
				font-weight:bold;
			}
		</style>
		
		<script type="text/javascript">
			
			$(function(){
				$( "#salva" ).button();
			});

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
			
						//validazione form
            $(function(){
              
                $("#modulo_login").validate({
                    rules: {
                        username:{ minlength:2, required: true },
                        password:{ minlength:2, required: true }
                    },
                    messages:{                    	
                        username:{ 
                        	minlength:"Lo username deve essere lungo almeno 2 caratteri",
                        	required: "Lo username e' obbligatorio!" 
                        },
                        password:{ 
                        	minlength:"La password deve essere lunga almeno 2 caratteri",
                        	required: "La password e' obbligatoria!" 
                        }
                    },
                    
                    submitHandler: function(form) { 
                        form.submit();
                    },

                    invalidHandler: function() { 
                        $( "#dialogKo" ).dialog("open");
                    }	

                })
            })
			
			$(function(){
				$( "#dialogKo" ).html("I dati inseriti non sono corretti, ricontrollali...."),
				$( "#dialogKo" ).dialog( { 
					title:"Attenzione!", 
					autoOpen:false, 
					modal:true,
					buttons: {
						Ok: function() {
							$(this).dialog("close");
						}
					}
				});
			});
			
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

	<div id="dialogKo" align="center"></div>
	
	<form id="modulo_login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		
		<table border="0" cellpadding="3" cellspacing="1" class="FacetFormTABLE" align="center">
			<tr>
				<td class="FacetFormHeaderFont">Username</td>
				<td align="center"><input type="text" id="username" name="username" /></td>
			</tr>
			<tr>
				<td class="FacetFormHeaderFont">Password</td>
				<td align="center"><input type="password" id="password" name="password" /></td>
			</tr>
			<tr>
				<td align="center">&nbsp;</td>
				<td align="right"><input type="submit" id="salva" name="salva" value="login" class="FacetButton"/></td>
			</tr>
<?php 
			if (isset($message)) { 
				print "<tr>"; 
				print "<td colspan='2' class=\"FacetDataTDRed\" align=\"center\">".($message)."</td>"; 
				print "</tr>"; 
				$message = null;
			} 
?> 			
		</table>
	</form>
	</body>
</html>

<?php
	}
?>