<?php
    $SERVER_NAME = $_SERVER["SERVER_NAME"];
    $REQUEST_URI = dirname($_SERVER["REQUEST_URI"]);
    $BASE_URL = "http://" . $SERVER_NAME . $REQUEST_URI;
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="<?= $BASE_URL ?>../styles.css" />
        <link rel="icon" href="<?= $BASE_URL ?>./assets/Logo.png" />
		<script type="text/javascript" src="<?= $BASE_URL ?>../javascript.js"></script>
        <title> Shopiest </title>
    </head>
    <body>
        <header>
			<nav class="header">
				<a class="logo" href="<?= $BASE_URL ?>">
					<img src="/assets/logo.png" /> Shopiest
				</a>
				<div class="search">
					<form method="POST" enctype="application/json" onsubmit="return search()" action="<?= $BASE_URL ?>./procurar.php">
						<input type="text" id="product" name="product" placeholder="Procurar..." />
						<button type="submit" class="float fa fa-search"></button>
					</form>
				</div>
				<div class="right">
					<a href="<?= $BASE_URL ?>./pesquisar.php"> Pesquisar
						<img src="<?= $BASE_URL ?>./assets/Logo.png" />
					</a>
					<a href="<?= $BASE_URL ?>./consultar.php"> Consultar
						<img src="<?= $BASE_URL ?>./assets/Logo.png" />
					</a>
					<a href="<?= $BASE_URL ?>./entrar.php"> Entrar
						<img src="<?= $BASE_URL ?>./assets/Logo.png" />
					</a>
					<a href="<?= $BASE_URL ?>./cadastrar.php"> Cadastrar
						<img class="profile" src="<?= $BASE_URL ?>./assets/Default.png" />
					</a>
				</div>
			</nav>
        </header>