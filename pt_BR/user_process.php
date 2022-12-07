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
					
					$imageName = $user -> generatePictureName();
					imagepng($imageFile, "../assets/users/" . $imageName);

					$file = $userData -> picture;
					$userData -> picture = $imageName;

					if ($file) {
						$path = getcwd() . "/../assets/users/" . $file;
						unlink($path);
					}
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
        
	}
    else if ($type == "update_data") {
        
    }
    else $message -> setMessage(false, "editprofile.php", "Não foi possível atualizar as informações.");
?>