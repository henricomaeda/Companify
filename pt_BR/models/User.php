<?php
	class User {
		public $email;
		public $name;
		public $lastname;
		public $password;
		public $description;
		public $picture;
		public $token;
		
		public function getFullName($user) {
			return $user -> name . " " . $user -> lastname;
		}
		
		public function generatePassword($password) {
			return password_hash($password, PASSWORD_DEFAULT);
		}
		
		public function generatePictureName() {
			return bin2hex(random_bytes(60)) . ".png";
		}
		
		public function generateToken() {
			return bin2hex(random_bytes(60));
		}
	}
	
	interface UserDAOInterface {
		public function buildUser($data);
		public function setTokenToSession($token, $redirect = true);
		public function destroyToken();
		public function create(User $user, $authUser = false);
		public function update(User $user, $redirect = true);
		public function findByEmail($email);
		public function findByToken($token);
		public function verifyToken();
		public function authenticateUser($email, $password);
		public function changePassword(User $user);
	}
?>