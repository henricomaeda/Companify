<?php
	class Database {
		private $servername;
		private $username;
		private $password;
		private $dbname;
		public $conn;
		
		public function __construct() {
			$this -> servername = "localhost";
			$this -> username = "root";
			$this -> password = "";
			$this -> dbname = "companify";
		}
		
		public function openConnection() {
			$this -> conn = new PDO("mysql:host=$this->servername; dbname=$this->dbname", $this -> username, $this -> password);
			$this -> conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		
		public function closeConnection() {
			$this -> conn = null;
		}
	}
?>