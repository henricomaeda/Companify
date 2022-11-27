<?php
	require_once("./templates/header.php");
	// $message -> setMessage(true, "return", "Seja muito bem-vindo, usuário!");
?>
<div class="connection">
	<form>
		<span class="title"> Conectar </span>
		<input type="text" id="search" name="search" placeholder="Procurar comércios e produtos..." />
		<button type="submit"></button>
	</form>
	<form>
		<span class="title"> Cadastrar </span>
		<input type="text" id="search" name="search" placeholder="Procurar comércios e produtos..." />
		<button type="submit"></button>
	</form>
</div>
<?php require_once("./templates/footer.php") ?>