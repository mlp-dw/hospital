<?php 
/////////////////////CONNEXION SERVEUR
$mysqlConnection = new PDO(
    'mysql:host=141.94.22.233;dbname=mlpdwwb_hospitale2n;charset=utf8', // serveur;base de donnée; encodage de caractère
    'root', // mon compte à moi pour me connecter au serveur
    'mlpdwwb' // mon mot de passe pour me connecter au serveur
);
$mysqlConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if(
    isset($_POST['patient']) && !empty($_POST['patient']) && 
    isset($_POST['id_rdv']) && !empty($_POST['id_rdv']) && 
    !empty($_POST['dateHour']) && isset($_POST['dateHour'])
){
    /////////////////ON MODIFIE
    
    $modifStatement = $mysqlConnection->prepare("UPDATE appointments SET dateHour = ?, idPatients = ? WHERE id = ?");
    $modifStatement->execute([$_POST["dateHour"], $_POST["patient"], $_POST["id_rdv"]]);
    
    if (!$modifStatement) {
        header("Location: ../rendezvous.php?patient_id=".$_POST['patient']."&error=Echec lors de la modification"); 
    }else{
        header("Location: ../rendezvous.php?patient_id=".$_POST['patient']."&success=La modification à bien été effectuée !"); // ../ sort du dossier courent x1 (process -> pdo2-1)
    } 
}
else{
 header("Location: ../rendezvous.php?patient_id=".$_POST['patient']."&error=Le formulaire n'est pas valide");
}