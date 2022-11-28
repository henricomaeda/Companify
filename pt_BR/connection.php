<?php
	require_once("./templates/header.php");

	// if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"])) {
	// 	$name = $_POST["name"];
	// 	$email = $_POST["email"];
	// 	$password = $_POST["password"];
	// 	$sql = "insert into users (use_email, use_name, use_password) values ('$email', '$name', '$password')";

	// 	try {
	// 		require_once("../database.php");
	// 		$conn->query($sql);
	// 		$message -> setMessage(true, "profile.php", "Seja muito bem-vindo (a), $name.");
	// 	}
	// 	catch (exception $e) {
	// 		$message -> setMessage(false, "return", $e->getMessage());
	// 	}
	// 	finally {
	// 		$conn->close();
	// 	}
	// }
?>

<div class="connection">
	<form method="POST" action="<?= $BASE_URL ?>/../connection_process.php">
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
	<form method="POST">
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