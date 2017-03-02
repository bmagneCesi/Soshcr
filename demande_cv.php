<!-- HEADER -->
<?php include('header.php') ?>
<!-- HEADER -->
<?php
//print_r($_SESSION);
include("connexion.php");
$pdo = connect();
$contrat2= "";
$poste2="";
$contrats=$pdo->query("SELECT * FROM contrat WHERE id_contrat=".$_SESSION['contrat']);
$contrats->setFetchMode(PDO::FETCH_OBJ);
$nbPers= 0;
while( $contrat = $contrats->fetch() ) {
    $contrat2 = $contrat->libelle;
}

if (isset($_SESSION['poste_hotellerie'])){
    $postes=$pdo->query("SELECT * FROM poste_recherche WHERE id_poste_recherche=".$_SESSION['poste_hotellerie']);
    $postes->setFetchMode(PDO::FETCH_OBJ);
    $nbPers= 0;
    while( $poste = $postes->fetch() ) {
        $poste2 = $poste->libelle;
    }
}
elseif ( isset($_SESSION['poste_restauration'])){
    $postes=$pdo->query("SELECT * FROM poste_recherche WHERE id_poste_recherche=".$_SESSION['poste_restauration']);
    $postes->setFetchMode(PDO::FETCH_OBJ);
    $nbPers= 0;
    while( $poste = $postes->fetch() ) {
        $poste2 = $poste->libelle;
    }
}

?>


    <div class="col-md-5">
        <div class="form-area">
            <form method="post">
                <br style="clear:both">
                <h3 style="margin-bottom: 25px; text-align: center;">Demande de CV</h3>
                <div class="form-group">
                    <textarea class="form-control" type="textarea" id="textarea2" name="textarea_2" placeholder="Message" maxlength="500" rows="9"><?php
                        echo "Bonjour,\n".
                            "Nous recherchons un(e) ".$poste2." à partir du ".$_SESSION['start']." en ".$contrat2.".\n".
                            "Envoyez nous votre curriculum vitae et une lettre de motivation.\n".
                            "Merci de répondre à [Entrez votre adresse email]\n".
                            "\n".
                            "A bientôt,\n".
                            "[Votre nom]\n".
                            "[Votre numéro de téléphone]\n"
                        ;
                        ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary pull-right">Envoyer</button>
            </form>
        </div>
    </div>


<?php

if ( isset($_POST['textarea_2']) ){
    if (($_POST['textarea_2']=="")){
        echo "Merci de remplir votre demande";
    }
    else{
        $addMail="";
        foreach ($_SESSION['mail_demande_utilisateur'] as $email){
            //echo $email;
            $addMail .= $email.", ";
        }
        //echo $addMail;
        // Plusieurs destinataires
        //$to  = 'aidan@example.com' . ', '; // notez la virgule
        //$to .= 'wez@example.com';

        $to = $addMail;

        // Sujet
        $subject = 'Vous avez reçu une nouvelle demande de CV sur SOSHCR  ';

        // message
        $message = $_POST['textarea_2'];

        // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // En-têtes additionnels

        // Envoi
        mail($to, $subject, $message, $headers);
        header('Location: message_demandeCV.php');
    }

}



?>
<!-- FOOTER -->
<?php include('footer.php') ?>
<!-- FOOTER -->

