<?php
	// Criando a classe Mensagem.
	class Message {
		private $URL;
		
		// Definindo o construtor.
		public function __construct($URL) {
			$this -> URL = $URL;
		}
		
		// Definindo a mensagem e redirecionamento.
		public function setMessage($MSG, $redirect = "index.php") {
			$_SESSION["MSG"] = $MSG;
			if ($redirect != "return") header("Location: $this->URL" . "/../" . $redirect);
			else header("Location: $_SERVER[HTTP_REFERER]");
		}
		
		// Recebendo a mensagem.
		public function getMessage() {
			if (!empty($_SESSION["MSG"])) return $_SESSION["MSG"];
			else return false;
		}
		
		// Resetando a mensagem.
		public function clearMessage() {
			$_SESSION["MSG"] = "";
		}
	}
?>