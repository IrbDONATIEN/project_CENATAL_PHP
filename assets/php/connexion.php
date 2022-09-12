<?php
	try{
		$db= new PDO('mysql:host=localhost;dbname=db_cenatal','root','');
	}
	catch(Exception $e ){
		die('votre connection a échouée');
	}
?>