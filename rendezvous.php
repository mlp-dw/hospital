<?php 
$mysqlConnection = new PDO(
    'mysql:host=141.94.22.233;dbname=mlpdwwb_hospitale2n;charset=utf8', // serveur;base de donnée; encodage de caractère
    'root', // mon compte à moi pour me connecter au serveur
    'mlpdwwb' // mon mot de passe pour me connecter au serveur
);
$mysqlConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = htmlentities(trim($_GET["patient_id"])); // permet que des balises ne s'execute pas et trim enlève les espaces vides
$id = (int) $id; // ne prend que des nombre entier
if(!is_int($id) || $id == 0){
    header("Location: liste-rendezvous.php");
    exit;
}

/// AFFICHE LES PATIENTS
$afficherProfil = $mysqlConnection->prepare("SELECT * FROM patients WHERE id= ?");
$afficherProfil->execute([$id]);
$patient = $afficherProfil->fetch(PDO::FETCH_ASSOC); //permet récupère une ligne de résultat sous forme de tableau associatif


/// AFFICHE LES RDV
$afficherRdv = $mysqlConnection->prepare("SELECT * FROM appointments WHERE idPatients= ? ORDER BY dateHour");
$afficherRdv->execute([$id]);
$rdvs = $afficherRdv->fetchAll(PDO::FETCH_ASSOC); //permet récupère une ligne de résultat sous forme de tableau associatif

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


<h3 class="m-3">Patient ayant RDV</h3>


<div class="card" style="width: 18rem;">
    <div class="card-body">
        <a href="liste-rendezvous.php" class="btn btn-danger">Retour</a><br><br>
        <h5 class="card-title"><?php echo $patient["firstname"] ?> <?php echo $patient["lastname"] ?> </h5>
        <p class="card-text">Né le : <?php echo $patient["birthdate"] ?> <br>Tel : <?php echo $patient["phone"] ?> <br> Email : <?php echo $patient["mail"] ?></p>
    </div>
</div>
<?php foreach ($rdvs as $rdv) { ?>

    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Rendez-vous </h5>
            <p class="card-text">Le : <?= $rdv["dateHour"]; ?> </p>
            <a href="update-rdv.php?rdv_id=<?=$rdv['id']?>" class="btn btn-primary">Modifier</a>
            <a href="./process/processSupprRDV.php?id_rdv=<?=$rdv['id']?>" class="btn btn-warning">Supprimer</a>
        </div>
    </div>
<?php } ?>



<?php include "footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
