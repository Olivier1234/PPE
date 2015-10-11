<form action="index.php?uc=ValiderVisiteur&action=actualiser" method="POST">
<h3>Fiche de frais du mois <?php echo $numMois."-".$numAnnee?> : 
    </h3>
    <div class="encadre">
    <p>
        Etat : <?php echo $libEtat?> depuis le <?php echo $dateModif?> <br> Montant validé : <?php echo $montantValide?>
              
                     
    </p>
  	<table class="listeLegere">
  	   <caption>Eléments forfaitisés </caption>
        <tr>
         <?php
         foreach ( $lesFraisForfait as $unFraisForfait ) 
		 {
			$libelle = $unFraisForfait['libelle'];
		?>	
			<th> <?php echo $libelle?></th>
		 <?php
        }
		?>
                        <th> Action</th>
		</tr>
        <tr>
        <?php
        $totalQuantite=0;
          foreach (  $lesFraisForfait as $i=>$unFraisForfait  ) 
		  {
				$quantite = $unFraisForfait['quantite'];
                                if($i==0){
                                    $totalQuantite=$totalQuantite+($quantite*110);
                                }
                                 if($i==1){
                                    $totalQuantite=$totalQuantite+($quantite*0.62);
                                }
                                 if($i==2){
                                    $totalQuantite=$totalQuantite+($quantite*80);
                                }
                                 if($i==3){
                                    $totalQuantite=$totalQuantite+($quantite*25);
                                }
		?>
                
               <td class="qteForfait"><input type="text"id="inputFrais" value="<?php echo $quantite?>" name="<?php echo $i?>"> </td>
		 <?php
          }
          ?>  <td><input type="submit"  value="Actualiser"></td>
		</tr>
    </table> 
     <input type="hidden" name="lstMois" value="<?php echo $mois?>">
          <input type="hidden" name="idVisiteur" value="<?php echo $idVisiteur?>">
  
</form>
  	<table class="listeLegere">
  	   <caption>Descriptif des éléments hors forfait -<?php echo $nbJustificatifs ?> justificatifs reçus -
       </caption>
             <tr>
                <th class="date">Date</th>
                <th class="libelle">Libellé</th>
                <th class='montant'>Montant</th>      
                <th class='Action'>Action</th> 
             </tr>
        <?php     
        $_session['frais']=array();
          foreach ( $lesFraisHorsForfait as $key => $unFraisHorsForfait ) 
		  { 
                   
                        $idForfait = $unFraisHorsForfait['id'];
                        $idVisiteur = $unFraisHorsForfait['idVisiteur'];
                        $mois = $unFraisHorsForfait['mois'];
			$date = $unFraisHorsForfait['date'];
			$libelle = $unFraisHorsForfait['libelle'];
			$montant = $unFraisHorsForfait['montant'];
                        
                        $_SESSION['frais'][$key]['idForfait']=$idForfait;
                        $_SESSION['frais'][$key]['montant']=$montant;
                        $_SESSION['frais'][$key]['mois']=$mois;
                        $_SESSION['frais'][$key]['idVisiteurClic']=$idVisiteur;
                        $_SESSION['frais'][$key]['libelle']=$libelle;
                        $_SESSION['frais'][$key]['date']=$date;
                        
		?>
             
              <tr>
                <td><?php echo $date ?></td>
                <td><?php echo $libelle ?></td>
                <td><?php echo $montant ?></td>
                
                <td> <a href="index.php?uc=ValiderVisiteur&lstMois=<?php echo $mois?>&idVisiteur=<?php echo $idVisiteur?>&action=supprimer&key=<?php echo $key;?>"> supprimer </a>
                 <a href="index.php?uc=ValiderVisiteur&action=reporter&key=<?php echo $key;?>"> Reporter </a></td>
              </tr>
              <?php  $totalQuantite= $totalQuantite+$montant;

                     }
                     
                 foreach ( $supprimer as  $unsupprimer ) 
		  { 
                	$date = $unsupprimer['date'];
			$libelle = $unsupprimer['libelle'];
			$montant = $unsupprimer['montant'];
		?>
             <tr>
                 <?php  ;?>
                <td><?php echo $date ?></td>
                <td><?php echo " refusé ".$libelle ?></td>
                <td><?php echo $montant ?></td>
                
              <?php  }  ?>
                            
             </tr>
       
    </table>

<form action="index.php?uc=ValiderVisiteur&action=justificatif" method="POST">
           
            <?php if(isset($mois)){ ?>
                   <input type="hidden" name="lstMois" value="<?php echo $mois?>">
                  <input type="hidden" name="idVisiteur" value="<?php echo $idVisiteur?>">

            <?php } ?>
            <label> nombre de justificatif : </label>
            <input type="text" name="justificatif" value="<?php echo $nbJustificatifs?>">
            <input type="submit" value="Ok" >
</form></br>
<form action="index.php?uc=ValiderVisiteur&action=Valider&total=<?php echo $totalQuantite;?>" method="POST">
    
    <?php if(isset($mois)){ ?>
            <input type="hidden" name="mois" value="<?php echo $mois?>">
          <input type="hidden" name="idVisiteur" value="<?php echo $idVisiteur?>">
          <input type="submit" value="valider" >
    <?php } ?>
</form>


  </div>
 













