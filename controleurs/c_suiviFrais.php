<?php
$action = $_REQUEST['action'];
if($action != "vuPdf")
{
    include("vues/v_sommaire.php");
}



switch($action){
    
    case 'listFrais':{
        $lstFraisV = $pdo->lstFraisValider();
        $_SESSION['listFraisV'] = array();
        $_SESSION['listFraisV'] = $lstFraisV; 
        $lstFraisR = $pdo->lstFraisRembourser();
        $_SESSION['listFraisR'] = array();
        $_SESSION['listFraisR'] = $lstFraisR; 
        if(isset($_REQUEST['numero']))
        {
            $num = $_REQUEST['numero'];
            include("vues/v_listVisiteurDetail.php");
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($id,$mois);
            $lesFraisForfait= $pdo->getLesFraisForfait($id,$mois);
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($id,$mois);
            $supprimer = $pdo->supprimer($id,$mois);
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
    case 'vuPdf':{
        $vpdf = $pdo->creerPDF();
        include("vues/v_creationPdf.php");
        $pdo->afficherPDF($vpdf);
    }break;
    
}