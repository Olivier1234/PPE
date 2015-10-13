<?php
/** 
 * Classe d'accès aux données. 
 
 * Utilise les services de la classe PDO
 * pour l'application GSB
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoGsb qui contiendra l'unique instance de la classe
 
 * @package default
 * @author Cheri Bibi
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */

class PdoGsb{   		
      	private static $serveur='mysql:host=localhost';
      	private static $bdd='dbname=gsbv2';   		
      	private static $user='root' ;    		
      	private static $mdp='' ;	
		private static $monPdo;
		private static $monPdoGsb=null;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	private function __construct(){
    	PdoGsb::$monPdo = new PDO(PdoGsb::$serveur.';'.PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$mdp); 
		PdoGsb::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		PdoGsb::$monPdo = null;
	}
/**
 * Fonction statique qui crée l'unique instance de la classe
 
 * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
 
 * @return l'unique objet de la classe PdoGsb
 */
	public  static function getPdoGsb(){
		if(PdoGsb::$monPdoGsb==null){
			PdoGsb::$monPdoGsb= new PdoGsb();
		}
		return PdoGsb::$monPdoGsb;  
	}
/**
 * Retourne les informations d'un visiteur 5
 
 * @param $login 
 * @param $mdp
 * @return l'id, le nom et le prénom sous la forme d'un tableau associatif 
*/
	public function getInfosVisiteur($login, $mdp){
		$req = "select visiteur.id as id, visiteur.nom as nom, visiteur.prenom as prenom, visiteur.typeVisiteur as typeVisiteur,visiteur.adresse as adresse,
                    visiteur.cp as cp, visiteur.ville as ville
                    from visiteur 
		where visiteur.login='$login' and visiteur.mdp='$mdp'";
		$rs = PdoGsb::$monPdo->query($req);
		$ligne = $rs->fetch();
		return $ligne;
	}
public function getMois(){
		$req2 = "select mois from fichefrais";
		$rs = PdoGsb::$monPdo->query($req2);
		$ligne2 = $rs->fetch();
		return $ligne2;
	}
        
