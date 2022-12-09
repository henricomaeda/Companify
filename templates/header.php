<?php
	session_start();
	require_once("./models/Message.php");
	require_once("./dao/UserDAO.php");

	$INDEX = "$_SERVER[HTTP_HOST]";
	$BASE_URL = "http://$INDEX$_SERVER[REQUEST_URI]";
	
	$message = new Message();
	$msg = $message -> getMessage();
	if (!empty($_SESSION["MSG"])) $message -> clearMessage();

	$userDao = new UserDAO();
	$userData = $userDao -> verifyToken(false);
	if ($userData) {
		$picture = $userData -> picture;
	
		if (!$picture) $picture = "default.png";
		else $picture = "./users/" . $picture;
	}
?>
<!DOCTYPE html>
<html lang="pt-BR">
		<head>
			<meta charset="UTF-8" />
			<meta http-equiv="X-UA-Compatible" content="IE=edge" />
			<meta name="viewport" content="width=device-width, initial-scale=1.0" />
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
			<link rel="stylesheet" href="<?= $BASE_URL ?>/../styles.css" />
			<link rel="icon" href="<?= $BASE_URL ?>/../assets/logo.png" />
			<script type="text/javascript" src="<?= $BASE_URL ?>/../functions.js"></script>
			<title> Companify </title>
		</head>
	<header>
		<nav class="header">
			<a class="logo" href="<?= $INDEX ?>/../">
				<img src="<?= $BASE_URL ?>/../assets/logo.png" />
			</a>
			<div class="search">
				<form method="POST" enctype="application/json" action="<?= $BASE_URL ?>/../search.php">
					<input type="text" id="search" name="search" placeholder="Procurar comércios e produtos..." />
					<button type="submit" class="float fa fa-search"></button>
				</form>
			</div>
			<div class="right">
				<a href="<?= $BASE_URL ?>/../companies.php">
					<span> Minhas empresas </span>
					<img src="<?= $BASE_URL ?>/../assets/flaticon/assets/companies
					.png" />
				</a>
				<?php if (!empty($_SESSION["use_token"])): ?>
					<a href="<?= $BASE_URL ?>/../editprofile.php">
						<span><?= $userData -> name ?></span>
						<img class="profile round" src="<?= $BASE_URL ?>/../assets/<?= $picture ?>" />
					</a>
				<?php else: ?>
					<a href="<?= $BASE_URL ?>/../auth.php">
						<span> Conectar </span>
						<img class="profile round" src="<?= $BASE_URL ?>/../assets/default.png" />
					</a>
				<?php endif ?>
			</div>
		</nav>
	</header>
		<body>
		<article class="body">