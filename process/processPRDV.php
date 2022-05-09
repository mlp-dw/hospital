<?php

//on teste si tous les champs du formulaire sont remplits
if (isset($_POST['dateHour']) && !empty($_POST['dateHour']) && isset($_POST['mail']) && !empty($_POST['mail']) &&
isset($_POST['lastname']) && isset($_POST['firstname'])	&& isset($_POST['birthdate']) && isset($_POST['phone']) && 
!empty($_POST['lastname']) && !empty($_POST['firstname']) && !empty($_POST['birthdate']) && !empty($_POST['phone'])
 )
{
	//on se connecte au serveur
	
    $mysqlConnection = new PDO(
        'mysql:host=141.94.22.233;dbname=mlpdwwb_hospitale2n;charset=utf8', // serveur;base de donnée; encodage de caractère
        'root', // mon compte à moi pour me connecter au serveur
        'mlpdwwb' // mon mot de passe pour me connecter au serveur
    );
    $mysqlConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // rapport d'erreur et emet une exception

    $pdoStmnt = $mysqlConnection->prepare("INSERT INTO patients ( lastname, firstname, birthdate, phone, mail) VALUES (?,?,?,?,?)");
    $addPatient = $pdoStmnt->execute([$_POST["lastname"], $_POST["firstname"], $_POST["birthdate"], $_POST["phone"], $_POST["mail"]]);
    
    $patientId = $mysqlConnection->lastInsertId();

    $waitingRDV = $mysqlConnection->prepare("INSERT INTO appointments (dateHour, idPatients) VALUES (?, ?)");
    $addRDV = $waitingRDV->execute([$_POST["dateHour"], $patientId]);

    if (!$addRDV) {
        header("Location: ../liste-rendezvous.php?error=Echec lors de l'ajout du rendez-vous"); 
    }else{
        header("Location: ../liste-rendezvous.php?success=Le rendez-vous a bien été ajouté !"); // ../ sort du dossier courent x1 (process -> pdo2-1)
    }
}else{
    header("Location: ../ajout-patient-rendezvous.php?error=Le formulaire n'est pas valide"); // ../ sort du dossier courent x1 (process -> pdo2-1)
}
