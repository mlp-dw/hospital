<?php
// connexion a la base de donnée
$mysqlConnection = new PDO(
    'mysql:host=141.94.22.233;dbname=mlpdwwb_hospitale2n;charset=utf8', // serveur;base de donnée; encodage de caractère
    'root', // mon compte à moi pour me connecter au serveur
    'mlpdwwb' // mon mot de passe pour me connecter au serveur
);

$mysqlConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdoStmnt = $mysqlConnection->prepare(" SELECT appointments.id,appointments.dateHour,appointments.idPatients,patients.lastname,patients.firstname, patients.birthdate 
                                        FROM appointments 
                                        JOIN patients 
                                            ON patients.id = appointments.idPatients  
                                        ORDER BY dateHour");
$pdoStmnt->execute();
$rdvs = $pdoStmnt->fetchAll(); //permet de trouver toutes les entrées du tableau

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

<h3 class="m-3">Liste des Rendez-Vous</h3>


<a href="ajout-rendezvous.php" class="btn btn-success m-3">Ajouter un rendez-vous</a>

<div class="bd-example">
    <table class="table table-success table-striped">
        <thead>
            <tr>
            <th scope="col">#</th>
                <th scope="col">Date et Heure</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Date de Naissance</th>
                <th scope="col">Détails</th>
                <th scope="col">Supprimer</th>
            </tr>
        </thead>

<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="d-flex flex-wrap justify-content-center">

    <!-- // On affiche chaque rdv un à un dès qu'il est ajouté -->
    <?php
            foreach ($rdvs as $rdv) {
                ?>
                    <tbody>
                        <tr>
                            <th scope="row"><?php echo $rdv["id"] ?></th>
                            <td><?php echo $rdv["dateHour"] ?></td>
                            <td><?php echo $rdv["lastname"] ?></td>
                            <td><?php echo $rdv["firstname"] ?></td>
                            <td><?php echo $rdv["birthdate"] ?></td>
                            <td><a class="btn btn-outline-dark" href="rendezvous.php?patient_id=<?=$rdv['idPatients']?>">Voir plus...</a></td>
                            <td><a class="btn btn-outline-dark" href="./process/processSupprRDV.php?id_rdv=<?=$rdv['id']?>">Supprimer</a></td>
                        </tr>
                    </tbody>

                <?php
            }
    ?>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    </table>
</div>

<?php include "footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
