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
<h3 class="mx-3">Veuillez renseigner tous les champs</h3>

<main class="form-signin m-3 d-flex justify-content-center ">
    <form action="./process/processAjouter.php" method="POST">

        <h1 class="h3 mb-3 fw-normal">Renseignement</h1>

        <div class="m-2">
            <label for="message">Nom</label>
            <input type="text" name="lastname" class="form-control" placeholder="nom">
        </div>

        <div class="m-2">
            <label for="message">Prénom</label>
            <input type="text" name="firstname" class="form-control" placeholder="prenom">
        </div>

        <div class="m-2">
            <label for="message">Date de Naissance</label>
            <input type="date" name="birthdate" class="form-control">
        </div>

        <div class="m-2">
            <label for="message">Téléphone</label>
            <input type="tel" name="phone" class="form-control" placeholder="06 12 12 12 12">
        </div>

        <div class="m-2">
            <label for="message">Email</label>
            <input type="email" name="mail" class="form-control" placeholder="name@example.com">
        </div>


        <div class="d-flex justify-content-center">
            <button class="w-30 btn btn-lg btn-primary" type="submit">Envoyer</button>
        </div>
    </form>
</main>

<?php include "footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
