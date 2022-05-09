<?php 
/////////////////////CONNEXION SERVEUR
$mysqlConnection = new PDO(
    'mysql:host=141.94.22.233;dbname=mlpdwwb_hospitale2n;charset=utf8', // serveur;base de donnée; encodage de caractère
    'root', // mon compte à moi pour me connecter au serveur
    'mlpdwwb' // mon mot de passe pour me connecter au serveur
);
$mysqlConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



if((isset($_POST['id_patient']) && isset($_POST['lastname']) && isset($_POST['firstname'])	&& isset($_POST['birthdate']) && isset($_POST['phone']) && isset($_POST['mail']) &&
!empty($_POST['id_patient']) && !empty($_POST['lastname']) && !empty($_POST['firstname'])	&& !empty($_POST['birthdate']) && !empty($_POST['phone']) && !empty($_POST['mail']))
){
    /////////////////ON MODIFIE
    
    $modifStatement = $mysqlConnection->prepare("UPDATE patients SET lastname = ?, firstname = ?, birthdate = ?, phone = ?, mail = ? WHERE id = ?");
    $modifStatement->execute([$_POST["lastname"], $_POST["firstname"], $_POST["birthdate"], $_POST["phone"], $_POST["mail"], $_POST["id_patient"]]);   
    
    if (!$modifStatement) {
        header("Location: ../profil-patient.php?patient_id=".$_POST['id_patient']."&error=Echec lors de la modification"); 
    }else{
        header("Location: ../profil-patient.php?patient_id=".$_POST['id_patient']."&success=La modification à bien été effectuée !"); // ../ sort du dossier courent x1 (process -> pdo2-1)
    } 
}
else{
 header("Location: ../profil-patient.php?patient_id=".$_POST['id_patient']."&error=Le formulaire n'est pas valide");
}