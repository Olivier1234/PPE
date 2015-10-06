<?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];


switch($action){
	case 'selectionnerMois':{
                 $idVisiteur = $_REQUEST['idVisiteur'];
		$lesMois=$pdo->getMoisValider($idVisiteur);
		// Afin de sélectionner par défaut le dernier mois dans la zone de liste
		// on demande toutes les clés, et on prend la première,
		// les mois étant triés décroissants
		$lesCles = array_keys( $lesMois );
		$moisASelectionner = $lesCles[0];
		include("vues/v_listeMoisValider.php");
		break;
	}
        case 'historique':{
            
             
		$lesMois=$pdo->getMoisEtat();
		// Afin de sélectionner par défaut le dernier mois dans la zone de liste
		// on demande toutes les clés, et on prend la première,
		// les mois étant triés décroissants
		$lesCles = array_keys( $lesMois );
		$moisASelectionner = $lesCles[0];
		include("vues/v_listeMoisValider.php");
		break;
        }
         
}