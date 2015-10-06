<?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];


switch($action){
        case 'historique':{
		$lesMois=$pdo->getMoisEtat();
		// Afin de sélectionner par défaut le dernier mois dans la zone de liste
		// on demande toutes les clés, et on prend la première,
		// les mois étant triés décroissants
		$lesCles = array_keys( $lesMois );
		$moisASelectionner = $lesCles[0];
		include("vues/v_listeMoisValider.php");
                if(isset($_REQUEST['lstMois']))
                {    
                    $mois =$_REQUEST['lstMois'];
                    $listVisiteur=$pdo->getVisiteurMois($mois);
                    include("vues/v_visiteurMois.php");
                    if(isset($_REQUEST['idVisiteur']))
                    {
                        $idVisiteur = $_REQUEST['idVisiteur'];
                        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$mois);
                        $lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$mois);
                        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$mois);
                        $numAnnee =substr( $mois,0,4);
                        $numMois =substr( $mois,4,2);
                        $libEtat = $lesInfosFicheFrais['libEtat'];
                        $montantValide = $lesInfosFicheFrais['montantValide'];
                        $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
                        $dateModif =  $lesInfosFicheFrais['dateModif'];
                        $dateModif =  dateAnglaisVersFrancais($dateModif);
                        include("vues/v_etatFrais.php");
                    }
                }
                break;
        }
         
}