<?php
	require_once("./templates/header.php");
	// $message -> setMessage(true, "return", "Seja muito bem-vindo, usuário!");
?>
<div class="connection">
	<form method="POST" enctype="application/json" action="<?= $BASE_URL ?>/../my_account.php">
		<span class="title"> Conectar </span>
		<hr />
		<div>
			<input type="email" name="email" required />
			<label> E-mail </label>
		</div>
		<div>
			<input type="password" name="password" required />
			<label> Senha </label>
		</div>
		<input type="submit" id="submit" value="Conectar" />
		<hr />
		<a href="<?= $BASE_URL ?>/../forgot.php">
			<span> Esqueceu a senha? </span>
		</a>
	</form>
	<form>
		<span class="title"> Cadastrar </span>
		<hr />
		<div>
			<input type="text" name="name" required />
			<label> Nome completo </label>
		</div>
		<div>
			<input type="email" name="email" required />
			<label> E-mail </label>
		</div>
		<div>
			<input type="password" name="password" required />
			<label> Senha </label>
		</div>
		<div>
			<input type="password" name="confirm_password" required />
			<label> Confirmação da senha </label>
		</div>
		<input type="submit" id="submit" value="Cadastrar" />
	</form>
</div>
<?php require_once("./templates/footer.php") ?>