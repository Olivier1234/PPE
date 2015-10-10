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
                        $supprimer = $pdo->supprimer($idVisiteur,$mois);
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
                break;
        
         
          case 'supprimer':{
                    $lesMois=$pdo->getMoisEtat();
		// Afin de sélectionner par défaut le dernier mois dans la zone de liste
		// on demande toutes les clés, et on prend la première,
		// les mois étant triés décroissants
		$lesCles = array_keys( $lesMois );
		$moisASelectionner = $lesCles[0];
                
                
                       
                        $key=$_REQUEST['key'];

                     $moisClic=$_SESSION['frais'][$key]['mois'];
                     $idForfait=$_SESSION['frais'][$key]['idForfait'];
                     $idVisiteurclic=$_SESSION['frais'][$key]['idVisiteurClic'];
                     $montant=$_SESSION['frais'][$key]['montant'];
                     $dateA=$_SESSION['frais'][$key]['date'];
                     $libelle=$_SESSION['frais'][$key]['libelle'];
                    

                      $date=dateFrancaisVersAnglais($dateA);
                     $pdo->addVisteurRefuse($idForfait,$idVisiteurclic,$moisClic,$libelle,$date,$montant);
                     $listVisiteur=$pdo->getVisiteurMois($moisClic);
                   
                        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteurclic,$moisClic);
                        $lesFraisForfait= $pdo->getLesFraisForfait($idVisiteurclic,$moisClic);
                        $supprimer = $pdo->supprimer($idVisiteurclic,$moisClic);
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
  
                    
                break;
        }
        
         case 'actualiser':{
		$lesMois=$pdo->getMoisEtat();
		// Afin de sélectionner par défaut le dernier mois dans la zone de liste
		// on demande toutes les clés, et on prend la première,
		// les mois étant triés décroissants
		$lesCles = array_keys( $lesMois );
		$moisASelectionner = $lesCles[0];
            
                
                    $mois =$_REQUEST['lstMois'];
                    $idVisiteur = $_REQUEST['idVisiteur'];
                    
                $zero=$_REQUEST['0'];
                $un=$_REQUEST['1'];
                $deux=$_REQUEST['2'];    
                $trois=$_REQUEST['3'];
              $pdo->actualiser($zero,$un,$deux,$trois,$idVisiteur,$mois);
               
                    
                    $listVisiteur=$pdo->getVisiteurMois($mois);
                    include("vues/v_visiteurMois.php");
                    
                  
                       
                        
                        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$mois);
                        $supprimer = $pdo->supprimer($idVisiteur,$mois);
                        $lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$mois);
                        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$mois);
                        $numAnnee =substr( $mois,0,4);
                        $numMois =substr( $mois,4,2);
                        $libEtat = $lesInfosFicheFrais['libEtat'];
                        $montantValide = $lesInfosFicheFrais['montantValide'];
                        $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
                        $dateModif =  $lesInfosFicheFrais['dateModif'];
                        $dateModif =  dateAnglaisVersFrancais($dateModif);
                      
                       include("vues/v_listeMoisVisiteur.php");
                       include("vues/v_etatFraisComptable.php");
                        
                    
                
                
        }
        
         case 'reporter':{
		$lesMois=$pdo->getMoisEtat();
		// Afin de sélectionner par défaut le dernier mois dans la zone de liste
		// on demande toutes les clés, et on prend la première,
		// les mois étant triés décroissants
		$lesCles = array_keys( $lesMois );
		$moisASelectionner = $lesCles[0];
                
                
                 $key=$_REQUEST['key'];
                 $moisClic=$_SESSION['frais'][$key]['mois'];
                     $idForfait=$_SESSION['frais'][$key]['idForfait'];
                     $idVisiteurclic=$_SESSION['frais'][$key]['idVisiteurClic'];
                     $montant=$_SESSION['frais'][$key]['montant'];
                     $dateA=$_SESSION['frais'][$key]['date'];
                     $libelle=$_SESSION['frais'][$key]['libelle'];
                     
                     
                  
			$numAnnee =substr( $moisClic,0,4);
			$numMois =substr( $moisClic,4,2);
			
                        if($numMois==12)
                        {
                            $numAnnee=$numAnnee+1;
                            $numMois=1;
                        }
                        else{
                            $numMois=$numMois+1;
                        }
                    
                    $pdo->reporter($idForfait,$idVisiteurclic,$moisClic);
               
                    
                    $listVisiteur=$pdo->getVisiteurMois($moisClic);
                   
                    
                  
                       
                        
                        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteurclic,$moisClic);
                        $supprimer = $pdo->supprimer($idVisiteurclic,$moisClic);
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
}