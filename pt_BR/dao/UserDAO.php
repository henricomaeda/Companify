<?php
	require_once("./templates/header.php");
	require_once("./models/User.php");
	require_once("./../models/Database.php");
	
	class UserDAO implements UserDAOInterface {
		private $message;
		private $database;
		
		public function __construct() {
			$this -> message = new Message();
			$this -> database = new Database("commercify");
		}
		
		public function buildUser($data) {
			$user = new User();
			
			$user -> email = $data["use_email"];
			$user -> name = $data["use_name"];
			$user -> lastname = $data["use_lastname"];
			$user -> password = $data["use_password"];
			$user -> description = $data["use_description"];
			$user -> picture = $data["use_picture"];
			$user -> token = $data["use_token"];
			
			return $user;
		}
		
		public function setTokenToSession($token, $redirect = true) {
			$user = new User();
			$_SESSION["use_token"] = $token;
			$userData = $this -> findByToken($token);
			if ($redirect) $this -> message -> setMessage(true, "editprofile.php", "Seja muito bem-vindo, " . $user -> getFullName($userData) . '!');
		}
		
		public function destroyToken() {
			$_SESSION["use_token"] = "";
			$this -> message -> setMessage(true, "", "Você foi desconectado com sucesso!");
		}
		
		public function create(User $user, $authUser = false) {
			$this -> database -> openConnection();
			$stmt = $this -> database -> conn -> prepare("insert into users values (
				:use_email,
				:use_name,
				:use_lastname,
				:use_password,
				:use_description,
				:use_picture,
				:use_token
			)");
			
			$stmt -> bindParam(":use_email", $user -> email);
			$stmt -> bindParam(":use_name", $user -> name);
			$stmt -> bindParam(":use_lastname", $user -> lastname);
			$stmt -> bindParam(":use_password", $user -> password);
			$stmt -> bindParam(":use_description", $user -> description);
			$stmt -> bindParam(":use_picture", $user -> picture);
			$stmt -> bindParam(":use_token", $user -> token);
			$stmt -> execute();
			
			$this -> database -> closeConnection();
			if ($authUser) $this -> setTokenToSession($user -> token);
		}
		
		public function update(User $user, $redirect = true) {
			$this -> database -> openConnection();
			$stmt = $this -> database -> conn -> prepare("update users set
				use_name = :use_name,
				use_lastname = :use_lastname,
				use_password = :use_password,
				use_description = :use_description,
				use_picture = :use_picture,
				use_token = :use_token
				where use_email = :use_email
			");
			
			$stmt -> bindParam(":use_name", $user -> name);
			$stmt -> bindParam(":use_lastname", $user -> lastname);
			$stmt -> bindParam(":use_password", $user -> password);
			$stmt -> bindParam(":use_description", $user -> description);
			$stmt -> bindParam(":use_picture", $user -> picture);
			$stmt -> bindParam(":use_token", $user -> token);
			$stmt -> bindParam(":use_email", $user -> email);
			$stmt -> execute();

			$this -> database -> closeConnection();
			if ($redirect) $this -> message -> setMessage(true, "return", "Os dados foram atualizados com sucesso!");
		}
		
		public function findByEmail($email) {
			if ($email != "") {
				$this -> database -> openConnection();
				$stmt = $this -> database -> conn -> prepare("select use_email, use_name, use_lastname, use_password, use_description, use_picture, use_token from users where use_email = :use_email");
				$stmt -> bindParam(":use_email", $email);
				$stmt -> execute();
				
				$this -> database -> closeConnection();
				if ($stmt -> rowCount() > 0) {
					$data = $stmt -> fetch();
					$user = $this -> buildUser($data);
					
					return $user;
				}
			}
			
			return false;
		}
		
		public function findByToken($token) {
			if ($token != "") {
				$this -> database -> openConnection();
				$stmt = $this -> database -> conn -> prepare("select use_email, use_lastname, use_name, use_password, use_description, use_picture, use_token from users where use_token = :use_token");
				$stmt -> bindParam(":use_token", $token);
				$stmt -> execute();
				
				$this -> database -> closeConnection();
				if ($stmt -> rowCount() > 0) {
					$data = $stmt -> fetch();
					$user = $this -> buildUser($data);
					
					return $user;
				}
			}
			
			return false;
		}
		
		public function verifyToken($redirect = true) {
			if (!empty($_SESSION["use_token"])) {
				$token = $_SESSION["use_token"];
				$user = $this -> findByToken($token);
				
				if ($user) return $user;
			}
			else if ($redirect) $this -> message -> setMessage(false, "auth.php", "Faça a autenticação para acessar esta página!");
		}
		
		public function authenticateUser($email, $password) {
			$user = $this -> findByEmail($email);
			if ($user) {
				if (password_verify($password, $user -> password)) {
					$token = $user -> generateToken();
					$this -> setTokenToSession($token, false);
					$user -> token = $token;
					$this -> update($user, false);
					
					$fullName = $user -> name . ' ' . $user -> lastname;
					if (!$user -> lastname) $fullName = $user -> name;
					return $fullName;
				}
			}
			
			return false;
		}
		
		public function changePassword(User $user) {
			if (password_verify($password, $user -> password)) {
				$this -> database -> openConnection();
				$stmt = $this -> database -> conn -> prepare("update users set use_password = :use_password where use_email = :use_email");
				$stmt -> bindParam(":use_password", $user -> password);
				$stmt -> bindParam(":use_email", $user -> email);
				$stmt -> execute();
				
				$this -> database -> closeConnection();
				return true;
			}
			
			return false;
		}
	}
?>