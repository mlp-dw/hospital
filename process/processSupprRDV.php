<?php 
/////////////////////CONNEXION SERVEUR
$mysqlConnection = new PDO(
    'mysql:host=141.94.22.233;dbname=mlpdwwb_hospitale2n;charset=utf8', // serveur;base de donnée; encodage de caractère
    'root', // mon compte à moi pour me connecter au serveur
    'mlpdwwb' // mon mot de passe pour me connecter au serveur
);
$mysqlConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



if(isset($_GET['id_rdv']) && !empty($_GET['id_rdv'])
){
    /////////////////ON SUPPRIME
    
    $modifStatement = $mysqlConnection->prepare("DELETE FROM appointments WHERE id = ?");
    $modifStatement->execute([$_GET["id_rdv"]]);   
    
    if (!$modifStatement) {
        header("Location: ../liste-rendezvous.php?patient_id=".$_GET['id_rdv']."&error=Echec lors de la supression"); 
    }else{
        header("Location: ../liste-rendezvous.php?patient_id=".$_GET['id_rdv']."&success=La supression à bien été effectuée !"); // ../ sort du dossier courent x1 (process -> pdo2-1)
    } 
}
else{
 header("Location: ../liste-rendezvous.php?patient_id=".$_GET['id_rdv']."&error=Le formulaire n'est pas valide");
}