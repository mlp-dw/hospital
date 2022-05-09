<?php
// connexion a la base de donnée
$mysqlConnection = new PDO(
    'mysql:host=141.94.22.233;dbname=mlpdwwb_hospitale2n;charset=utf8', // serveur;base de donnée; encodage de caractère
    'root', // mon compte à moi pour me connecter au serveur
    'mlpdwwb' // mon mot de passe pour me connecter au serveur
);

$mysqlConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// PERMET D4AFFICHER TOUS LES PATIENTS SANS PAGINATION = LONGUE LISTE
// $pdoStmnt = $mysqlConnection->prepare("SELECT * FROM patients");
// $pdoStmnt->execute();
// $patients = $pdoStmnt->fetchAll(); //permet de trouver toutes les entrées du tableau


//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//PAGINATION

if(isset($_GET['page']) && !empty($_GET['page'])){
    $currentPage = (int) strip_tags($_GET['page']);
}else{
    $currentPage = 1;
}
$pagination = $mysqlConnection->prepare("SELECT COUNT(*) AS id FROM patients");
$pagination->execute();
$resultCount = $pagination->fetch(PDO::FETCH_ASSOC);
$nbrPage = (int)$resultCount['id'];

$parPage = 5;
$pages = ceil($nbrPage / $parPage);
$premier = ($currentPage * $parPage) - $parPage;

$qPagination = $mysqlConnection->prepare('SELECT * FROM patients ORDER BY lastname ASC LIMIT :premier, :parpage;');
$qPagination->bindValue(':premier', $premier, PDO::PARAM_INT);
$qPagination->bindValue(':parpage', $parPage, PDO::PARAM_INT);
$qPagination->execute();

$patients = $qPagination->fetchAll(PDO::FETCH_ASSOC);

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>PDO Hospital</title>
</head>
<body>
<?php include "header.php"; ?>

<!-- ==============================================================================================================
VERIF D'ENVOI -->

<?php if (isset($_GET['error'])) {?>
    <div class="alert alert-danger" role="alert">
        <?= $_GET['error']?>
    </div>
<?php } ?>
<?php if (isset($_GET['success'])) {?>
    <div class="alert alert-success" role="alert">
        <?= $_GET['success']?>
    </div>
<?php } ?>

<!-- ============================================================================================================== -->

<h3 class="m-3">Liste des patients</h3>

<div class="d-flex flex-row justify-content-start">

    <a href="ajout-patient.php" class="btn btn-success m-3">Ajouter un patient</a>

    <div class="" id="search_form">
        <form action="" method="POST" class="d-flex flex-row justify-content-start" autocompletion="auto">
            <input class="form-control my-3 ms-3" type="search" placeholder="Search" aria-label="Search" name="search" value="">
            <input class="form-control my-3 w-25" type="submit" name="envoi" value="Ok">
        </form>
    </div>

</div>
<?php

//on teste IF le champ de recherche est rempli et ELSE s'il est vide

if(isset($_POST['search']) && !empty($_POST['search']))
{
    $_POST["search"] = htmlspecialchars($_POST["search"]); //pour empêcher l'execution de balise
    $select = $mysqlConnection->prepare("SELECT * FROM patients WHERE lastname LIKE ? OR firstname LIKE ?");
    $select->execute([$_POST["search"]."%" , $_POST["search"]."%"]);

    if (!$select) {
        header("Location: ../liste-patient.php?error=Echec lors de la recherche"); 
    }else{
    ?>
    <div class="bd-example">
            <table class="table table-success table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Date de Naissance</th>
                        <th scope="col">Téléphone</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Détails</th>
                        <th scope="col">Supprimer Patients et RDV</th>
                    </tr>
                </thead>

        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
        <div class="d-flex flex-wrap justify-content-center">

            <!-- // On affiche chaque patient un à un dès qu'il est ajouté -->
            <?php
                    foreach ($select as $result) {
                        ?>
                            <tbody>
                                <tr>
                                    <th scope="row"><?php echo $result["id"] ?></th>
                                        <td><?php echo $result["lastname"] ?></td>
                                        <td><?php echo $result["firstname"] ?></td>
                                        <td><?php echo $result["birthdate"] ?></td>
                                        <td><?php echo $result["phone"] ?></td>
                                        <td><?php echo $result["mail"] ?></td>
                                        <td><a class="btn btn-outline-dark" href="profil-patient.php?patient_id=<?=$result['id']?>">Voir plus...</a></td>
                                        <td><a class="btn btn-outline-dark w-75" href="./process/processSupprALL.php?patient_id=<?=$result['id']?>">Suppr tout</a></td>
                                    </tr>
                            </tbody>

                        <?php
                    }
            ?>
        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
            </table>
        </div>
    <?php
    }
}else{
    ?>        

        <div class="bd-example">
            <table class="table table-success table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Date de Naissance</th>
                        <th scope="col">Téléphone</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Détails</th>
                        <th scope="col">Supprimer Patients et RDV</th>
                    </tr>
                </thead>

        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
        <div class="d-flex flex-wrap justify-content-center">

            <!-- // On affiche chaque patient un à un dès qu'il est ajouté -->
            <?php
                    foreach ($patients as $patient) {
                        ?>
                            <tbody>
                                <tr>
                                    <th scope="row"><?php echo $patient["id"] ?></th>
                                        <td><?php echo $patient["lastname"] ?></td>
                                        <td><?php echo $patient["firstname"] ?></td>
                                        <td><?php echo $patient["birthdate"] ?></td>
                                        <td><?php echo $patient["phone"] ?></td>
                                        <td><?php echo $patient["mail"] ?></td>
                                        <td><a class="btn btn-outline-dark" href="profil-patient.php?patient_id=<?=$patient['id']?>">Voir plus...</a></td>
                                        <td><a class="btn btn-outline-dark w-75" href="./process/processSupprALL.php?patient_id=<?=$patient['id']?>">Suppr tout</a></td>
                                    </tr>
                            </tbody>

                        <?php
                    }
            ?>
        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
            </table>
        </div>
    <?php
}

?>
<!-- ===========================================================================================================================
========== PAGINATION VISIBLE -->

<nav class="d-flex justify-content-center ">
    <ul class="pagination">
        <li class="link-dark <?= ($currentPage == 1) ? "disabled" : "" ?>">
            <a href="liste-patient.php?page=<?= $currentPage - 1 ?>" class="page-link link-dark"><<</a>
        </li>
        <?php for($page = 1; $page <= $pages; $page++): ?>
            <li class="link-dark <?= ($currentPage == $page) ? "active" : "" ?>">
                <a href="liste-patient.php?page=<?= $page ?>" class="page-link link-dark"><?= $page ?></a>
            </li>
        <?php endfor ?>
            <li class="link-dark <?= ($currentPage == $pages) ? "disabled" : "" ?>">
            <a href="liste-patient.php?page=<?= $currentPage + 1 ?>" class="page-link link-dark">>></a>
        </li>
    </ul>
</nav>

<!-- =========================================================================================================================== -->

<?php include "footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
