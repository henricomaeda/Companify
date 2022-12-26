<?php
    $picture = "default_company.png";
    $name = "Nome da empresa";
    $rating = 0;

    if ($company -> picture) $picture = "./companies/" . $company -> picture;
    if ($company -> name) $name = $company -> name;
?>
<div class="company shadow">
    <form class="deleteButton" method="POST" action="./company_process.php">
        <input type="hidden" name="type" value="delete" />
        <input type="hidden" name="id" value="<?= $company -> id ?>" />
        <input id="submit" type="submit" value="" />
    <div class="picture round shadow">
        <img class="round" src="./assets/<?= $picture ?>" />
    </div>
    <div class="details">
        <span class="title"><?= $name ?></span>
        <div class="rating">
            <?php for ($evaluation = $rating; $evaluation > 0; $evaluation--): ?>
                <span class="fa fa-star checked"></span>
            <?php endfor ?>
            <?php for ($evaluation = (5 - $rating); $evaluation > 0; $evaluation--): ?>
                <span class="fa fa-star"></span>
            <?php endfor ?>
        </div>
        <form method="POST" action="./company.php">
            <input type="hidden" name="id" value="<?= $company -> id ?>" />
            <input type="submit" class="other" value="Visualizar" />
        </form>
        <form method="POST" action="./edit_company.php">
            <input type="hidden" name="id" value="<?= $company -> id ?>" />
            <input type="submit" value="Alterar dados" />
        </form>
    </div>
</div>