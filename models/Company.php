<?php
	class Company {
		public $id;
		public $name;
		public $description;
		public $picture;
		public $user_id;
		
		public function generatePictureName() {
			return bin2hex(random_bytes(60)) . ".png";
		}
	}
	
	interface CompanyDAOInterface {
		public function buildCompany($data);
		public function create(Company $company);
		public function update(Company $company);
		public function delete($company_id);
		public function getCompaniesByUserId($user_id);
		public function findById($company_id);
	}
?>