<?php
	require_once("./templates/header.php");
	require_once("./models/User.php");
	
	$type = filter_input(INPUT_POST, "type");
	if ($type == "update_picture") {
		$user = new User();
		if (isset($_FILES["picture"]) && !empty($_FILES["picture"]["tmp_name"])) {
			$image = $_FILES["picture"];
			$imageTypes = ["image/jpeg", "image/jpg", "image/png"];
			$jpgArray = ["image/jpeg", "image/jpg"];

			if (in_array($image["type"], $imageTypes)) {
				try {
					if (in_array($image["type"], $jpgArray)) $imageFile = imagecreatefromjpeg($image["tmp_name"]);
					else $imageFile = imagecreatefrompng($image["tmp_name"]);
					
					$path = getcwd() . "/assets/users/";
					$imageName = $user -> generatePictureName();
					imagepng($imageFile, $path . $imageName);

					$file = $userData -> picture;
					$userData -> picture = $imageName;

					if ($file) unlink($path . $file);
				}
				catch (Throwable $e) {
					$error = "Arquivo corrompido.";
				}
			}
			else $error = "Arquivo de imagem não permitido.";
		}
		
		if ($error) $message -> setMessage(false, "return", $error);
		else $userDao -> update($userData);
	}
    else if ($type == "update_password") {
		$old_password = filter_input(INPUT_POST, "old_password");
		$new_password = filter_input(INPUT_POST, "new_password");
		$confirm_password = filter_input(INPUT_POST, "confirm_password");
		
		$valid_o = $old_password && !empty($old_password);
		$valid_n = $new_password && !empty($new_password);
		$valid_c = $confirm_password && !empty($confirm_password);

		if ($valid_o && $valid_n && $valid_c) {
			if ($new_password == $confirm_password) {
				if ($userDao -> changePassword($userData, $old_password, $new_password)) $message -> setMessage(true, "return", "A senha foi atualizada com sucesso!");
				else $message -> setMessage(false, "return", "Não foi possível atualizar a senha.");
			}
			else $message -> setMessage(false, "return", "As senhas devem se corresponder.");
		}
		else $message -> setMessage(false, "return", "Preencha todos os campos corretamente.");
        
	}
    else if ($type == "update_data") {
		$name = filter_input(INPUT_POST, "name");
		$lastname = filter_input(INPUT_POST, "lastname");
		$description = filter_input(INPUT_POST, "description");
		$no_lastname = filter_input(INPUT_POST, "checkbox");
        
		$valid_n = $name && !empty($name);
		$valid_l = $lastname && !empty($lastname);
		$valid_d = $description && !empty($description);

		if ($valid_n && ($valid_l || $no_lastname)) {
			if (!str_contains($name, ' ')) {
				if ($no_lastname || strlen(trim($lastname)) >= 2) {
					$userData = $userDao -> verifyToken();

					$userData -> name = $name;
					if ($no_lastname || !$valid_l) $userData -> lastname = null;
					else $userData -> lastname = $lastname;
					if ($valid_d) $userData -> description = $description;
					else $userData -> description = null;
					
					$userDao -> update($userData);
				}
				else $message -> setMessage(false, "return", "O sobrenome deve conter ao menos 2 letras.");
			}
			else $message -> setMessage(false, "return", "O primeiro nome não deve conter espaços.");
		}
		else $message -> setMessage(false, "return", "Preencha todos os campos corretamente.");
    }
	else $message -> setMessage(false, "editprofile.php", "Não foi possível atualizar as informações.");
?>