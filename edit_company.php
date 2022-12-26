<?php
	require_once("./templates/header.php");
	require_once("./dao/CompanyDAO.php");

    $company_id = filter_input(INPUT_POST, "id");
    $valid_c = $company_id && $company_id >= 0;
    
    if ($valid_c) {
        $companyDao = new CompanyDAO();
        $company = $companyDao -> findById($company_id);

        if ($company) {
            $title = $company -> name;
            require_once("./templates/title_card.php");

            $picture = "default_company.png";
            if ($company -> picture) $picture = "./companies/" . $company -> picture;
            ?>
            <div class="profile">
                <div class="profile_component">
                    <form class="picture shadow" method="POST" enctype="multipart/form-data" action="./company_process.php">
                        <input type="hidden" name="type" value="update_picture">
                        <input type="hidden" name="id" value="<?= $company -> id ?>">
                        <div class="picture">
                            <div class="spin"></div>
                            <img class="round" src="./assets/<?= $picture ?>" />
                        </div>
                        <input type="file" name="picture" required />
                        <input type="submit" id="submit" value="Atualizar imagem" />
                    </form>
                </div>
                <div class="profile_component">
                    <form class="information shadow" method="POST" action="./company_process.php">
                        <input type="hidden" name="type" value="update_data">
                        <input type="hidden" name="id" value="<?= $company -> id ?>">
                        <span> Nome da empresa: </span>
                        <input type="text" name="name" minlength="2" maxlength="20" value="<?= $company -> name ?>" required />
                        <span> Descrição: </span>
                        <textarea class="description" name="description" maxlength="200" rows="7"><?= $company -> description ?></textarea>
                        <input type="submit" id="submit" value="Atualizar dados" />
                    </form>
                </div>
            </div>  
            <?php
        }
        else $message -> setMessage(false, "return", "A empresa não foi encontrada.");
    }
    else $message -> setMessage(false, "my_companies.php", "Selecione uma empresa para alterar os dados.");
    require_once("./templates/footer.php");
?>