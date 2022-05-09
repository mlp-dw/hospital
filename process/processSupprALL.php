<?php 
/////////////////////CONNEXION SERVEUR
$mysqlConnection = new PDO(
    'mysql:host=141.94.22.233;dbname=mlpdwwb_hospitale2n;charset=utf8', // serveur;base de donnée; encodage de caractère
    'root', // mon compte à moi pour me connecter au serveur
    'mlpdwwb' // mon mot de passe pour me connecter au serveur
);
$mysqlConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


if(isset($_GET['patient_id']) && !empty($_GET['patient_id']) ){
    /////////////////ON SUPPRIME

    
    $modifStatement = $mysqlConnection->prepare("DELETE FROM patients WHERE id = ?"); 
    //Ici je suis allée dans phpmyadmin  pour modifier la structure de de ma table (Structure->vue relationnelle) afin de 
    // modifier ON DELETE de RESTRICT à CASCADE qui a permit de supprimer tous les rdv à la suppression du patient 
    $modifStatement->execute([$_GET["patient_id"]]);   
    
    if (!$modifStatement) {
        header("Location: ../liste-patient.php?patient_id=".$_GET['patient_id']."&error=Echec lors de la supression"); 
    }else{
        header("Location: ../liste-patient.php?patient_id=".$_GET['patient_id']."&success=La supression à bien été effectuée !"); // ../ sort du dossier courent x1 (process -> pdo2-1)
    } 
}
// else{
//  header("Location: ../liste-patient.php?patient_id=".$_GET['id_patient']."&error=Le formulaire n'est pas valide");
// }