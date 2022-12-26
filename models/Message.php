<?php
	class Message {
		public function setMessage($sucess, $redirect, $MSG) {
			if ($sucess) $_SESSION["MSG_STATUS"] = "sucess";
			else $_SESSION["MSG_STATUS"] = "error";
			
			if (empty($redirect) || $redirect == "index.php") $redirect = "./";
			$_SESSION["MSG"] = $MSG;

			if ($redirect == "return") {
				if (isset($_SERVER["HTTP_REFERER"])) header("Location: $_SERVER[HTTP_REFERER]");
				else header("Location: ./");
			}
			else header("Location: " . $redirect);
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