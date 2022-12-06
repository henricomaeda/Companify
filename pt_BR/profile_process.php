<?php
	require_once("./templates/header.php");
	require_once("./models/User.php");

	$type = filter_input(INPUT_POST, "type");
	if ($type == "update_picture") {
        
	}
    else if ($type == "update_password") {
        
	}
    else if ($type == "update_data") {
        
    }
    else $message -> setMessage(false, "return", "Não foi possível atualizar as informações.");
?>