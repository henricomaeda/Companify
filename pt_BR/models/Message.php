<?php
	class Message {
		private $URL;
		public function __construct() {
			$this -> URL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]/../";
		}
		
		public function setMessage($sucess, $redirect, $MSG) {
			if ($sucess) $_SESSION["MSG_STATUS"] = "sucess";
			else $_SESSION["MSG_STATUS"] = "error";
			
			if (empty($redirect) || $redirect == "index.php") $redirect = "/../";
			$_SESSION["MSG"] = $MSG;

			if ($redirect == "return") {
				if (isset($_SERVER["HTTP_REFERER"])) header("Location: $_SERVER[HTTP_REFERER]");
				else header("Location: $this->URL" . "/../");
			}
			else header("Location: $this->URL" . $redirect);
		}
		
		public function getMessage() {
			if (!empty($_SESSION["MSG"])) return $_SESSION["MSG"];
			else return false;
		}
		
		public function clearMessage() {
			$_SESSION["MSG"] = "";
		}
	}
?>