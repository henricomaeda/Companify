<?php
	require_once("./templates/header.php");
	require_once("./models/Company.php");
	require_once("./dao/CompanyDAO.php");
	
	$company = new Company();
    $companyDao = new CompanyDAO();
	$type = filter_input(INPUT_POST, "type");
	
	if ($type == "register") {
		$name = filter_input(INPUT_POST, "name");
        $user_id = $userData -> id;
		
		$valid_n = $name && !empty($name);
		$valid_u = $user_id && $user_id >= 0;
		
		if ($valid_n && $valid_u) {
            $company -> name = $name;
            $company -> user_id = $user_id;
            
            $companyDao -> create($company);
		}
		else $message -> setMessage(false, "return", "Preencha todos os campos corretamente.");
	}
	else if ($type == "update_picture") {
		$company_id = filter_input(INPUT_POST, "id");
		if (isset($company_id) && $company_id >= 0) {
			$companyData = $companyDao -> findById($company_id);
			if (isset($_FILES["picture"]) && !empty($_FILES["picture"]["tmp_name"])) {
				$image = $_FILES["picture"];
				$imageTypes = ["image/jpeg", "image/jpg", "image/png"];
				$jpgArray = ["image/jpeg", "image/jpg"];
	
				if (in_array($image["type"], $imageTypes)) {
					try {
						if (in_array($image["type"], $jpgArray)) $imageFile = imagecreatefromjpeg($image["tmp_name"]);
						else $imageFile = imagecreatefrompng($image["tmp_name"]);
						
						$path = getcwd() . "/assets/companies/";
						if (!is_dir($path)) mkdir($path);
						
						$imageName = $company -> generatePictureName();
						imagepng($imageFile, $path . $imageName);
	
						$file = $companyData -> picture;
						$companyData -> picture = $imageName;
	
						if ($file) unlink($path . $file);
					}
					catch (Throwable $e) {
						$error = "Arquivo corrompido.";
					}
				}
				else $error = "Arquivo de imagem não permitido.";
			}
			
			if (isset($error)) $message -> setMessage(false, "return", $error);
			else $companyDao -> update($companyData);
		}
		else $message -> setMessage(false, "return", "A empresa não foi encontrada.");
	}
	else if ($type == "update_data") {
		$name = filter_input(INPUT_POST, "name");
		$description = filter_input(INPUT_POST, "description");
        
		$valid_n = $name && !empty($name);
		$valid_d = $description && !empty($description) && strlen(trim($description)) > 0;

		if ($valid_n) {
			$company_id = filter_input(INPUT_POST, "id");
			$companyData = $companyDao -> findById($company_id);

			$companyData -> name = $name;
			if ($valid_d) $companyData -> description = $description;
			else $companyData -> description = null;
			
			$companyDao -> update($companyData);
		}
		else $message -> setMessage(false, "return", "Preencha todos os campos corretamente.");
	}
	else if ($type == "delete") {
		$company_id = filter_input(INPUT_POST, "id");
		if (isset($company_id) && $company_id >= 0) $companyDao -> delete($company_id);
		else $message -> setMessage(false, "return", "A empresa não foi encontrada.");
	}
	else $message -> setMessage(false, "my_companies.php", "Não foi possível realizar o processo.");
?>