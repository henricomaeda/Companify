<?php
	require_once("./templates/header.php");
	require_once("./dao/UserDAO.php");
	require_once("./models/User.php");

	$user = new User();
	$userDao = new UserDao();
	
	$userData = $userDao -> verifyToken();
	$fullName = $user -> getFullName($userData);
	
	if ($userData -> picture == "") $userData -> picture = "default.png";
?>
<div class="profile">
	<div class="profile_component">
		<form class="picture" method="POST" action="<?= $BASE_URL ?>/../profile_process.php">
			<input type="hidden" name="type" value="update_picture">
			<img src="<?= $BASE_URL ?>/../../assets/default.png" />
			<input type="file" />
			<input type="submit" id="submit" value="Atualizar imagem" />
		</form>
		<form class="password" method="POST" action="<?= $BASE_URL ?>/../profile_process.php">
			<input type="hidden" name="type" value="update_password">
			<span>
				Senha antiga
				<input type="password" />
			</span>
			<span>
				Nova senha
				<input type="password" />
			</span>
			<span>
				Confirmar senha
				<input type="password" />
			</span>
			<input type="submit" id="submit" value="Atualizar senha" />
		</form>
	</div>
	<div class="profile_component">
		<span class="fullname"><?= $fullName ?></span>
		<form class="information" method="POST" action="<?= $BASE_URL ?>/../profile_process.php">
			<input type="hidden" name="type" value="update_data">
			<span>
				Primeiro nome:
				<input type="text" value="<?= $userData -> name ?>" />
			</span>
			<span>
				Sobrenome:
				<input type="text" value="<?= $userData -> lastname ?>" />
			</span>
			<span>
				E-mail:
				<input type="text" value="<?= $userData -> email ?>" readonly />
			</span>
			<span>
				Descrição:
				<textarea class="description" rows="11"><?= $userData -> description ?></textarea>
			</span>
			<input type="submit" id="submit" value="Atualizar dados" />
		</form>
	</div>
</div>
<?php require_once("./templates/footer.php") ?>