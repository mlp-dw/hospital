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
$afficherProfil = $mysqlConnection->prepare("SELECT * FROM patients WHERE id= ?");
$afficherProfil->execute([$id]);
$afficherProfil = $afficherProfil->fetch(PDO::FETCH_ASSOC); //permet récupère une ligne de résultat sous forme de tableau associatif

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


<h3 class="mx-3">Modification du patient</h3>

<main class="form-signin m-3 d-flex justify-content-center ">
    <form action="./process/processUpdatePatient.php" method="POST">

        <div class="m-2">
            <label for="message">Nom</label>
            <input type="text" name="lastname" class="form-control" placeholder="nom" value="<?=$afficherProfil['lastname']?>">
        </div>

        <div class="m-2">
            <label for="message">Prénom</label>
            <input type="text" name="firstname" class="form-control" placeholder="prenom" value="<?=$afficherProfil['firstname']?>">
        </div>

        <div class="m-2">
            <label for="message">Date de Naissance</label>
            <input type="date" name="birthdate" class="form-control" value="<?=$afficherProfil['birthdate']?>">
        </div>

        <div class="m-2">
            <label for="message">Téléphone</label>
            <input type="tel" name="phone" class="form-control" placeholder="06 12 12 12 12" value="<?=$afficherProfil['phone']?>">
        </div>

        <div class="m-2">
            <label for="message">Email</label>
            <input type="email" name="mail" class="form-control" placeholder="name@example.com" value="<?=$afficherProfil['mail']?>">
        </div>
        <input type="hidden" name="id_patient" value="<?=$afficherProfil['id']?>">

        <div class="d-flex justify-content-center">
            <button class="w-30 btn btn-lg btn-primary" type="submit" name="modif">Envoyer</button>
        </div>
    </form>
</main>

<?php include "footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
