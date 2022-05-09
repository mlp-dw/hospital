<?php

//on teste si tous les champs du formulaire sont remplits
if (isset($_POST['lastname']) && isset($_POST['firstname'])	&& isset($_POST['birthdate']) && isset($_POST['phone']) && isset($_POST['mail']) &&
!empty($_POST['lastname']) && !empty($_POST['firstname'])	&& !empty($_POST['birthdate']) && !empty($_POST['phone']) && !empty($_POST['mail']))
{
	//on se connecte au srveur
	
    $mysqlConnection = new PDO(
        'mysql:host=141.94.22.233;dbname=mlpdwwb_hospitale2n;charset=utf8', // serveur;base de donnée; encodage de caractère
        'root', // mon compte à moi pour me connecter au serveur
        'mlpdwwb' // mon mot de passe pour me connecter au serveur
    );
    $mysqlConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $pdoStmnt = $mysqlConnection->prepare("INSERT INTO `patients` ( `lastname`, `firstname`, `birthdate`, `phone`, `mail`) VALUES (?,?,?,?,?)");
    $isSuccess = $pdoStmnt->execute([$_POST["lastname"], $_POST["firstname"], $_POST["birthdate"], $_POST["phone"], $_POST["mail"]]);
    // $mysqlConnection->lastInsertId(); // PERMET DE RECUPERER LE DERNIER ID CREER DANS LA BASE DE DONNEES
    // $patients = $pdoStmnt->fetchAll();
    if (!$isSuccess) {
        header("Location: ../liste-patient.php?error=Echec lors de l\'ajout du patient"); 
    }else{
        header("Location: ../liste-patient.php?success=Le patient à bien été ajouté !"); // ../ sort du dossier courent x1 (process -> pdo2-1)
    }
}else{
    header("Location: ../ajout-patient.php?error=Le formulaire n'est pas valide"); // ../ sort du dossier courent x1 (process -> pdo2-1)
}




