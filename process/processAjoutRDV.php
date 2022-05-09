<?php

//on teste si tous les champs du formulaire sont remplits
if (isset($_POST['patient'])  && isset($_POST['dateHour']) && !empty($_POST['dateHour']) && !empty($_POST['patient']) )
{
	//on se connecte au serveur
	
    $mysqlConnection = new PDO(
        'mysql:host=141.94.22.233;dbname=mlpdwwb_hospitale2n;charset=utf8', // serveur;base de donnée; encodage de caractère
        'root', // mon compte à moi pour me connecter au serveur
        'mlpdwwb' // mon mot de passe pour me connecter au serveur
    );
    $mysqlConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // rapport d'erreur et emet une exception

    
    $pdoStmnt = $mysqlConnection->prepare("INSERT INTO appointments (dateHour, idPatients) VALUES (?, ?)");
    $isSuccess = $pdoStmnt->execute([$_POST["dateHour"], $_POST["patient"]]);

    if (!$isSuccess) {
        header("Location: ../liste-rendezvous.php?error=Echec lors de l'ajout du rendez-vous"); 
    }else{
        header("Location: ../liste-rendezvous.php?success=Le rendez-vous a bien été ajouté !"); // ../ sort du dossier courent x1 (process -> pdo2-1)
    }
}else{
    header("Location: ../ajout-rendezvous.php?error=Le formulaire n'est pas valide"); // ../ sort du dossier courent x1 (process -> pdo2-1)
}
