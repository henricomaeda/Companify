<?php
	session_start();
	require_once("./models/Message.php");

	$INDEX = "$_SERVER[HTTP_HOST]";
	$BASE_URL = "http://$INDEX$_SERVER[REQUEST_URI]";
	$message = new Message($BASE_URL);
	$msg = $message -> getMessage();

	if (!empty($_SESSION["MSG"])) $message -> clearMessage();
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
				<img src="<?= $BASE_URL ?>/../../assets/logo.png" /><span> Commercify </span>
			</a>
			<div class="search">
				<form method="POST" enctype="application/json" onsubmit="return search()" action="<?= $BASE_URL ?>/../procurar.php">
					<input type="text" id="product" name="product" placeholder="Procurar comércios e produtos..." />
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
				<a href="<?= $BASE_URL ?>/../mycontent.php">
					<span> Meus comércios </span>
					<img class="profile" src="<?= $BASE_URL ?>/../../assets/flaticon/assets/products.png" />
				</a>
				<a href="<?= $BASE_URL ?>/../connection.php">
					<span> Conectar </span>
					<img class="profile" src="<?= $BASE_URL ?>/../../assets/default.png" />
				</a>
			</div>
		</nav>
	</header>
    <body>
		<article class="body">
			<?php if(!empty($msg)): ?>
				<a href="<?= $BASE_URL ?>">
					<span class="message">
						<?= $msg ?>
					</span>
				</a>
			<?php endif; ?>