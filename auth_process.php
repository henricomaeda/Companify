<?php
	require_once("./templates/header.php");
	require_once("./models/User.php");
	
	$user = new User();
	$type = filter_input(INPUT_POST, "type");
	
	if ($type == "register") {
		$name = filter_input(INPUT_POST, "name");
		$lastname = filter_input(INPUT_POST, "lastname");
		$email = filter_input(INPUT_POST, "email");
		$password = filter_input(INPUT_POST, "password");
		$confirm_password = filter_input(INPUT_POST, "confirm_password");
		$no_lastname = filter_input(INPUT_POST, "checkbox");
		
		$valid_n = $name && !empty($name);
		$valid_l = $lastname && !empty($lastname);
		$valid_e = $email && !empty($email);
		$valid_p = $password && !empty($password);
		$valid_c = $confirm_password && !empty($confirm_password);
		
		if ($no_lastname) $valid_l = true;
		if ($valid_n && $valid_l && $valid_e && $valid_p && $valid_c) {
			if ($password == $confirm_password) {
				if (!function_exists("str_contains") || !str_contains($name, ' ')) {
					if ($no_lastname || strlen(trim($lastname)) >= 2) {
						if (!$userDao -> findByEmail($email)) {
							$token = $user -> generateToken();
							$password = $user -> generatePassword($password);
							
							$user -> name = $name;
							if (!$no_lastname) $user -> lastname = $lastname;
							$user -> email = $email;
							$user -> password = $password;
							$user -> token = $token;
							$auth = true;
							
							$userDao -> create($user, $auth);
						}
						else $message -> setMessage(false, "return", "O e-mail inserido já está sendo utilizado.");
					}
					else $message -> setMessage(false, "return", "O sobrenome deve conter ao menos 2 letras.");
				}
				else $message -> setMessage(false, "return", "O primeiro nome não deve conter espaços.");
			}
			else $message -> setMessage(false, "return", "As senhas devem se corresponder.");
		}
		else $message -> setMessage(false, "return", "Preencha todos os campos corretamente.");
	}
	else if ($type == "login") {
		$email = filter_input(INPUT_POST, "email");
		$password = filter_input(INPUT_POST, "password");
		
		$valid_e = $email && !empty($email);
		$valid_p = $password && !empty($password);
		
		if ($valid_e && $valid_p) {
			$userName = $userDao -> authenticateUser($email, $password);
			if ($userName) $message -> setMessage(true, "edit_profile.php", "Seja muito bem-vindo, " . $userName .'!');
			else $message -> setMessage(false, "return", "Usuário e/ou senha incorretos.");
		}
		else $message -> setMessage(false, "return", "Preencha todos os campos corretamente.");
	}
	else $message -> setMessage(false, "auth.php", "Não foi possível realizar a autenticação.");
?>