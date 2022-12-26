<?php
	require_once("./templates/header.php");
	require_once("./models/Company.php");
	require_once("./models/Database.php");
	require_once("./models/Review.php");
	
	class CompanyDAO implements CompanyDAOInterface {
		private $message;
		private $database;
		
		public function __construct() {
			$this -> message = new Message();
			$this -> database = new Database();
		}

		public function buildCompany($data) {
			$company = new Company();
			
			$company -> id = $data["com_id"];
			$company -> name = $data["com_name"];
			$company -> description = $data["com_description"];
			$company -> picture = $data["com_picture"];
			$company -> user_id = $data["use_id"];
            
			return $company;
		}

		public function create(Company $company) {
			$this -> database -> openConnection();
			$stmt = $this -> database -> conn -> prepare("insert into companies (com_name, use_id) values (:com_name, :use_id)");
			$stmt -> bindParam(":com_name", $company -> name);
			$stmt -> bindParam(":use_id", $company -> user_id);
			$stmt -> execute();
			
			$this -> database -> closeConnection();
			$this -> message -> setMessage(true, "return", "A empresa foi adicionada com sucesso!");
		}

		public function update(Company $company) {
			$this -> database -> openConnection();
			$stmt = $this -> database -> conn -> prepare("update companies set
				com_name = :com_name,
				com_description = :com_description,
				com_picture = :com_picture
				where com_id = :com_id
			");
			
			$stmt -> bindParam(":com_name", $company -> name);
			$stmt -> bindParam(":com_description", $company -> description);
			$stmt -> bindParam(":com_picture", $company -> picture);
			$stmt -> bindParam(":com_id", $company -> id);
			$stmt -> execute();
			
			$this -> database -> closeConnection();
			$this -> message -> setMessage(true, "my_companies.php", "A empresa foi atualizada com sucesso!");
		}

		public function delete($company_id) {
			$companyData = $this -> findById($company_id);
			$path = getcwd() . "/assets/companies/";
			$file = $companyData -> picture;
			if ($file) unlink($path . $file);

			$this -> database -> openConnection();
			$stmt = $this -> database -> conn -> prepare("delete from companies where com_id = :com_id");
			$stmt -> bindParam(":com_id", $company_id);
			$stmt -> execute();
			
			$this -> database -> closeConnection();
			$this -> message -> setMessage(true, "my_companies.php", "A empresa foi removida com sucesso!");
		}
        
		public function getCompaniesByUserId($user_id) {
			$companies = [];
			
			$this -> database -> openConnection();
			$stmt = $this -> database -> conn -> prepare("select com_id, com_name, com_description, com_picture, use_id from companies where use_id = :use_id");
			$stmt -> bindParam(":use_id", $user_id);
			$stmt -> execute();
			
			if ($stmt -> rowCount() > 0) {
				$companiesArray = $stmt -> fetchAll();
				
				foreach($companiesArray as $company) {
					$companies[] = $this -> buildCompany($company);
				}
			}

			return $companies;
		}

		public function findById($company_id) {
			$company = [];
			
			$this -> database -> openConnection();
			$stmt = $this -> database -> conn -> prepare("select com_id, com_name, com_description, com_picture, use_id from companies where com_id = :com_id");
			$stmt -> bindParam(":com_id", $company_id);
			$stmt -> execute();
			
			if ($stmt -> rowCount() > 0) {
				$companyData = $stmt -> fetch();
				$company = $this -> buildCompany($companyData);
				return $company;
			}
			
			return false;
		}
	}
?>