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
    header("Location: liste-patient.php");
    exit;
}
/// AFFICHE LES PATIENTS
$afficherProfil = $mysqlConnection->prepare("SELECT * FROM patients WHERE id= ?");
$afficherProfil->execute([$id]);


$afficherProfil = $afficherProfil->fetch(PDO::FETCH_ASSOC); //permet récupère une ligne de résultat sous forme de tableau associatif

/// AFFICHE LES RDV
$afficherRdv = $mysqlConnection->prepare("SELECT * FROM appointments WHERE id= ?");
$afficherRdv->execute([$id]);


$afficherRdv = $afficherRdv->fetchAll(); //permet de trouver toutes les entrées du tableau

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


<h3 class="m-3">Profil patient</h3>


<div class="card" style="width: 18rem;">
    <div class="card-body">
        <a href="liste-patient.php" class="btn btn-danger">Retour</a><br><br>
        <h5 class="card-title"><?php echo $afficherProfil["firstname"] ?> <?php echo $afficherProfil["lastname"] ?> </h5>
        <p class="card-text">Né le : <?php echo $afficherProfil["birthdate"] ?> <br>Tel : <?php echo $afficherProfil["phone"] ?> <br> Email : <?php echo $afficherProfil["mail"] ?></p>
        <a href="update-patient.php?patient_id=<?=$afficherProfil['id']?>" class="btn btn-primary">Modifier</a>
        <a href="./process/processSupprPatient.php?id_patient=<?=$afficherProfil['id']?>" class="btn btn-warning">Supprimer</a>
    </div>
</div>





<?php include "footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
