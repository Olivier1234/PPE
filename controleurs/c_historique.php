<?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];


switch($action){
        case 'historique':{
                /*
                 * affiche les mois ou il y a des frais à valider
                 * si le mois a ete choisi dmet la vue du choix visiteur correspondant au mois
                 * garde le mois en selected
                 * affiche les fiches frais ,fiche frais horsforfait et fiche frais hors forfait refuse si les 
                 * visiteur et mois son selectionner
                 */
             
                $date=date('Y-m-d');
		$lesMois=$pdo->getMoisEtat();
		$lesCles = array_keys( $lesMois );
                if(isset($_REQUEST['lstMois']))
                {   
                    $mois =$_REQUEST['lstMois'];  
                }
                
		$moisASelectionner = $lesCles[0];
                include("vues/v_listeMoisValider.php");
                if(isset($_REQUEST['lstMois']))
                {
                    if($_REQUEST['lstMois'] != '...')
                    {
                    $listVisiteur=$pdo->getVisiteurMois($mois);
                    include("vues/v_visiteurMois.php");                   
                    if(isset($_REQUEST['idVisiteur']))
                    {
                        if($_REQUEST['idVisiteur'] != '...')
                        {
                            $idVisiteur = $_REQUEST['idVisiteur'];
                            include("vues/v_fonction.php");
                            include("vues/v_etatFraisComptable.php");   
                        }
                    }
                    }
                }
                
                break;
             }
                
          
          case 'supprimer':{
                    /*supprime la ligne dans frais hors forfait 
                     * ajoute la ligne hors forfait dans hors forfait  refuse 
                     * 
                     */
                     $lesMois=$pdo->getMoisEtat();
                     $lesCles = array_keys( $lesMois );
                     $moisASelectionner = $lesCles[0];
                     $key=$_REQUEST['key'];
                     $mois=$_SESSION['frais'][$key]['mois'];
                     $idForfait=$_SESSION['frais'][$key]['idForfait'];
                     $idVisiteur=$_SESSION['frais'][$key]['idVisiteurClic'];
                     $montant=$_SESSION['frais'][$key]['montant'];
                     $dateA=$_SESSION['frais'][$key]['date'];
                     $libelle=$_SESSION['frais'][$key]['libelle'];
                     $date=dateFrancaisVersAnglais($dateA);
                      $libelle2="refusé $libelle";
                      
           
        
                     $pdo->addVisteurRefuse($idForfait,$idVisiteur,$mois,$libelle,$date,$montant);
                     $listVisiteur=$pdo->getVisiteurMois($mois);
                   include("vues/v_listeMoisValider.php");
                   include("vues/v_visiteurMois.php");  
                   include("vues/v_fonction.php");  
                   include("vues/v_etatFraisComptable.php");
                   
                    
                break;
        }
        
         case 'actualiser':{
		$lesMois=$pdo->getMoisEtat();
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
                include("vues/v_listeMoisValider.php");              
                include("vues/v_visiteurMois.php");
                include("vues/v_fonction.php");
                include("vues/v_etatFraisComptable.php");  
                break;     
        }
        
         case 'reporter':{
		$lesMois=$pdo->getMoisEtat();
		$lesCles = array_keys( $lesMois );
		$moisASelectionner = $lesCles[0];
                $key=$_REQUEST['key'];
                $mois=$_SESSION['frais'][$key]['mois'];
                $idForfait=$_SESSION['frais'][$key]['idForfait'];
                $idVisiteur=$_SESSION['frais'][$key]['idVisiteurClic'];
                $montant=$_SESSION['frais'][$key]['montant'];
                $dateA=$_SESSION['frais'][$key]['date'];
                $libelle=$_SESSION['frais'][$key]['libelle'];
                $pdo->reporter($idForfait,$idVisiteur,$mois);
                $listVisiteur=$pdo->getVisiteurMois($mois);
                include("vues/v_listeMoisValider.php");
                include("vues/v_visiteurMois.php");  
                include("vues/v_fonction.php");
                include("vues/v_etatFraisComptable.php");
                
                break;
        }
        
        case 'Valider':{ 
                $date=date('Y-m-d');
                $lesMois=$pdo->getMoisEtat();
		$lesCles = array_keys( $lesMois );
		$moisASelectionner = $lesCles[0];
                $moisVal= $_REQUEST['mois'];
                $idVisiteur= $_REQUEST['idVisiteur'];
                include("vues/v_listeMoisValider.php");
                $total=  $_REQUEST['total'];
                $pdo->valider($idVisiteur,$moisVal,$total,$date);    
                 
                break;           
        }
        
        case 'justificatif':{
               
                $lesMois=$pdo->getMoisEtat();
		$lesCles = array_keys( $lesMois );
		$moisASelectionner = $lesCles[0];
                $mois= $_REQUEST['lstMois'];
                $idVisiteur= $_REQUEST['idVisiteur']; 
                $nbJustificatif= $_REQUEST['justificatif'];
                include("vues/v_listeMoisValider.php");
                $pdo->justificatif($idVisiteur,$mois,$nbJustificatif);    
                $listVisiteur=$pdo->getVisiteurMois($mois);
                include("vues/v_visiteurMois.php");
                include("vues/v_fonction.php");
                include("vues/v_etatFraisComptable.php");    
                
                break;           
        }

}