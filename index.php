<?php
require_once("include/fct.inc.php");
require_once ("include/class.pdogsb.inc.php");
if(!isset($_REQUEST['uc'])){
	$_REQUEST['uc'] = 'connexion';
}
$uc = $_REQUEST['uc'];

if($uc != "voirPdf")
{
    include("vues/v_entete.php") ;
}
session_start();

    $pdo = PdoGsb::getPdoGsb();
    $estConnecte = estConnecte();
    if(!isset($_REQUEST['uc']) || !$estConnecte)
        {
            $_REQUEST['uc'] = 'connexion';
        }


switch($uc){
	case 'connexion':{
		include("controleurs/c_connexion.php");break;
	}
	case 'gererFrais' :{
		include("controleurs/c_gererFrais.php");break;
	}
	case 'etatFrais' :{
		include("controleurs/c_etatFrais.php");break;        
	}
        case 'ValiderVisiteur':{
                include("controleurs/c_historique.php");break;
        }
        case 'suiviFrais':{
                include("controleurs/c_suiviFrais.php");break;
        }
        case 'voirPdf':{
            include("controleurs/c_suiviFrais.php");break;
        }break;     
        case 'param':{
            include("controleurs/c_paramComptable.php");break;
        }break;     
}
include("vues/v_pied.php") ;
?>