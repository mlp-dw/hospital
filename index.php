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

<div class="m-3 d-flex flex-column justify-content-center align-items-center">
    <h3 class="mx-3">Bienvenue à l'hôpital PDO !</h3>

<div class="w-50">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="https://www.malakoffhumanis.com/sites/smile/files/styles/editorial_page_top_image_desktop/public/images/2020-121-mh-photo-differences-hopital-public-clinique-privee-as-54048895-1024x577.jpg?itok=oVClgsdL" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
            <img src="https://cdn.radiofrance.fr/s3/cruiser-production/2022/01/5a260847-f74a-493e-8ab3-030cafdc60fa/870x489_capture_decran_2022-01-13_a_20.40.59.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
            <img src="https://resize-elle.ladmedia.fr/r/625,,forcex/crop/625,437,center-middle,forcex,ffffff/img/var/plain_site/storage/images/societe/news/elle-lutte-contre-ces-hopitaux-trop-machos-3975812/95804470-2-fre-FR/Elle-lutte-contre-ces-hopitaux-trop-machos.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<br><br><br>
    <div class="d-flex flex-row">

        
        <a href="ajout-patient.php" class="btn btn-success m-2">Ajouter un patient</a>
        
        <a href="liste-patient.php" class="btn btn-success m-2">Liste des patients</a>
        

    </div>

    <div class="d-flex flex-row">

        
        <a href="ajout-rendezvous.php" class="btn btn-success m-2">Prendre RDV</a>
        
        <a href="liste-rendezvous.php" class="btn btn-success m-2">Liste des RDV</a>

    </div>

    <div class="d-flex flex-row">

        
        <a href="ajout-patient-rendez-vous.php" class="btn btn-success m-2">Ajouter Patient + RDV</a>
        

    </div>

</div>


<?php include "footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
