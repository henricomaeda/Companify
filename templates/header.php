<?php
	session_start();
	$index = "$_SERVER[HTTP_HOST]";
	require_once("./models/Message.php");
	require_once("./dao/UserDAO.php");
	
	$message = new Message();
	$msg = $message -> getMessage();
	if (!empty($_SESSION["MSG"])) $message -> clearMessage();

	$userDao = new UserDAO();
	$userData = $userDao -> verifyToken(false);

	if ($userData) {
		$picture = $userData -> picture;
		if ($picture) $picture = "./users/" . $picture;
		else $picture = "default_user.png";
	}
?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="./styles.css" />
		<link rel="icon" href="./assets/logo.png" />
		<script type="text/javascript" src="./functions.js"></script>
		<title> Companify </title>
	</head>
	<header>
		<nav class="header">
			<a class="logo" href="<?= $index ?>/../">
				<img src="./assets/logo.png" />
			</a>
			<div class="search">
				<form method="POST" enctype="application/json" action="./search.php">
					<input type="text" id="search" name="search" placeholder="Procurar empresas e produtos..." />
					<button type="submit" class="float fa fa-search"></button>
				</form>
			</div>
			<div class="right">
				<a href="./my_companies.php">
					<span> Minhas empresas </span>
					<img src="./assets/flaticon/assets/companies.png" />
				</a>
				<?php if (!empty($_SESSION["use_token"])): ?>
					<a href="./edit_profile.php">
						<span><?= $userData -> name ?></span>
						<img class="profile round" src="./assets/<?= $picture ?>" />
					</a>
				<?php else: ?>
					<a href="./auth.php">
						<span> Conectar </span>
						<img class="profile round" src="./assets/default_user.png" />
					</a>
				<?php endif ?>
			</div>
		</nav>
	</header>
		<body>
		<article class="body">