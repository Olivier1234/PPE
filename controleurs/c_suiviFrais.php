<?php
$action = $_REQUEST['action'];
if($action != "vuPdf")
{
    include("vues/v_sommaire.php");
}



switch($action){
    //case listFrais  
        //affichage des frais valider
            // creation de la SESSION listFraisV =
        //affichage des frais rembourser
            // creation de la SESSION listFraisR
    case 'listFrais':{
        $lstFraisV = $pdo->lstFraisValider();
        $_SESSION['listFraisV'] = array();
        $_SESSION['listFraisV'] = $lstFraisV; 
        $lstFraisR = $pdo->lstFraisRembourser();
        $_SESSION['listFraisR'] = array();
        $_SESSION['listFraisR'] = $lstFraisR; 
        if(isset($_REQUEST['numero']))
        {
            $num = $_REQUEST['numero']; // récupération du POST
            include("vues/v_listVisiteurDetail.php");// include vu
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($id,$mois);
            $lesFraisForfait= $pdo->getLesFraisForfait($id,$mois);
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($id,$mois);
            $supprimer = $pdo->supprimer($id,$mois); //recupération des fichefraishorsforfaitrefuser
            $numAnnee =substr( $mois,0,4);
            $numMois =substr( $mois,4,2);
            $libEtat = $lesInfosFicheFrais['libEtat'];
            $montantValide = $lesInfosFicheFrais['montantValide'];
            $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
            $dateModifi =  $lesInfosFicheFrais['dateModif'];
            $dateModif =  dateAnglaisVersFrancais($dateModifi);  
            if(isset($_REQUEST['rembourser']))
            {
                $pdo->Rembourser($id,$mois,$nbJustificatifs,$montantValide,$dateModifi,$idEtat); 
                include("vues/v_Remboursement.php");
            }
            else
            {
                include("vues/v_lstFicheDetail.php");
            }
        }
        else
        {
            include("vues/v_listFraisValider.php");
        } 
    }break;
    // case vuPdf
       // creation du pdf
       // include vu 
       // affichage du pdf
    case 'vuPdf':{
        $vpdf = $pdo->creerPDF();
        include("vues/v_creationPdf.php");
        $pdo->afficherPDF($vpdf);
    }break;
    
}