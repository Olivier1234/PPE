<?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];


switch($action){
        case 'formulaire':{
                   include('vues/v_formComptable.php');
                break;
             }
             
             case 'infosForm':{
                    $idVisiteur=$_SESSION['idVisiteur'];
                   $nom=$_REQUEST['nom'];
                   $prenom=$_REQUEST['prenom'];
                   $ville=$_REQUEST['ville'];
                   $cp=$_REQUEST['cp'];
                   $adresse=$_REQUEST['adresse'];
                   $type=$_SESSION['type'];
                   $pdo->changerInfosVisiteur($idVisiteur,$nom,$prenom,$ville,$cp,$adresse);
                    connecter($idVisiteur,$nom,$prenom,$type,$ville,$cp,$adresse);
                     include('vues/v_infosForm.php');
                break;
             }
        }