        public function getMoisEtat(){
		
		  
		$req = "select fichefrais.mois as mois from  fichefrais where   idEtat='CR'
		order by fichefrais.mois desc ";
		$res = PdoGsb::$monPdo->query($req);
		$lesMois =array();
		$laLigne = $res->fetch();
		while($laLigne != null)	{
			$mois = $laLigne['mois'];
			$numAnnee =substr( $mois,0,4);
			$numMois =substr( $mois,4,2);
			$lesMois["$mois"]=array(
		     "mois"=>"$mois",
		    "numAnnee"  => "$numAnnee",
			"numMois"  => "$numMois"
             );
			$laLigne = $res->fetch(); 		
		}
		return $lesMois;
	}
	
/**
 * Retourne sous forme d'un tableau associatif toutes les lignes de frais hors forfait
 * concernées par les deux arguments
 
 * La boucle foreach ne peut être utilisée ici car on procède
 * à une modification de la structure itérée - transformation du champ date-
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return tous les champs des lignes de frais hors forfait sous la forme d'un tableau associatif 
*/
	public function getLesFraisHorsForfait($idVisiteur,$mois){
	    $req = "select * from lignefraishorsforfait where lignefraishorsforfait.idvisiteur ='$idVisiteur' 
		and lignefraishorsforfait.mois = '$mois' ";	
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		$nbLignes = count($lesLignes);
		for ($i=0; $i<$nbLignes; $i++){
			$date = $lesLignes[$i]['date'];
			$lesLignes[$i]['date'] =  dateAnglaisVersFrancais($date);
		}
		return $lesLignes; 
	}
/**
 * Retourne le nombre de justificatif d'un visiteur pour un mois donné
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return le nombre entier de justificatifs 
*/
	public function getNbjustificatifs($idVisiteur, $mois){
		$req = "select fichefrais.nbjustificatifs as nb from  fichefrais where fichefrais.idvisiteur ='$idVisiteur' and fichefrais.mois = '$mois'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		return $laLigne['nb'];
	}
/**
 * Retourne sous forme d'un tableau associatif toutes les lignes de frais au forfait
 * concernées par les deux arguments
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return l'id, le libelle et la quantité sous la forme d'un tableau associatif 
*/
	public function getLesFraisForfait($idVisiteur, $mois){
		$req = "select fraisforfait.id as idfrais, fraisforfait.libelle as libelle, 
		lignefraisforfait.quantite as quantite from lignefraisforfait inner join fraisforfait 
		on fraisforfait.id = lignefraisforfait.idfraisforfait
		where lignefraisforfait.idvisiteur ='$idVisiteur' and lignefraisforfait.mois='$mois' 
		order by lignefraisforfait.idfraisforfait";	
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes; 
	}
/**
 * Retourne tous les id de la table FraisForfait
 
 * @return un tableau associatif 
*/
	public function getLesIdFrais(){
		$req = "select fraisforfait.id as idfrais from fraisforfait order by fraisforfait.id";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
/**
 * Met à jour la table ligneFraisForfait
 
 * Met à jour la table ligneFraisForfait pour un visiteur et
 * un mois donné en enregistrant les nouveaux montants
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @param $lesFrais tableau associatif de clé idFrais et de valeur la quantité pour ce frais
 * @return un tableau associatif 
*/
	public function majFraisForfait($idVisiteur, $mois, $lesFrais){
		$lesCles = array_keys($lesFrais);
		foreach($lesCles as $unIdFrais){
			$qte = $lesFrais[$unIdFrais];
			$req = "update lignefraisforfait set lignefraisforfait.quantite = $qte
			where lignefraisforfait.idvisiteur = '$idVisiteur' and lignefraisforfait.mois = '$mois'
			and lignefraisforfait.idfraisforfait = '$unIdFrais'";
			PdoGsb::$monPdo->exec($req);
		}
		
	}
/**
 * met à jour le nombre de justificatifs de la table ficheFrais
 * pour le mois et le visiteur concerné
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
*/
	public function majNbJustificatifs($idVisiteur, $mois, $nbJustificatifs){
		$req = "update fichefrais set nbjustificatifs = $nbJustificatifs 
		where fichefrais.idvisiteur = '$idVisiteur' and fichefrais.mois = '$mois'";
		PdoGsb::$monPdo->exec($req);	
	}
/**
 * Teste si un visiteur possède une fiche de frais pour le mois passé en argument
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return vrai ou faux 
*/	
	public function estPremierFraisMois($idVisiteur,$mois)
	{
		$ok = false;
		$req = "select count(*) as nblignesfrais from fichefrais 
		where fichefrais.mois = '$mois' and fichefrais.idvisiteur = '$idVisiteur'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		if($laLigne['nblignesfrais'] == 0){
			$ok = true;
		}
		return $ok;
	}
/**
 * Retourne le dernier mois en cours d'un visiteur
 
 * @param $idVisiteur 
 * @return le mois sous la forme aaaamm
*/	
	public function dernierMoisSaisi($idVisiteur){
		$req = "select max(mois) as dernierMois from fichefrais where fichefrais.idvisiteur = '$idVisiteur'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		$dernierMois = $laLigne['dernierMois'];
		return $dernierMois;
	}
	
/**
 * Crée une nouvelle fiche de frais et les lignes de frais au forfait pour un visiteur et un mois donnés
 
 * récupère le dernier mois en cours de traitement, met à 'CL' son champs idEtat, crée une nouvelle fiche de frais
 * avec un idEtat à 'CR' et crée les lignes de frais forfait de quantités nulles 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
*/
	public function creeNouvellesLignesFrais($idVisiteur,$mois){
		$dernierMois = $this->dernierMoisSaisi($idVisiteur);
		$laDerniereFiche = $this->getLesInfosFicheFrais($idVisiteur,$dernierMois);
		if($laDerniereFiche['idEtat']=='CR'){
				$this->majEtatFicheFrais($idVisiteur, $dernierMois,'CL');
				
		}
		$req = "insert into fichefrais(idvisiteur,mois,nbJustificatifs,montantValide,dateModif,idEtat) 
		values('$idVisiteur','$mois',0,0,now(),'CR')";
		PdoGsb::$monPdo->exec($req);
		$lesIdFrais = $this->getLesIdFrais();
		foreach($lesIdFrais as $uneLigneIdFrais){
			$unIdFrais = $uneLigneIdFrais['idfrais'];
			$req = "insert into lignefraisforfait(idvisiteur,mois,idFraisForfait,quantite) 
			values('$idVisiteur','$mois','$unIdFrais',0)";
			PdoGsb::$monPdo->exec($req);
		 }
	}
/**
 * Crée un nouveau frais hors forfait pour un visiteur un mois donné
 * à partir des informations fournies en paramètre
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @param $libelle : le libelle du frais
 * @param $date : la date du frais au format français jj//mm/aaaa
 * @param $montant : le montant
*/
	public function creeNouveauFraisHorsForfait($idVisiteur,$mois,$libelle,$date,$montant){
		$dateFr = dateFrancaisVersAnglais($date);
		$req = "insert into lignefraishorsforfait 
		values('','$idVisiteur','$mois','$libelle','$dateFr','$montant')";
		PdoGsb::$monPdo->exec($req);
	}
/**
 * Supprime le frais hors forfait dont l'id est passé en argument
 
 * @param $idFrais 
*/
	public function supprimerFraisHorsForfait($idFrais){
		$req = "delete from lignefraishorsforfait where lignefraishorsforfait.id =$idFrais ";
		PdoGsb::$monPdo->exec($req);
	}
/**
 * Retourne les mois pour lesquel un visiteur a une fiche de frais
 
 * @param $idVisiteur 
 * @return un tableau associatif de clé un mois -aaaamm- et de valeurs l'année et le mois correspondant 
*/
	public function getLesMoisDisponibles($idVisiteur){
		$req = "select fichefrais.mois as mois from  fichefrais where fichefrais.idvisiteur ='$idVisiteur'  
		order by fichefrais.mois desc ";
		$res = PdoGsb::$monPdo->query($req);
		$lesMois =array();
		$laLigne = $res->fetch();
		while($laLigne != null)	{
			$mois = $laLigne['mois'];
			$numAnnee =substr( $mois,0,4);
			$numMois =substr( $mois,4,2);
			$lesMois["$mois"]=array(
		     "mois"=>"$mois",
		    "numAnnee"  => "$numAnnee",
			"numMois"  => "$numMois"
             );
			$laLigne = $res->fetch(); 		
		}
		return $lesMois;
	}
        
        public function getMoisValider($idVisiteur){
		$req = "select fichefrais.mois as mois from  fichefrais where fichefrais.idvisiteur ='$idVisiteur'  and idEtat='CR'
		order by fichefrais.mois desc ";
		$res = PdoGsb::$monPdo->query($req);
		$lesMois =array();
		$laLigne = $res->fetch();
		while($laLigne != null)	{
			$mois = $laLigne['mois'];
			$numAnnee =substr( $mois,0,4);
			$numMois =substr( $mois,4,2);
			$lesMois["$mois"]=array(
		     "mois"=>"$mois",
		    "numAnnee"  => "$numAnnee",
			"numMois"  => "$numMois"
             );
			$laLigne = $res->fetch(); 		
		}
		return $lesMois;
	}
/**
 * Retourne les informations d'une fiche de frais d'un visiteur pour un mois donné
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return un tableau avec des champs de jointure entre une fiche de frais et la ligne d'état 
*/	
	public function getLesInfosFicheFrais($idVisiteur,$mois){
		$req = "select ficheFrais.idEtat as idEtat, ficheFrais.dateModif as dateModif, ficheFrais.nbJustificatifs as nbJustificatifs, 
			ficheFrais.montantValide as montantValide, etat.libelle as libEtat from  fichefrais inner join Etat on ficheFrais.idEtat = Etat.id 
			where fichefrais.idvisiteur ='$idVisiteur' and fichefrais.mois = '$mois'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		return $laLigne;
	}
/**
 * Modifie l'état et la date de modification d'une fiche de frais
 
 * Modifie le champ idEtat et met la date de modif à aujourd'hui
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 */
 
	public function majEtatFicheFrais($idVisiteur,$mois,$etat){
		$req = "update ficheFrais set idEtat = '$etat', dateModif = now() 
		where fichefrais.idvisiteur ='$idVisiteur' and fichefrais.mois = '$mois'";
		PdoGsb::$monPdo->exec($req);
	}
        
        /*
         * retourne les visiteur pour un mois donner
         * @param $mois sous forme aaaamm
         * 
         */
         
         function getVisiteurMois($mois){
            $req = "select visiteur.id,visiteur.nom,visiteur.prenom from visiteur ,fichefrais  where visiteur.id = fichefrais.idVisiteur and fichefrais.mois='".$mois."' and idEtat ='CR'";
            $res = PdoGsb::$monPdo->query($req);
            $listVisiteur = $res->fetchAll(); 
            return $listVisiteur;
        }
        /*
         * retourne les fraishorsforfaitrefuse 
         * @param $idVisiteur id du visiteur selectionné
         * @param $mois mois selectionner sous forme aaaamm
         * 
         */
   function supprimer($idVisteur,$mois){
             $sql="select * from lignefraishorsforfaitrefuse where idVisiteur='".$idVisteur."' and mois='".$mois."';";
		$res = PdoGsb::$monPdo->query($sql);
		$lesLignes = $res->fetchAll();
		$nbLignes = count($lesLignes);
		for ($i=0; $i<$nbLignes; $i++){
			$date = $lesLignes[$i]['date'];
			$lesLignes[$i]['date'] =  dateAnglaisVersFrancais($date);
		}
		return $lesLignes; 
        }
        /*
         * insert les frais forfait dans frais forfait refuse et supprimer dans fiche frais forfait
         * 
         @param $idVisiteur du frais forfait
         @param $mois mois selectionner sous forme aaaamm
         *@param $id id du frais hors forfait
         * @param $libelle libelle de frais hors forfait
         *@param $date date de frais hors forfait
         * @param $montant montant de frais hors forfait
         */
     
        
        function addVisteurRefuse($id,$idVisiteur,$mois,$libelle,$date,$montant){
        
            $libelle2="refusé $libelle";
             $sql="update lignefraishorsforfait set libelle='$libelle2' where idVisiteur='$idVisiteur' and mois='$mois' and id='$id'";
            PdoGsb::$monPdo->exec($sql);
             $sql="insert into lignefraishorsforfaitrefuse values($id,'$idVisiteur','$mois','$libelle2','$date',$montant)";
            PdoGsb::$monPdo->exec($sql);
        }
        
        /*
         * update les frais forfais 
         * 
         */
         function actualiser($zero,$un,$deux,$trois,$idVisiteur,$mois){
        
             $sql="update lignefraisforfait set quantite=$zero where idVisiteur='$idVisiteur' and mois='$mois' and idFraisForfait='ETP'";
            PdoGsb::$monPdo->exec($sql);
            
             $sql="update lignefraisforfait set quantite=$un where idVisiteur='$idVisiteur' and mois='$mois' and idFraisForfait='KM'";
            PdoGsb::$monPdo->exec($sql);
            
             $sql="update lignefraisforfait set quantite=$deux where idVisiteur='$idVisiteur' and mois='$mois' and idFraisForfait='NUI'";
            PdoGsb::$monPdo->exec($sql);
            
             $sql="update lignefraisforfait set quantite=$trois where idVisiteur='$idVisiteur' and mois='$mois' and idFraisForfait='REP'";
            PdoGsb::$monPdo->exec($sql);
        }
        
        /*update les frais hors forfait en augmenter le mois de 1
         */
        
        function reporter($id,$idVisiteur,$mois){
            
			$numAnnee =substr( $mois,0,4);
			$numMois =substr( $mois,4,2);
			
                        if($numMois==12)
                        {
                            $numAnnee=$numAnnee+1;
                            $numMois=1;
                        }
                        else{
                            $numMois=$numMois+1;
                        }
		     
             $sql="update lignefraishorsforfait set mois='".$numAnnee.$numMois."' where idVisiteur='$idVisiteur' and mois='$mois' and id=$id";
            PdoGsb::$monPdo->exec($sql);
            
        }
        
        /*
         * change idEtat de la fiche frais en VA
         * change le montantValide avec le montant calculer $ total en param
         * change la date de Modif de la derniere date 
         * 
         */
    function valider($id,$mois,$total,$date){
            $updateVal="update fichefrais set idEtat ='VA' where idVisiteur='$id' and mois ='$mois'";
            PdoGsb::$monPdo->exec($updateVal);
            $updateVal="update fichefrais set montantValide=$total where idVisiteur ='$id' and mois='$mois'";
            PdoGsb::$monPdo->exec($updateVal);   
            $updateVal="update fichefrais set dateModif='$date' where idVisiteur ='$id' and mois='$mois'";
            PdoGsb::$monPdo->exec($updateVal);   
    }
    
    /*
     * update le nombre de justificaif de fiche frais
     */
    function justificatif($id,$mois,$nbJustificatif){
            $updateVal="update fichefrais set nbJustificatifs=$nbJustificatif where idVisiteur='$id' and mois ='$mois'";
            PdoGsb::$monPdo->exec($updateVal);
           
    }
    // fonction qui recupère toutes les informations d'un visiteur
    public function infoVisiteur($id){
            $req = "select * from visiteur where visiteur.id='$id'";
		$rs = PdoGsb::$monPdo->query($req);
		$ligne = $rs->fetch();
		return $ligne;
        }
      // fonction qui récupère tous les montants des fiche de frais forfait  
      public function getLesMontantFrais(){
		$req = "select fraisforfait.montant  from fraisforfait order by fraisforfait.id";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
        
        /* 
         * update les informations personnel du visiteur
         */
         function changerInfosVisiteur($idVisiteur,$nom,$prenom,$ville,$cp,$adresse){
     $sql="update visiteur set nom='$nom' where id='$idVisiteur'";
      PdoGsb::$monPdo->exec($sql);   
      $sql="update visiteur set prenom='$prenom' where id='$idVisiteur'";
      PdoGsb::$monPdo->exec($sql);   
      $sql="update visiteur set ville='$ville' where id='$idVisiteur'";
      PdoGsb::$monPdo->exec($sql);   
      $sql="update visiteur set cp='$cp' where id='$idVisiteur'";
      PdoGsb::$monPdo->exec($sql);   
      $sql="update visiteur set adresse='$adresse' where id='$idVisiteur'";
      PdoGsb::$monPdo->exec($sql);   
 }
    // fonction update fichefrais de VA a RB
        /* @param $id récupère l'id
         * @param $mois récupère le mois
         * @param $nbJustificatifs recupère le nombre de justificatif
         * @param $idEtat recupère l'id Etat
         * @param $montantValide //
         * @param $dateModifi //
         */
        function Rembourser($id,$mois,$nbJustificatifs,$montantValide,$dateModifi,$idEtat){
            $updateFR="update fichefrais set fichefrais.idEtat = 'RB' where idVisiteur ='$id' and fichefrais.mois = '$mois' and montantValide =$montantValide and fichefrais.nbJustificatifs = $nbJustificatifs and fichefrais.dateModif ='$dateModifi' and fichefrais.idEtat ='$idEtat'";
            PdoGsb::$monPdo->exec($updateFR);
        }
        // récupère le dernier moi de la base de donnée (max(mois))
        public function dernierMois(){
		$req = "select max(mois) as dernierMois from fichefrais";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		$dernierMois = $laLigne['dernierMois'];
		return $dernierMois;
	}
        // affichage de la liste frais Valider VA
        public function lstFraisValider(){
 		$req = "select id,mois,nom,prenom,nbJustificatifs,montantValide,dateModif,idEtat  from fichefrais, visiteur  where visiteur.id = fichefrais.idVisiteur and fichefrais.idEtat = 'VA' "
                        . "order by mois desc,id ";
		$res = PdoGsb::$monPdo->query($req);
		$lstFraisV = $res->fetchall();
		return $lstFraisV;           
        }
        // Affichage de la liste des frais rembourser du dernier mois -1 
        public function lstFraisRembourser(){
                $mois = $this->dernierMois();
                $mois = $mois -1;
 		$req = "select id,mois,nom,prenom,nbJustificatifs,montantValide,dateModif,idEtat  from fichefrais, visiteur  where visiteur.id = fichefrais.idVisiteur and fichefrais.idEtat = 'RB' and mois='".$mois."' order by dateModif desc,mois ";
                $res = PdoGsb::$monPdo->query($req);
		$lstFraisV = $res->fetchall();
		return $lstFraisV;           
        }
        // Recupère la somme des montants hors forfait refuser d'un visiteur pour un certain mois
        public function montantJust($id,$mois){
                $req = "select sum(montant) as montantRe from lignefraishorsforfaitrefuse where idVisiteur='$id' and mois='$mois'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
                $ligne = $laLigne['montantRe'];
		return $ligne;
        }
        //function creation du pdf 
            // Récupération de toutes les variables importante pour l'affichage du  pdf 
        function creerPDF(){
            $num = $_REQUEST['numeroPDF'];
            $vpdf =array();
            $id = $_SESSION['listFraisR'][$num]["id"];
            $nom = $_SESSION['listFraisR'][$num]["nom"];
            $prenom = $_SESSION['listFraisR'][$num]["prenom"];
            $mois = $_SESSION['listFraisR'][$num]["mois"];
//            $nbJustificatifs = $_SESSION['listFraisR'][$num]["nbJustificatifs"];
//            $montantValide = $_SESSION['listFraisR'][$num]["montantValide"];
//            $dateModif = $_SESSION['listFraisR'][$num]["dateModif"];
            $idEtat = $_SESSION['listFraisR'][$num]["idEtat"];
            
            $infoV = $this->infoVisiteur($id);
            $adresse = $infoV["adresse"];
            $cp = $infoV["cp"];
            $ville = $infoV["ville"];
            $dateEmbauche = $infoV["dateEmbauche"];
            $typeVisiteur = $infoV["typeVisiteur"];
            $montantRefuse = $this->montantJust($id,$mois);
            $lesFraisHorsForfait = $this->getLesFraisHorsForfait($id,$mois);
            $lesFraisForfait= $this->getLesFraisForfait($id,$mois);
            $lesInfosFicheFrais = $this->getLesInfosFicheFrais($id,$mois);
            $lesMontantFrais = $this->getLesMontantFrais();
            $numAnnee =substr( $mois,0,4);
            $numMois =substr( $mois,4,2);
            $libEtat = $lesInfosFicheFrais['libEtat'];
            $montantValide = $lesInfosFicheFrais['montantValide'];
            $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
            $dateModifi =  $lesInfosFicheFrais['dateModif'];
            $dateModif =  dateAnglaisVersFrancais($dateModifi);
            $quantite= array();
            $libelle =array();
            $montant = array();
            $montantT =array();

            foreach ($lesMontantFrais as $unMontantFrais) 
            {
		$montant[] = $unMontantFrais['montant'];
            }
            foreach (  $lesFraisForfait as $unFraisForfait  ) 
            {
		$quantite[] = $unFraisForfait['quantite'];
            }
            foreach ( $lesFraisForfait as $unFraisForfait ) 
            {
		$libelle[] = $unFraisForfait['libelle'];
            }
            for($i=0; $i<=4;$i++)
            {
                $montantT[] = $quantite[$i] * $montant[$i] ;
            }
            //faux montant refuse
            $vpdf['montRefuse']= $montantRefuse;
            $vpdf['dateNow']= date("d/m/Y");
            $vpdf['montantT'] = $montantT;
            $vpdf['montant'] = $montant;
            $vpdf['quantite']=$quantite;
            $vpdf['libelle']=$libelle;
            $vpdf['id'] = $id;
            $vpdf['euros'] = chr(128);
            $vpdf['nom'] = $nom;
            $vpdf['prenom'] = $prenom;
            $vpdf['mois'] = $mois;
            $vpdf['numMois'] = $numMois;
            $vpdf['numAnnee'] = $numAnnee;
            $vpdf['nbJust'] = $nbJustificatifs;
            $vpdf['montVal'] = $montantValide;
            $vpdf['dateMo'] = $dateModif;
            $vpdf['idEtat'] = $idEtat;
            $vpdf['adresse'] = $adresse;
            $vpdf['ville'] = $ville;
            $vpdf['cp'] = $cp;
            $vpdf['dateEmbauche'] = $dateEmbauche;
            $vpdf['typeVisiteur'] = $typeVisiteur;
            return $vpdf; 
        }
        // Affichage du pdf 
            // utilisation de la classe PDF_MC_Table() qui a un include fpdf.php
                // Utilisation de Multicell,SetFont, AddPage, SetYX, Row, Table, Image
        function afficherPDF($vpdf){
            require('fpdf/mc_table.php');
            $pdf=ob_get_clean();
            $pdf=new PDF_MC_Table();
            $pdf->AddPage();
            $pdf->SetFont('Times','',12);
            $pdf->Image("images/logo.png", 7, 5, 50.9);
            $pdf->SetXY(9, 15);  
            $pdf->RoundedRect(95, 54, 110, 35, 2, 'D');
            $pdf->SetXY(9, 40);
            $pdf->MultiCell(80, 5, utf8_decode("Siège social : GSB\nPhiladelphie, \nPennsylvanie, Etats-Unis\ngsb_galaxybourdin@gmail.com "), 0, "L", 0);
            $pdf->SetXY(100, 57);
            $pdf->MultiCell(100,7,utf8_decode("Client :  ".$vpdf['nom']." ".$vpdf['prenom']."\nAdresse : ".$vpdf['adresse']."\nCode postal : ".$vpdf['cp']."\nVille : ".$vpdf['ville']), 0, "L", 0);
            $pdf->SetXY(9, 100);
            $pdf->MultiCell(80, 5, utf8_decode("Remboursement du :  ".$vpdf['numMois']." / ".$vpdf['numAnnee']), 0, "L", 0);
            $pdf->SetWidths(array(47.5,47.5,47.5,47.5));
            srand(microtime()*1000000); 
            $pdf->SetXY(10, 110);
            $pdf->MultiCell(190,7, utf8_decode('Eléments forfaitisés'), 1, "L", 0);
            $pdf->Row2(array('Frais forfaitaires',utf8_decode('Quantité'),'Montant unitaire','Montant total'));
            $pdf->Row2(array($vpdf['libelle'][0],utf8_decode($vpdf['quantite'][0]),$vpdf['montant'][0],$vpdf['montantT'][0]." ".html_entity_decode($vpdf['euros'])));
            $pdf->Row2(array(utf8_decode($vpdf['libelle'][1]),utf8_decode($vpdf['quantite'][1]),$vpdf['montant'][1],$vpdf['montantT'][1]." ".html_entity_decode($vpdf['euros'])));
            $pdf->Row2(array(utf8_decode($vpdf['libelle'][2]),utf8_decode($vpdf['quantite'][2]),$vpdf['montant'][2],$vpdf['montantT'][2]." ".html_entity_decode($vpdf['euros'])));
            $pdf->Row2(array(utf8_decode($vpdf['libelle'][3]),utf8_decode($vpdf['quantite'][3]),$vpdf['montant'][3],$vpdf['montantT'][3]." ".html_entity_decode($vpdf['euros'])));
            $pdf->SetXY(10, 157);
            mysql_connect('localhost','root','');
            mysql_select_db('gsbv2');
            //First table: put all columns automatically
            $pdf->MultiCell(190,7, utf8_decode('Eléments hors forfait'), 1, "L", 0);
            $prop=array('HeaderColor'=>array(205,216,211),
                        'color1'=>array(255,255,255),
                        'color2'=>array(255,255,250),
                        'padding'=>2);
            $pdf->AddCol('date',35,'','Date');
            $pdf->AddCol('libelle',105,'Libelle');
            $pdf->AddCol('montant',50,'Montant','R');
            $pdf->Table("select date,libelle,montant  from lignefraishorsforfait lf where lf.mois='".$vpdf['mois']."' and lf.idVisiteur='".$vpdf['id']."' "
                    . "UNION ALL (select date,libelle,montant as idlfr from lignefraishorsforfaitrefuse lfr where lfr.mois='".$vpdf['mois']."' and lfr.idVisiteur='".$vpdf['id']."')",$prop);
            $pdf->SetXY(10, 200);
            $pdf->MultiCell(190,7, utf8_decode('Eléments hors forfait refusé'), 1, "L", 0);
            $pdf->AddCol('date',35,'','Date');
            $pdf->AddCol('libelle',105,'Libelle');
            $pdf->AddCol('montant',50,'Montant','R');
            $pdf->Table("select date,libelle,montant  from lignefraishorsforfaitrefuse where mois='".$vpdf['mois']."' and idVisiteur='".$vpdf['id']."'",$prop);
            $pdf->SetXY(130, 230);
            $pdf->MultiCell(70,7,"Total du ".$vpdf['numMois']." / ".$vpdf['numAnnee']." : ".$vpdf['montVal']." ".html_entity_decode($vpdf['euros'])."\nNombre de justificatifs : ".$vpdf['nbJust']." ".utf8_decode("\nMontant refusé :").$vpdf['montRefuse']." ".html_entity_decode($vpdf['euros'])."\nFait le : ".$vpdf['dateNow']."", 1, "R", 0);
            $pdf->Output();
        }
}
