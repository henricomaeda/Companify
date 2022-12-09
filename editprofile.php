<?php
	require_once("./templates/header.php");
	require_once("./dao/UserDAO.php");
	require_once("./models/User.php");

	$user = new User();
	$userDao = new UserDao();
	
	$userData = $userDao -> verifyToken();
	$picture = $userData -> picture;
	
	if (!$picture) $picture = "default.png";
	else $picture = "./users/" . $picture;

	$title = $user -> getFullName($userData);
	require_once("./templates/title_card.php");
?>
<div class="profile">
	<div class="profile_component">
		<form class="picture" method="POST" enctype="multipart/form-data" action="<?= $BASE_URL ?>/../user_process.php">
			<input type="hidden" name="type" value="update_picture">
			<div class="picture">
				<div class="spin"></div>
				<img class="round" src="<?= $BASE_URL ?>/../assets/<?= $picture ?>" />
			</div>
			<input type="file" name="picture" required />
			<input type="submit" id="submit" value="Atualizar imagem" />
		</form>
		<form class="password" method="POST" enctype="multipart/form-data" action="<?= $BASE_URL ?>/../user_process.php">
			<input type="hidden" name="type" value="update_password">
			<span> Antiga senha: </span>
			<input type="password" name="old_password" maxlength="200" required />
			<span> Nova senha: </span>
			<input type="password" name="new_password" maxlength="200" required />
			<span> Confirmar senha: </span>
			<input type="password" name="confirm_password" maxlength="200" required />
			<input type="submit" id="submit" value="Atualizar senha" />
		</form>
	</div>
	<div class="profile_component">
		<form class="email" method="POST" enctype="multipart/form-data" action="<?= $BASE_URL ?>/../logout.php">
			<span> E-mail cadastrado: </span>
			<input type="text" placeholder="Não foi possível consultar o e-mail." maxlength="200" value="<?= $userData -> email ?>" readonly />
			<input type="submit" id="submit" value="Desconectar" />
		</form>
		<form class="information" method="POST" action="<?= $BASE_URL ?>/../user_process.php">
			<input type="hidden" name="type" value="update_data">
			<span> Primeiro nome: </span>
			<input type="text" name="name" minlength="2" maxlength="20" value="<?= $userData -> name ?>" required />
			<span> Sobrenome: </span>
			<input type="text" name="lastname" id="lastname" minlength="2" maxlength="200" value="<?= $userData -> lastname ?>" required />
			<span> Descrição: </span>
			<textarea class="description" name="description" maxlength="200" rows="9"><?= $userData -> description ?></textarea>
			<div class="lastname">
				<input type="checkbox" name="checkbox" id="checkbox" onclick="noLastname()" />
				<div class="checkmark">
					<span></span>
				</div>
				<div class="subject"> Não possuo sobrenome. </div>
			</div>
			<input type="submit" id="submit" value="Atualizar dados" />
		</form>
	</div>
</div>
<?php
	require_once("./templates/footer.php");
	if (!$userData -> lastname):
?>
<script> noLastname(true) </script>
<?php endif ?>