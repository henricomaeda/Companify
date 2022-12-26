<?php
	require_once("./templates/header.php");
	require_once("./dao/CompanyDAO.php");

	$title = "Minhas empresas";
	require_once("./templates/title_card.php");

	$userData = $userDao -> verifyToken();
	$user_id = $userData -> id;
	
	$companyDAO = new CompanyDAO();
	$companies = $companyDAO -> getCompaniesByUserId($user_id);
?>
<form class="companies shadow" method="POST" action="./company_process.php">
	<label> Nome da empresa: </label>
	<div>
		<input type="hidden" name="type" value="register">
		<input type="text" name="name" minlength="2" maxlength="200" required />
		<input type="submit" value="Adicionar empresa" />
	</div>
</form>
<div class="companies">
	<?php
		foreach($companies as $company) {
			require("./templates/company_card.php");
		}
	?>
</div>
<?php require_once("./templates/footer.php") ?>