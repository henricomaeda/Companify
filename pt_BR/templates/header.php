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
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="<?= $BASE_URL ?>/../../styles.css" />
        <link rel="icon" href="<?= $BASE_URL ?>/../../assets/logo.png" />
		<script type="text/javascript" src="<?= $BASE_URL ?>/../../javascript.js"></script>
        <title> Commercify </title>
    </head>
	<header>
		<nav class="header">
			<a class="logo" href="<?= $INDEX ?>/../">
				<img src="<?= $BASE_URL ?>/../../assets/logo.png" />
				<div>
					<span> Commercify </span>
				</div>
			</a>
			<div class="search">
				<form method="POST" enctype="application/json" action="<?= $BASE_URL ?>/../procurar.php">
					<input type="text" id="search" name="search" placeholder="Procurar comércios e produtos..." />
					<button type="submit" class="float fa fa-search"></button>
				</form>
			</div>
			<div class="right">
				<div class="languages">
					<a href="<?php echo str_replace("pt_BR", "en_US", $BASE_URL) ?>">
						<img class="language" src="<?= $BASE_URL ?>/../../assets/languages/united_states.png" />
					</a>
					<img class="default language" src="<?= $BASE_URL ?>/../../assets/languages/brazil.png" />
				</div>
				<a href="<?= $BASE_URL ?>/../trades.php">
					<span> Meus comércios </span>
					<img src="<?= $BASE_URL ?>/../../assets/flaticon/assets/trades
					.png" />
				</a>
				<?php if (!empty($_SESSION["use_token"])): ?>
					<a href="<?= $BASE_URL ?>/../profile.php">
						<span><?= $userData -> name ?></span>
						<img class="profile" src="<?= $BASE_URL ?>/../../assets/default.png" />
					</a>
					<a href="<?= $BASE_URL ?>/../logout.php">
						<span> Desconectar </span>
						<img src="<?= $BASE_URL ?>/../../assets/flaticon/assets/logout.png" />
					</a>
				<?php else: ?>
					<a href="<?= $BASE_URL ?>/../auth.php">
						<span> Conectar </span>
						<img class="profile" src="<?= $BASE_URL ?>/../../assets/default.png" />
					</a>
				<?php endif; ?>
			</div>
		</nav>
	</header>
    <body>
		<article class="body">