<?php
	require_once("./templates/header.php");
	if (!empty($_SESSION["use_token"])) $message -> setMessage(true, "profile.php", "");
?>
<div class="connection">
	<form method="POST" action="<?= $BASE_URL ?>/../auth_process.php">
		<input type="hidden" name="type" value="login">
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
	<form method="POST" action="<?= $BASE_URL ?>/../auth_process.php">
		<input type="hidden" name="type" value="register">
		<span class="title"> Cadastrar </span>
		<hr />
		<div>
			<input type="text" name="name" minlength="2" maxlength="20" required />
			<label> Primeiro nome </label>
		</div>
		<div>
			<input type="text" id="lastname" name="lastname" minlength="2" maxlength="200" required />
			<label> Sobrenome </label>
		</div>
		<div>
			<input type="email" name="email" maxlength="200" required />
			<label> E-mail </label>
		</div>
		<div>
			<input type="password" name="password" maxlength="200" required />
			<label> Senha </label>
		</div>
		<div>
			<input type="password" name="confirm_password" maxlength="200" required />
			<label> Confirmação da senha </label>
		</div>
		<div class="lastname">
			<input type="checkbox" name="checkbox" id="checkbox" onclick="noLastname()" />
			<div class="checkmark">
				<span></span>
			</div>
			<div class="subject"> Não possuo sobrenome. </div>
		</div>
		<input type="submit" id="submit" value="Cadastrar" />
	</form>
</div>
<?php require_once("./templates/footer.php") ?>