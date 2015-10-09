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
                
                if(isset($_SESSION['frais'])){
                        $moisC=true; 
                        $key=$_REQUEST['key'];
                        $moisClic=$_SESSION['frais'][$key]['mois'];

                     $idVisiteurclic=$_SESSION['frais'][$key]['idVisiteurClic'];
                     $montant=$_SESSION['frais'][$key]['montant'];
                     $date=$_SESSION['frais'][$key]['date'];
                     $libelle=$_SESSION['frais'][$key]['libelle'];
                           // $pdo->addVisteurRefuse($idVisiteur,$moisClic,$_SESSION['libelle'],$_SESSION['date'],$_SESSION['montant']);
                    $listVisiteur=$pdo->getVisiteurMois($moisClic);
                   
                        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteurclic,$moisClic);
                        $lesFraisForfait= $pdo->getLesFraisForfait($idVisiteurclic,$moisClic);
                        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteurclic,$moisClic);
                        $numAnnee =substr( $moisClic,0,4);
                        $numMois =substr( $moisClic,4,2);
                        $libEtat = $lesInfosFicheFrais['libEtat'];
                        $montantValide = $lesInfosFicheFrais['montantValide'];
                        $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
                        $dateModif =  $lesInfosFicheFrais['dateModif'];
                        $dateModif =  dateAnglaisVersFrancais($dateModif); 
                        include("vues/v_listeMoisVisiteur.php");
                     
                       include("vues/v_etatFraisComptable.php");
                        
                       
                        unset($moisClic);
                        unset($idVisiteurclic);
                        unset($_SESSION['frais']);
                         
                    }
                
                
                else{ 
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
                      
                        include("vues/v_etatFraisComptable.php");
                        
                    }
                }
                }
        }
                break;
        
         
          case 'supprimer':{
                    
                break;
        }
}